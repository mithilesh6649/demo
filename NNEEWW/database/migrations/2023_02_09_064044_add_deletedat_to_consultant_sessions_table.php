<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedatToConsultantSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultant_sessions', function (Blueprint $table) {
           $table->softDeletes();
       });
        Schema::table('referral_patients', function (Blueprint $table) {
           $table->softDeletes();
       });
        Schema::table('testimonials', function (Blueprint $table) {
           $table->softDeletes();
       });
        Schema::table('social_links', function (Blueprint $table) {
           $table->softDeletes();
       });
        Schema::table('blogs', function (Blueprint $table) {
           $table->softDeletes();
       });
        Schema::table('recipes', function (Blueprint $table) {
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
        Schema::table('consultant_sessions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('referral_patients', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('social_links', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
