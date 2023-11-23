<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_chats', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('ticket_id')->nullable();
            $table->char('chat_unqiue_id')->unique();
            $table->boolean('is_chat_ended')->default(0);
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_chats', function (Blueprint $table) {
            $table->dropUnique('group_chats_chat_unqiue_id_unqiue');
            $table->dropForeign(['group_chats_ticket_id_foreign']);
        });
    }
}
