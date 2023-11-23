<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicianMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinician_metadata', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('clinician_id');
            $table->string('image')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('working_area')->nullable();
            $table->char('open_time')->nullable();
            $table->char('close_time')->nullable();
            $table->char('currency', 10)->nullable();
            $table->float('charges')->nullable();
            $table->enum('charges_per', ['hr', 'min'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('clinician_id')->references('id')->on('clinicians')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinician_metadata');
    }
}
