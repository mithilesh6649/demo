<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToSchedulerTypeColumnInMedicineTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `medicine_trackers` MODIFY scheduler_type ENUM('1','2') DEFAULT NULL;");

        Schema::table('medicine_trackers', function (Blueprint $table) {
            $table->datetime('start_date')->nullable()->change();
            $table->datetime('end_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_trackers', function (Blueprint $table) {
            //
        });
    }
}
