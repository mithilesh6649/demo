<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorecolumnToHealthComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_complaints', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->string('image')->nullable()->after('description');
            $table->boolean('is_show')->comment('1|Yes ( Display on Website ) 0|No')->default('0')->after('image');
            $table->boolean('types')->comment('0|allergy 1|disease 2|Disorders 3|General Information')->default('0')->after('is_show'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_complaints', function (Blueprint $table) {
             $table->dropColumn(['image','is_show','type']);
        });
    }
}
