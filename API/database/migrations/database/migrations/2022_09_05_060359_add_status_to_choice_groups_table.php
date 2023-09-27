<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToChoiceGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('choice_groups', function (Blueprint $table) {
            $table->tinyInteger('status')->comment('0=>inactive,1=>active')->default(1)->after('total_choice_count'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('choice_groups', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
