<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('management', function (Blueprint $table) {
            $table->renameColumn('name','name_en');
            $table->renameColumn('organization', 'organization_en');
            $table->renameColumn('content', 'content_en');

            $table->string('name_ar')->nullable()->after('name');
            $table->string('organization_ar')->nullable()->after('organization');
            $table->longText('content_ar')->nullable()->after('content');
           
        });

        Schema::table('management_roles', function (Blueprint $table) {
            $table->renameColumn('name', 'name_en');
           
            $table->string('name_ar')->nullable()->after('name');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('management', function (Blueprint $table) {
            //
        });
    }
}
