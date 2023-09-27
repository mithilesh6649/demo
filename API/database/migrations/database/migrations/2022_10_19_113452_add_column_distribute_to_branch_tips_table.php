<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDistributeToBranchTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_tips', function (Blueprint $table) {
            $table->boolean('is_distributed')->default(0)->after('report_date');
            $table->integer('distributed_batch')->nullable()->after('is_distributed');
        });

        Schema::table('branch_tip_distributions', function (Blueprint $table) {
            $table->boolean('is_distributed')->default(0)->after('distribution_date');
            $table->integer('distributed_batch')->nullable()->after('is_distributed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch_tips', function (Blueprint $table) {
            //
        });
    }
}
