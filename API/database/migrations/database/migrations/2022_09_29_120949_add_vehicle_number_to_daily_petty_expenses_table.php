<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVehicleNumberToDailyPettyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_expenses', function (Blueprint $table) {
            $table->string('car_id')->nullable()->after('voucher_number');
            $table->string('driver_name')->nullable()->after('car_id');
            $table->string('driven_km')->nullable()->after('driver_name');
            $table->string('fuel')->nullable()->after('driven_km');
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
            $table->dropColumn('car_id');
            $table->dropColumn('driver_name');
            $table->dropColumn('driver_km');
            $table->dropColumn('fuel');
        });
    }
}
