<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryChargeToBranchLocalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_localities', function (Blueprint $table) {
           $table->float('delivery_fee')->after('minimum_order_amount')->nullable();
           $table->softDeletes();
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
             $table->dropColumn('delivery_fee');
        });
    }
}
