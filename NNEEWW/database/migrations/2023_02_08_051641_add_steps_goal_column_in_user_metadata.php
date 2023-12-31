<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStepsGoalColumnInUserMetadata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_metadata', function (Blueprint $table) {
            $table->integer('step_goal')->after('water_glass_goal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_metadata', function (Blueprint $table) {
            $table->dropColumn('step_goal');
        });
    }
}
