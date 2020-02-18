<?php

use Illuminate\Database\Seeder;
use App\Entities\SpotsType;

class SpotTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpotsType::truncate();
        factory(SpotsType::class, 1)->create();
    }
}
