<?php

use Illuminate\Database\Seeder;
use App\Entities\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::truncate();
        factory(Page::class,1)->create();
    }
}
