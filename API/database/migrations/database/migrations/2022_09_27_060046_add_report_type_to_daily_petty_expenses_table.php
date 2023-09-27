<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportTypeToDailyPettyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_expenses', function (Blueprint $table) {
            $table->tinyInteger('report_type')->default(0)->comment('0=>normal,1=>pv voucher')->after('voucher_number');
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
            $table->dropColumn('report_type');
        });
    }
}
