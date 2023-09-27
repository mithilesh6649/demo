<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditDebitCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_debit_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('bank')->nullable();
            $table->float('k_net',8,3)->nullable();
            $table->float('visa',8,3)->nullable();
            $table->float('master_card',8,3)->nullable();
            $table->float('gcc',8,3)->nullable();
            $table->float('orders',8,3)->nullable();            
            $table->float('amex',8,3)->nullable();
            $table->float('payment_getway',8,3)->nullable();
            $table->float('diner',8,3)->nullable();
            $table->float('mm_pay_link',8,3)->nullable();

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
        Schema::dropIfExists('credit_debit_commissions');
    }
}
