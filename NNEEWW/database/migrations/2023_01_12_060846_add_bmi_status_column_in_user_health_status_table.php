<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBmiStatusColumnInUserHealthStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_statuses', function (Blueprint $table) {
            $table->enum('bmi_status', ['underweight', 'normal', 'overweight', 'obesity'])->after('bmi')->nullable();
            $table->float('weight_difference')->after('target_weight_unit')->nullable();
            $table->datetime('target_weight_completion_date')->after('weight_difference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_statuses', function (Blueprint $table) {
            $table->dropColumn(['bmi_status', 'weight_difference', 'target_weight_completion_date']);
        });
    }
}
