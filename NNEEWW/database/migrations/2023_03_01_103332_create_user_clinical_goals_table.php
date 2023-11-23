<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClinicalGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_clinical_goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('health_statuses_id');
            $table->unsignedBigInteger('clinical_goal_id')->comment('From MD dropdown module:-user_clinical_goals');
            $table->integer('action_plan_id')->nullable();
            $table->integer('current_goal')->nullable();
            $table->integer('target_goal')->nullable();
            $table->timestamps();
            $table->foreign('health_statuses_id')->references('id')->on('health_statuses')->onDelete('CASCADE');
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_clinical_goals',function (Blueprint $table) {

            $table->dropForeign(['list_health_statuses_id_foreign']);
        }); 
    }
}
