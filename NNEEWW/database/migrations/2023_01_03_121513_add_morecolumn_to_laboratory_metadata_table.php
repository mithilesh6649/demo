<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorecolumnToLaboratoryMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboratory_metadata', function (Blueprint $table) {
            $table->string('image')->nullable()->after('laboratory_id');
            $table->float('discount')->nullable()->after('charges');
            $table->string('latitude')->after('state');
            $table->string('longitude')->after('latitude');
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
            $table->dropColumn(['image','discount','latitude','longitude']);
        });
    }
}
