<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('branch_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->nullable();
            $table->string('role_tag')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=>inactive,1=>active');
            $table->softDeletes();
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
        Schema::dropIfExists('branch_roles');
    }
}
