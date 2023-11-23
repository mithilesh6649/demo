<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebUserWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_user_working_hours', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('web_user_id');
            $table->tinyInteger('days'); 
            $table->time('open_time');
            $table->time('close_time');
            $table->timestamps();
            $table->softDeletes();
            $table->index('days');
            $table->foreign('web_user_id')->references('id')->on('web_users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_user_working_hours',function($table){
             $table->dropIndex(['days']);
             $table->dropForeign(['web_user_working_hours_web_user_id_foreign']);
        });
    }
}
