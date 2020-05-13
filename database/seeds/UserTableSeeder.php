<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = [
            'id' => 1,
            'name' => 'userName',
            'login' => 'username', //login
            'password' => 'password', // password
            'last_online' => '13.05.2020', //last online
            'last_ip' =>  '127.0.0.1',
        ];

        User::create($user);
        factory(User::class, 9)->create();
    }
}
