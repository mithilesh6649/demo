<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToDailyPettyExpenseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_expense_categories', function (Blueprint $table) {
            $table->string('slug')->after('cat_name')->nullable();
        });
        Schema::table('daily_petty_expense_sub_categories', function (Blueprint $table) {
            $table->string('slug')->after('sub_cat_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_petty_expense_categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('daily_petty_expense_sub_categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
