<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDecimalPlacesToMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->float('price', 8,3)->change();
        });

        Schema::table('cart_choices', function (Blueprint $table) {
            $table->float('choice_price', 8,3)->change();
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->float('menu_item_price', 8,3)->change();
            $table->float('item_total', 8,3)->change();
            $table->float('total_price', 8,3)->change();
        });

        Schema::table('choices', function (Blueprint $table) {
            $table->float('price', 8,3)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
