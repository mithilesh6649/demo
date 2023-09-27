<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChangeColumnDatatypeToDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
           
            $table->text('cheque')->nullable()->change();
            $table->text('printed_gift_card')->nullable()->change();
            $table->text('e_gift_card')->nullable()->change();
            $table->text('gift_coupon_voucher')->nullable()->change();
            $table->text('cash_equivalent')->nullable()->change();
            $table->text('talabat_credit_TMP')->nullable()->change();
            $table->text('talabat_credit_TGO')->nullable()->after('talabat_credit_TMP');
            $table->text('deliveroo_credit_TMP')->nullable()->change();
            $table->text('deliveroo_credit_TGO')->nullable()->after('deliveroo_credit_TMP');
            $table->text('v_thru_credit_TMP')->nullable()->change();
            $table->text('v_thru_credit_TGO')->nullable()->after('v_thru_credit_TMP');
            $table->text('others_credit_TMP')->nullable()->change();
            $table->text('others_credit_TGO')->nullable()->after('others_credit_TMP');


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
