<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->string('email_verification_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('is_email_verified')->default(0)->comment('0=>unverified,1=>verified');
            $table->string('phone_number')->nullable();
            $table->tinyInteger('job_alert')->default(0)->comment('0=>disabled,1=>enabled');
            $table->string('ip_address')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('login_with')->nullable()->comment('email, facebook, google, linkedin etc.');
            $table->tinyInteger('is_user_locked')->default(0)->comment('0=>no,1=>yes');
            $table->timestamp('user_locked_at')->nullable();
            $table->tinyInteger('wrong_attempt')->nullable();
            $table->string('primary_language')->nullable();
            $table->integer('country')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->biginteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
