<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicianSpecializationMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinician_specialization_maps', function (Blueprint $table) {
            $table->unSignedBigInteger('clinician_id');
            $table->unSignedBigInteger('specialization_id');

            $table->foreign('clinician_id')->references('id')->on('clinicians')->onDelete('CASCADE');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinician_specialization_maps', function (Blueprint $table) {
            
            $table->dropForeign(['clinician_specialization_maps_clinician_id_foreign', 'clinician_specialization_maps_specialization_id_foreign']);
        });
    }
}
