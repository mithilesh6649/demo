<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id');
            $table->integer('branch_id');
            $table->date('start_leave_date')->nullable();
            $table->date('end_leave_date')->nullable();
            $table->enum('leave_type', ['0','1'])->comment("0:Single Leave'', 1:Multiple Leaves'");
            $table->mediumText('reason')->nullable();
            $table->enum('status', ['0','1'])->default('1')->comment("0:inactive', 1:active'");
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
        Schema::dropIfExists('staff_leaves');
    }
}
