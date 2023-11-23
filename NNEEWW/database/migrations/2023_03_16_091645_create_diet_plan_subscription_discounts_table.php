<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietPlanSubscriptionDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_plan_subscription_discounts', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('diet_plan_id');
            $table->float('discount_value');
            $table->char('discount_type');
            $table->string('discription')->nullable();
            $table->datetime('valid_from')->nullable();
            $table->datetime('valid_until')->nullable();
            $table->boolean('status')->comment('0|inactive 1|active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('diet_plan_id', 'diet_plan_discount_foreign')->references('id')->on('diet_plan_subscriptions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diet_plan_subscription_discounts', function (Blueprint $table) {
            $table->dropForeign('diet_plan_discount_foreign');
        });
    }
}
