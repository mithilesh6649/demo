<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDiscountsTableAllColumnInDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->renameColumn('dicount_type', 'discount_type');
            $table->renameColumn('amount', 'discount_amount');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
           $table->renameColumn('discount_type', 'dicount_type');
           $table->renameColumn('discount_amount', 'amount');
           
        });
    }
}
