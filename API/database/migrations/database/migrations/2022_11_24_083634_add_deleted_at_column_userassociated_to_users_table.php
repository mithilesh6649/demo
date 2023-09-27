<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtColumnUserassociatedToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->softDeletes()->after('status');
        });

        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->softDeletes()->after('user_loyalty_log');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->softDeletes()->after('accepted_at');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->softDeletes()->after('is_loyalty');
        });

        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->softDeletes()->after('pointaddby');
        });

        Schema::table('user_loyalty_points', function (Blueprint $table) {
            $table->softDeletes()->after('total_points');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->softDeletes()->after('address_type');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('user_loyalty_points', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

    }
}
