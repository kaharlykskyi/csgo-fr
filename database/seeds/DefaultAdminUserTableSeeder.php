<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefaultAdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'country_id' => 'Ukraine',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'city' => 'Kiev',
            'date_birth' => '2018-08-10',
            'sex' => 'male',
            'role' => 'admin',
            'is_verified' => 2
        ]);
    }
}
