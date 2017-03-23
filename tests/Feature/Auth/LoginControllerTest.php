<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Tests\DbTestCase;
use Tests\TestCase;

class LoginControllerTest extends DbTestCase
{
    public function testLoginPageIsAvailable()
    {
        $this->get(route('login.get'))->assertStatus(200)->assertSee('Авторизация');
    }

    public function testLoginShouldBeSuccessfullWithRightCredentials()
    {
        $this->post(route('login.post'), [
            'login' => $this->user->login,
            'password' => '12345'
        ])->assertJson([
            'redirect' => route('profile.get')
        ])->assertSessionHas('notificate', [
            'flash' => [
                'message' => 'Авторизация успешно завершена!',
                'level' => 'success'
            ]
        ]);
    }

    public function testLoginShouldBeThrowValidationException()
    {
        $this->post(route('login.post'), [])->assertStatus(302)
            ->assertSessionHas('errors', $this->convertToValidationErrors([
                'login' => ["Поле login обязательно для заполнения."],
                'password' => ["Поле password обязательно для заполнения."],
            ]));
    }
}
