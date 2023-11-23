<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTraitQuantityColumninTraitPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traits_prices', function (Blueprint $table) {
            $table->tinyInteger('trait_quantity')->after('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traits_prices', function (Blueprint $table) {
            $table->dropColumn('trait_quantity');
        });
    }
}
