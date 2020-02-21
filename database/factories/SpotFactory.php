<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Spot;
use Faker\Generator as Faker;

$factory->define(Spot::class, function (Faker $faker) {
    return [
        'company_id' => 1,
        'address' => $faker->address,
        'type' => 1,
        'ident' => $faker->domainName,
        'settings' => json_encode(123),
        'page_id' => 1,
    ];
});
