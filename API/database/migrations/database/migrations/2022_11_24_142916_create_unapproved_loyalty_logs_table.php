<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnapprovedLoyaltyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unapproved_loyalty_logs', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('customer_number')->default('+965');
            $table->string('country_code')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('level')->nullable();
            $table->float('invoice_amount',8,3)->nullable();
            $table->float('lavel_point',8,3)->nullable();
            $table->float('loyalty_points',8,3)->nullable();
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
        Schema::dropIfExists('unapproved_loyalty_logs');
    }
}
