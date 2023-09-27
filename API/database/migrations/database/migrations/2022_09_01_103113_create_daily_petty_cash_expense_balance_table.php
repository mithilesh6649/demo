<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyPettyCashExpenseBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_petty_cash_expense_balance', function (Blueprint $table) {
            $table->id();
            $table->string('mode')->nullable();
            $table->float('petty_cash_opening_balance')->nullable();
            $table->float('cash_received')->nullable();
            $table->float('cash_expense')->nullable();
            $table->float('petty_cash_closing_balance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_petty_cash_expense_balance');
    }
}
