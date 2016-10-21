<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;

use App\Repositories\Contracts\UserRepositoryContract;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Репозиторий пользователей.
     *
     * @var UserRepositoryContract
     */
    protected $users;

    /**
     * RegistrationController constructor.
     * @param $users
     */
    public function __construct(UserRepositoryContract $users)
    {
        $this->users = $users;
    }


    public function index()
    {
        return view('profile.index');
    }
    
    public function logout(){
        Auth::logout();
        $auth = Auth::guard()->check();
        return view('auth.login', compact('auth'));
    }



}
