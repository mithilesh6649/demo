<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentOfferIdToCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->integer('current_offer_id')->nullable()->after('offer_description');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->bigInteger('item_id')->nullable()->change();
            $table->string('offer_description')->nullable()->after('item_id');
            $table->integer('current_offer_id')->nullable()->after('offer_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('current_offer_id');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('offer_description');
            $table->dropColumn('current_offer_id');
        });
    }
}
