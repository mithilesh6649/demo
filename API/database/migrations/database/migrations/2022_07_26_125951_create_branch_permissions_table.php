<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->string('customer_manage');
            $table->string('staff_manage');
            $table->string('menu_manage');
            $table->string('order_manage');
            $table->string('dine_caterign_manage');
            $table->string('payment_manage');
            $table->string('report_manage');
			$table->tinyInteger('status')->comment('0=>inactive,1=>active')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_permissions');
    }
}
