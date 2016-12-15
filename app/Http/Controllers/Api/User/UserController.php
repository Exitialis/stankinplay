<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['universityProfile' => function($query) {
            $query->with('group');
        }, 'discipline']);

        if ($request->input('sort')) {
            $users = $users->orderBy($request->input('sort'));
        }

        $users = $users->paginate(10);

        return response()->json($users);
    }
}
