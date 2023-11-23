<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubPlanFeatureMapsTable extends Migration
{
    /**
     * Run the migrations. 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_plan_feature_maps', function (Blueprint $table) {
         $table->id(); 
         $table->unSignedBigInteger('diet_id');
         $table->unSignedBigInteger('feature_id');

         $table->foreign('diet_id')->references('id')->on('diets')->onDelete('CASCADE');
         $table->foreign('feature_id')->references('id')->on('features')->onDelete('CASCADE');

         $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_plan_feature_maps',function(Blueprint $table){
          $table->dropForeign(['sub_plan_feature_maps_diet_id_foreign', 'sub_plan_feature_maps_feature_id_foreign']);
        });
    }
}
