<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCarExpiryToCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
              $table->tinyInteger('expiry_before_one_months')->comment('1=>sent,0=>not sent')->default(0)->after('status');
             $table->tinyInteger('expiry_before_15_days')->comment('1=>sent,0=>not sent')->default(0)->after('expiry_before_one_months');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
               $table->dropColumn('expiry_before_one_months');
              $table->dropColumn('expiry_before_15_days');
        });
    }
}
