<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemPriceToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->float('item_price',8,3)->nullable()->after('quantity');
            $table->float('item_total',8,3)->nullable()->after('item_price');
            $table->float('total_price',8,3)->nullable()->after('item_total');
            $table->tinyInteger('item_type')->default(0)->comment('0=>regular,1=>coupon,2=>loyalty')->after('total_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('item_price',8,3);
            $table->dropColumn('item_total',8,3);
            $table->dropColumn('total_price',8,3);
            $table->dropColumn('item_type');
        });
    }
}
