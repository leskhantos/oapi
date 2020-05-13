<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Spot;
use Faker\Generator as Faker;

$factory->define(Spot::class, function (Faker $faker) {
    return [
        'company_id' => rand(1, 3),
        'address' => $faker->address,
        'type' => rand(1, 3),
        'ident' => $faker->domainWord,
        'settings' => json_encode(123),
        'style_id' => rand(1, 3),
    ];
});
