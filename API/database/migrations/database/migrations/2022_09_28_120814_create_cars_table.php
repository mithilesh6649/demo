<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('lease_no')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('no_plate')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('file_no')->nullable();
            $table->string('document_no')->nullable();
            $table->string('chassis_no');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('branch')->nullable();
            $table->string('ins_no')->nullable();
            $table->string('remarks');
            $table->boolean('status')->default('1');
            $table->foreign('owner_id')->references('id')->on('ownerships');
            $table->foreign('driver_id')->references('id')->on('drivers');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
