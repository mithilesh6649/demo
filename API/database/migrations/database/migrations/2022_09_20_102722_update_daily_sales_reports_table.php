<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            $table->text('amex')->change();
            $table->text('visa')->change();
            $table->text('master')->change();
            $table->text('dinner')->change();
            $table->text('mm_online_link')->change();
            $table->text('knet')->change();
            $table->text('other_cards')->change();
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
            $table->text('amex')->change();
            $table->text('visa')->change();
            $table->text('master')->change();
            $table->text('dinner')->change();
            $table->text('mm_online_link')->change();
            $table->text('knet')->change();
            $table->text('other_cards')->change();
        });
    }
}
