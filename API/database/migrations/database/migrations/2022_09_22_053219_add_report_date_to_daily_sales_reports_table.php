<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportDateToDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            $table->date('report_date')->nullable()->after('cash_in_hand_closing_balance');
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
           $table->dropColumn('report_date');
        });
    }
}
