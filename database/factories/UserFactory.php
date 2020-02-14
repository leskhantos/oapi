<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Company;
use App\Entities\User;
use Faker\Generator as Faker;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'login' => $faker->userName,
        'password' => 'password', // password
        'last_online' => $faker->date(),
        'last_ip' =>  $faker->ipv4 ,
        'company_id' => 1
    ];
});
