<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddStatusForumPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thread_posts', function (Blueprint $table) {
            $table->enum('moder',['true','false'])->default('false');
            $table->unsignedInteger('moder_id')->nullable();

            $table->foreign('moder_id')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thread_posts', function (Blueprint $table) {
            $table->dropForeign('moder_id');
            $table->dropColumn(['moder','moder_id']);
        });
    }
}
