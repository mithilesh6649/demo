<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToHealthStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_statuses', function (Blueprint $table) {
              $table->after('recommended_water_intake',function($table){
                  $table->float('current_waist_circumference')->nullable();
                  $table->float('target_waist_circumference')->nullable();
                  $table->integer('waist_action_plan')->nullable();
                  $table->float('current_hip_circumference')->nullable();
                  $table->float('target_hip_circumference')->nullable();
                  $table->integer('hip_action_plan')->nullable();
                  $table->longText('ant_other_information')->nullable();
                  $table->longText('user_clinical_goals_other_information')->nullable();
                  $table->longText('nutritional_goals_other_information')->nullable();
              });
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
            //
        });
    }
}
