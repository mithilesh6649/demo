<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchTipDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_tip_distributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->float('amount',8,3)->nullable();
            $table->string('type')->default('Normal');
            $table->date('distribution_date')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('staff_id')->references('id')->on('staff'); 
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
        Schema::dropIfExists('branch_tip_distributions');
    }
}
