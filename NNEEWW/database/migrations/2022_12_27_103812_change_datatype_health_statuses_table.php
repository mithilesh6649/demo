<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatypeHealthStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_statuses', function (Blueprint $table) {
            $table->unsignedInteger('disease_id')->change();
            $table->unsignedInteger('weekly_goals')->change();
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
            $table->integer('disease_id')->change();
            $table->integer('weekly_goals')->change();
        });
    }
}
