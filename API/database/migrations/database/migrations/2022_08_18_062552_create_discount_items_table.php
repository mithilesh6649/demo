<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount_id');
            $table->integer('menu_category_id')->nullable();
            $table->integer('menu_item_id')->nullable();
            $table->timestamps();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_items');
    }
}
