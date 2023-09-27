<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchAssignedPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_assigned_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('branches_permission_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('branch_role_id')->nullable();
            $table->tinyInteger('status')->comment('1 => Active , 0 => Incative')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_assigned_permissions');
    }
}
