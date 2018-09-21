<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMassegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_masseges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sender');
            $table->unsignedInteger('addressee');
            $table->unsignedTinyInteger('seen')->default(0);
            $table->unsignedInteger('chat_id')->nullable();
            $table->text('massage');
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
        Schema::dropIfExists('chat_masseges');
    }
}
