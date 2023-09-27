<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOffersFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // $table->integer('offer_id')->nullable()->after('quantity');
            // $table->integer('coupon_id')->nullable()->after('offer_id');
            // $table->string('discount')->nullable()->after('coupon_id');
            // $table->string('current_offer')->nullable()->after('discount');
            // $table->string('loyalty_points')->nullable()->after('current_offer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_items', function (Blueprint $table) {
            // $table->dropColumn('offer_id');
            // $table->dropColumn('coupon_id');
            // $table->dropColumn('discount_id');
            // $table->dropColumn('current_offer');
            // $table->dropColumn('loyalty_points');
        });
    }
}
