<?php

namespace App\Http\Controllers\Api\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::paginate(10);

        return response()->json($groups);
    }

    public function lists(Request $request)
    {
        $groups = Group::where('name', 'LIKE', $request->input('q') . '%')
            ->limit(10)
            ->select('name as text', 'id')
            ->get()
            ->toArray();

        return response()->json($groups);
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
