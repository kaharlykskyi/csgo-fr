<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToChatMassegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign(['creator']);
            $table->dropForeign(['recipient']);
            $table->dropColumn('creator');
            $table->dropColumn('recipient');
        });

        Schema::table('chat_masseges', function (Blueprint $table) {
            $table->renameColumn('sender','user');
            $table->renameColumn('addressee','user2');
            $table->unsignedTinyInteger('seen2')->default(0);
            $table->dropForeign(['chat_id']);
            $table->dropColumn('chat_id');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user2')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::dropIfExists('chats');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_masseges', function (Blueprint $table) {
            //
        });
    }
}
