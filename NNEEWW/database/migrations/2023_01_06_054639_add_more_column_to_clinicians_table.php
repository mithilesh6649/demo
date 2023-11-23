<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnToCliniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicians', function (Blueprint $table) {
           $table->after('name',function($table){
            $table->unSignedBigInteger('role_id')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('country_code')->nullable();
            $table->bigInteger('phone_number')->unique()->nullable();
            $table->boolean('phone_verified')->default(0)->comment('0|not verified  1|verified')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->boolean('email_verified')->default(0)->comment('0|not verified  1|verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE');
           });     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::table('clinicians', function (Blueprint $table) {
            $table->dropForeign(['clinicians_role_id_foreign']);
            $table->dropIndex(['clinicians_role_id_index']);
            $table->dropColumn(['role_id','email','password','country_code','phone_number','phone_verified','phone_verified_at','email_verified','email_verified_at','last_login_at']);
        });
    }
}
