<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id')->nullable();
            $table->unSignedBigInteger('invitee_id')->nullable();
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('invitee_id')->references('id')->on('web_users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments', function (Blueprint $table) {
            $table->dropForeign(['appointments_user_id_foreign', 'appointments_invitee_id_foreign']);
        });
    }
}
