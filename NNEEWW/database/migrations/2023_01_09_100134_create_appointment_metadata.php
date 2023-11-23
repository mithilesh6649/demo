<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentMetadata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_metadata', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('appointment_id');
            $table->string('appointment_join_url')->nullable();
            $table->dateTime('appointment_time')->nullable();
            $table->json('appointment_response')->nullable();
            $table->enum('status', ['1', '2', '3'])->comment('1|requested  2|scheduled  3|appointment end')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_metadata', function (Blueprint $table) {
            $table->dropForeign('appointment_metadata_appointment_id_foreign');
        });
    }
}
