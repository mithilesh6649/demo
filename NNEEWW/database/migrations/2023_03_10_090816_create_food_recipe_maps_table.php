<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodRecipeMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_recipe_maps', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('food_id');
            $table->unSignedBigInteger('recipe_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['food_id', 'recipe_id']);
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('CASCADE');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_recipe_maps', function (Blueprint $table) {
            $table->dropIndex(['food_id', 'recipe_id']);
            $table->dropForeign(['food_recipe_maps_food_id_foreign', 'food_recipe_maps_recipe_id_foreign']);
        });
    }
}
