<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusInUserSpecializedDietPlanMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_specialized_diet_plan_maps', function (Blueprint $table) {
            $table->boolean('status')->after('diet_id')->comment('0|inactive  1|active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_specialized_diet_plan_maps', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
}
