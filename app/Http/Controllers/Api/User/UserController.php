<?php

namespace App\Http\Controllers\Api\User;

use App\Models\UniversityProfile;
use App\Models\User;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,api');
    }

    public function index(Request $request)
    {
        $users = User::selectRaw('first_name, last_name, middle_name, groups.name as group_name, disciplines.name as discipline_name, university_profiles.studentID, university_profiles.module, university_profiles.budget, university_profiles.grants', [])
                    ->leftJoin('disciplines', 'users.discipline_id', '=', 'disciplines.id')
                    ->leftJoin('university_profiles', 'university_profiles.id', '=', 'users.id')
                    ->leftJoin('groups', 'university_profiles.group_id', '=', 'groups.id');

        if ($sort = $request->input('sort')) {
            $order = $request->input('order') ?: '';
            if (in_array($sort, User::getModel()->getAttributes())) {
                $users->orderByRaw('users.' . $sort . ' ' . $order);
            } elseif (in_array($sort, UniversityProfile::getModel()->getVisible())) {
                $users->orderByRaw('university_profiles.' . $sort . ' ' . $order);
            }
        } else {
            $users->orderByRaw('users.discipline_id');
        }
        $users = $users->paginate(10);

        return response()->json($users);
    }

    /**
     * Фильтр пользователей по аттрибутам.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        return response()->json($this->searchUsers($request)->paginate(10));
    }

    /**
     * Экспорт в excel.
     *
     * @param Request $request
     */
    public function export(Request $request)
    {
        $users = $this->searchUsers($request)->get();

        $userExportedAttributes = (new User())->exportedAttributes;
        $universityProfileExportedAttributes = (new UniversityProfile())->exportedAttributes;

        $output = [];

        $output[] = array_merge(array_values($userExportedAttributes), array_values($universityProfileExportedAttributes));

        foreach ($users as $user) {
            $temp = [];
            foreach ($userExportedAttributes as $attribute => $attributeTranslation) {
                if ($attribute == 'discipline') {
                    $temp[] = $user->discipline->name;
                } else {
                    $temp[] = $user->{$attribute};
                }
            }

            foreach ($universityProfileExportedAttributes as $attribute => $attributeTranslation) {
                if ($attribute == 'group') {
                    $temp[] = $user->universityProfile->group ? $user->universityProfile->group->name : 'Не указана';
                } elseif ($attribute != 'studentID' && $attribute != 'group') {
                    $temp[] = $user->universityProfile->castBoolean($user->universityProfile->{$attribute});
                } else {
                    $temp[] = $user->universityProfile->{$attribute};
                }
            }

            $output[] = $temp;
        }

        Excel::create('StankinplayUsers', function($excel) use($output) {
            $excel->sheet('users', function ($sheet) use($output) {
                $sheet->fromArray($output);
            });
        })->export('xls');
    }

    private function searchUsers(Request $request)
    {
        $userAttributes = User::getModel()->getVisible();
        $universityProfileAttributes = UniversityProfile::getModel()->getVisible();

        $inputs = $request->all();

        $userWhere = [];
        $universityProfileWhere = [];

        foreach ($inputs as $filter => $value) {
            if($value) {
                if ($value == 'true') {
                    $value = 1;
                } elseif ($value == 'false') {
                    $value = 0;
                }
                if (in_array($filter, $userAttributes)) {
                    $userWhere[] = [$filter, 'LIKE', $value.'%'];
                } else if (in_array($filter, $universityProfileAttributes)) {
                    $universityProfileWhere[] = [$filter, 'LIKE', $value.'%'];
                }
            }
        }

        $users = User::where($userWhere)->whereHas('universityProfile', function($query) use($universityProfileWhere) {
            $query->where($universityProfileWhere);
        })->with(['universityProfile' => function($query) {
            $query->with('group');
        }, 'discipline']);

        return $users;
    }

}
