<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkMatchLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_likes', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('comments_match')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_likes', function (Blueprint $table) {
            $table->dropForeign('comment_id');
            $table->dropForeign('user_id');
        });
    }
}
