<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorecolumnToAppointmentMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_metadata', function (Blueprint $table) {
             $table->time('start_time')->nullable()->after('appointment_time');
             $table->time('end_time')->nullable()->after('start_time');
             $table->string('meeting_id')->nullable()->after('appointment_id');
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
            $table->dropColumn(['start_time','end_time','meeting_id']);
        });
    }
}
