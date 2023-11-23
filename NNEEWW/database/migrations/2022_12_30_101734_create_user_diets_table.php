<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_diets', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_daily_diet_id');
            $table->unSignedBigInteger('food_id');
            $table->unSignedBigInteger('meal_type_id')->comment('which meal breakfst, lunch, snacks or dinner Prm key of md_dropdowns');
            $table->tinyInteger('quantity')->nullable();
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_daily_diet_id', 'food_id', 'meal_type_id']);
            $table->foreign('user_daily_diet_id')->references('id')->on('user_daily_diets')->onDelete('CASCADE');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('CASCADE');
            $table->foreign('meal_type_id')->references('id')->on('md_dropdowns')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_diets', function (Blueprint $table) {
            $table->dropIndex(['user_daily_diet_id', 'meal_type_id', 'food_id']);
            $table->dropForeign(['user_diets_user_id_foreign', 'user_diets_food_id_foreign', 'user_diets_meal_type_id_foreign']);
        });
    }
}
