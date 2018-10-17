<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkForumCategoryRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_category_relation', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('forum_category')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('forum_topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_category_relation', function (Blueprint $table) {
            $table->dropForeign(['category_id','topic_id']);
        });
    }
}
