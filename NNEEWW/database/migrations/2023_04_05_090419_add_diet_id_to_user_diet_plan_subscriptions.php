<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDietIdToUserDietPlanSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_diet_plan_subscriptions', function (Blueprint $table) {
              $table->integer('diet_id')->after('diet_plan_subscription_id')->nullable();
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
              $table->dropColumn('diet_id');
        });
    }
}
