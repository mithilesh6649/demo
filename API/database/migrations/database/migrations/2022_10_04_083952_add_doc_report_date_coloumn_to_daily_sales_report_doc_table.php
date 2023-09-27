<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocReportDateColoumnToDailySalesReportDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_report_doc', function (Blueprint $table) {
            $table->date('doc_report_date')->nullable()->after('doc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_sales_report_doc', function (Blueprint $table) {
            $table->dropColumn('doc_report_date');
        });
    }
}
