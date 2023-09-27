<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinimumOrderAmountToBranchLocalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_localities', function (Blueprint $table) {
            $table->float('minimum_order_amount')->after('status')->default(5);
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->float('minimum_order_amount')->change();
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
            $table->dropColumn('minimum_order_amount');
        });
    }
}
