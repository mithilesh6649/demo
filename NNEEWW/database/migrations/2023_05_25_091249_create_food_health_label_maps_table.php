<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodHealthLabelMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_health_label_maps', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('food_id');
            $table->unSignedBigInteger('health_label_id');
            $table->timestamps();

            $table->foreign('food_id')->references('id')->on('foods')->onDelete('CASCADE');
            $table->foreign('health_label_id')->references('id')->on('health_labels')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_health_label_maps', function (Blueprint $table) {

            $table->dropForeign(['food_health_label_maps_health_label_id_foreign', 'food_health_label_maps_food_id_foreign']);
        });
    }
}
