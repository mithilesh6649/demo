<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietSubscriptionFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_subscription_feature_maps', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('feature_id');
            $table->unSignedBigInteger('diet_plan_subscription_id');
            $table->timestamps();
            $table->index('feature_id');
            $table->index('diet_plan_subscription_id');
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('CASCADE');
            $table->foreign('diet_plan_subscription_id')->references('id')->on('diet_plan_subscriptions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diet_subscription_feature_maps', function (Blueprint $table) {
            $table->dropIndex(['feature_id', 'diet_plan_subscription_id']);
            $table->dropForeign(['diet_subscription_feature_maps_feature_id_foreign', 'diet_subscription_feature_maps_diet_plan_subscription_id_foreign']);
        });
    }
}
