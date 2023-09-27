<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrdersCountInDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            $table->integer('dine_in_restaurant_count')->after('credit_sale')->nullable();
            $table->integer('dine_in_cabin_count')->after('dine_in_restaurant_count')->nullable();
            $table->integer('self_pickup_count')->after('dine_in_cabin_count')->nullable();
            $table->integer('home_delivery_count')->after('self_pickup_count')->nullable();
            $table->integer('buffet_count')->after('home_delivery_count')->nullable();
            $table->integer('talabat_TEM_count')->after('buffet_count')->nullable();
            $table->integer('talabat_TGO_count')->after('talabat_TEM_count')->nullable();
            $table->integer('deliveroo_TEM_count')->after('talabat_TGO_count')->nullable();
            $table->integer('deliveroo_TGO_count')->after('deliveroo_TEM_count')->nullable();
            $table->integer('v_thru_count')->after('deliveroo_TGO_count')->nullable();
            $table->integer('mm_online_count')->after('v_thru_count')->nullable();
            $table->integer('osc_count')->after('mm_online_count')->nullable();
            $table->integer('garden_count')->after('osc_count')->nullable();
            $table->integer('others_gross_count')->after('garden_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            //
        });
    }
}
