<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppointmentrelatedcolumnToUserMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_metadata', function (Blueprint $table) {
           $table->after('user_id',function($table){
            $table->longText('reason_for_appointment')->nullable();
            $table->longText('expectations_appointment')->nullable();
            $table->longText('clinical_goals_appointment')->nullable();
            $table->longText('other_information_appointment')->nullable();
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
        Schema::table('user_metadata', function (Blueprint $table) {
             $table->dropColumn(['reason_for_appointment','expectations_appointment','clinical_goals_appointment','other_information_appointment']);
        });
    }
}
