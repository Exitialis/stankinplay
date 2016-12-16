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
}
