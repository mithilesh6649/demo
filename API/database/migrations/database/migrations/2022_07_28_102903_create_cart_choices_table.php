<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_choices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_item_id');
            $table->bigInteger('choice_group_id');
            $table->bigInteger('choice_id');
            $table->float('choice_price')->nullable();
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
        Schema::dropIfExists('cart_choices');
    }
}
