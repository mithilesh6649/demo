<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnInFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('features', function (Blueprint $table) {
            $table->tinyInteger('type')->after('slug')->comment('1|diet plans  2|sub diet plan  3|sub diet plan duration')->default(1);
            $table->boolean('is_genetic_test')->after('type')->default(0);
            $table->tinyInteger('genetic_test_count')->after('is_genetic_test')->comment('number of genetic tests')->nullable();
            $table->tinyInteger('other_test_count')->after('genetic_test_count')->comment('number of other tests')->nullable();
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('features', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropColumn(['type', 'genetic_test_count', 'other_test_count']);
        });
    }
}
