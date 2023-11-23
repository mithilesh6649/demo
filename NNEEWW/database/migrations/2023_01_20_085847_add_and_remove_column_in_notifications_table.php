<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndRemoveColumnInNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_notification_type_id_foreign');
            $table->dropColumn(['notification_type_id','notification_image','title','body']);
            $table->unSignedBigInteger('notification_template_id')->comment('primary key of notification templates')->after('id');
            $table->foreign('notification_template_id')->references('id')->on('notification_templates')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('notification_image')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->unSignedBigInteger('notification_type_id')->comment('primary key of md_dropdown');

            $table->dropColumn(['notification_template_id']);
            $table->dropForeign(['notifications_notification_template_id_foreign']);

            $table->foreign('notification_type_id')->references('id')->on('md_dropdowns')->onDelete('CASCADE');
        });
    }
}
