<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;


$factory->define(App\Entities\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'disabled' => $faker->boolean
    ];
});
