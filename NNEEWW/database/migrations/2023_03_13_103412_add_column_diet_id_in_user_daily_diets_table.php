<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDietIdInUserDailyDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_daily_diets', function (Blueprint $table) {
            $table->unSignedBigInteger('diet_id')->after('diet_plan_id')->nullable();

            $table->foreign('diet_id')->references('id')->on('diets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_daily_diets', function (Blueprint $table) {
            $table->dropForeign('user_daily_diets_diet_id_foreign');
            $table->dropColumn('diet_id');
        });
    }
}
