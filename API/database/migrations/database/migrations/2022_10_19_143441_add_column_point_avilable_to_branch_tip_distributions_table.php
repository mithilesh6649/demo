<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPointAvilableToBranchTipDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_tip_distributions', function (Blueprint $table) {
            $table->float('points')->nullable()->after('staff_id');
            $table->integer('available')->nullable()->after('points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch_tip_distributions', function (Blueprint $table) {
            //
        });
    }
}
