<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableColumnInWebUserMetadata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('web_user_metadata', function (Blueprint $table) {
            $table->renameColumn('clinician_id', 'web_user_id');
        });

        Schema::table('web_user_specialization_maps', function (Blueprint $table) {
            $table->renameColumn('clinician_id', 'web_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_user_metadata', function (Blueprint $table) {
            $table->renameColumn('web_user_id', 'clinician_id');
        });

        Schema::table('web_user_specialization_maps', function (Blueprint $table) {
            $table->renameColumn('web_user_id', 'clinician_id');
        });
    }
}
