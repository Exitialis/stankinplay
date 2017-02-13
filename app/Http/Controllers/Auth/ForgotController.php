<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ForgotPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgotController extends Controller
{
    public function index()
    {
        return view('auth.forgot');
    }

    public function reset(ForgotPost $request)
    {

    }
}
