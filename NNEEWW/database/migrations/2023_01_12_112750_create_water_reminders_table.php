<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_reminders', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->datetime('cron_time');
            $table->tinyInteger('actual_repetition_count');
            $table->tinyInteger('repetition_count');
            $table->char('reminder_type', 15);
            $table->datetime('add_time_to_cron_time')->nullable();
            $table->tinyInteger('interval_time')->nullable();
            $table->boolean('status')->comment('0|disable notification  1|enable notification');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->index(['user_id', 'cron_time', 'status', 'repetition_count']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('water_reminders', function (Blueprint $table) {
            $table->foreign('water_reminders_user_id_foreign');
            $table->dropIndex(['user_id', 'cron_time', 'status', 'repetition_count']);
        });
    }
}
