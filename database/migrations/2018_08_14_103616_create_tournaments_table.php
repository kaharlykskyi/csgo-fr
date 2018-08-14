<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('short_title',46);
            $table->text('content_tournament');
            $table->text('banner_image');
            $table->string('country_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('viewers_count')->nullable();
            $table->date('publication_date');
            $table->json('tournament_metadata')->nullable();
            $table->string('author')->nullable();
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
        Schema::dropIfExists('tournaments');
    }
}
