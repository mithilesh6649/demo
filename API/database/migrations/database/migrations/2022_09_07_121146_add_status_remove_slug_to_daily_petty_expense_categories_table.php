<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusRemoveSlugToDailyPettyExpenseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_petty_expense_categories', function (Blueprint $table) {
          $table->tinyInteger('status')->default(1)->comment('1=>active,1=>inactive')->after('cat_name')->nullable();
           $table->dropColumn('slug');
        });


        Schema::table('daily_petty_expense_sub_categories', function (Blueprint $table) {
          $table->tinyInteger('status')->default(1)->comment('1=>active,1=>inactive')->after('sub_cat_name')->nullable();
           $table->dropColumn('parent_slug');
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
            //
        });
    }
}
