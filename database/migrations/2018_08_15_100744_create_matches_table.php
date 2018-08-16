<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTimeTz('match_day');
            $table->json('fin_score')->nullable();
            $table->json('team')->nullable();
            $table->json('map')->nullable();
            $table->json('stream_link')->nullable();
            $table->timestamps();
        });


        Schema::table('latest_match_teams', function (Blueprint $table) {
            $table->dropForeign(['match_id']);
        });

        Schema::table('upcoming_match_teams', function (Blueprint $table) {
            $table->dropForeign(['match_id']);
        });

        Schema::drop('upcoming_matches');
        Schema::drop('latest_matches');
        Schema::drop('latest_match_teams');
        Schema::drop('upcoming_match_teams');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
