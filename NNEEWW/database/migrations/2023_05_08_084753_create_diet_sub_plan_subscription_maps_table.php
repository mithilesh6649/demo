<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietSubPlanSubscriptionMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('diet_sub_plan_subscription_maps', function (Blueprint $table) {
            $table->id(); 
            $table->unSignedBigInteger('diet_plan_subscription_id');
            $table->unSignedBigInteger('diet_id');

            $table->foreign('diet_plan_subscription_id', 'sub_diet_plan_subscription_foreign')->references('id')->on('diet_plan_subscriptions')->onDelete('CASCADE');
            $table->foreign('diet_id')->references('id')->on('diets')->onDelete('CASCADE');
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
        Schema::dropIfExists('diet_sub_plan_subscription_maps', function(Blueprint $table) {

            $table->dropForeign(['sub_diet_plan_subscription_foreign', 'lists_diet_id_foreign']);
            $table->dropColumn(['diet_plan_subscription_id', 'diet_id']);
        });
    }
}
