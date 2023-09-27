<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchDeliveryAndBranchPickupTimeToBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->bigInteger('branch_delivery_time')->nullable()->after('accepts_paypal');
            $table->bigInteger('branch_pickup_time')->nullable()->after('branch_delivery_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('branch_delivery_time');
            $table->dropColumn('branch_pickup_time');
        });
    }
}
