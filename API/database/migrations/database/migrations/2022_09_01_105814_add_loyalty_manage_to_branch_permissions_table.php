<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoyaltyManageToBranchPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_permissions', function (Blueprint $table) {
              $table->string('loyalty_manage')->after('report_manage')->nullable();
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
              $table->dropColumn('loyalty_manage');
        });
    }
}
