<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceDatatypeToDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            $table->float('dine_in_restaurent', 8,3)->change();
             $table->float('dine_in_cabin', 8,3)->change();
              $table->float('take_away_self_pickup', 8,3)->change();
               $table->float('home_delivery', 8,3)->change();
                $table->float('buffet', 8,3)->change();
                 $table->float('talabat_TEM', 8,3)->change();
                  $table->float('talabat_TGO', 8,3)->change();
                   $table->float('deliveroo_TEM', 8,3)->change();
                    $table->float('deliveroo_TGO', 8,3)->change();
                     $table->float('v_thru', 8,3)->change();
                      $table->float('mm_online', 8,3)->change();
                       $table->float('osc', 8,3)->change();
                        $table->float('garden', 8,3)->change();
                         $table->float('others_gross', 8,3)->change();
                          $table->float('discount', 8,3)->change();
                           $table->float('complimentary', 8,3)->change();
                            $table->float('sale_Return', 8,3)->change();
                             $table->float('cash_in_hand_actual', 8,3)->change();
                              $table->float('cash_shortage', 8,3)->change();
                               $table->float('cash_overage', 8,3)->change();
                                $table->float('cheque', 8,3)->change();
                                 $table->float('printed_gift_card', 8,3)->change();
                                  $table->float('e_gift_card', 8,3)->change();
                                   $table->float('gift_coupon_voucher', 8,3)->change();
                                    $table->float('cash_equivalent', 8,3)->change();
                                     $table->float('talabat_credit', 8,3)->change();
                                      $table->float('deliveroo_credit', 8,3)->change();
                                       $table->float('v_thru_credit', 8,3)->change();
                                        $table->float('others_credit', 8,3)->change();
                                        $table->float('gross_sale', 8,3)->change();
                                     $table->float('discount_return', 8,3)->change();
                                      $table->float('net_sale', 8,3)->change();
                                       $table->float('cash_in_hand', 8,3)->change();
                                        $table->float('cards_sale', 8,3)->change();
                                        $table->float('cheque_cash', 8,3)->change();
                                     $table->float('credit_sale', 8,3)->change();
                                      $table->float('total_collection', 8,3)->change();
                                       $table->float('cash_in_hand_opening_balance', 8,3)->change();
                                        $table->float('cash_sales', 8,3)->change();
                                        $table->float('cash_deposit_in_bank', 8,3)->change();
                                     $table->float('cash_in_hand_closing_balance', 8,3)->change();
                                      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_sales_reports', function (Blueprint $table) {
            //
        });
    }
}
