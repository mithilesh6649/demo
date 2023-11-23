<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInLabMetadata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboratory_metadata', function (Blueprint $table) {
            $table->char('country_code', 4)->after('close_time');
            $table->bigInteger('phone_number')->after('country_code');
            $table->char('country', 30)->after('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laboratory_metadata', function (Blueprint $table) {
            $table->dropColumn(['country_code', 'phone_number', 'country']);
        });
    }
}
