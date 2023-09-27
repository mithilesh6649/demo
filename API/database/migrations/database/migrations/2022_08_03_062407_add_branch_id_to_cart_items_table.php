<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdToCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('delivery_type')->after('offer_id')->nullable();
            $table->date('date')->after('delivery_type')->nullable();
            $table->time('from_time')->after('date')->nullable();
            $table->time('to_time')->after('from_time')->nullable();
            $table->bigInteger('branch_id')->after('to_time')->nullable();
            $table->bigInteger('category_id')->after('branch_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('delivery_type');
            $table->dropColumn('date');
            $table->dropColumn('from_time');
            $table->dropColumn('to_time');
            $table->dropColumn('branch_id');
            $table->dropColumn('category_id');
        });
    }
}
