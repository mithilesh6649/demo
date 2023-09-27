<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactNoToUserLoyaltyPointLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable()->change();
            $table->string('contact_number')->nullable()->after('user_id');
            $table->string('pointaddby')->nullable()->after('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->dropColumn('contact_number');
            $table->dropColumn('pointaddby');
        });
    }
}
