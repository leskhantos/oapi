<?php

use Illuminate\Database\Seeder;
use App\Entities\Spot;

class SpotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spot::truncate();
        factory(Spot::class, 1)->create();
    }
}
