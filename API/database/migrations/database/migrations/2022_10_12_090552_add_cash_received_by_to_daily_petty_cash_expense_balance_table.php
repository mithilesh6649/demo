<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCashReceivedByToDailyPettyCashExpenseBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_cash_expense_balance', function (Blueprint $table) {
            $table->string('cash_received_by')->after('petty_cash_closing_balance')->default('cash');
            $table->string('cheque_number')->after('cash_received_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_petty_cash_expense_balance', function (Blueprint $table) {
            $table->dropColumn('cash_received_by');
            $table->dropColumn('cheque_number');
        });
    }
}
