<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDineInCartChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dine_in_cart_choices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dine_in_cart_id')->nullable();
            $table->bigInteger('choice_group_id')->nullable();
            $table->bigInteger('choice_id')->nullable();
            $table->double('choice_price')->nullable();
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
        Schema::dropIfExists('dine_in_cart_choices');
    }
}
