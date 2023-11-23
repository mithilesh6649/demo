<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCurrentOpeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('current_openings', function (Blueprint $table) {
            $table->boolean('status')->comment('0|inactive 1|active')->default('1')->after('employee_type');
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
        Schema::table('current_openings', function (Blueprint $table) {
            $table->dropColumn(['status', 'deleted_at']);
        });
    }
}
