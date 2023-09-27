<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTipDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('employee_tip_distributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->float('point',8,3)->nullable();
            $table->float('tip',8,3)->nullable();
            $table->float('rider',8,3)->nullable();
            $table->dateTime('tip_date')->nullable();
            $table->dateTime('distribution_date')->nullable();
            $table->integer('distributed_batch')->nullable();

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
        Schema::dropIfExists('employee_tip_distributions');
    }
}
