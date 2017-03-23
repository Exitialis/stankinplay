<?php

namespace Tests\Feature\Auth;

use App\Models\Discipline;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Validation\ValidationException;
use Tests\DbTestCase;

class RegistrationController extends DbTestCase
{
    public function testRegistrationPageOk()
    {
        $this->get(route('registration.get'))->assertStatus(200)->assertSee('Регистрация');
    }

    public function testRegistrationSuccessfully()
    {
        $discipline = Discipline::get()->random(1)->first();
        $group = Group::first();

        $login = $this->faker->userName;
        $email = $this->faker->safeEmail;
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $middleName = $this->faker->firstNameMale;

        $this->post(route('registration.store'), [
            'login' => $login,
            'email' => $email,
            'password' => '12345',
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'discipline' => $discipline->id,
            'group_id' => $group->id,
            'module' => 0
        ])->assertJson([
            'redirect' => route('login.get')
        ]);

        $id = User::where('login', $login)->first()->id;

        $this->assertDatabaseHas('users', [
            'login' => $login,
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'discipline_id' => $discipline->id,
        ]);

        $this->assertDatabaseHas('university_profiles', [
            'user_id' => $id,
            'module' => 0,
            'group_id' => $group->id,
            'studentID' => null,
            'budget' => 0,
            'grants' => 0,
            'socialActivity' => 0,
            'gto' => 0,
            'anotherSections' => 0
        ]);

    }

    public function testRegistrationFailsWithValidationErrors()
    {
        $bag = new ViewErrorBag();
        $bag->put('default', new MessageBag(
            [
                'login' => ["Поле login обязательно для заполнения."],
                'email' => ["Поле email обязательно для заполнения."],
                'discipline' => ["Поле discipline обязательно для заполнения."],
                'email' => ["Поле email обязательно для заполнения."],
                'first_name' => ["Поле first name обязательно для заполнения."],
                'group_id' => ["Поле group id обязательно для заполнения."],
                'last_name' => ["Поле last name обязательно для заполнения."],
                'login' => ["Поле login обязательно для заполнения."],
                'middle_name' => ["Поле middle name обязательно для заполнения."],
                'password' => ["Поле password обязательно для заполнения."],
            ]
        ));

        $this->post(route('registration.store'), [])->assertStatus(302)
            ->assertSessionHas('errors', $bag);
    }

}
