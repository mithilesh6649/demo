<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_patients', function (Blueprint $table) {
            $table->id();
            $table->char('first_name', 40)->nullable();
            $table->char('last_name', 40)->nullable();
            $table->char('email', 40)->nullable();
            $table->char('city', 25)->nullable();
            $table->char('country_code', 4)->nullable();
            $table->bigInteger('contact')->nullable();
            $table->json('diseases')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_patients');
    }
}
