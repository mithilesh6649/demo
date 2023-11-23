<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnCronRunInMedicineRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_reminders', function (Blueprint $table) {
            $table->boolean('cron_run')->after('remind_time')->comment('0|cron not run  1|cron runs')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_reminders', function (Blueprint $table) {
            $table->dropColumn('cron_run');
        });
    }
}
