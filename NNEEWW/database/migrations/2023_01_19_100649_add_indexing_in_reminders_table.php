<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexingInRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_schedulers', function (Blueprint $table) {
            $table->index('medicine_tracker_id');
        });

        Schema::table('medicine_reminders', function (Blueprint $table) {
            $table->index('medicine_tracker_id');
            $table->index('remind_time');
        });

        Schema::table('water_trackers', function (Blueprint $table) {
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_schedulers', function (Blueprint $table) {
            $table->dropIndex(['medicine_tracker_id']);
        });

        Schema::table('medicine_reminders', function (Blueprint $table) {
            $table->dropIndex(['medicine_tracker_id']);
            $table->dropIndex(['remind_time']);
        });

        Schema::table('water_trackers', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });
    }
}
