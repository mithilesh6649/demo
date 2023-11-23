<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietFoodMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_food_maps', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('diet_id');
            $table->unSignedBigInteger('food_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('diet_id')->references('id')->on('diets')->onDelete('CASCADE');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diet_food_maps', function (Blueprint $table) {

            $table->dropForeign(['diet_food_maps_diet_id_foreign', 'diet_food_maps_food_id_foreign']);
        });
    }
}
