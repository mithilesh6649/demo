<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_balances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('maintenance_report_id')->nullable();
            $table->double('opening_balance')->nullable();
            $table->double('cash_received')->nullable();
            $table->double('expense')->nullable();
            $table->double('closing_balance')->nullable();
            $table->date('report_date')->nullable();
            $table->string('doc_ref_no')->nullable();
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
        Schema::dropIfExists('maintenance_balances');
    }
}
