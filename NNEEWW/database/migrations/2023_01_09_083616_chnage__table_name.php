<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChnageTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('clinicians', 'web_users');
        Schema::rename('clinician_metadata', 'web_user_metadata');
        Schema::rename('clinician_specialization_maps', 'web_user_specialization_maps');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('web_users', 'clinicians');
        Schema::rename('web_user_metadata', 'clinician_metadata');
        Schema::rename('web_user_specialization_maps', 'clinician_specialization_maps');
    }
}
