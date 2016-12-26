<?php

use Carbon\Carbon;

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'api_token' => bcrypt('secret' . 'some@email.com'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Episode::class, function (Faker\Generator $faker) {
    return [
        'number' => rand(1,100),
        'title' => $faker->title,
        'description' => $faker->paragraph,
        'air_date' => (string) Carbon::parse('-1 week'),
    ];
});


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Topic::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->title,
        'description' => $faker->paragraph,
    ];
});
