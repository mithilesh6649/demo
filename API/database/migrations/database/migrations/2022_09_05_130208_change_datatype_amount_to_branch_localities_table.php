<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatypeAmountToBranchLocalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_localities', function (Blueprint $table) {
            $table->float('delivery_fee',8,3)->nullable()->change();
            $table->float('minimum_order_amount',8,3)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch_localities', function (Blueprint $table) {
            //
        });
    }
}
