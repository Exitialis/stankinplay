<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function index(){
        return view('auth.registration');
    }

    public function store(Request $request){
        $this->validate($request,[
            'login' => 'required|max:255',
            'email' => 'required|email',
            'pass' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'middle_name' => 'required|max:255',
            'group' => 'required|max:255'
        ]);
    }
    
}
