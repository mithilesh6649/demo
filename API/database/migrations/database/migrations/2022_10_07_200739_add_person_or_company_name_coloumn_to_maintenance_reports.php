<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonOrCompanyNameColoumnToMaintenanceReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenance_reports', function (Blueprint $table) {
            $table->string('person_or_company_name')->nullable()->after('doc_ref_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenance_reports', function (Blueprint $table) {
            $table->dropColumn('person_or_company_name');
        });
    }
}
