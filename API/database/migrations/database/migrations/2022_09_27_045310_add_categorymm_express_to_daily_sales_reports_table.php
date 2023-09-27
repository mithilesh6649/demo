<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategorymmExpressToDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            $table->float('MM_Express_TGO',8,3)->nullable()->after('talabat_TGO');
            $table->integer('MM_Express_TGO_count')->nullable()->after('talabat_TGO_count');
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
            $table->dropColumn('MM_Express_TGO');
            $table->dropColumn('MM_Express_TGO_count');
        });
    }
}
