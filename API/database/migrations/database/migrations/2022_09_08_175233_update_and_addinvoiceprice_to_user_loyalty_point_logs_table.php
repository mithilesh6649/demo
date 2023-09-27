<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAndAddinvoicepriceToUserLoyaltyPointLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->renameColumn('total_amount', 'invoice_amount');
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
            $table->dropColumn('invoice_amount');
        });
    }
}
