<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('ip')->nullable();
            $table->bigInteger('menu_item_id');
            $table->tinyInteger('quantity')->default(1);
            $table->float('menu_item_price');
            $table->float('item_total');
            $table->float('total_price');
            $table->tinyInteger('is_offer_applied')->comment('0=>no,1=>yes')->default(0);
            $table->integer('offer_id')->nullable();
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
        Schema::dropIfExists('cart_items');
    }
}
