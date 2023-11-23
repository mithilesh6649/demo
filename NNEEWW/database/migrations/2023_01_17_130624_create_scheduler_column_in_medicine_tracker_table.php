<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulerColumnInMedicineTrackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_trackers', function (Blueprint $table) {
            $table->boolean('schedule')->after('scheduler_type')->nullable()->comment('0|not scheduled  1|scheduled');
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
            $table->dropColumn('schedule');
        });
    }
}
