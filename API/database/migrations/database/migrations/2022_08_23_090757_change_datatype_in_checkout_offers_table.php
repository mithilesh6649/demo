<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatypeInCheckoutOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkout_offers', function (Blueprint $table) {
              $table->dateTime('start_date')->change();
              $table->dateTime('end_date')->change();
        });

        Schema::table('discounts', function (Blueprint $table) {
              $table->dateTime('start_date')->change();
              $table->dateTime('end_date')->change();
        });

        Schema::table('coupon_codes', function (Blueprint $table) {
              $table->dateTime('start_date')->change();
              $table->dateTime('end_date')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */ 
    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
            //
        });
        Schema::table('coupon_codes', function (Blueprint $table) {
            //
        });
        Schema::table('checkout_offers', function (Blueprint $table) {
            //
        });
    }
}
