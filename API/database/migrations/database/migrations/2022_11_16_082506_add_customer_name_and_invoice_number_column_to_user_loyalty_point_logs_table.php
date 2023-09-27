<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerNameAndInvoiceNumberColumnToUserLoyaltyPointLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->after('user_id');
            $table->string('invoice_number')->nullable()->after('customer_name');
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
            //
        });
    }
}
