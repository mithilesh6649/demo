<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrintedCountToDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            $table->integer('printed_count')->nullable()->after('printed_gift_card');
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
            $table->dropColumn('printed_count');
        });
    }
}
