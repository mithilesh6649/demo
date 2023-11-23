<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDailyDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_daily_diets', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->date('meal_date');
            $table->integer('total_breakfast_calorie_intake')->nullable();
            $table->integer('total_lunch_calorie_intake')->nullable();
            $table->integer('total_snack_calorie_intake')->nullable();
            $table->integer('total_dinner_calorie_intake')->nullable();
            $table->unSignedBigInteger('meal_assigned_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'meal_date']);
            $table->foreign('meal_assigned_by_id')->references('id')->on('web_users')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_daily_diets', function (Blueprint $table) {

            $table->dropIndex(['user_id', 'meal_date']);
            $table->dropForeign(['user_daily_diets_user_id_foreign',  'user_diets_meal_assigned_by_id_foreign']);
        });
    }
}
