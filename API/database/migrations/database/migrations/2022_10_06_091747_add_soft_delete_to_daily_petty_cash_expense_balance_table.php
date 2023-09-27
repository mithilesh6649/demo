<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToDailyPettyCashExpenseBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_cash_expense_balance', function (Blueprint $table) {
            $table->softDeletes()->after('report_date');
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
            $table->dropSoftDeletes();
        });
    }
}
