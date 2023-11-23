<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDailyExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_daily_exercises', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->date('exercise_date');
            $table->integer('total_calorie_burnt')->nullable();
            $table->unSignedBigInteger('web_user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['exercise_date', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_daily_exercises', function (Blueprint $table) {
            $table->dropIndex(['exercise_date', 'user_id']);
            $table->dropForeign(['user_daily_exercises_user_id_foreign', 'user_daily_exercises_web_user_id_foreign']);
        });
    }
}
