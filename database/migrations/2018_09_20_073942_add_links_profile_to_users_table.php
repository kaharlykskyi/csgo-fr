<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinksProfileToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('twitch_profile')->nullable();
            $table->string('steam_profile')->nullable();
            $table->text('description')->nullable();
            $table->string('faceit_profile')->nullable();
            $table->string('youtube_profile')->nullable();
            $table->string('instagram_profile')->nullable();
            $table->string('twitter_profile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'twitch_profile',
                'steam_profile',
                'description',
                'faceit_profile',
                'youtube_profile',
                'instagram_profile',
                'twitter_profile'
            ]);
        });
    }
}
