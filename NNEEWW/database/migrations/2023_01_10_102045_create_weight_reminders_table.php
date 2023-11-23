<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_reminders', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->char('timepoint');
            $table->enum('type', ['1', '2'])->comment('1|day  2|date');
            $table->datetime('cron_time')->nullable();
            $table->boolean('status')->default(0)->comment('0|disable Notfication  1|enable Notification');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->index(['user_id', 'cron_time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_reminders', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropIndex(['user_id', 'cron_time']);
        });
    }
}
