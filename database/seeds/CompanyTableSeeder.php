<?php

use Illuminate\Database\Seeder;
use App\Entities\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();
        factory(Company::class, 1)->create();
    }
}
