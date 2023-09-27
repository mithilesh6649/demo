<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_items', function (Blueprint $table) {
            $table->id();
            $table->string('gift_item_name_en')->nullable();
            $table->string('gift_item_name_ar')->nullable();
            $table->string('gift_item_image')->nullable();
            $table->float('price',8,3)->default(0.000);
            $table->bigInteger('menu_item_id')->nullable()->comment('optional');
            $table->timestamps();
        });

        Schema::create('gift_item_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('gift_item_id');
            $table->string('session_id')->nullable();
            $table->string('user_id')->nullable();
            $table->float('price',8,3)->default(0.000);
            $table->timestamps();
        });

        Schema::create('gift_item_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('gift_item_id');
            $table->string('user_id')->nullable();
            $table->float('price',8,3)->default(0.000);
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
        Schema::dropIfExists('gift_items');
        Schema::dropIfExists('gift_item_carts');
        Schema::dropIfExists('gift_item_orders');
    }
}
