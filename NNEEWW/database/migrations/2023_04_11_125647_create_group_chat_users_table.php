<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_chat_users', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('group_chat_id');
            $table->unSignedBigInteger('gena_health_user_id');
            $table->char('gena_health_user_guard');
            $table->boolean('is_blocked')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('gena_health_user_id');
            $table->index('gena_health_user_guard');
            $table->foreign('group_chat_id', 'group_chat_id_user_foreign')->references('id')->on('group_chats')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_chat_users', function (Blueprint $table) {
            $table->dropForeign(['group_chat_id_user_foreign']);
        });
    }
}
