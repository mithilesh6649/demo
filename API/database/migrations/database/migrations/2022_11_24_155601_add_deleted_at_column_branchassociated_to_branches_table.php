<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtColumnBranchassociatedToBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('branch_assigned_permissions', function (Blueprint $table) {
            $table->softDeletes()->after('status');
        });

        Schema::table('branch_logs', function (Blueprint $table) {
            $table->softDeletes()->after('status');
        });

        Schema::table('branch_tip_balances', function (Blueprint $table) {
            $table->softDeletes()->after('branch_tip_distribution_id');
        });

        Schema::table('branch_working_hours', function (Blueprint $table) {
            $table->softDeletes()->after('break_ending_time');
        });

        Schema::table('discount_branches', function (Blueprint $table) {
            $table->softDeletes()->after('branch_id');
        });

        Schema::table('current_offer_branches', function (Blueprint $table) {
            $table->softDeletes()->after('branch_id');
        });

        Schema::table('checkout_offer_branches', function (Blueprint $table) {
            $table->softDeletes()->after('branch_id');
        });

        Schema::table('branches_permissions', function (Blueprint $table) {
            $table->softDeletes();
        });

         Schema::table('branch_permissions', function (Blueprint $table) {
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

        Schema::table('branch_assigned_permissions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('branch_logs', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('branch_tip_balances', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('branch_working_hours', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('discount_branches', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('current_offer_branches', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('checkout_offer_branches', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('branches_permissions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

              Schema::table('branch_permissions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

    }
}
