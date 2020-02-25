<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'company_id' =>1,
        'name'=>$faker->name,
        'type'=>1,
        'title'=>$faker->title,
    ];
});
