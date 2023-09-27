<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchRoleIdToBranchPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_permissions', function (Blueprint $table) {
             $table->integer('branch_role_id')->nullable()->after('branch_id')->comment('branche role id means->manger,font desk etc id for branch managers role');
             $table->dropColumn('staff_manage');
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
              $table->dropColumn('branch_role_id');
        });
    }
}
