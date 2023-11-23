<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFavouriteExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_favourite_exercises', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->unSignedBigInteger('exercise_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'exercise_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_favourite_exercises', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'exercise_id']);
            $table->dropForeign(['user_favourite_exercises_user_id_foreign', 'user_favourite_exercises_exercise_id_foreign']);
        });
    }
}
