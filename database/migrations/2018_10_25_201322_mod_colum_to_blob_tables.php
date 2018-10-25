<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModColumToBlobTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `thread_posts` MODIFY COLUMN `text_post` LONGBLOB");
        DB::statement("ALTER TABLE `chat_masseges` MODIFY COLUMN `massage` LONGBLOB");
        DB::statement("ALTER TABLE `comments_match` MODIFY COLUMN `comment` LONGBLOB");
        DB::statement("ALTER TABLE `news_comments` MODIFY COLUMN `comment` LONGBLOB");
        DB::statement("ALTER TABLE `tournament_comments` MODIFY COLUMN `comment` LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `thread_posts` MODIFY COLUMN `text_post` TEXT");
        DB::statement("ALTER TABLE `chat_masseges` MODIFY COLUMN `massage` TEXT");
        DB::statement("ALTER TABLE `comments_match` MODIFY COLUMN `comment` TEXT");
        DB::statement("ALTER TABLE `news_comments` MODIFY COLUMN `comment` TEXT");
        DB::statement("ALTER TABLE `tournament_comments` MODIFY COLUMN `comment` TEXT");
    }
}
