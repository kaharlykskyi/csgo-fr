<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTablePart2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countrys')->insert(['country' => 'International', 'flag' => 'inter.png']);
        DB::table('countrys')->insert(['country' => 'Europe', 'flag' => 'eu.png']);
    }
}
