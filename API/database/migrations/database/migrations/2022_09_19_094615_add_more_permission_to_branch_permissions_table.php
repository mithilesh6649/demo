<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorePermissionToBranchPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_permissions', function (Blueprint $table) {
              $table->string('new_orders_view')->after('order_manage');
              $table->string('accept_orders')->after('order_manage');
              $table->string('menu_category_view')->after('order_manage');
              $table->string('menu_category_edit')->after('order_manage');
              $table->string('menu_items_view')->after('order_manage');
              $table->string('menu_items_edit')->after('order_manage');
              $table->string('loyalties_view')->after('order_manage');
              $table->string('loyalties_edit')->after('order_manage');
              $table->string('loyalties_add')->after('order_manage');
              $table->string('branch_localities_view')->after('order_manage');
              $table->string('branch_localities_edit')->after('order_manage');
              $table->string('daily_sales_reports_view')->after('order_manage');
              $table->string('daily_sales_reports_edit')->after('order_manage');
              $table->string('daily_sales_reports_add')->after('order_manage');
              $table->string('daily_petty_expense_view')->after('order_manage');
              $table->string('daily_petty_expense_edit')->after('order_manage');
              $table->string('daily_petty_expense_add')->after('order_manage');
              $table->dropColumn('menu_manage')->after('order_manage');
              $table->dropColumn('report_manage')->after('order_manage');
              $table->dropColumn('loyalty_manage')->after('order_manage'); 
              $table->dropColumn('dine_caterign_manage')->after('order_manage'); 
              $table->dropColumn('payment_manage')->after('order_manage');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch_permissions', function (Blueprint $table) {
            //
        });
    }
}
