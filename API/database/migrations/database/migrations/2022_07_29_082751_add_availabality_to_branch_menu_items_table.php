<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvailabalityToBranchMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_menu_items', function (Blueprint $table) {
              $table->integer('availabality')->default(1)->after('status')->nullable()->comment('1 =>Available,0 =>Unavailable,60=>Unaivalibale for 1 Hour(60min),120 =>Unaivalibale for 2 Hour(120min),240=>Unaivalibale for 4 Hour(240min),1440=>Unaivalibale Untill Next Day(1440min)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch_menu_items', function (Blueprint $table) {
               $table->dropColumn('availabality');
        });
    }
}
