<?php

use Illuminate\Database\Seeder;
use App\Entities\Style;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Style::truncate();
        factory(Style::class,1)->create();
    }
}
