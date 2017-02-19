<?php

namespace App\Http\Controllers\Api\User;

use App\Models\UniversityProfile;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
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

    public function filter(Request $request)
    {
        $userAttributes = User::getModel()->getVisible();
        $universityProfileAttributes = UniversityProfile::getModel()->getVisible();

        $inputs = $request->all();

        $userWhere = [];
        $universityProfileWhere = [];

        foreach ($inputs as $filter => $value) {
            if (in_array($filter, $userAttributes)) {
                $userWhere[] = [$filter, 'LIKE', $value.'%'];
            } else if (in_array($filter, $universityProfileAttributes)) {
                $universityProfileWhere[] = [$filter, 'LIKE', $value.'%'];
            }
        }

        $users = User::where($userWhere)->whereHas('universityProfile', function($query) use($universityProfileWhere) {
            $query->where($universityProfileWhere);
        })->with(['universityProfile' => function($query) {
            $query->with('group');
        }, 'discipline'])->paginate(10);

        return response()->json(compact('users'));
    }
    public function temp()
    {
        $users = User::with(['universityProfile' => function($query) {
            $query->with('group');
        }])->whereHas('team', function($query) {
            $query->where('name', '#lowiq')->orWhere('name', 'MAT.TEAM')->orWhere('name', 'MayDay');
        })->get();

        $output = [];

        $output[] = ['Фамилия', 'Имя', 'Отчество', 'Группа', 'Студенческий', 'Бюджет', 'Стипендия'];

        foreach ($users as $user) {
            $first_name = $user->first_name;
            $last_name = $user->last_name;
            $middle_name = $user->middle_name;
            $group = $user->universityProfile->group ? $user->universityProfile->group->name : '';
            $studentID = $user->universityProfile->studentID ?: 'Не заполнено' ;
            $budget = $user->universityProfile->budget ? 'Да' : 'Нет';
            $grants = $user->universityProfile->grants ? 'Да' : 'Нет';

            $output[] = [$first_name, $last_name, $middle_name, $group, $studentID, $budget, $grants];
        }

        Excel::create('temp', function($excel) use($output) {
            $excel->sheet('test', function ($sheet) use($output) {
                $sheet->fromArray($output);
            });
        })->export('xls');
    }

}
