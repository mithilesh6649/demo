<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContryCodeToUserLoyaltyPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_loyalty_points', function (Blueprint $table) {
            $table->string('country_code')->default('+965')->after('contact_number');
        });

        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->string('country_code')->default('+965')->after('contact_number');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_loyalty_points', function (Blueprint $table) {
            $table->dropColumn('country_code');
        });
        Schema::table('user_loyalty_point_logs', function (Blueprint $table) {
            $table->dropColumn('country_code');
        });
    }
}
