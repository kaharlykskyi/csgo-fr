<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->text('logo')->nullable();
            $table->string('nickname')->unique();
            $table->string('full_name')->nullable();
            $table->string('country');
            $table->unsignedTinyInteger('age')->nullable();
            $table->unsignedInteger('team_id')->nullable();
            $table->enum('account_type',['player','admin']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
