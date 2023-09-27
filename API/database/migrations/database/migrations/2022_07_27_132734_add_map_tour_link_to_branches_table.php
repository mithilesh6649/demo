<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMapTourLinkToBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
             $table->string('map_link')->nullable()->after('address');
             $table->string('tour_link')->nullable()->after('map_link');
             $table->string('branch_pdf')->nullable()->after('tour_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
                $table->dropColumn(['map_link','tour_link','branch_pdf']);
        });
    }
}
