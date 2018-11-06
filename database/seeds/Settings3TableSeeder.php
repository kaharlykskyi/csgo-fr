<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Settings3TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(['name' => 'count_latest_match', 'value' => '10']);
        DB::table('settings')->insert(['name' => 'count_all_news', 'value' => '5']);
        DB::table('settings')->insert(['name' => 'count_all_tournaments', 'value' => '10']);
        DB::table('settings')->insert(['name' => 'count_news_tabbed', 'value' => '10']);
    }
}
