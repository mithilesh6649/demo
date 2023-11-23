<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFollowUpDescriptionToAppointmentMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_metadata', function (Blueprint $table) {
            $table->longText('followup_description')->nullable()->after('appointment_other_information');
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
            $table->dropColumn('followup_description');
        });
    }
}
