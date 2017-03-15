<?php

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

class UserController extends DbTestCase
{
    public function testUserUpdate()
    {
        $user = User::get()->random(1);
        $memberRole = \App\Models\Role::where('name', 'member')->first();

        $this->put(route('api.users.update', $user->id), [
            'role' => 'member'
        ], $this->authHeaders($this->user))->followRedirects()->assertResponseOk();
    }
}
