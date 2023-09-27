<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('branch_id');
            $table->bigInteger('address_id');
            $table->tinyInteger('cutlery')->comment('yes=>1, no=>0')->default(0);
            $table->string('special_instruction')->nullable();
            $table->tinyInteger('payment_method')->comment('1=>credit card,2=>cash')->default(2);
            $table->float('sub_total');
            $table->float('delivery_fee')->nullable();
            $table->float('tax')->nullable();
            $table->float('total_amount');
            $table->float('discount')->default(0);
            $table->float('final_amount');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->bigInteger('item_id');
            $table->tinyInteger('quantity');
            $table->timestamps();
        });

        Schema::create('order_choices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->bigInteger('order_item_id');
            $table->bigInteger('choice_id');
            $table->tinyInteger('quantity');
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('order_choices');
    }
}
