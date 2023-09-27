<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryTypeToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_type')->nullable()->after('final_amount');
            $table->date('date')->nullable()->after('delivery_type');
            $table->time('from_time')->nullable()->after('date');
            $table->time('to_time')->nullable()->after('from_time');
            $table->bigInteger('branch_locality_id')->nullable()->after('to_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('delivery_type');
            $table->dropColumn('date');
            $table->dropColumn('from_time');
            $table->dropColumn('to_time');
            $table->dropColumn('branch_locality_id');
        });
    }
}
