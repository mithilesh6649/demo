<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatLongToWebUserMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('web_user_metadata', function (Blueprint $table) {
            $table->after('working_area', function ($table) {
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->string('address')->nullable();
                $table->char('city')->nullable();
                $table->char('state')->nullable();
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
        Schema::table('web_user_metadata', function (Blueprint $table) {
            $table->dropColumn(['working_area','latitude','longitude','address','city','state']);
        });
    }
}
