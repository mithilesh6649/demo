<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDietAndTestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_diet_and_test_logs', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->date('log_date');
            $table->float('body_fat_percentage')->nullable();
            $table->float('body_fat')->nullable();
            $table->float('bmi')->nullable();
            $table->float('fasting_blood_sugar')->nullable();
            $table->float('random_blood_sugar')->nullable();
            $table->float('hba1c')->nullable();
            $table->float('cholesterol')->nullable();
            $table->float('hdl')->nullable();
            $table->float('ldl')->nullable();
            $table->float('triglycerides')->nullable();
            $table->float('serum_creatinine')->nullable();
            $table->float('haemoglobin')->nullable();
            $table->float('albumin')->nullable();
            $table->float('calcium')->nullable();
            $table->float('phosphorous')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('log_date');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_diet_and_test_logs', function (Blueprint $table) {
            $table->dropIndex(['log_date']);
            $table->dropForeign('user_diet_and_test_logs_user_id_foreign');
        });
    }
}
