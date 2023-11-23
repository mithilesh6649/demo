<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSpecializedDietPlanMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_specialized_diet_plan_maps', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_diet_plan_subscription_id');
            $table->unSignedBigInteger('diet_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_diet_plan_subscription_id', 'user_specialized_diet_plan_subscription_id_foreign')->references('id')->on('user_diet_plan_subscriptions')->onDelete('CASCADE');
            $table->foreign('diet_id')->references('id')->on('diets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_specialized_diet_plan_maps', function (Blueprint $table) {
            $table->dropForeign(['user_specialized_diet_plan_subscription_id_foreign', 'user_specialized_diet_plan_maps_diet_id_foreign']);
        });
    }
}
