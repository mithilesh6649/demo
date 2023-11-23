<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_plan_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->char('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->float('monthly_amount')->nullable();
            $table->float('quaterly_amount')->comment('price based on per month')->nullable();
            $table->float('yearly_amount')->comment('price based on per month')->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('is_free');
            $table->boolean('status')->comment('0|inactive  1|active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diet_plan_subscriptions');
    }
}
