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
        $categories = [
            [
                'id' => 1,
                'name' => 'Смс',
                'code' => 060,
            ],
            [
                'id' => 2,
                'name' => 'Звонки',
                'code' => 060,
            ],
            [
                'id' => 3,
                'name' => 'Ваучеры',
                'code' => 070,
            ]
        ];

        foreach ($categories as $category) {
            SpotsType::create($category);
        }
    }
}
