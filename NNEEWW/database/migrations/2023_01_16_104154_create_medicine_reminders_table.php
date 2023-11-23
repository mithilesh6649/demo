<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_reminders', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('medicine_tracker_id');
            $table->datetime('remind_time');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('medicine_tracker_id')->references('id')->on('medicine_trackers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_reminders', function (Blueprint $table) {
            $table->dropForeign('medicine_reminders_medicine_tracker_id_foreign');
        });
    }
}
