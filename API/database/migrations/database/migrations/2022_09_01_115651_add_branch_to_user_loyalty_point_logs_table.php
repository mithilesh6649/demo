<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchToUserLoyaltyPointLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->string('branch_id')->nullable()->after('level');
            $table->float('total_amount')->nullable()->after('branch_id');
            $table->string('added_by_id')->nullable()->after('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->dropColumn('branch_id');
            $table->dropColumn('total_amount');
            $table->dropColumn('added_by_id');
        });
    }
}
