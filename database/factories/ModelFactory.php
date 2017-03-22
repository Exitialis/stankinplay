<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Discipline;
use App\Models\Group;
use App\Models\Team;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'discipline_id' => 1,
        'login' => $faker->userName,
        'email' => $faker->email,
        'password' => bcrypt('12345'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'middle_name' => $faker->firstName,
        'team_id' => null
    ];
});

$factory->define(App\Models\Team::class, function (Faker\Generator $faker) {
    $disciplines = Discipline::pluck('id')->toArray();
    return [
        'discipline_id' => $faker->randomElement($disciplines),
        'name' => $faker->company
    ];
});
