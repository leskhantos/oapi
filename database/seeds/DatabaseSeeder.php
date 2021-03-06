<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(UserTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(SpotTypesTableSeeder::class);
        $this->call(SpotTableSeeder::class);
        $this->call(PageTableSeeder::class);
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
