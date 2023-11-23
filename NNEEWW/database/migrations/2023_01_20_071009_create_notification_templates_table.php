<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id(); 
            $table->string('notification_image')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->boolean('notification_type')->comment('1|Push Notification  0|Email Notification')->default(1);
            $table->unSignedBigInteger('notification_type_id')->comment('primary key of md_dropdown');
            $table->boolean('status')->comment('0 => Inactive, 1 => Active')->default(1);
            $table->softDeletes(); 
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
        Schema::dropIfExists('notification_templates',function(Blueprint $table){
             $table->dropForeign('notification_type_id_foreign');
        });
    }
}
