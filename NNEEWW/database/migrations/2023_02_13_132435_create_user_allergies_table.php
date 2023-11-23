<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_health_complaints', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->unSignedBigInteger('health_complaint_id')->comment('Prm Key of health_complaints tbl');
            $table->char('type')->comment('0|allergy 1|disease 2|Disorders 3|General Information 4|food allergies');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('health_complaint_id')->references('id')->on('health_complaints')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_health_complaints', function (Blueprint $table) {

            $table->dropForeign(['user_health_complaints_user_id_foreign', 'user_health_complaints_health_complaint_id_foreign']);
        });
    }
}
