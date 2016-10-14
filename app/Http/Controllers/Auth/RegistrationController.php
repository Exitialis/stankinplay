<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function index(){
        return view('auth.registration');
    }

    public function store(Request $request){

    }
}
