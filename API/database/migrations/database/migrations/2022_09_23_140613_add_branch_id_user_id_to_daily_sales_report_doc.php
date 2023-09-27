<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdUserIdToDailySalesReportDoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_report_doc', function (Blueprint $table) {
            $table->integer('branch_id')->nullable()->after('id');
            $table->integer('user_id')->nullable()->after('branch_id');
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
            $table->dropColumn('branch_id');
            $table->dropColumn('user_id');
        });
    }
}
