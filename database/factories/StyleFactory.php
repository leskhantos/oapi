<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Style;
use Faker\Generator as Faker;

$factory->define(Style::class, function (Faker $faker) {
    return [
        'company_id' =>1,
        'name'=>$faker->name,
        'title'=>$faker->title,
    ];
});
