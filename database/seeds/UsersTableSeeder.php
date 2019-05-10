<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('11111111'),
        ]);
        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => bcrypt('22222222'),
        ]);
    }
}
