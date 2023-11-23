<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriptionSubPlanPricingIdInUserDietPlanSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_diet_plan_subscriptions', function (Blueprint $table) {
            $table->unSignedBigInteger('subscription_sub_plan_pricing_id')->after('diet_id')->nullable();
            
            $table->foreign('subscription_sub_plan_pricing_id', 'user_diet_plan_pricing_id_foreign')->references('id')->on('subscription_sub_plan_pricings')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_diet_plan_subscriptions', function (Blueprint $table) {
            $table->dropForeign(['user_diet_plan_pricing_id_foreign']);
            $table->dropColumn('subscription_sub_plan_pricing_id');
        });
    }
}
