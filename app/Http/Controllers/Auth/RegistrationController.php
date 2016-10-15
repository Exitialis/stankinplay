<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\StoreRegistrationPost;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function index(){
        return view('auth.registration');
    }

    public function store(StoreRegistrationPost $request){
        
    }
    
}
