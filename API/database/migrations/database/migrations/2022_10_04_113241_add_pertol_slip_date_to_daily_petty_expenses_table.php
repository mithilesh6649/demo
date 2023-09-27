<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPertolSlipDateToDailyPettyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_expenses', function (Blueprint $table) {
            $table->date('petrol_slip_date')->nullable()->after('fuel_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_petty_expenses', function (Blueprint $table) {
            $table->date('petrol_slip_date');
        });
    }
}
