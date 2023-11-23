<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exercises', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_daily_exercise_id');
            $table->unSignedBigInteger('exercise_id');
            $table->tinyInteger('duration')->comment('in minutes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_daily_exercise_id', 'exercise_id']);
            $table->foreign('user_daily_exercise_id')->references('id')->on('user_daily_exercises')->onDelete('CASCADE');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exercises', function (Blueprint $table) {
            $table->dropIndex(['user_daily_exercise_id', 'exercise_id']);
            $table->dropForeign(['user_exercises_user_daily_exercise_id_foreign', 'user_exercises_exercise_id_foreign']);
        });
    }
}
