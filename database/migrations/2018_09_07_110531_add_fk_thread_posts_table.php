<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkThreadPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thread_posts', function (Blueprint $table) {
            $table->foreign('thread_id')->references('id')->on('topic_threads')->onDelete('cascade');
            $table->foreign('parent_post')->references('id')->on('thread_posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
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
            $table->dropForeign('thread_id');
            $table->dropForeign('parent_post');
            $table->dropForeign('user_id');
        });
    }
}
