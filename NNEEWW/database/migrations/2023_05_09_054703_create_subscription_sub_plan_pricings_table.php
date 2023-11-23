<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionSubPlanPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_sub_plan_pricings', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('diet_id');
            $table->tinyInteger('duration')->comment('in_month');
            $table->float('amount');
            $table->tinyInteger('discount')->comment('in_percent')->nullable();
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('subscription_sub_plan_pricings', function (Blueprint $table) {

            $table->dropForeign(['subscription_sub_plan_pricings_diet_id_foreign']);
        });
    }
}
