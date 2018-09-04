<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments_match', function (Blueprint $table) {
            $table->unsignedInteger('parent_comment')->nullable();
            $table->integer('like_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments_match', function (Blueprint $table) {
            $table->dropColumn('parent_comment');
            $table->dropColumn('like_count');
        });
    }
}
