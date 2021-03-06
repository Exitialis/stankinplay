<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function show($user, Request $request)
    {
        $authUser = auth()->user();

        $user = User::with(['universityProfile' => function($query) {
            $query->with(['group']);
        }, 'discipline', 'team', 'roles'])->find($user);

        if( ! $authUser->hasRole('admin') && $authUser->hasRole('discipline_head')) {
            if($user->discipline->first()->name !== $authUser->discipline->first()->name) {
                abort(403, 'Нельзя получить доступ к пользователю, который не относится к вашей дисциплине');
            }
        }

        $roles = Role::get();

        return view('admin.users.show', compact('user', 'roles'));
    }
}
