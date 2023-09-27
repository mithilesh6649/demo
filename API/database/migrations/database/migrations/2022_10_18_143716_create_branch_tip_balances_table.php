<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchTipBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_tip_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->float('opening_balance',8,3)->nullable();
            $table->float('tip_received',8,3)->nullable();
            $table->float('tip_distributed',8,3)->nullable();
            $table->float('closing_balance',8,3)->nullable();
            $table->unsignedBigInteger('branch_tip_id')->nullable();
            $table->unsignedBigInteger('branch_tip_distribution_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches'); 
            $table->foreign('branch_tip_id')->references('id')->on('branch_tips');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('branch_tip_balances');
    }
}
