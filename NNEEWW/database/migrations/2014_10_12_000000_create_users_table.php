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
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->tinyInteger('country_code')->nullable();
            $table->bigInteger('phone_number')->unique()->nullable();
            $table->integer('login_otp')->nullable();
            $table->boolean('phone_verified')->default(0)->comment('0|not verified  1|verified')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->boolean('email_verified')->default(0)->comment('0|not verified  1|verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('login_with')->nullable();
            $table->boolean('account_locked')->nullable();
            $table->timestamp('account_locked_at')->nullable();
            $table->tinyInteger('wrong_attempt')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->boolean('push_notification')->default(0)->comment('0|disable  1|enable')->nullable();
            $table->boolean('email_notification')->default(0)->comment('0|disable  1|enable')->nullable();
            $table->boolean('terms_and_conditions')->comment('0|rejected  1|accepted')->nullable();
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->rememberToken();
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
