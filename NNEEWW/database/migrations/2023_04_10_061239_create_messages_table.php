<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('group_chat_id');
            $table->unSignedBigInteger('sender_id');
            $table->longText('message')->nullable();
            $table->tinyInteger('message_type')->comment('1|text message   2|file attachments');
            $table->timestamps();

            $table->foreign('group_chat_id')->references('id')->on('group_chats')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages', function (Blueprint $table) {
            $table->dropForeign(['messages_group_chat_id_foreign']);
        });
    }
}
