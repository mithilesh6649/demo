<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorecolumnsToAppointmentMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_metadata', function (Blueprint $table) {
            $table->after('appointment_response',function($table){
              $table->mediumText('reason_for_appointment')->nullable();
              $table->mediumText('expectations')->nullable();
              $table->mediumText('clinical_goals')->nullable();
              $table->longText('appointment_other_information')->nullable();
          });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment_metadata', function (Blueprint $table) {
        $table->dropColumn(['appointment_response','reason_for_appointment','expectations','clinical_goals','appointment_other_information']);
        });
    }
}
