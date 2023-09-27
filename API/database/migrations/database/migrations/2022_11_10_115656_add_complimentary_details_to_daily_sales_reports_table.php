<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComplimentaryDetailsToDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            $table->text('complimentary_name')->nullable()->after('complimentary');
            $table->text('complimentary_contact')->nullable()->after('complimentary_name');
            $table->text('complimentary_invoice')->nullable()->after('complimentary_contact');
            $table->text('complimentary_amount')->nullable()->after('complimentary_invoice');
            $table->text('complimentary_ref')->nullable()->after('complimentary_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            //
        });
    }
}
