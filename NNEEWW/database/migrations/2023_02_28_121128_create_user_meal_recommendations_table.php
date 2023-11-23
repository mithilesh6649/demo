<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMealRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meal_recommendations', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->unSignedBigInteger('food_id');
            $table->unSignedBigInteger('meal_type_id')->comment('primry key of md_dropdowns_table');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_meal_recommendations', function (Blueprint $table) {

            $table->dropForeign(['user_meal_recommendations_user_id_foreign', 'user_meal_recommendations_food_id_foreign', 'user_meal_recommendations_meal_type_id_foreign']);
        });
    }
}
