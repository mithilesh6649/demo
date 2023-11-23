<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDietPlanSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_diet_plan_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->unSignedBigInteger('diet_plan_subscription_id');
            $table->datetime('expire_at');
            $table->boolean('status')->comment('0|inactive 1|active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_diet_plan_subscriptions', function (Blueprint $table) {
            $table->dropForeign(['user_diet_plan_subscriptions_user_id_foreign', 'user_diet_plan_subscriptions_diet_plan_subscription_id_foreign']);
        });
    }
}
