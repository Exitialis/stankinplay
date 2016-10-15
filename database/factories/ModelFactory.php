<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\Discipline;
use App\Models\Team;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {

    return [
        'login' => $faker->userName,
        'email' => $faker->email,
        'password' => bcrypt('12345'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'middle_name' => $faker->firstName,
        'group' => 'idb-14-13',
    ];
});

$factory->define(App\Models\Team::class, function (Faker\Generator $faker) {

    $disciplines = Discipline::pluck('id')->toArray();

    return [
        'discipline_id' => $faker->randomElement($disciplines),
        'name' => $faker->company
    ];
});


