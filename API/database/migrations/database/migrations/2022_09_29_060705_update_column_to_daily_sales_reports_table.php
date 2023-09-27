<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnToDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {

            $table->renameColumn('talabat_credit', 'talabat_credit_TMP');
            $table->renameColumn('deliveroo_credit', 'deliveroo_credit_TMP');
            $table->renameColumn('v_thru_credit', 'v_thru_credit_TMP');
            $table->renameColumn('others_credit', 'others_credit_TMP');


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
