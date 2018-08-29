<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkTeamHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_history', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_history', function (Blueprint $table) {
            $table->dropForeign('player_id');
            $table->dropForeign('team_id');
        });
    }
}
