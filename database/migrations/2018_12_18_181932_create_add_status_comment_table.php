<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddStatusCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_comments', function (Blueprint $table) {
            $table->enum('moder',['true','false'])->default('false');
            $table->unsignedInteger('moder_id')->nullable();

            $table->foreign('moder_id')->references('id')->on('users')->onDelete('SET NULL');
        });

        Schema::table('comments_match', function (Blueprint $table) {
            $table->enum('moder',['true','false'])->default('false');
            $table->unsignedInteger('moder_id')->nullable();

            $table->foreign('moder_id')->references('id')->on('users')->onDelete('SET NULL');
        });

        Schema::table('tournament_comments', function (Blueprint $table) {
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
        Schema::table('news_comments', function (Blueprint $table) {
            $table->dropForeign('moder_id');
            $table->dropColumn(['moder','moder_id']);
        });

        Schema::table('comments_match', function (Blueprint $table) {
            $table->dropForeign('moder_id');
            $table->dropColumn(['moder','moder_id']);
        });

        Schema::table('tournament_comments', function (Blueprint $table) {
            $table->dropForeign('moder_id');
            $table->dropColumn(['moder','moder_id']);
        });
    }
}
