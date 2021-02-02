<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    $name = explode(' ', $faker->name);
    return [
        'email'          => $faker->unique()->safeEmail,
        'password'       => Hash::make('my_secret_password'),
        'active'         => $faker->boolean(),
        'remember_token' => Str::random(10)
    ];
});
