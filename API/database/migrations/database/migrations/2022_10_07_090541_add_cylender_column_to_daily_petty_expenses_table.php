<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCylenderColumnToDailyPettyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_expenses', function (Blueprint $table) {
            $table->integer('number_cylinder')->nullable()->after('petrol_slip_date');
            $table->float('cylinder_amount',8,3)->nullable()->after('number_cylinder');
            $table->float('cylinder_commission',8,3)->nullable()->after('cylinder_amount');
            $table->float('totol_amount',8,3)->nullable()->after('cylinder_commission');
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
            $table->dropColumn('number_cylinder');
            $table->dropColumn('cylinder_amount');
            $table->dropColumn('cylinder_commission');
            $table->dropColumn('totol_amount');
        });
    }
}
