<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(['name' => 'count_news_home', 'value' => '30']);
        DB::table('settings')->insert(['name' => 'count_tournaments_home', 'value' => '30']);
        DB::table('settings')->insert(['name' => 'count_latest_match_scoreboard', 'value' => '10']);
        DB::table('settings')->insert(['name' => 'count_live_match_scoreboard', 'value' => '10']);
        DB::table('settings')->insert(['name' => 'count_upcoming_match_scoreboard', 'value' => '10']);
        DB::table('settings')->insert(['name' => 'pre_match_scoreboard', 'value' => '10']);
        DB::table('settings')->insert(['name' => 'count_forum_topics', 'value' => '25']);
        DB::table('settings')->insert(['name' => 'count_topic_posts', 'value' => '25']);
        DB::table('settings')->insert(['name' => 'count_forum_topics_profile', 'value' => '10']);
        DB::table('settings')->insert(['name' => 'count_topic_posts_profile', 'value' => '5']);
        DB::table('settings')->insert(['name' => 'count_comments_profile', 'value' => '10']);
    }
}
