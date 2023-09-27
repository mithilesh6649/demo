<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissionMaintenanceColumnToBranchPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('branch_permissions', function (Blueprint $table) {
            $table->string('maintenance_reports_add')->nullable()->after('new_orders_view');
            $table->string('maintenance_reports_view')->nullable()->after('maintenance_reports_add');
            $table->string('maintenance_reports_edit')->nullable()->after('maintenance_reports_view');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch_permissions', function (Blueprint $table) {
            $table->dropColumn('maintenance_reports_add');
            $table->dropColumn('maintenance_reports_view');
            $table->dropColumn('maintenance_reports_edit');




        });
    }
}
