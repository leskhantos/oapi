<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\SpotsType;
use Faker\Generator as Faker;

$factory->define(SpotsType::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'code' => $faker->countryCode,
    ];
});
