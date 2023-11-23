<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubPlanPricingFeatureMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_plan_pricing_feature_maps', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('subscription_sub_plan_pricing_id');
            $table->unSignedBigInteger('feature_id');

            $table->foreign('subscription_sub_plan_pricing_id','subscription_sub_plan_pricing_foreign')->references('id')->on('subscription_sub_plan_pricings')->onDelete('CASCADE');
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
        Schema::dropIfExists('sub_plan_pricing_feature_maps',function(Blueprint $table){

              $table->dropForeign(['subscription_sub_plan_pricing_foreign', 'sub_plan_pricing_feature_maps_feature_id_foreign']);
        });
    }
}
