<?php

namespace App\Http\Controllers\Permissions;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function can($permission, Request $request)
    {
        $user = \Auth::user();

        if ( ! $user) {
            return response()->json(flash('Вы не авторизованны', 'error'));
        }

        $can = $user->can($permission);
        
        return response()->json(compact('can'));
    }
}
