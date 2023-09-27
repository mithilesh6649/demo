<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToDailyPettyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_expenses', function (Blueprint $table) {
            $table->softDeletes()->after('report_date');
        });
        Schema::table('daily_petty_expense_docs', function (Blueprint $table) {
            $table->softDeletes()->after('doc');
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
            $table->dropSoftDeletes();
        });
        Schema::table('daily_petty_expense_docs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
