<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Settings2TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(['name' => 'count_streams', 'value' => '10']);
        DB::table('settings')->insert(['name' => 'count_popular_topic', 'value' => '5']);
        DB::table('settings')->insert(['name' => 'count_latest_forum', 'value' => '10']);
    }
}
