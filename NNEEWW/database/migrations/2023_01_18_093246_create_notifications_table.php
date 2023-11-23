<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('notification_image')->nullable();
            $table->unSignedBigInteger('notification_to');
            $table->char('notification_to_guard');
            $table->unSignedBigInteger('notification_from')->nullable();
            $table->char('notification_from_guard')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->unSignedBigInteger('notification_type_id')->comment('primary key of md_dropdown');
            $table->boolean('read')->comment('0|unread  1|read')->default(0);
            $table->timestamps();

            $table->foreign('notification_type_id')->references('id')->on('md_dropdowns')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_notification_type_id_foreign');
        });
    }
}
