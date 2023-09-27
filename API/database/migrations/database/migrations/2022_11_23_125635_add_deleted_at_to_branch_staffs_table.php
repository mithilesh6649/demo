<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToBranchStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_staffs', function (Blueprint $table) {
             $table->softDeletes()->after('is_tip_pending'); 
        });

        Schema::table('staff_promotion_histories', function (Blueprint $table) {
             $table->softDeletes()->after('new_point'); 
        });

        Schema::table('branch_cars', function (Blueprint $table) {
             $table->softDeletes()->after('status'); 
        });

        Schema::table('branch_drivers', function (Blueprint $table) {
             $table->softDeletes()->after('status'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch_staffs', function (Blueprint $table) {
             $table->dropColumn('deleted_at');
        });

      Schema::table('staff_promotion_histories', function (Blueprint $table) {
             $table->dropColumn('deleted_at'); 
       });

        Schema::table('branch_cars', function (Blueprint $table) {
             $table->dropColumn('deleted_at'); 
       });

        Schema::table('branch_drivers', function (Blueprint $table) {
             $table->dropColumn('deleted_at'); 
       });  
    }
}
