<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNutritionalGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_nutritional_goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('health_statuses_id');
            $table->unsignedBigInteger('nutritional_goal_id')->comment('From MD dropdown module:-user_clinical_goals');
            $table->integer('action_plan_id')->nullable();
            $table->string('goal')->nullable();
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
        
        Schema::dropIfExists('user_nutritional_goals',function (Blueprint $table) {

            $table->dropForeign(['list_health_statuses_id_foreign']);
        }); 
    }
}
