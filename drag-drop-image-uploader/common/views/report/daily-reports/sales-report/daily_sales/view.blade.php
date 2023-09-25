@extends('adminlte::page')
@section('title', 'Branch |  Daily Sales Reports Details')
@section('content_header')
@section('content')
<div class="rightside_content" >
   <div class="container-fluid p-0">
      <div class="alert d-none" role="alert" id="flash-message">
      </div>
      <div class="row justify-content-center">
         <div class="col-md-12" >
            <div class="card order_outer rounded_circle">
               <div class="card-body rounded_circle table p-0 mb-0">
                  <div class="order_details">
                     <div class="card-main pt-3 m-0">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                           <h3 class="mb-0">Daily Sales Reports Details</h3>
                           <a class="btn btn-sm btn-success m-0" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="Branch-statement branch_wrapper">
                           <form id="addReportForm" method="post"
                              action="{{ route('report.update_report', $daily_report_sales->id) }}">
                              @csrf
                              <input type="hidden" id="daily_sales_report_id"
                                 value="{{ $daily_report_sales->id }}">
                              <table class="table border Responsive-table m-0">
                                 <thead class="t_head">
                                    <tr>
                                       <th colspan="3" class="text-center">MUGHAL MAHAL</th>
                                    </tr>
                                 </thead>
                                 <tbody class="t_body" >
                                    <tr>
                                       <th colspan="3" class="text-center body_head">BRANCH-STATEMENT OF
                                          DALIY
                                          SALES &
                                          CASH IN
                                          HAND
                                       </th>
                                    </tr>
                                    <tr>
                                       <th class="thead_one">SL:<span class="manual_system"> {{$daily_report_sales->dsr_sl}}</span></th>
                                       <th class="thead_two text-center">Date: <span class="manual_system">
                                          <span>{{ date('d/m/Y', strtotime($daily_report_sales->report_date)) }}</span>
                                          <span class="dates_errorsa"></span>
                                          </span>
                                       <th class="thead_three text-right">Branch:
                                          {{$daily_report_sales->branch->title_en}} ( {{$daily_report_sales->branch->title_ar}} )
                                       </th>
                                    </tr>
                                    <tr>
                                       <th>
                                          RV NO: <span class="manual_system"> {{ $daily_report_sales->rv_number ?? 'N/A' }} </span>
                                          <!-- <input type="text" step="0.01" name="rv_number"
                                             class="rv_number" placeholder="RV Number" id="rv_number"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->rv_number }}"> -->
                                       </th>
                                       <td></td>
                                       <th class="text-right">Amounts</th>
                                    </tr>
                                    <tr>
                                       <th>GROSS SALE</th>
                                       <td></td>
                                       <td class="sale_content_box">
                                          <p class="show_gross_sale amount-sale" id="show_gross_sale">KD
                                             {{ number_format($daily_report_sales->gross_sale, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" name="gross_sale" class="gross_sale"
                                             id="gross_sale"
                                             value="{{ $daily_report_sales->gross_sale }}">
                                       </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Dine-In Restaurent</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="dine_in_restaurant_count"
                                             class="gross_sum" id="dine_in_restaurant_count"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->dine_in_restaurant_count }}"
                                             data-next="#dine_in_cabin_count">
                                       </td>
                                       <td>
                                          <input type="number" step="0.01" name="dine_in_restaurent"
                                             class="add_gross_sum gross_sum" placeholder=""
                                             id="dine_in_restaurent" maxlength="100" aria-invalid="false"
                                             value="{{ number_format($daily_report_sales->dine_in_restaurent, 3, '.', '') }}"
                                             data-next="#dine_in_cabin">
                                       </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Dine-In Cabin</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="dine_in_cabin_count"
                                             class="gross_sum" id="dine_in_cabin_count" maxlength="100"
                                             aria-invalid="false"
                                             value="{{ $daily_report_sales->dine_in_cabin_count }}"
                                             data-next="#self_pickup_count">
                                       </td>
                                       <td><input type="number" name="dine_in_cabin"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="dine_in_cabin" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->dine_in_cabin, 3, '.', '') }}"
                                          data-next="#take_away_self_pickup"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Take Away/Self Pickup</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="self_pickup_count" class="gross_sum"
                                             id="self_pickup_count" maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->self_pickup_count }}"
                                             data-next="#home_delivery_count">
                                       </td>
                                       <td><input type="number" name="take_away_self_pickup"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="take_away_self_pickup" maxlength="100"
                                          aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->take_away_self_pickup, 3, '.', '') }}"
                                          data-next="#home_delivery">
                                       </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Home Delivery</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="home_delivery_count"
                                             class="gross_sum" id="home_delivery_count"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->home_delivery_count }}"
                                             data-next="#buffet_count">
                                       </td>
                                       <td><input type="number" name="home_delivery"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="home_delivery" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->home_delivery, 3, '.', '') }}"
                                          data-next="#buffet"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Buffet</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="buffet_count" class="gross_sum"
                                             id="buffet_count" maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->buffet_count }}"
                                             data-next="#talabat_TEM_count">
                                       </td>
                                       <td><input type="number" name="buffet"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="buffet" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->buffet, 3, '.', '') }}"
                                          data-next="#talabat_TEM"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Talabat(TMP)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="talabat_TEM_count"
                                             class="gross_sum" id="talabat_TEM_count" maxlength="100"
                                             aria-invalid="false"
                                             value="{{ $daily_report_sales->talabat_TEM_count }}"
                                             data-next="#talabat_TGO_count">
                                       </td>
                                       <td><input type="number" name="talabat_TEM"
                                          class="add_gross_sum gross_sum keyupevent"
                                          id="talabat_TEM" maxlength="100" aria-invalid="false"
                                          step="any"
                                          value="{{ number_format($daily_report_sales->talabat_TEM, 3, '.', '') }}"
                                          data-next="#talabat_TGO"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Talabat(TGO)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="talabat_TGO_count"
                                             class="gross_sum" id="talabat_TGO_count" maxlength="100"
                                             aria-invalid="false"
                                             value="{{ $daily_report_sales->talabat_TGO_count }}"
                                             data-next="#MM_Express_TGO_count">
                                       </td>
                                       <td><input type="number" name="talabat_TGO"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="talabat_TGO" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->talabat_TGO, 3, '.', '') }}"
                                          data-next="#MM_Express_TGO"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>MM Express(TGO)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="MM_Express_TGO_count"
                                             class="gross_sum" id="MM_Express_TGO_count"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->MM_Express_TGO_count }}"
                                             data-next="#deliveroo_TEM_count">
                                       </td>
                                       <td><input type="number" name="MM_Express_TGO"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="MM_Express_TGO" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->MM_Express_TGO, 3, '.', '') }}"
                                          data-next="#deliveroo_TGO"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Deliveroo(TMP)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="deliveroo_TEM_count"
                                             class="gross_sum" id="deliveroo_TEM_count"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->deliveroo_TEM_count }}"
                                             data-next="#deliveroo_TGO_count">
                                       </td>
                                       <td><input type="number" name="deliveroo_TEM"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="deliveroo_TEM" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->deliveroo_TEM, 3, '.', '') }}"
                                          data-next="#deliveroo_TGO"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Deliveroo(TGO)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="deliveroo_TGO_count"
                                             class="gross_sum" id="deliveroo_TGO_count"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->deliveroo_TGO_count }}"
                                             data-next="#v_thru_count">
                                       </td>
                                       <td><input type="number" name="deliveroo_TGO"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="deliveroo_TGO" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->deliveroo_TGO, 3, '.', '') }}"
                                          data-next="#v_thru"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>V-Thru</td>
                                       <td  class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="v_thru_count" class="gross_sum"
                                             id="v_thru_count" maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->v_thru_count }}"
                                             data-next="#mm_online_count">
                                       </td>
                                       <td><input type="number" name="v_thru"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="v_thru" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->v_thru, 3, '.', '') }}"
                                          data-next="#mm_online"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>MM Online</td>
                                       <td  class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="mm_online_count"
                                             class="gross_sum" data-next="#osc_count"
                                             id="mm_online_count" maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->mm_online_count }}">
                                       </td>
                                       <td><input type="number" name="mm_online"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="mm_online" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->mm_online, 3, '.', '') }}"
                                          data-next="#osc"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>OSC</td>
                                       <td  class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="osc_count" class="gross_sum"
                                             data-next="#garden_count" id="osc_count" maxlength="100"
                                             aria-invalid="false"
                                             value="{{ $daily_report_sales->osc_count }}">
                                       </td>
                                       <td><input type="number" name="osc"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="osc" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->osc, 3, '.', '') }}"
                                          data-next="#garden"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Garden</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="garden_count" class="gross_sum"
                                             data-next="#others_gross_count" id="garden_count"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->garden_count }}">
                                       </td>
                                       <td><input type="number" name="garden"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="garden" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->garden, 3, '.', '') }}"
                                          data-next="#others_gross"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Others</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders:</p>
                                          <input type="number" name="others_gross_count"
                                             class="gross_sum" id="others_gross_count" maxlength="100"
                                             aria-invalid="false"
                                             value="{{ $daily_report_sales->others_gross_count }}">
                                       </td>
                                       <td><input type="number" name="others_gross"
                                          class="add_gross_sum gross_sum keyupevent" step="any"
                                          id="others_gross" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->others_gross, 3, '.', '') }}"
                                          data-next="#discount"></td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <th>Discount & Return</th>
                                       <td></td>
                                       <td class="last_number sale_content_box">
                                          <p class="show_discount_return amount-sale"
                                             id="show_discount_return">KD
                                             {{ number_format($daily_report_sales->discount_return, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" step="any" name="discount_return"
                                             class="discount_return" id="discount_return"
                                             value="{{ $daily_report_sales->discount_return }}">
                                       </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Discount</td>
                                       <td></td>
                                       <td><input type="number" name="discount"
                                          class="discount_sum gross_sum keyupevent" step="any"
                                          id="discount" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->discount, 3, '.', '') }}"
                                          data-next="#complimentary"></td>
                                    </tr>
                                    <!-- <tr style="pointer-events: none;">
                                       <td>Complimentary</td>
                                       <td></td>
                                       <td><input type="number" name="complimentary"
                                          class="discount_sum gross_sum keyupevent " step="any"
                                          id="complimentary" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->complimentary, 3, '.', '') }}"
                                          data-next="#sale_Return"></td>
                                    </tr> -->
                                      <?php
                                                     
                                            $complimentary = json_decode($daily_report_sales->complimentary_amount) == null ? [] : json_decode($daily_report_sales->complimentary_amount);
                                           @$complimentary_sum = array_sum($complimentary);

                                           $complimentary_name = json_decode($daily_report_sales->complimentary_name) == null ? [] : json_decode($daily_report_sales->complimentary_name);
                                          
                                           $complimentary_contact = json_decode($daily_report_sales->complimentary_contact) == null ? [] : json_decode($daily_report_sales->complimentary_contact);
                                          
                                           $complimentary_invoice = json_decode($daily_report_sales->complimentary_invoice) == null ? [] : json_decode($daily_report_sales->complimentary_invoice);
                                          
                                           $complimentary_ref = json_decode($daily_report_sales->complimentary_ref) == null ? [] : json_decode($daily_report_sales->complimentary_ref);
                                         


                                                     ?>
                                                    <tr>
                                                        <td>
                                                        <a href="javascript:;"
                                                                class="btn btn-success open_Complimentary_modal btn_ok"><i
                                                                    class="fa fa-plus add_input"
                                                                    aria-hidden="true"></i>Complimentary</a>

                                                            <input type="hidden" step="any" name="Complimentary"
                                                                class="Complimentary_inserted_values" id="Complimentary_inserted_values">

                                                        <input type="hidden" step="any" name="Complimentary_name">
                                                        <input type="hidden" step="any" name="Complimentary_contact">
                                                        <input type="hidden" step="any" name="Complimentary_invoice">
                                                        <input type="hidden" step="any" name="Complimentary_amount" >
                                                        <input type="hidden" step="any" name="Complimentary_ref" >
                                                    </td>
                                                        <td>
                                                            <p class="total_entries_Complimentary amount-sale field_add_text"
                                                                id="total_entries_Complimentary">
                                                                {{ count($complimentary) }} Slip(s)    
                                                                </p>
                                                        </td>
                                                        <td class="last_number sale_content_box">
                                                            <p class="Complimentary_card_show amount-sale" id="Complimentary_card_show">
                                                           {{ number_format($daily_report_sales->complimentary, 3, '.', '') }} </p> 
                                                            <input type="hidden" step="any"
                                                                class="discount_sum gross_sum" id="Complimentary"
                                                                maxlength="100" aria-invalid="false" value="">
                                                        </td>
                                                    </tr>


                                    <tr style="pointer-events: none;">
                                       <td>Sale & Return</td>
                                       <td></td>
                                       <td><input type="number" name="sale_Return"
                                          class="discount_sum gross_sum keyupevent" step="any"
                                          id="sale_Return" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->sale_Return, 3, '.', '') }}"
                                          data-next="#cash_in_hand_actual"></td>
                                    </tr>
                                    <tr class="sale_content">
                                       <th>NET SALE (After Discount & Return)</th>
                                       <td></td>
                                       <td class="sale_content_box">
                                          <p class="show_net_sale amount-sale gross_sum"
                                             id="show_net_sale">KD
                                             {{ number_format($daily_report_sales->net_sale, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" name="net_sale" step="any"
                                             class="net_sale" id="net_sale"
                                             value="{{ $daily_report_sales->net_sale }}">
                                       </td>
                                    </tr>
                                    <!-- <tr>
                                       <th colspan="3" class="text-center"></th>
                                       </tr> -->
                                    <tr>
                                       <th>Method Of Payment(cash/Cheque & Cash Equivalent)</th>
                                       <td></td>
                                       <td></td>
                                    </tr>
                                    <tr>
                                       <th>Cash In Hand-schedule</th>
                                       <td></td>
                                       <td  class="sale_content_box last_number">
                                          <p class="show_cash_in_hand amount-sale"
                                             id="show_cash_in_hand">KD
                                             {{ number_format($daily_report_sales->cash_in_hand, 3, '.', '') }}
                                          </p>
                                          <input  type="hidden" name="cash_in_hand"
                                             class="cash_in_hand gross_sum" id="cash_in_hand"
                                             maxlength="100" aria-invalid="false" step="any"
                                             value="{{ $daily_report_sales->cash_in_hand }}">
                                       </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Cash In Hand-Actual</td>
                                       <td></td>
                                       <td>
                                          <input type="number" name="cash_in_hand_actual"
                                             class="cash_in_hand_sum gross_sum keyupevent"
                                             id="cash_in_hand_actual" maxlength="100"
                                             aria-invalid="false" step="any"
                                             value="{{ number_format($daily_report_sales->cash_in_hand_actual, 3, '.', '') }}"
                                             data-next="#cheque">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="disable_text">Cash-Shortage</td>
                                       <td></td>
                                       <td class="last_numbers">
                                          <p class="cash_shortage para-table" id="cash_shortage">
                                             {{ number_format($daily_report_sales->cash_shortage, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" name="cash_shortage"
                                             class="get_cash_shortage gross_sum "
                                             id="get_cash_shortage" maxlength="100"
                                             aria-invalid="false" step="any"
                                             value="{{ $daily_report_sales->cash_shortage }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="disable_text">Cash-Overage</td>
                                       <td></td>
                                       <td class="main_numbers">
                                          <p class="cash_overage para-table" id="cash_overage">
                                             {{ number_format($daily_report_sales->cash_overage, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" name="cash_overage"
                                             class="get_cash_overage gross_sum " id="get_cash_overage"
                                             maxlength="100" aria-invalid="false" step="any"
                                             value="{{ $daily_report_sales->cash_overage }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <th>Card Sale</th>
                                       <td></td>
                                       <td class="sale_content_box">
                                          <p class="show_cards_sale amount-sale" id="show_cards_sale">
                                             KD
                                             {{ number_format($daily_report_sales->cards_sale, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" name="cards_sale"
                                             class="cards_sale gross_sum " id="cards_sale"
                                             maxlength="100" aria-invalid="false" step="any"
                                             value="{{ $daily_report_sales->cards_sale }}">
                                       </td>
                                    </tr>
                                    <?php
                                       $amex = json_decode($daily_report_sales->amex) == null ? [] : json_decode($daily_report_sales->amex);
                                       @$sum_amex = array_sum($amex);
                                       
                                       $visa = json_decode($daily_report_sales->visa) == null ? [] : json_decode($daily_report_sales->visa);
                                       @$sum_visa = array_sum($visa);
                                       
                                       $master = json_decode($daily_report_sales->master) == null ? [] : json_decode($daily_report_sales->master);
                                       @$sum_master = array_sum($master);
                                       
                                       $dinner = json_decode($daily_report_sales->dinner) == null ? [] : json_decode($daily_report_sales->dinner);
                                       @$sum_dinner = array_sum($dinner);
                                       
                                       $mm_online_link = json_decode($daily_report_sales->mm_online_link) == null ? [] : json_decode($daily_report_sales->mm_online_link);
                                       @$sum_mm_online_link = array_sum($mm_online_link);
                                       
                                       $knet = json_decode($daily_report_sales->knet) == null ? [] : json_decode($daily_report_sales->knet);
                                       @$sum_knet = array_sum($knet);
                                       
                                       $other_cards = json_decode($daily_report_sales->other_cards) == null ? [] : json_decode($daily_report_sales->other_cards);
                                       @$sum_other_cards = array_sum($other_cards);
                                       
                                       //Cheque/Cash Equivalent
                                       $cheque = json_decode($daily_report_sales->cheque) == null ? [] : json_decode($daily_report_sales->cheque);
                                       @$cheque_total = array_sum($cheque);
                                       
                                       $printed_gift_card = json_decode($daily_report_sales->printed_gift_card) == null ? [] : json_decode($daily_report_sales->printed_gift_card);
                                       
                                       $printed_gift_card_number = json_decode($daily_report_sales->printed_gift_card_number) == null ? [] : json_decode($daily_report_sales->printed_gift_card_number);
                                       
                                       @$printed_gift_card_total = array_sum($printed_gift_card);
                                       
                                       $e_gift_card = json_decode($daily_report_sales->e_gift_card) == null ? [] : json_decode($daily_report_sales->e_gift_card);
                                       @$e_gift_card_total = array_sum($e_gift_card);
                                       
                                       $gift_coupon_voucher = json_decode($daily_report_sales->gift_coupon_voucher) == null ? [] : json_decode($daily_report_sales->gift_coupon_voucher);
                                       @$gift_coupon_voucher_total = array_sum($gift_coupon_voucher);
                                       
                                       $cash_equivalent_c = json_decode($daily_report_sales->cash_equivalent) == null ? [] : json_decode($daily_report_sales->cash_equivalent);
                                       @$cash_equivalent_c_total = array_sum($cash_equivalent_c);
                                       
                                       //Credit Sale
                                       
                                       $talabat_credit_TMP = json_decode($daily_report_sales->talabat_credit_TMP) == null ? [] : json_decode($daily_report_sales->talabat_credit_TMP);
                                       @$talabat_credit_TMP_total = array_sum($talabat_credit_TMP);
                                       
                                       $talabat_credit_TGO = json_decode($daily_report_sales->talabat_credit_TGO) == null ? [] : json_decode($daily_report_sales->talabat_credit_TGO);
                                       @$talabat_credit_TGO_total = array_sum($talabat_credit_TGO);
                                       
                                       $deliveroo_credit_TMP = json_decode($daily_report_sales->deliveroo_credit_TMP) == null ? [] : json_decode($daily_report_sales->deliveroo_credit_TMP);
                                       @$deliveroo_credit_TMP_total = array_sum($deliveroo_credit_TMP);
                                       
                                       $deliveroo_credit_TGO = json_decode($daily_report_sales->deliveroo_credit_TGO) == null ? [] : json_decode($daily_report_sales->deliveroo_credit_TGO);
                                       @$deliveroo_credit_TGO_total = array_sum($deliveroo_credit_TGO);
                                       
                                       $v_thru_credit_TMP = json_decode($daily_report_sales->v_thru_credit_TMP) == null ? [] : json_decode($daily_report_sales->v_thru_credit_TMP);
                                       @$v_thru_credit_TMP_total = array_sum($v_thru_credit_TMP);
                                       
                                       $v_thru_credit_TGO = json_decode($daily_report_sales->v_thru_credit_TGO) == null ? [] : json_decode($daily_report_sales->v_thru_credit_TGO);
                                       @$v_thru_credit_TGO_total = array_sum($v_thru_credit_TGO);
                                       
                                       $others_credit_TMP = json_decode($daily_report_sales->others_credit_TMP) == null ? [] : json_decode($daily_report_sales->others_credit_TMP);
                                       @$others_credit_TMP_total = array_sum($others_credit_TMP);
                                       
                                       $others_credit_TGO = json_decode($daily_report_sales->others_credit_TGO) == null ? [] : json_decode($daily_report_sales->others_credit_TGO);
                                       @$others_credit_TGO_total = array_sum($others_credit_TGO);
                                       
                                       $remarks_list = json_decode($daily_report_sales->remarks) == null ? [] : json_decode($daily_report_sales->remarks);                                            
                                       
                                       ?>
                                    <tr>
                                       <td> <a href="javascript:;"
                                          class="btn btn-success open_amex_modal btn_ok m-0"><i
                                          class="fa fa-plus add_input"
                                          aria-hidden="true"></i>Amex</a>
                                          <input type="hidden" name="amex"
                                             class="amex_inserted_values" step="any"
                                             id="amex_inserted_values" value="{{ implode(',',@$amex) }}" >
                                       </td>
                                       <td>
                                          <p class="total_entries_amex amount-sale field_add_text"
                                             id="total_entries_amex">{{ count($amex) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="amex_card_show amount-sale" id="amex_card_show">
                                             {{ number_format(@$sum_amex, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="sum_card_sale gross_sum"
                                             id="amex" maxlength="100" step="any"
                                             aria-invalid="false" value="{{ @$sum_amex }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <a href="javascript:;"
                                             class="btn btn-success open_visa_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>Visa</a>
                                          <input type="hidden" name="visa"
                                             class="visa_inserted_values" step="any"
                                             id="visa_inserted_values" value="{{ implode(',',@$visa) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_visa amount-sale field_add_text"
                                             id="total_entries_visa">{{ count(@$visa) }} Slip(s)</p>
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="visa_card_show amount-sale" id="visa_card_show">
                                             {{ number_format(@$sum_visa, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="sum_card_sale gross_sum"
                                             id="visa" maxlength="100" step="any"
                                             aria-invalid="false" value="{{ @$sum_visa }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <a href="javascript:;"
                                             class="btn btn-success open_master_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>Master</a>
                                          <input type="hidden" step="any" name="master"
                                             class="master_inserted_values"
                                             id="master_inserted_values" value="{{ implode(',',@$master) }}" >
                                       </td>
                                       <td>
                                          <p class="total_entries_master amount-sale field_add_text"
                                             id="total_entries_master">{{ count(@$master) }} Slip(s)
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="master_card_show amount-sale" id="master_card_show">
                                             {{ number_format(@$sum_master, 3, '.', '') }} 
                                          </p>
                                          <input type="hidden" step="any"
                                             class="sum_card_sale gross_sum" id="master"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ @$sum_master }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <a href="javascript:;"
                                             class="btn btn-success open_dinner_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>Diner</a>
                                          <input type="hidden" step="any" name="dinner"
                                             class="dinner_inserted_values"
                                             id="dinner_inserted_values" value="{{ implode(',',@$dinner) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_dinner amount-sale field_add_text"
                                             id="total_entries_dinner">
                                             {{ count(@$dinner) }} Slip(s)
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="dinner_card_show amount-sale" id="dinner_card_show">
                                             {{ number_format(@$sum_dinner, 3, '.', '') }} 
                                          </p>
                                          <input type="hidden" step="any"
                                             class="sum_card_sale gross_sum" id="dinner"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ @$sum_dinner }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <a href="javascript:;"
                                             class="btn btn-success open_mm_online_link_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input" aria-hidden="true"></i>MM
                                          Online Link</a>
                                          <input type="hidden" step="any" name="mm_online_link"
                                             class="mm_online_link_inserted_values"
                                             id="mm_online_link_inserted_values" value="{{ implode(',',@$mm_online_link) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_mm_online_link amount-sale field_add_text"
                                             id="total_entries_mm_online_link">
                                             {{ count(@$mm_online_link) }} Slip(s)
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="mm_online_link_card_show amount-sale"
                                             id="mm_online_link_card_show">
                                             {{ number_format(@$sum_mm_online_link, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" step="any"
                                             class="sum_card_sale gross_sum" id="mm_online_link"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ @$sum_mm_online_link }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td><a href="javascript:;"
                                          class="btn btn-success open_knet_modal btn_ok m-0"><i
                                          class="fa fa-plus add_input"
                                          aria-hidden="true"></i>Knet</a>
                                          <input type="hidden" step="any" name="knet"
                                             class="knet_inserted_values" id="knet_inserted_values" value="{{ implode(',',@$knet) }}" >
                                       </td>
                                       <td>
                                          <p class="total_entries_knet amount-sale field_add_text"
                                             id="total_entries_knet">{{ count($knet) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="knet_card_show amount-sale" id="knet_card_show">
                                             {{ number_format(@$sum_knet, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" step="any"
                                             class="sum_card_sale gross_sum" id="knet"
                                             maxlength="100" value="{{ @$sum_knet }}"
                                             aria-invalid="false" value="">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <a href="javascript:;"
                                             class="btn btn-success open_other_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>Other Cards</a>
                                          <input type="hidden" step="any" name="other_cards"
                                             class="other_card_inserted_values"
                                             id="other_card_inserted_values" value="{{ implode(',',@$other_cards) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_other_cards amount-sale field_add_text"
                                             id="total_entries_other_cards">{{ count($other_cards) }}
                                             Slip(s)
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="other_card_show amount-sale" id="other_card_show">
                                             {{ number_format(@$sum_other_cards, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" step="any"
                                             class="sum_card_sale gross_sum" id="other_cards"
                                             maxlength="100" value="{{ @$sum_other_cards }}"
                                             aria-invalid="false" value="">
                                       </td>
                                    </tr>
                                    <tr>
                                       <th>Cheque/Cash Equivalent</th>
                                       <td></td>
                                       <td class="sale_content_box">
                                          <p class="show_cheque_cash amount-sale" id="show_cheque_cash">
                                             KD
                                             {{ number_format($daily_report_sales->cheque_cash, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" step="any" name="cheque_cash"
                                             class="cheque_cash gross_sum" id="cheque_cash"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ number_format($daily_report_sales->cheque_cash, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <p class="printed_gift" >Printed Gift Card</p>
                                          <input type="hidden" name="printed_gift_card"
                                             class="printed_gift_card_inserted_values" step="any" id="printed_gift_card_inserted_values" value="{{ implode(',',@$printed_gift_card) }}">
                                          <input type="hidden" name="printed_gift_card_number" step="any" id="printed_gift_card_number" value="{{ implode(',',@$printed_gift_card_number) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_printed_gift_card amount-sale field_add_text"
                                             id="total_entries_printed_gift_card"> {{ $daily_report_sales->printed_count }}
                                             Printed Gift Card 
                                          </p>
                                          <input type="hidden" name="printed_count" step="any" aria-invalid="false" id="printed_count" value="{{ $daily_report_sales->printed_count }}">
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="printed_gift_card_show amount-sale" id="printed_gift_card_show">{{ number_format(@$printed_gift_card_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="cheques_input_value gross_sum"
                                             id="printed_gift_card" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$printed_gift_card_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> <a href="javascript:;"
                                          class="btn btn-success open_cheque_modal btn_ok m-0"><i
                                          class="fa fa-plus add_input"
                                          aria-hidden="true"></i>Cheque</a>
                                          <input type="hidden" name="cheque"
                                             class="cheque_inserted_values" step="any" id="cheque_inserted_values" value="{{ implode(',',@$cheque) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_cheque amount-sale field_add_text"
                                             id="total_entries_cheque">{{ count(@$cheque) }}
                                             Slip(s)
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="cheque_card_show amount-sale" id="cheque_card_show">
                                             {{ number_format(@$cheque_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="cheques_input_value gross_sum"
                                             id="cheque" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$cheque_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> <a href="javascript:;"
                                          class="btn btn-success open_E_gift_card_modal btn_ok m-0"><i
                                          class="fa fa-plus add_input"
                                          aria-hidden="true"></i>E-Gift Card</a>
                                          <input type="hidden" name="E_gift_card"
                                             class="E_gift_card_inserted_values" step="any" id="E_gift_card_inserted_values" value="{{ implode(',',@$e_gift_card) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_E_gift_card amount-sale field_add_text"
                                             id="total_entries_E_gift_card">{{ count(@$e_gift_card) }} Slip(s) </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="E_gift_card_show amount-sale" id="E_gift_card_show">
                                             {{ number_format(@$e_gift_card_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="cheques_input_value gross_sum"
                                             id="E_gift_card" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$e_gift_card_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> <a href="javascript:;"
                                          class="btn btn-success open_Coupon_gift_card_modal btn_ok m-0"><i
                                          class="fa fa-plus add_input"
                                          aria-hidden="true"></i>Coupon/Voucher</a>
                                          <input type="hidden" name="Coupon_gift_card"
                                             class="Coupon_gift_card_inserted_values" step="any" id="Coupon_gift_card_inserted_values" value="{{ implode(',',@$gift_coupon_voucher) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_Coupon_gift_card amount-sale field_add_text"
                                             id="total_entries_Coupon_gift_card">{{ count(@$gift_coupon_voucher) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="Coupon_gift_card_show amount-sale" id="Coupon_gift_card_show">{{ number_format(@$gift_coupon_voucher_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="cheques_input_value gross_sum"
                                             id="Coupon_gift_card" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$gift_coupon_voucher_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> <a href="javascript:;"
                                          class="btn btn-success open_cash_card_modal btn_ok m-0"><i
                                          class="fa fa-plus add_input"
                                          aria-hidden="true"></i>Cash Equivalent(others)</a>
                                          <input type="hidden" name="cash_equivalent_card"
                                             class="cash_card_inserted_values" step="any" id="cash_card_inserted_values" value="{{ implode(',',@$cash_equivalent_c) }}" >
                                       </td>
                                       <td>
                                          <p class="total_entries_cash_card amount-sale field_add_text"
                                             id="total_entries_cash_card">{{ count(@$cash_equivalent_c) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="cash_card_show amount-sale" id="cash_card_show">
                                             {{ number_format(@$cash_equivalent_c_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="cheques_input_value gross_sum"
                                             id="cash_card" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$cash_equivalent_c_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <th>Credit Sale</th>
                                       <td></td>
                                       <td class="sale_content_box">
                                          <p class="show_credit_sale amount-sale" id="show_credit_sale">
                                             KD
                                             {{ number_format($daily_report_sales->credit_sale, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" name="credit_sale"
                                             class="credit_sale gross_sum " step="any"
                                             id="credit_sale" maxlength="100" aria-invalid="false"
                                             value="{{ number_format($daily_report_sales->credit_sale, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> 
                                          <a href="javascript:;"
                                             class="btn btn-success open_talabat_credit_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>Talabat Credit</a>
                                          <input type="hidden" name="talabat_creditTGO"
                                             class="talabat_credit_inserted_values" step="any" id="talabat_credit_inserted_values" value="{{ implode(',',@$talabat_credit_TGO) }}">
                                          <input type="hidden" name="talabat_creditTMP"
                                             class="talabat_credit_inserted_values" step="any" id="talabat_credit_inserted_values" value="{{ implode(',',@$talabat_credit_TMP) }}">
                                       </td>
                                       <td>
                                          <p class="total_entries_talabat_credit amount-sale field_add_text d-none" 
                                             id="total_entries_talabat_credit">{{ count(@$talabat_credit_TMP)+count(@$talabat_credit_TGO) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="talabat_credit_show amount-sale" id="talabat_credit_show"> {{ number_format(@$talabat_credit_TMP_total+@$talabat_credit_TGO_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="credits_input_value gross_sum"
                                             id="talabat_credit" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$talabat_credit_TMP_total+@$talabat_credit_TGO_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> 
                                          <a href="javascript:;"
                                             class="btn btn-success open_deliveroo_credit_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>Deliveroo Credit</a>
                                          <input type="hidden" name="deliveroo_creditTGO"
                                             class="talabat_credit_inserted_values" step="any" id="deliveroo_credit_inserted_values" value="{{ implode(',',@$deliveroo_credit_TGO) }}" >
                                          <input type="hidden" name="deliveroo_creditTMP"
                                             class="talabat_credit_inserted_values" step="any" id="deliveroo_credit_inserted_values" value="{{ implode(',',@$deliveroo_credit_TMP) }}" >
                                       </td>
                                       <td>
                                          <p class="total_entries_deliveroo_credit amount-sale field_add_text d-none"
                                             id="total_entries_deliveroo_credit">{{ count(@$deliveroo_credit_TMP)+count(@$deliveroo_credit_TGO) }} Slip(s) </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="deliveroo_credit_show amount-sale" id="deliveroo_credit_show">{{ number_format(@$deliveroo_credit_TMP_total+@$deliveroo_credit_TGO_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="credits_input_value gross_sum"
                                             id="deliveroo_credit" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$deliveroo_credit_TMP_total+@$deliveroo_credit_TGO_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> 
                                          <a href="javascript:;"
                                             class="btn btn-success open_v_thru_credit_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>V Thru Credit</a>
                                          <input type="hidden" name="v_thru_creditTGO"
                                             class="talabat_credit_inserted_values" step="any" id="v_thru_credit_inserted_values" value="{{ implode(',',@$v_thru_credit_TGO) }}" >
                                          <input type="hidden" name="v_thru_creditTMP"
                                             class="talabat_credit_inserted_values" step="any" id="v_thru_credit_inserted_values" value="{{ implode(',',@$v_thru_credit_TMP) }}" >
                                       </td>
                                       <td>
                                          <p class="total_entries_v_thru_credit amount-sale field_add_text d-none"
                                             id="total_entries_v_thru_credit">{{ count(@$v_thru_credit_TMP)+count(@$v_thru_credit_TGO) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="v_thru_credit_show amount-sale" id="v_thru_credit_show">{{ number_format(@$v_thru_credit_TMP_total+@$v_thru_credit_TGO_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="credits_input_value gross_sum"
                                             id="v_thru_credit" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$v_thru_credit_TMP_total+@$v_thru_credit_TGO_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> 
                                          <a href="javascript:;"
                                             class="btn btn-success open_others_credit_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>Others</a>
                                          <input type="hidden" name="others_creditTGO"
                                             class="others_credit_inserted_values" step="any" id="others_credit_inserted_values" value="{{ implode(',',@$others_credit_TGO) }}" >
                                          <input type="hidden" name="others_creditTMP"
                                             class="talabat_credit_inserted_values" step="any" id="others_credit_inserted_values" value="{{ implode(',',@$others_credit_TMP) }}" >
                                       </td>
                                       <td>
                                          <p class="total_entries_others_credit amount-sale field_add_text d-none"
                                             id="total_entries_others_credit">{{ count(@$others_credit_TMP)+count(@$others_credit_TGO) }} Slip(s) </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="others_credit_show amount-sale" id="others_credit_show">{{ number_format(@$others_credit_TMP_total+@$others_credit_TMP_total, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" class="credits_input_value gross_sum"
                                             id="others_credit" maxlength="100" step="any" aria-invalid="false"
                                             value="{{ number_format(@$others_credit_TMP_total+@$others_credit_TMP_total, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr class="sale_content">
                                       <th>Total Collection</th>
                                       <td></td>
                                       <td class="last_number sale_content_box">
                                          <!-- <p class="show_total_collection amount-sale"
                                             id="show_total_collection">KD
                                             {{ number_format($daily_report_sales->total_collection, 3, '.', '\'') }}</p>
                                             <input type="hidden" step="any" name="total_collection"
                                             class="total_collection gross_sum" id="total_collection"
                                             maxlength="100" aria-invalid="false" value="{{ number_format($daily_report_sales->total_collection, 3, '.', '\'') }}"> -->
                                       </td>
                                    </tr>
                                    <tr class="table_second_heading">
                                       <td >
                                          <a href="javascript:;"
                                             class="btn btn-success open_remarks_modal btn_ok m-0"><i
                                             class="fa fa-plus add_input"
                                             aria-hidden="true"></i>Remarks <span class="font-weight-bold text-white"> ( {{count($remarks_list)}} )</span> </a>
                                          <input type="hidden" step="any" name="remarks"
                                             class="remarksvalue"
                                             id="remarks_inserted_values" value="{{ implode(',',@$remarks_list) }}">
                                       </td>
                                       <th>Cash in Hand Opening Balance = </th>
                                       <td class="sale_content_box">
                                          <p id="cash_in_hand_tag" class="cash_in_hand_tag amount-sale">
                                             {{ @$daily_report_sales->cash_in_hand_opening_balance == null ? 'KD ' .'0.000': number_format(@$daily_report_sales->cash_in_hand_opening_balance, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" step="any"
                                             name="cash_in_hand_opening_balance" class="gross_sum"
                                             id="cash_in_hand_opening_balance" maxlength="100"
                                             aria-invalid="false"
                                             value="{{ @$daily_report_sales->cash_in_hand_opening_balance == null ? '0.000': number_format(@$daily_report_sales->cash_in_hand_opening_balance, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr class="table_second_heading">
                                       <td></td>
                                       <th>(+)Cash Sales</th>
                                       <td class="sale_content_box">
                                          <p class="get_cash_sales para-table amount-sale"
                                             id="get_cash_sales">
                                             {{ number_format($daily_report_sales->cash_sales, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" step="any" name="cash_sales"
                                             class="cash_sales gross_sum" id="cash_sales"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->cash_sales }}">
                                       </td>
                                    </tr>
                                    <tr class="table_second_heading" style="pointer-events: none;">
                                       <td></td>
                                       <th>(-)Cash Deposit In Bank</th>
                                       <td><input type="number" step="any"
                                          name="cash_deposit_in_bank"
                                          class="total_cash_handel gross_sum keyupevent"
                                          id="cash_deposit_in_bank" maxlength="100"
                                          aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->cash_deposit_in_bank, 3, '.', '') }}">
                                       </td>
                                    </tr>
                                    <tr class="table_second_heading sale_content">
                                       <td></td>
                                       <th>Cash in Hand Closing Balance =</th>
                                       <td class="sale_content_box">
                                          <p class="show_cash_in_hand_closing_balance amount-sale"
                                             id="show_cash_in_hand_closing_balance">
                                             KD
                                             {{ number_format($daily_report_sales->cash_in_hand_closing_balance, 3, '.', '') }}
                                          </p>
                                          <input type="hidden" name="cash_in_hand_closing_balance"
                                             class="cash_in_hand_closing_balance gross_sum"
                                             id="cash_in_hand_closing_balance" maxlength="100"
                                             aria-invalid="false"
                                             value="{{ $daily_report_sales->cash_in_hand_closing_balance }}">
                                       </td>
                                    </tr>
                                    <!--  <tr class="table_second_heading sale_content">
                                       <td >
                                           
                                           <a href="javascript:;"
                                               class="btn btn-success open_remarks_modal btn_ok m-0"><i
                                                   class="fa fa-plus add_input"
                                                   aria-hidden="true"></i>Remarks </a>
                                       
                                       
                                           <input type="hidden" step="any" name="remarks"
                                               class="remarksvalue"
                                               id="remarks_inserted_values" value="{{ implode(',',@$remarks_list) }}">
                                       
                                       </td>
                                       <td><p id="number_count_remarks">{{count(@$remarks_list)}} Remarks</p></td> 
                                       <td></td>
                                       
                                       </tr> -->
                                 </tbody>
                                 <tfoot>
                                    <!-- <tr>
                                       <th colspan="3" class="text-center"></th>
                                       </tr> -->
                                 </tfoot>
                              </table>
                              {{-- Upload Invoice Modal --}}
                              <div class="modal fade" id="upload_invoice_modal" tabindex="-1"
                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h4 class="modal-title" id="exampleModalLabel">Upload Document
                                          </h4>
                                          <button type="button" class="close close_thumbnail"
                                             data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true" class="close_modal">
                                          ×
                                          </span>
                                          </button>
                                       </div>
                                       <div class="modal-body" class="upload_invoice">
                                          <div class="model-back">
                                             <div class="row">
                                                <div class="col-12 invoice_input mb-2">
                                                   <label class="form-label"
                                                      for="upload_daily_sales">Invoice Domain
                                                   </label>
                                                   <select name="upload_daily_sales_invoice_domain"
                                                      id="upload_daily_sales_invoice_domain">
                                                      <option value="discount">
                                                         Discount
                                                      </option>
                                                      <option value="complimentary">
                                                         Complimentary
                                                      </option>
                                                      <option value="cash_deposit_in_bank">
                                                         Cash Deposit In Bank
                                                      </option>
                                                      <option value="report_from_icg">
                                                         Report From ICG
                                                      </option>
                                                      <option value="cheque">
                                                         Cheque
                                                      </option>
                                                      <option value="printed_gift_cards">
                                                         Printed Gift Card
                                                      </option>
                                                      <option value="e_gift_card">
                                                         E-Gift Card
                                                      </option>
                                                      <option value="gift_coupon_or_voucher">
                                                         Gift Coupon/Voucher
                                                      </option>
                                                   </select>
                                                </div>
                                                <div class="col-12 invoice_inputtwo">
                                                   <div class="form-group mt-0">
                                                      <label class="form-label">Doc Upload <span
                                                         class="text-danger">*</span></label>
                                                      <input type="file" id="uploadFile"
                                                         name="uploadFile" />
                                                      <input type="hidden" id="image_base64"
                                                         name="image_base64" />
                                                   </div>
                                                </div>
                                             </div>
                                             <div
                                                class="modal-footer justify-content-end added pt-0 px-0">
                                                <!-- <input type="submit" value="Save All" class="btn btn-danger m-0"> -->
                                                <a class="btn btn-sm btn_clr document_upload_submit btn-success ml-0"
                                                   href="javascript:;"
                                                   id="document_upload_submit">Add</a>
                                             </div>
                                             {{-- Table --}}
                                             <div class="upload_wrapper">
                                                <table id="daily_sales_docs"
                                                   class="table w-100 table-bordered table_index table-hover dataTable no-footer">
                                                   <thead class="table-dark"
                                                      style="white-space: nowrap;">
                                                      <tr>
                                                         <th
                                                            class="order-first align-top sorting_disabled">
                                                            Sr. No.
                                                         </th>
                                                         <th
                                                            class="order-first align-top sorting_disabled">
                                                            Document Name
                                                         </th>
                                                         <th
                                                            class="first align-top sorting_disabled">
                                                            Date
                                                         </th>
                                                         <th
                                                            class="first align-top sorting_disabled">
                                                            Action
                                                         </th>
                                                      </tr>
                                                   </thead>
                                                   <tbody id='daily_sales_docs_list'>
                                                      <?php $count = 1; ?>
                                                      @forelse ($daily_sales_report_doc as $report)
                                                      <tr>
                                                         <th class="table_th">
                                                            {{ $count }}
                                                         </th>
                                                         <th class="table_th">
                                                            @if ($report->invoice_domain == 'discount')
                                                            Discount
                                                            @elseif($report->invoice_domain == 'complimentary')
                                                            Complimentary
                                                            @elseif($report->invoice_domain == 'cash_deposit_in_bank')
                                                            Cash Deposit In Bank
                                                            @elseif($report->invoice_domain == 'report_from_icg')
                                                            Report From ICG
                                                            @elseif($report->invoice_domain == 'cheque')
                                                            Cheque
                                                            @elseif($report->invoice_domain == 'printed_gift_cards')
                                                            Printed Gift Card
                                                            @elseif($report->invoice_domain == 'e_gift_card')
                                                            E-Gift Card
                                                            @elseif($report->invoice_domain == 'gift_coupon_or_voucher')
                                                            Gift Coupon/Voucher
                                                            @endif
                                                         </th>
                                                         <td class="table_td">
                                                            {{ date('d/m/Y', strtotime($report->created_at)) }}
                                                         </td>
                                                         @if (Gate::check('daily_sales_reports_view'))
                                                         <td class="table_td"
                                                            style="padding: 0.25rem!important;">
                                                            @can('daily_sales_reports_view')
                                                            <a href="javascript:;"
                                                               class="action-button view_doc mr-1"
                                                               title="View"
                                                               id="{{ $report->id }}"
                                                               data-id="{{ $report->doc }}"><i
                                                               class="text-info fa fa-eye eye_green"></i>
                                                            </a>
                                                            <a href="javascript:;"
                                                               class="text-warning edit_doc fa fa-edit mr-1"
                                                               title="Edit"
                                                               id="{{ $report->id }}"
                                                               data-id="{{ $report->doc }}"><i
                                                               class="fa fa-pencil-square"></i>
                                                            </a>
                                                            <a href="javascript:;"
                                                               class="action-button delete_doc mr-1"
                                                               title="View"
                                                               id="{{ $report->id }}"><i
                                                               class="text-info fa fa-trash text-danger"></i>
                                                            </a>
                                                            @endcan
                                                         </td>
                                                         @endif
                                                      </tr>
                                                      <?php $count++; ?>
                                                      @empty
                                                      @endforelse
                                                   </tbody>
                                                </table>
                                             </div>
                                             {{-- ---------- --}}
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              {{-- signature --}}
                              <!-- second -->
                              @if(@$daily_report_sales['verified_by']==null || @$daily_report_sales['verified_by']=="") 
                               
                                 <div class="col-md-12 mt-3 P-0">
                                 <div class="form-group mb-0">
                                 <label>Verified by</label>
                                 <div class="wrapper">
                                 <canvas id="signature-pad_2" class="signature-pad"></canvas>
                                 </div>
                                 </div>

                                 </div> 

                              @else
                              <div class="col-md-12 mt-3 p-0 mb-3">
                                 <div class="form-group mb-0">
                                    <label>Verified by</label>
                                    <div class="wrapper">
                                       <img src="{{@$daily_report_sales['verified_by']}}" class="signature_image" alt="">
                                    </div>
                                 </div>
                              </div>
                              @endif
                              <!-- third -->
                              @if(@$daily_report_sales['approved_by']==null || @$daily_report_sales['approved_by']=="")

                                <div class="col-md-12 mt-3 P-0" style="padding: 0 !important;">
                                                <div class="form-group mb-0">
                                                    <label>Approved by</label>
                                                    <div class="wrapper">
                                                      <canvas id="signature-pad_3" class="signature-pad"></canvas>
                                                    </div>
                                                </div>
                                                
                                            </div>

                              @else
                              <div class="col-md-12 mt-3 P-0" style="padding: 0 !important;">
                                 <div class="form-group mb-0">
                                    <label>Approved by</label>
                                    <div class="wrapper">
                                       <img src="{{@$daily_report_sales['approved_by']}}" class="signature_image" alt="">
                                    </div>
                                 </div>
                              </div>
                              @endif
                              {{-- signature --}}
                              {{-- -------------------- --}}
                              <center class="mt-3">
                               <button type="button" class="btn btn-primary btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                   Document Details
                               </button>
                               </center>
                       <!--        <div class="card-footer uploadvoice d-flex align-items-center flex-wrap">
                                 <button
                                    class="button btn_bg_color common_btn text-white save_btn">Update</button>
                                   <a class="btn btn-sm btn_clr open_upload_income_modal btn-success added_content ml-2"
                                    href="javascript:;">Edit Upload Invoice</a>
                                
                              </div> -->
                              <!-- <button class="btn btn-sm btn_clr btn-success">Add</button> -->
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- Card Sale Modals --}}
{{-- cheque Modal --}}
<div class="modal fade" id="cheque_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Cheque</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_cheque_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_cheque" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php  $i=0;@endphp
                  @forelse($cheque as $cheque_list)
                  <span id="cheque_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="cheque_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="cheque_input_value_{{$i}}" data-id="{{$i}}" value="{{ number_format($cheque_list, 3, '.', '') }}"><a href="javascript:;" class="cheque_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="cheque_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="cheque_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="cheque_input_value_0" data-id="0"><a href="javascript:;" class="cheque_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
   
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- printed_gift_card_modal Modal --}}
<div class="modal fade" id="printed_gift_card_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Printed Gift Card</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_printed_gift_card_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_printed_gift_card" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0; @endphp
                  @forelse($printed_gift_card as $printed_gift_list)
                  <span id="printed_gift_card_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="printed_gift_card_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="printed_gift_card_input_value_{{$i}}" value="{{number_format($printed_gift_list, 3, '.', '') }}" data-id="{{$i}}"><a href="javascript:;" class="printed_gift_card_delete_icon delete_input_icon" id="{{$i}}"></a></span>
                  @php $i++;@endphp
                  @empty
                  <span id="printed_gift_card_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="printed_gift_card_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="printed_gift_card_input_value_0" data-id="0"><a href="javascript:;" class="printed_gift_card_delete_icon delete_input_icon" id="0"></a></span>
                  @endforelse
               </div>
         
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- E-Gift Card Modal --}}
<div class="modal fade" id="E_gift_card_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">E-Gift Card</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_E_gift_card_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_E_gift_card" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0; @endphp  
                  @forelse($e_gift_card as $e_gift_list)
                  <span id="E_gift_card_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" value="{{number_format($e_gift_list, 3, '.', '')}}" step="0.01" class="E_gift_card_input_value input_card gross_sum margin-unset"  maxlength="100" aria-invalid="false" id="E_gift_card_input_value_{{$i}}" data-id="{{$i}}"><a href="javascript:;" class="E_gift_card_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="E_gift_card_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="E_gift_card_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="E_gift_card_input_value_0" data-id="0"><a href="javascript:;" class="E_gift_card_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
         
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}} 
{{-- Coupon-Gift Card Modal --}}
<div class="modal fade" id="Coupon_gift_card_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Gift Coupon/Voucher</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_Coupon_gift_card_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_Coupon_gift_card" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($gift_coupon_voucher as $gift_coupon_list)
                  <span id="Coupon_gift_card_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" value="{{number_format($gift_coupon_list, 3, '.', '')}}" class="Coupon_gift_card_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="Coupon_gift_card_input_value_{{$i}}" data-id="{{$i}}"><a href="javascript:;" class="Coupon_gift_card_delete_icon delete_input_icon" id="{{$i}}"></a></span>
                  @php $i++;@endphp
                  @empty
                  <span id="Coupon_gift_card_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="Coupon_gift_card_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="Coupon_gift_card_input_value_0" data-id="0"><a href="javascript:;" class="Coupon_gift_card_delete_icon delete_input_icon" id="0"></a></span>
                  @endforelse
               </div>
    
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}} 
{{-- Cash Equivalent(others)--}}
<div class="modal fade" id="cash_card_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Cash Equivalent(others)</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_cash_card_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_cash_card" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($cash_equivalent_c as $cash_equivalent_lsit)
                  <span id="cash_card_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01"  value="{{number_format($cash_equivalent_lsit, 3, '.', '')}}" class="cash_card_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="cash_card_input_value_{{$i}}" data-id="{{$i}}"><a href="javascript:;" class="cash_card_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++;@endphp
                  @empty
                  <span id="cash_card_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="cash_card_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="cash_card_input_value_0" data-id="0"><a href="javascript:;" class="cash_card_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
          
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}} 
{{-- Talabat Credit--}}
<div class="modal fade" id="talabat_credit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Talabat Credit</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_talabat_credit_amounts" style="pointer-events:none;">
            <div class="model-back">
               <div id="add_multiple_talabat_credit" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  <span id="talabat_credit_data_0" class="card-list d-flex align-items-center mt-1">
                     @forelse($talabat_credit_TMP as $talabat_credit_TMP_list)
                     <input type="number" step="0.01" class="TMPtalabat_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="talabat_credit_input_value_0" placeholder="TMP" data-id="0" value="{{number_format($talabat_credit_TMP_list, 3, '.', '')}}">
                     &nbsp;&nbsp;
                     @empty
                     <input type="number" step="0.01" class="TMPtalabat_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="talabat_credit_input_value_0" placeholder="TMP" data-id="0">
                     &nbsp;&nbsp;
                     @endforelse
                     @forelse($talabat_credit_TGO as $talabat_credit_TGO_list)
                     <input type="number" step="0.01" class="TGOtalabat_credit_input_value input_card gross_sum margin-unset" maxlength="100" value="{{number_format($talabat_credit_TGO_list, 3, '.', '')}}" aria-invalid="false" id="talabat_credit_input_value_0" data-id="0" placeholder="TGO">
                     &nbsp;&nbsp;
                     @empty
                     <input type="number" step="0.01" class="TGOtalabat_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="talabat_credit_input_value_0" data-id="0" placeholder="TGO">
                     &nbsp;&nbsp;
                     @endforelse
                     <!-- <a href="javascript:;" class="talabat_credit_delete_icon delete_input_icon" id="0"><i class="text-danger fa fa-trash-alt talabat_credit_remove_btn" style="font-size:16px;cursor:pointer"></i></a> -->
                  </span>
               </div>
      
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- deliveroo_credit--}}
<div class="modal fade" id="deliveroo_credit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Deliveroo Credit</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_deliveroo_credit_amounts" style="pointer-events:none;">
            <div class="model-back">
               <div id="add_multiple_deliveroo_credit" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  <span id="deliveroo_credit_data_0" class="d-flex align-items-center mt-1">
                     @forelse($deliveroo_credit_TMP as $deliveroo_credit_TMP_list)
                     <input type="number" step="0.01" class="TMPdeliveroo_credit_input_value input_card gross_sum margin-unset" maxlength="100" value="{{number_format($deliveroo_credit_TMP_list, 3, '.', '')}}" aria-invalid="false" id="deliveroo_credit_input_value_0" placeholder="TMP" data-id="0">
                     &nbsp;&nbsp;
                     @empty
                     <input type="number" step="0.01" class="TMPdeliveroo_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="deliveroo_credit_input_value_0" placeholder="TMP" data-id="0">
                     &nbsp;&nbsp;
                     @endforelse
                     @forelse($deliveroo_credit_TGO as $deliveroo_credit_TGO_list)
                     <input type="number" step="0.01" class="TGOdeliveroo_credit_input_value input_card gross_sum margin-unset" maxlength="100" value="{{number_format($deliveroo_credit_TGO_list, 3, '.', '')}}" aria-invalid="false" id="deliveroo_credit_input_value_0" data-id="0" placeholder="TGO">
                     @empty
                     <input type="number" step="0.01" class="TGOdeliveroo_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="deliveroo_credit_input_value_0" data-id="0" placeholder="TGO">
                     @endforelse
                     <!-- <a href="javascript:;" class="deliveroo_credit_delete_icon delete_input_icon" id="0"><i class="text-danger fa fa-trash-alt deliveroo_credit_remove_btn" style="font-size:16px;cursor:pointer"></i></a> -->
                  </span>
               </div>
    
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- v_thru_credit--}}
<div class="modal fade" id="v_thru_credit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">V Thru Credit</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_v_thru_credit_amounts" style="pointer-events:none;">
            <div class="model-back">
               <div id="add_multiple_v_thru_credit" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  <span id="v_thru_credit_data_0" class="d-flex align-items-center mt-1">
                     @forelse($v_thru_credit_TMP as $v_thru_credit_list)
                     <input type="number" step="0.01" class="TMPv_thru_credit_input_value input_card gross_sum margin-unset" maxlength="100" value="{{number_format($v_thru_credit_list, 3, '.', '')}}" aria-invalid="false" id="v_thru_credit_input_value_0" placeholder="TMP" data-id="0">
                     @empty
                     <input type="number" step="0.01" class="TMPv_thru_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="v_thru_credit_input_value_0" placeholder="TMP" data-id="0">
                     @endforelse
                     &nbsp;&nbsp;
                     @forelse($v_thru_credit_TGO as $v_thru_credit_TGO_list)
                     <input type="number" step="0.01" class="TGOv_thru_credit_input_value input_card gross_sum margin-unset" maxlength="100" value="{{number_format($v_thru_credit_TGO_list, 3, '.', '')}}" aria-invalid="false" id="v_thru_credit_input_value_0" data-id="0" placeholder="TGO">
                     @empty
                     <input type="number" step="0.01" class="TGOv_thru_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="v_thru_credit_input_value_0" data-id="0" placeholder="TGO">
                     @endforelse
                     <!-- <a href="javascript:;" class="v_thru_credit_delete_icon delete_input_icon" id="0"><i class="text-danger fa fa-trash-alt v_thru_credit_remove_btn" style="font-size:16px;cursor:pointer"></i></a> -->
                  </span>
               </div>
   
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- others_credit_modal--}}
<div class="modal fade" id="others_credit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Others</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_others_credit_amounts" style="pointer-events:none;">
            <div class="model-back">
               <div id="add_multiple_others_credit" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  <span id="others_credit_data_0" class="d-flex align-items-center mt-1">
                     @forelse($others_credit_TMP as $others_credit_TMP_list)  
                     <input type="number" step="0.01" class="TMPothers_credit_input_value input_card gross_sum margin-unset" maxlength="100" value="{{number_format($others_credit_TMP_list, 3, '.', '')}}" aria-invalid="false" id="others_credit_input_value_0" placeholder="TMP" data-id="0">
                     @empty
                     <input type="number" step="0.01" class="TMPothers_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="others_credit_input_value_0" placeholder="TMP" data-id="0">
                     @endforelse
                     &nbsp;&nbsp;
                     @forelse($others_credit_TGO as $others_credit_TGO_list)
                     <input type="number" step="0.01" class="TGOothers_credit_input_value input_card gross_sum margin-unset" maxlength="100" value="{{number_format($others_credit_TGO_list, 3, '.', '')}}" aria-invalid="false" id="others_credit_input_value_0" data-id="0" placeholder="TGO">
                     @empty
                     <input type="number" step="0.01" class="TGOothers_credit_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="others_credit_input_value_0" data-id="0" placeholder="TGO">
                     @endforelse
                     <!-- <a href="javascript:;" class="others_credit_delete_icon delete_input_icon" id="0"><i class="text-danger fa fa-trash-alt others_credit_remove_btn" style="font-size:16px;cursor:pointer"></i></a> -->
                  </span>
               </div>
 
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
<div class="modal fade" id="remarks_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Remarks</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_remarks_amounts" style="pointer-events:none;">
            <div class="model-back">
               <div id="add_multiple_remarks" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0 @endphp
                  @forelse($remarks_list as $remarks_lists)
                  <div class="remarks_content w-100 d-flex align-items-center mt-3" id="remarks_{{$i}}">
                     <input type="text" class="form-control remarks_input_value" name="remarks[{{$i}}]" id="remarks" data-id="{{$i}}" value="{{$remarks_lists}}"><a href="javascript:;" class="remarks_delete_icon delete_input_icon" id="{{$i}}"></a>
                  </div>
                  @php $i++; @endphp
                  @empty
                  <div class="remarks_content w-100 d-flex align-items-center mt-3" id="remarks_0">
                     <input type="text" class="form-control remarks_input_value" name="remarks[0]" id="remarks" data-id="0"><a href="javascript:;" class="remarks_delete_icon delete_input_icon" id="0"></a>
                  </div>
                  @endforelse
               </div>
        
            </div>
         </div>
      </div>
   </div>
</div>
{{-- Amex Card Modal --}}
<div class="modal fade" id="amex_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Amex Card</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_amex_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_amex" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($amex as $amxvalue)
                  <span id="amex_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" class="amex_input_value input_card gross_sum margin-unset" id="amex_input_value_{{$i}}" data-id="{{$i}}" value="{{number_format($amxvalue,3, '.', '')}}" maxlength="100" aria-invalid="false"><a href="javascript:;" class="amex_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="amex_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="amex_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="amex_input_value_0" data-id="0"> </span>
                  @endforelse
               </div>
       
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- Visa Card Modal --}}
<div class="modal fade" id="visa_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Visa Card</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_visa_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_visa" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($visa as $visavalue)
                  <span id="visa_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" class="visa_input_value input_card gross_sum margin-unset" id="visa_input_value_{{$i}}" data-id="{{$i}}"  value="{{number_format($visavalue,3, '.', '')}}" maxlength="100" aria-invalid="false"><a href="javascript:;" class="visa_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="visa_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="visa_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="visa_input_value_0" data-id="0"><a href="javascript:;" class="visa_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
        
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- Master Card Modal --}}
<div class="modal fade" id="master_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Master Card</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_master_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_master" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($master as $master_value)
                  <span id="master_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" class="master_input_value input_card gross_sum margin-unset" value="{{number_format($master_value,3, '.','')}}" id="master_input_value_{{$i}}" data-id="{{$i}}" maxlength="100" aria-invalid="false"><a href="javascript:;" class="master_delete_icon delete_input_icon" id="{{$i}}" > </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="master_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="master_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="master_input_value_0" data-id="0"><a href="javascript:;" class="master_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
  
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- Dinner Card Modal --}}
<div class="modal fade" id="dinner_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Diner Card</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_dinner_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_dinner" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($dinner as $dinner_value)
                  <span id="dinner_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" class="dinner_input_value input_card gross_sum margin-unset" value="{{number_format($dinner_value,3, '.','')}}" id="dinner_input_value_{{$i}}" data-id="{{$i}}" maxlength="100" aria-invalid="false"><a href="javascript:;" class="dinner_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="dinner_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="dinner_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="dinner_input_value_0" data-id="0"><a href="javascript:;" class="dinner_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
      
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- MM Online Link Card Modal --}}
<div class="modal fade" id="mm_online_link_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">MM Online Link Card</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_mm_online_link_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_mm_online_link" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($mm_online_link as $mm_online_link_value)
                  <span id="mm_online_link_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" class="mm_online_link_input_value input_card gross_sum margin-unset" value="{{number_format($mm_online_link_value,3, '.','')}}" id="mm_online_link_input_value_{{$i}}" data-id="{{$i}}" maxlength="100" aria-invalid="false"><a href="javascript:;" class="mm_online_link_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="mm_online_link_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="mm_online_link_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="mm_online_link_input_value_0" data-id="0"><a href="javascript:;" class="mm_online_link_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
  
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}

{{-- dicount Modal --}}
    <div class="modal fade" id="Complimentary_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Complimentary</h4>
                    <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="close_modal">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body" class="add_Complimentary_amounts">
                    <div class="model-back">
                        <div id="add_multiple_Complimentary" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                        <?php 
                           $i=0;
                         ?>
                         @forelse($complimentary as $complimentary_det)

                         <div id="Complimentary_data_0" class="d-flex align-items-center mt-1">
                          <span><input type="text" name="name" placeholder="Name" class="form-control Complimentary_input_name" value="{{@$complimentary_name[$i]}}" readonly></span>
                          <span><input type="number" name="contact" placeholder="Contact" class="form-control Complimentary_input_contact" readonly value="{{@$complimentary_contact[$i]}}"></span>
                          <span><input type="text" name="invoice" placeholder="invoce" class="form-control Complimentary_input_invoice" readonly value="{{@$complimentary_invoice[$i]}}"></span>
                          <span><input type="number" step="any" name="complimentary_amount"  placeholder="Amount" class="form-control Complimentary_input_value" readonly value="{{ number_format(@$complimentary_det, 3, '.', '') }}"></span>
                          <span><input type="text" name="ref" readonly value="{{@$complimentary_ref[$i]}}" placeholder="Ref" class="form-control Complimentary_input_ref" ></span>
                          <!-- <a href="javascript:;" class="Complimentary_delete_icon delete_input_icon" id="0"><i
                                        class="text-danger fa fa-trash-alt choice_remove_btn ml-2"
                                        style="font-size:16px;cursor:pointer"></i></a> -->
                         </div>
                          @php $i++; @endphp
                         @empty
                           <div id="Complimentary_data_0" class="d-flex align-items-center mt-1">
                          <span><input type="text" name="name" readonly placeholder="Name" class="form-control Complimentary_input_name"></span>
                          <span><input type="number" name="contact" readonly placeholder="Contact" class="form-control Complimentary_input_contact"></span>
                          <span><input type="text" name="invoice" readonly placeholder="invoce" class="form-control Complimentary_input_invoice"></span>
                          <span><input type="number" step="any" readonly name="complimentary_amount"  placeholder="Amount" class="form-control Complimentary_input_value"></span>
                          <span><input type="text" name="ref" readonly placeholder="Ref" class="form-control Complimentary_input_ref"></span>
                          <!-- <a href="javascript:;" class="Complimentary_delete_icon delete_input_icon" id="0"><i
                                        class="text-danger fa fa-trash-alt choice_remove_btn ml-2"
                                        style="font-size:16px;cursor:pointer"></i></a> -->
                         </div>
                         @endforelse

                            <!-- <span id="knet_data_0" class="d-flex align-items-center mt-1"><input type="number"
                                    step="any" class="knet_input_value input_card gross_sum margin-unset"
                                    maxlength="100" aria-invalid="false" id="knet_input_value_0" data-id="0"><a
                                    href="javascript:;" class="knet_delete_icon delete_input_icon" id="0"><i
                                        class="text-danger fa fa-trash-alt choice_remove_btn ml-2"
                                        style="font-size:16px;cursor:pointer"></i></a></span> -->

                        </div>

                        <div class="d-flex align-items-center justify-content-center" style="margin-top: 16px;">
                           <!--  <div id="Complimentary_add_btn" class="left_btn">
                                <a href="javascript:;" class="btn btn-success add_Complimentary_total btn_ok_save">Save</a>
                            </div>
                            <div class="right_btn ml-2">
                                <a href="javascript:;" class="add_card_input" id="add_Complimentary">
                                    Add
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ---------- --}}
    
{{-- Knet Card Modal --}}
<div class="modal fade" id="knet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Knet Card</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_knet_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_knet" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($knet as $knet_value)
                  <span id="knet_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" class="knet_input_value input_card gross_sum margin-unset" id="knet_input_value_{{$i}}" value="{{number_format($knet_value,3, '.','')}}" data-id="{{$i}}" maxlength="100" aria-invalid="false"><a href="javascript:;" class="knet_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="knet_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="knet_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="knet_input_value_0" data-id="0"><a href="javascript:;" class="knet_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
       
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- Other Card Modal --}}
<div class="modal fade" id="other_card_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Other Cards</h4>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="add_other_card_amounts" style="pointer-events: none;">
            <div class="model-back">
               <div id="add_multiple_other" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
                  @php $i=0;@endphp
                  @forelse($other_cards as $other_cards_value)
                  <span id="other_cards_data_{{$i}}" class="card-list d-flex align-items-center mt-1"><input type="number" class="other_input_value input_card gross_sum margin-unset" id="other_input_value_{{$i}}" value="{{number_format($other_cards_value,3, '.','')}}" data-id="{{$i}}" maxlength="100" aria-invalid="false"><a href="javascript:;" class="other_cards_delete_icon delete_input_icon" id="{{$i}}"> </a></span>
                  @php $i++; @endphp
                  @empty
                  <span id="other_cards_data_0" class="card-list d-flex align-items-center mt-1"><input type="number" step="0.01" class="other_input_value input_card gross_sum margin-unset" maxlength="100" aria-invalid="false" id="other_input_value_0" data-id="0"><a href="javascript:;" class="other_cards_delete_icon delete_input_icon" id="0"> </a></span>
                  @endforelse
               </div>
 
            </div>
         </div>
      </div>
   </div>
</div>
{{-- ---------- --}}
{{-- Doc Pop Up Modal --}}
<div class="modal fade" id="doc_image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Document</h5>
            <button type="button" class="close close_thumbnail" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal_doc">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="document_image_pop_up" id="document_image_pop_up">
         </div>
      </div>
   </div>
</div>
{{-- --------------- --}}
{{-- Update Invoice Modal --}}
<div class="modal fade" id="update_invoice_modal" tabindex="-1"
   role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Update Document
            </h4>
            <button type="button" class="close close_thumbnail"
               data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_modal_edit_doc">
            ×
            </span>
            </button>
         </div>
         <div class="modal-body" class="upload_invoice">
            <div class="model-back">
               <div class="row">
                  <div class="col-12 invoice_select_edit mb-2">
                  </div>
                  <div class="col-12 invoice_input_edit_doc_image">
                  </div>
               </div>
               <div class="modal-footer update_invoice_btn justify-content-end added pt-0 px-0">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- -------------------- --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
   <h4 class="modal-title" id="exampleModalLongTitle">Document Details</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">×</span>
   </button>
</div>
<div class="modal-body">
   <div class="model-back">
 
      <div class="upload_wrapper">
 
         <div class="alert d-none" role="alert" id="flash-message-2">  </div>
         <table style="width:100%" id="order-online-users-list" class="table table-bordered table-hover yajra-datatable">
            <thead>
               <tr>
                  <th>Sr. No.</th>
                  <th>Document Name</th>
                  <th>Document Image</th>
                  <th>Date</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody class="filter_date_show" id="orders_list">
               <?php $count = 1; ?>
               @foreach($daily_sales_report_doc as $daily_sales_data)
               <tr>
                  <td>{{ $count }}</td>
                  <td class="text-uppercase">
                     <!--   @if($daily_sales_data->invoice_domain == 'discount')
                        Discount
                        @elseif($daily_sales_data->invoice_domain == 'complimentary')
                        Complimentary
                        @elseif($daily_sales_data->invoice_domain == 'cash_deposit_in_bank')
                        Cash Deposit In Bank
                        @elseif($daily_sales_data->invoice_domain == 'report_from_icg')
                        Report From ICG
                        @elseif($daily_sales_data->invoice_domain == 'cheque')
                        Cheque
                        @elseif($daily_sales_data->invoice_domain == 'printed_gift_cards')
                        Printed Gift Card
                        @elseif($daily_sales_data->invoice_domain == 'e_gift_card')
                        E-Gift Card
                        @elseif($daily_sales_data->invoice_domain == 'gift_coupon_or_voucher')
                        Gift Coupon/Voucher    
                        @endif --> 
                     @foreach ($daily_invoice_types as $daily_invoice_type)
                     @if ($daily_invoice_type->value == $daily_sales_data->invoice_domain)
                     {{$daily_invoice_type->name}}
                     @endif
                     @endforeach
                  </td>
                  <!--  <td>  {{pathinfo($daily_sales_data->doc, PATHINFO_EXTENSION) }}</td> -->
                  <td>@if(pathinfo($daily_sales_data->doc, PATHINFO_EXTENSION) == 'pdf')
                     <a href="{{ env('BRANCH_PORTAL_DOC_URL').$daily_sales_data->doc }}" target="_blank"><i class="fas fa-file-pdf fa-10x text-danger" style="font-size:30px;"></i></a> 
                     @else
                     <a href="{{env('BRANCH_PORTAL_DOC_URL').$daily_sales_data->doc}}" target="_blank"><img src="{{env('BRANCH_PORTAL_DOC_URL').$daily_sales_data->doc}}"></a> 
                     @endif 
                  </td>
                  <td>  {{ date('d/m/Y', strtotime($daily_sales_data->created_at)) }}</td>
                  <td>
                     <!-- <a class="action-button" title="View" href="#"><i class="text-info fa fa-eye"></i></a> -->
                    <a href="{{env('BRANCH_PORTAL_DOC_URL').$daily_sales_data->doc}}" target="_blank"><i class="text-warning fa fa-eye"></i></a>
                    
                  </td>
               </tr>
               <?php $count++; ?>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
</div
@endsection
@section('css')
<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
   rel='stylesheet'>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
{{-- signature --}} 
<style>
   .signature_image{
   border-radius: 5px;
   max-width: 100%;
   margin: 0 auto;
   }
   .Branch-statement .table td.orders_count_wrap {
     border: none;
     border-bottom: 1px solid #dee2e6;
   }
   .wrapper {
      background-color: #ffffff;
      border-radius: 5px;
   }
   .card-footer {
      padding: 24px 0 0;
   }
</style>
<style type="text/css">
   /*      .wrapper {
   position: relative;
   width: 100%;
   height: 200px;
   -moz-user-select: none;
   -webkit-user-select: none;
   -ms-user-select: none;
   user-select: none;
   margin-bottom: 20px;
   }
   .signature-pad {
   position: absolute;
   left: 0;
   top: 0;
   width:100%;
   height:200px;
   background-color: white;
   }*/
</style>
{{-- signature --}}
<style type="text/css">
   .disabled_button{
   opacity: .6;
   }
   td:hover{
   background: none !important;
   }
   .orders_count{
   white-space: nowrap;
   margin: 10px 5px;
   }
   .orders_count_wrap{
   display: inline-flex;
   }
   .toastr_btn{
   font-size: 15px;
   border: 1px solid;
   padding: 2px 10px;
   }
   .dataTables_length, .dataTables_filter {
   width: auto;
   }
   *{
   padding: 0;
   margin: 0;
   list-style: none;
   color: #000000; 
   outline-style: none;
   font-size: 16px;
   font-family: 'libre_baskervillebold';
   }
   @font-face {
   font-family: '../fonts/libre_baskervillebold';
   src: url('librebaskerville-bold-webfont.woff2') format('woff2'),
   url('librebaskerville-bold-webfont.woff') format('woff');
   font-weight: normal;
   font-style: normal;
   }
   @font-face {
   font-family: '../fonts/libre_baskervilleitalic';
   src: url('librebaskerville-italic-webfont.woff2') format('woff2'),
   url('librebaskerville-italic-webfont.woff') format('woff');
   font-weight: normal;
   font-style: normal;
   }
   @font-face {
   font-family: '../fonts/libre_baskervilleregular';
   src: url('librebaskerville-regular-webfont.woff2') format('woff2'),
   url('librebaskerville-regular-webfont.woff') format('woff');
   font-weight: normal;
   font-style: normal;
   }
   .Branch-statement .table td, .table th {
   vertical-align: top;
   /* border-top: 1px solid #dee2e6;*/
   border: 1px solid #dee2e6;
   }
   .Branch-statement {
   width: 100%;
   background-color: #f6f7fb;
   }
   .Branch-statement table {
   background-color: #ffffff;
   border: 1px solid #dee2e6;
   border-radius: 10px;
   text-align: center;
   }
   .Branch-statement .table td{
   padding: 8px 10px !important;
   }
   .Branch-statement .table td {
   font-size: 14px;
   vertical-align: middle;
   color: #212529;
   text-align: right;
   }
   .Branch-statement .table th{
   font-size: 14px;
   font-weight: 600;
   padding: 12px 10px;
   color: #000;
   border: 1px solid #dee2e6;
   text-align: left;
   vertical-align: inherit;
   }
   .Branch-statement .table td:hover{
   background-color: rgb(246 247 251);
   }
   .table_second_heading th{
   color: #000000 !important;
   }
   /* .sale_content{
   border-bottom: 2px solid #000000;
   } */
   .sale_content_box input::placeholder {
   font-weight: bold;
   }
   .sale_content_box{
   /* background-color: #f4312708; */
   background-color: #dee2e63b;
   }
   .main_numbers input::placeholder{
   color: #ff0000 !important;
   font-weight: bold;
   }
   .Branch-statement .table td input::placeholder {
   color: #000000;
   }
   .Branch-statement .table td input {
   border: none;
   width: 100%;
   text-align: right;
   }
   .last_number input::placeholder {
   font-weight: bold !important;
   }
   button.btn_clr {
   background-color: #F43127 !important;
   border: 1px solid #F43127 !important;
   padding: 6px 20px;
   text-decoration: auto;
   font-size: 14px;
   top: 0;
   order: 2;
   border-radius: 5px;
   white-space: nowrap;
   }
   input.gross_sum {
   text-align: center !important;
   display: block;
   padding: 9px 2px;
   border: 1px solid #dfe1eb !important;
   background: #fff;
   border-radius: 5px;
   }
   thead.t_head th{
   font-size: 20px !important;
   padding-top: 20px !important;
   padding-bottom: 5px !important;
   }
   tbody.t_body{
   border-top: 0px solid transparent !important;
   }
   tbody.t_body .body_head{
   font-weight: 400;
   padding-top: 10px;
   padding-bottom: 16px;
   font-size: 14px;
   border-top: 0px solid transparent !important;
   }
   .manual_system {
   color: #000000;
   font-weight: 400;
   font-size: 14px;
   }
   .amount-sale {
   font-size: 14px !important;
   margin-bottom: 0;
   }
   .Branch-statement .table td p {
   margin-bottom: 0;
   }
   .Branch-statement .table td.disable_text{
   padding: 8px 10px !important;
   }
   @media screen and (max-width: 1300px) {
   .Responsive-table{
   display: block;
   width: 100%;
   overflow-x: auto;
   -webkit-overflow-scrolling: touch;
   white-space: nowrap;
   }
   }
   td.gross_sum {
   background: #f9f9f9;
   }
   td.gross_sum input {
   background: #f9f9f9;
   }
   td.grossSum_view{
   background-color: #fff;
   }
   td.grossSum_view input{
   background-color: #fff;
   }
   .para-table{
   text-align: center !important;
   width: 155px !important;
   margin-left: auto;
   padding: 4px 2px;
   }
   td.sale_content_box p{
   text-align: center;
   width: 155px !important;
   margin-left: auto;
   padding: 5px 2px;
   }
   th.thead_one{
   width: 35%;
   }
   .thead_two{
   width: 30%;
   } 
   .thead_three{
   width: 35%;
   }
</style>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src=
   "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link href=
   'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
   rel='stylesheet'>
<script src=
   "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- <script> toastr.success("Please review following customization options - Choose Your Starter");</script>
   -->
{{-- signature --}}
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script type="text/javascript">
   if("{{@$daily_report_sales['verified_by']}}"==null || "{{@$daily_report_sales['verified_by']}}"==""){
       var canvas_2 = document.getElementById('signature-pad_2');
   }
   if("{{@$daily_report_sales['approved_by']}}"==null || "{{@$daily_report_sales['approved_by']}}"==""){
       var canvas_3 = document.getElementById('signature-pad_3');
   }
   
   // function resizeCanvas() {
   //     var ratio =  Math.max(window.devicePixelRatio || 1, 1);
   
   //     if("{{@$daily_report_sales['verified_by']}}"==null || "{{@$daily_report_sales['verified_by']}}"==""){
   //         canvas_2.width = canvas_2.offsetWidth * ratio;
   //         canvas_2.height = canvas_2.offsetHeight * ratio;
   //         canvas_2.getContext("2d").scale(ratio, ratio);
   //     }
   
   //     if("{{@$daily_report_sales['approved_by']}}"==null || "{{@$daily_report_sales['approved_by']}}"==""){
   //         canvas_3.width = canvas_3.offsetWidth * ratio;
   //         canvas_3.height = canvas_3.offsetHeight * ratio;
   //         canvas_3.getContext("2d").scale(ratio, ratio);
   //     }
   // }
   
   //     // window.onresize = resizeCanvas;
   //     resizeCanvas();
   
   //     if("{{@$daily_report_sales['verified_by']}}"==null || "{{@$daily_report_sales['verified_by']}}"==""){
   //         var signaturePad_2 = new SignaturePad(canvas_2, {
   //         backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
   //     });
   //     }
   
   //     if("{{@$daily_report_sales['approved_by']}}"==null || "{{@$daily_report_sales['approved_by']}}"==""){
   //         var signaturePad_3 = new SignaturePad(canvas_3, {
   //         backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
   //     });
   //     }
   
   //     if("{{@$daily_report_sales['verified_by']}}"==null || "{{@$daily_report_sales['verified_by']}}"==""){
   //         document.getElementById('clear_2').addEventListener('click', function () {
   //           signaturePad_2.clear();
   //       });
   //     }
   
   //     if("{{@$daily_report_sales['approved_by']}}"==null || "{{@$daily_report_sales['approved_by']}}"==""){
   //         document.getElementById('clear_3').addEventListener('click', function () {
   //           signaturePad_3.clear();
   //       });
   //     }
   
   //     if("{{@$daily_report_sales['verified_by']}}"==null || "{{@$daily_report_sales['verified_by']}}"==""){
   //         document.getElementById('undo_2').addEventListener('click', function () {
   //           var data = signaturePad_2.toData();
   //           if (data) {
   //             data.pop(); // remove the last dot or line
   //             signaturePad_2.fromData(data);
   //         }
   //     });
   //     }
   
   //     if("{{@$daily_report_sales['approved_by']}}"==null || "{{@$daily_report_sales['approved_by']}}"==""){
   //         document.getElementById('undo_3').addEventListener('click', function () {
   //           var data = signaturePad_3.toData();
   //           if (data) {
   //             data.pop(); // remove the last dot or line
   //             signaturePad_3.fromData(data);
   //         }
   //     });
   //     }
   
       $(document).on('click','.save_btn',function(){
   
           if("{{@$daily_report_sales['verified_by']}}"==null || "{{@$daily_report_sales['verified_by']}}"==""){
               $('#signature_2').val(signaturePad_2.toData().length!=0?signaturePad_2.toDataURL('image/png'):null);
           }
           if("{{@$daily_report_sales['approved_by']}}"==null || "{{@$daily_report_sales['approved_by']}}"==""){
               $('#signature_3').val(signaturePad_3.toData().length!=0?signaturePad_3.toDataURL('image/png'):null);
           }
       })
   
</script>
<script type="text/javascript">
   //start date section in input feild
   
   $(document).ready(function() {
              // Gross //
              let sum_1 = {{$daily_report_sales->gross_sale >0 ?number_format($daily_report_sales->gross_sale,3, '.', ''):0}};
              let sum_2 = {{$daily_report_sales->discount_return > 0 ?number_format($daily_report_sales->discount_return,3, '.', ''):0}};
              let sum_3 = {{$daily_report_sales->cash_in_hand >0 ?number_format($daily_report_sales->cash_in_hand,3, '.', ''):0}};
              let sum_4 = {{$daily_report_sales->cards_sale >0 ?number_format($daily_report_sales->cards_sale,3, '.', ''):0}};
              let sum_5 = {{$daily_report_sales->cheque_cash >0 ?number_format($daily_report_sales->cheque_cash,3, '.', ''):0}};
              let sum_6 = {{$daily_report_sales->credit_sale>0 ? number_format($daily_report_sales->credit_sale,3, '.', '') :0}};
              let sum_7 = {{$daily_report_sales->total_collection>0 ?number_format($daily_report_sales->total_collection,3, '.', '') :0}};
              let net_sale ={{$daily_report_sales->net_sale > 0?number_format($daily_report_sales->net_sale,3, '.', '') :0 }};
              let total_card_sale = {{$daily_report_sales->cards_sale >0 ?number_format($daily_report_sales->cards_sale,3, '.', ''):0}};
              let total_cheque_cash = {{$daily_report_sales->cheque_cash >0 ?number_format($daily_report_sales->cheque_cash,3, '.', ''):0}};
              let total_credit_sale = {{$daily_report_sales->credit_sale >0 ?number_format($daily_report_sales->credit_sale,3, '.', ''):0}};
              let show_cash_in_hand = {{$daily_report_sales->cash_in_hand > 0 ?number_format($daily_report_sales->cash_in_hand,3, '.', ''):0 }};
              let cash_in_hand_actual = {{$daily_report_sales->cash_in_hand_actual >0 ?number_format($daily_report_sales->cash_in_hand_actual,3, '.', '') :0}};
   
              $(document).on("change", ".add_gross_sum", function() {
                  sum_1 = 0;
   
                  $("input[class *= 'add_gross_sum']").each(function() {
                      sum_1 += +$(this).val();
                  });
   
                  let discount_return = Number($('#discount_return').val());
   
   
                  $("#show_gross_sale").text('KD' + ' ' + Number(sum_1 + discount_return).toFixed(3));
                  $('#gross_sale').val(Number(sum_1 + discount_return));
                  $('#show_net_sale').text('KD' + ' ' + Number((sum_1 + discount_return) - sum_2).toFixed(
                      3));
                  $('#net_sale').val(Number((sum_1 + discount_return) - sum_2).toFixed(3));
                  span_entries_fulfilled();
                  closing_balance();
   
                  // Check For Span If 0 //
   
                  if (Number(sum_1 + discount_return) == 0) {
                      $("#show_gross_sale").text('');
                      $('#gross_sale').val('');
                      $('#show_net_sale').text('');
                      $('#net_sale').val('');
                  }
   
                  if (show_cash_in_hand == 0) {
                      entries_get_nullify();
                  }
   
                  //  ------------ //
   
              });
   
   
              // -------------- //
   
              // Discount //
   
              $(document).on("change", ".discount_sum", function() {
                  sum_2 = 0;
   
                  $("input[class *= 'discount_sum']").each(function() {
                      sum_2 += +$(this).val();
                  });
   
                  $("#show_discount_return").text('KD' + ' ' + sum_2.toFixed(3));
                  $('#discount_return').val(sum_2.toFixed(3));
                  let discount_return = Number($('#discount_return').val());
                  $("#show_gross_sale").text('KD' + ' ' + Number(sum_1 + discount_return).toFixed(3));
                  $('#gross_sale').val(Number(sum_1 + discount_return).toFixed(3));
                  $('#show_net_sale').text('KD' + ' ' + Number((sum_1 + discount_return) - sum_2).toFixed(
                      3));
                  $('#net_sale').val(Number((sum_1 + discount_return) - sum_2).toFixed(3));
   
                  span_entries_fulfilled();
                  closing_balance();
   
                  if (sum_2 == 0) {
                      $("#show_discount_return").text('');
                      $('#discount_return').val('');
                  }
   
                  if (Number(sum_1 + discount_return) == 0) {
                      $("#show_gross_sale").text('');
                      $('#gross_sale').val('');
                  }
   
                  if (Number((sum_1 + discount_return) - sum_2) == 0 || Number((sum_1 + discount_return) - sum_2)==null) {
                      $('#show_net_sale').text('');
                      $('#net_sale').val('');
                  }
   
                  if (show_cash_in_hand == 0) {
                      entries_get_nullify();
                  }
              });
   
   
              //  ------- //
   
              // Cash In Hand-schedule //
   
              $(document).on("change", ".cash_in_hand_sum", function() {
                  sum_3 = 0;
   
                  $("input[class *= 'cash_in_hand_sum']").each(function() {
                      sum_3 += +$(this).val();
                  });
   
                  $("#show_total_collection").text('KD' + ' ' + Number(sum_3 + sum_4 + sum_5 + sum_6)
                      .toFixed(3));
                  $('#total_collection').val(Number(sum_3 + sum_4 + sum_5 + sum_6).toFixed(3));
   
                  if (Number(sum_3 + sum_4 + sum_5 + sum_6) == 0) {
                      $("#show_total_collection").text('');
                      $('#total_collection').val('');
                  }
   
                  span_entries_fulfilled();
                  closing_balance();
   
                  if (show_cash_in_hand == 0) {
                      entries_get_nullify();
                  }
   
              });
   
              //  --------- //
   
              // Card Sale //
   
              function card_sum() {
   
                  sum_4 = 0;
   
                  $("input[class *= 'sum_card_sale']").each(function() {
                      sum_4 += +$(this).val();
                  });
   
                  $("#show_cards_sale").text('KD' + ' ' + sum_4.toFixed(3));
                  $('#cards_sale').val(sum_4.toFixed(3));
                  $("#show_total_collection").text('KD' + ' ' + Number(sum_3 + sum_4 + sum_5 + sum_6).toFixed(3));
                  $('#total_collection').val(Number(sum_3 + sum_4 + sum_5 + sum_6).toFixed(3));
   
                  if (sum_4 == 0) {
                      $("#show_cards_sale").text('');
                      $('#cards_sale').val('');
                  }
   
                  if (Number(sum_3 + sum_4 + sum_5 + sum_6) == 0) {
                      $("#show_total_collection").text('');
                      $('#total_collection').val('');
                  }
   
                  span_entries_fulfilled();
                  closing_balance();
   
                  if (show_cash_in_hand == 0) {
                      entries_get_nullify();
                  }
              }
              //  --------- //
   
              // Cheque/Cash Equivalent //
   
              $(document).on("change", ".sum_cheque", function() {
                  sum_5 = 0;
   
                  $("input[class *= 'sum_cheque']").each(function() {
                      sum_5 += +$(this).val();
                  });
                  $("#show_cheque_cash").text('KD' + ' ' + sum_5.toFixed(3));
                  $('#cheque_cash').val(sum_5.toFixed(3));
                  $("#show_total_collection").text('KD' + ' ' + Number(sum_3 + sum_4 + sum_5 + sum_6)
                      .toFixed(3));
                  $('#total_collection').val(Number(sum_3 + sum_4 + sum_5 + sum_6).toFixed(3));
   
                  if (sum_5 == 0) {
                      $("#show_cheque_cash").text('');
                      $('#cheque_cash').val('');
                  }
   
                  if (Number(sum_3 + sum_4 + sum_5 + sum_6) == 0) {
                      $("#show_total_collection").text('');
                      $('#total_collection').val('');
                  }
   
                  span_entries_fulfilled();
                  closing_balance();
   
                  if (show_cash_in_hand == 0) {
                      entries_get_nullify();
                  }
              });
   
              //  ------------------- //
   
              // Credit Sale //
   
              $(document).on("change", ".credit_sum", function() {
                  sum_6 = 0;
   
                  $("input[class *= 'credit_sum']").each(function() {
                      sum_6 += +$(this).val();
                  });
                  $("#show_credit_sale").text('KD' + ' ' + sum_6.toFixed(3));
                  $('#credit_sale').val(sum_6.toFixed(3));
                  $("#show_total_collection").text('KD' + ' ' + Number(sum_3 + sum_4 + sum_5 + sum_6)
                      .toFixed(3));
                  $('#total_collection').val(Number(sum_3 + sum_4 + sum_5 + sum_6).toFixed(3));
   
                  if (sum_6 == 0) {
                      $("#show_credit_sale").text('');
                      $("#credit_sale").val('');
                  }
   
                  if (Number(sum_3 + sum_4 + sum_5 + sum_6) == 0) {
                      $("#show_total_collection").text('');
                      $('#total_collection').val('');
   
                  }
   
                  span_entries_fulfilled();
                  closing_balance();
   
                  if (show_cash_in_hand == 0) {
                      entries_get_nullify();
                  }
              });
   
   
              function span_entries_fulfilled() {
                  net_sale = $('#net_sale').val();
                  total_card_sale = $('#cards_sale').val();
                  total_cheque_cash = $('#cheque_cash').val();
                  total_credit_sale = $('#credit_sale').val();
                  console.log(net_sale,total_card_sale,total_cheque_cash,total_credit_sale);
   
                  show_cash_in_hand = net_sale - total_card_sale -total_cheque_cash - total_credit_sale;
   
                  $('#show_cash_in_hand').text('KD' + ' ' + Number(show_cash_in_hand).toFixed(3));
                  $('#cash_in_hand').val(Number(show_cash_in_hand).toFixed(3));
   
   
                  //    $('#get_cash_sales').text(Number(show_cash_in_hand).toFixed(3));
                  // $('#cash_sales').val(Number(show_cash_in_hand).toFixed(3));
   
                  cash_in_hand_actual = $('#cash_in_hand_actual').val();
   
                  $('#get_cash_sales').text(Number(cash_in_hand_actual).toFixed(3));
                  $('#cash_sales').val(Number(cash_in_hand_actual).toFixed(3));
   
                  cash_in_hand_actual =Number($('#cash_in_hand_actual').val()).toFixed(3);
   
                  var amount=Number(show_cash_in_hand - cash_in_hand_actual).toFixed(3);
   
                  var overage_amount=0;
                  var shortage_amount=0;
                  if(show_cash_in_hand>=cash_in_hand_actual){
                   shortage_amount=amount;
               }else{
                  overage_amount=amount;
              }
   
   
   
              $('#cash_shortage').text(Math.abs(shortage_amount).toFixed(3));
              $('#cash_overage').text(Math.abs(overage_amount).toFixed(3));
              $('#get_cash_shortage').val(Math.abs(shortage_amount).toFixed(3));
              $('#get_cash_overage').val(Math.abs(overage_amount).toFixed(3));
          }
   
          function entries_get_nullify(){
              $('#show_cash_in_hand').text('');
              $('#cash_in_hand').val('');
              $('#get_cash_sales').text('');
              $('#cash_sales').val('');
              $('#cash_shortage').text('');
              $('#cash_overage').text('');
              $('#get_cash_shortage').val('');
              $('#get_cash_overage').val('');
          }
   
   
   
   
          function closing_balance() {
   
              sum_7 = 0;
   
              let cash_in_hand_balance = Number($('#cash_in_hand_opening_balance').val());
              let cash_sales = Number($('#cash_sales').val());
              let cash_deposit_in_bank = Number($('#cash_deposit_in_bank').val());
              let chack_balance=cash_in_hand_balance+cash_sales;
   
              if(chack_balance<cash_deposit_in_bank){
                  $('#cash_deposit_in_bank').val('');
                  cash_deposit_in_bank=0;
              }
   
              sum_7 = cash_in_hand_balance + cash_sales - cash_deposit_in_bank;
   
              $('#show_cash_in_hand_closing_balance').text('KD' + ' ' + Number(sum_7).toFixed(3));
              $('#cash_in_hand_closing_balance').val(Number(sum_7).toFixed(3));
   
          }
   
          $(document).on("change", ".total_cash_handel", function() {
   
              closing_balance();
   
              if (sum_7 == 0) {
                  $('#show_cash_in_hand_closing_balance').text('');
                  $('#cash_in_hand_closing_balance').val('');
              }
          });
   
          $(document).on('click','.save_btn',function(){
              if(!$('#cash_in_hand_actual').val()){
                  toastr.warning('Cash In Hand-Actual is required');
                  return false;
              }
          })
   
          $(document).on('keyup click','input',function(){
              $('input').css('background','white');
              if($(this).data('next')){
                  $(this).css('background','#ebe97d');
              }
          })
   
   
          //  ---------- //
   
   
          // Card Sale Dynamic //
   
   
   
          let amex_sum ={{@$sum_amex??0}};
          let visa_sum = {{@$sum_visa??0}};
          let master_sum = {{@$sum_master??0}};
          let dinner_sum = {{@$sum_dinner??0}};
          let mm_online_link_sum = {{@$sum_mm_online_link??0}};
          let knet_sum = {{@$sum_knet??0}};
          let other_sum = {{@$sum_other_cards??0}};
   
          let cheque_sum={{@$cheque_total??0}};
          let printed_gift_card_sum={{@$printed_gift_card_total??0}};
          let E_gift_card_sum = {{@$e_gift_card_total??0}};
          let Coupon_gift_card_sum = {{@$gift_coupon_voucher_total??0}};
          let cash_card_sum ={{@$cash_equivalent_c_total??0}};
   
          let talabat_credit_sumTGO={{@$talabat_credit_TGO_total??0}};;
          let talabat_credit_sumTMP={{@$talabat_credit_TMP_total??0}};;
          let deliveroo_credit_sumTGO={{@$deliveroo_credit_TGO_total??0}};;
          let deliveroo_credit_sumTMP={{@$deliveroo_credit_TMP_total??0}};;
          let v_thru_credit_sumTGO={{@$v_thru_credit_TGO_total??0}};;
          let v_thru_credit_sumTMP={{@$v_thru_credit_TMP_total??0}};;
          let others_credit_sumTGO={{@$others_credit_TGO_total??0}};;
          let others_credit_sumTMP={{@$others_credit_TMP_total??0}};;
          
          
   
          let amex_array =  {!! json_encode($amex) !!};
          let visa_array =  {!! json_encode($visa) !!};
          let master_array =  {!! json_encode($master) !!};
          let dinner_array =  {!! json_encode($dinner) !!};
          let mm_online_link_array =  {!! json_encode($mm_online_link) !!};
          let knet_array =  {!! json_encode($knet) !!};
          let other_array =  {!! json_encode($other_cards) !!};
   
          let cheque_array={!! json_encode($cheque) !!};
          let printed_gift_card_array={!! json_encode($printed_gift_card) !!};
          let E_gift_card_array={!! json_encode($e_gift_card) !!};
          let Coupon_gift_card_array={!! json_encode($gift_coupon_voucher) !!};
          let cash_card_array={!! json_encode($cash_equivalent_c) !!};
          let talabat_credit_arrayTMP={!! json_encode($talabat_credit_TMP) !!};
          let talabat_credit_arrayTGO={!! json_encode($talabat_credit_TGO) !!};
   
          let deliveroo_credit_arrayTMP={!! json_encode($deliveroo_credit_TMP) !!};
          let deliveroo_credit_arrayTGO={!! json_encode($deliveroo_credit_TGO) !!};
          let v_thru_credit_arrayTMP={!! json_encode($v_thru_credit_TMP) !!};
          let v_thru_credit_arrayTGO={!! json_encode($v_thru_credit_TGO) !!};
          let others_credit_arrayTMP={!! json_encode($others_credit_TMP) !!};
          let others_credit_arrayTGO={!! json_encode($others_credit_TGO) !!};
   
   
          let amex_count = {{count($amex)>0?count($amex):1}};
          let visa_count = {{count($visa)>0?count($visa):1}};
          let master_count = {{count($master)>0?count($master):1}};
          let dinner_count = {{count($dinner)>0?count($dinner):1}};
          let mm_online_link_count = {{count($mm_online_link)>0?count($mm_online_link):1}};
          let knet_count = {{count($knet)>0?count($knet):1}};
          let other_cards_count = {{count($other_cards)>0?count($other_cards):1}};
   
   
          let cheque_count={{count($cheque)>0?count($cheque):1}};
          let printed_gift_card_count={{count($printed_gift_card)>0?count($printed_gift_card):1}};
          let E_gift_card_count={{count($e_gift_card)>0?count($e_gift_card):1}};
          let Coupon_gift_card_count={{count($gift_coupon_voucher)>0?count($gift_coupon_voucher):1}};
          let cash_card_count={{count($cash_equivalent_c)>0?count($cash_equivalent_c):1}};
          let talabat_credit_count=1;
          let remarks_count={{count($remarks_list)>0?count($remarks_list):1}};
   
       //    //remarks
       //    $('#add_remarks').click(function(e){
   
       //        remarks_count++;
   
       //        var input_box='<div class="remarks_content w-100 d-flex align-items-center mt-3" id="remarks_'+remarks_count+'" > <input type="text" class="form-control remarks_input_value" name="remarks['+(remarks_count-1)+']" id="remark_input_value_'+remarks_count+'" data-id="'+remarks_count+'"><a href="javascript:;" class="remarks_delete_icon delete_input_icon" id="'+remarks_count+'"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a> </div>';
       //        $('#add_multiple_remarks').append(input_box);
       //        $('#remark_input_value_'+remarks_count).focus();
       //    });
       //     // add input box on tab click
       //     $( "#remarks_modal" ).keyup(function(e) {
       //        var code = e.keyCode || e.which;
       //        if (code == '9' || code == '13') {
   
       //         remarks_count++;
       //         var input_box='<div class="remarks_content w-100 d-flex align-items-center mt-3" id="remarks_'+remarks_count+'" > <input type="text" class="form-control remarks_input_value" name="remarks['+(remarks_count-1)+']" id="remark_input_value_'+remarks_count+'" data-id="'+remarks_count+'"><a href="javascript:;" class="remarks_delete_icon delete_input_icon" id="'+remarks_count+'"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a> </div>';
       //         $('#add_multiple_remarks').append(input_box);
       //         $('#remark_input_value_'+remarks_count).focus();
       //     }
       // });
   
           $(document).on('click','.remarks_delete_icon',function(){
   
              let id = $(this).attr('id');
              $('#remarks_' + id).remove();
   
   
              let remarks_arr=[];
              let flag = 0;
   
              $("input[class *= 'remarks_input_value']").each(function() {
   
                  if ($(this).val() == '') {
                      flag = 1;
                      toastr.error('Fields Should Not Be Empty');
                  }else{
                   remarks_arr.push($(this).val());
               }
           });
   
              $('#remarks_inserted_values').val(remarks_arr);
   
              $('#number_count_remarks').text(remarks_arr.length+' Remarks');
   
              remarks_count--;
   
          }); 
   
           //remarks
           $(document).on("click", '.add_remarks_total', function() {
   
               let remarks_arr=[];
               let flag = 0;
   
               $("input[class *= 'remarks_input_value']").each(function() {
   
                  if ($(this).val() == '') {
                      flag = 1;
                      toastr.error('Fields Should Not Be Empty');
                  }else{
                   remarks_arr.push($(this).val());
               }
           });
   
               $('#remarks_inserted_values').val(remarks_arr);
   
               $('#number_count_remarks').text(remarks_arr.length+' Remarks');
   
               if (flag == 0) {
                  $('.modal').modal('hide');
              }
   
          });
   
   
          // //  cheque //
          // $('#add_cheque').click(function(e) {
          //     cheque_count++;
          //     $('#add_multiple_cheque').append(
          //         '<span id="cheque_data_' + cheque_count +
          //         '" class="d-flex align-items-center mt-1"><input type="number" class="cheque_input_value input_card gross_sum margin-unset" id="cheque_input_value_' +
          //         cheque_count +
          //         '" data-id="' + cheque_count +
          //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="cheque_delete_icon delete_input_icon" id="' +
          //         cheque_count +
          //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //         );
          //     $('#cheque_input_value_'+cheque_count).focus();
          // });
   
          // $( "#cheque_modal" ).keyup(function(e) {
          //     var code = e.keyCode || e.which;
          //     if (code == '9' || code == '13') {
          //         cheque_count++;
          //         $('#add_multiple_cheque').append(
          //             '<span id="cheque_data_' + cheque_count +
          //             '" class="d-flex align-items-center mt-1"><input type="number" class="cheque_input_value input_card gross_sum margin-unset" id="cheque_input_value_' +
          //             cheque_count +
          //             '" data-id="' + cheque_count +
          //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="cheque_delete_icon delete_input_icon" id="' +
          //             cheque_count +
          //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //             );
          //         $('#cheque_input_value_'+cheque_count).focus();
          //     }
          // });
   
          $(document).on("click", ".cheque_delete_icon", function() {
              let id = $(this).attr('id');
              $('#cheque_data_' + id).remove();
   
              cheque_sum = 0;
   
              cheque_array = [];
   
              $("input[class *= 'cheque_input_value']").each(function() {
                  cheque_sum += +$(this).val();
                  cheque_array.push($(this).val());
              });
   
              if (cheque_sum != 0) {
                  cheque();
              } else {
                  $('#cheque_card_show').text(0);
                  $('#cheque').val(0);
                  $('#total_entries_cheque').text('');
                  cheque_sale_sum();
                  closing_balance();
              }
   
              cheque_count--;
   
          });
   
          $(document).on("keyup", ".cheque_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
                          //$('#cheque_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  cheque_sum = 0;
   
                  cheque_array = [];
   
                  $("input[class *= 'cheque_input_value']").each(function() {
                      cheque_sum += +$(this).val();
                      cheque_array.push($(this).val());
                  });
   
              });
   
          function cheque() {
              $("input[name = 'cheque']").val(cheque_array.filter((a) => a));
   
              $('#cheque_card_show').text(Number(cheque_sum).toFixed(3));
              $('#cheque').val(Number(cheque_sum).toFixed(3));
   
              if (cheque_array.filter((a) => a).length > 0) {
                  $('#total_entries_cheque').text(cheque_array.filter((a) => a).length + ' ' + 'SLIPS');
              } else {
                  $('#total_entries_cheque').text('');
              }
              cheque_sale_sum();
              closing_balance();
          }
   
          function amex() {
              $("input[name = 'amex']").val(amex_array.filter((a) => a));
   
              $('#amex_card_show').text(Number(amex_sum).toFixed(3));
              $('#amex').val(Number(amex_sum).toFixed(3));
                  // $('#add_multiple_amex').html('');
                  // $('#amex_add_btn').html('');
                  if (amex_array.filter((a) => a).length > 0) {
                      $('#total_entries_amex').text(amex_array.filter((a) => a).length + ' ' + 'Slip(s)');
                  } else {
                      $('#total_entries_amex').text('');
                  }
                  card_sum();
                  closing_balance();
              }
   
              function cheque_sale_sum() {
   
                 sum_5=0;
   
                 $("input[class *= 'cheques_input_value']").each(function() {
                  sum_5 += +$(this).val();
              });
   
                 $("#show_cheque_cash").text('KD' + ' ' + sum_5.toFixed(3));
                 $('#cheque_cash').val(sum_5.toFixed(3));
                 $("#show_total_collection").text('KD' + ' ' + Number(sum_3 + sum_4 + sum_5 + sum_6)
                  .toFixed(3));
                 $('#total_collection').val(Number(sum_3 + sum_4 + sum_5 + sum_6).toFixed(3));
   
                 if (sum_5 == 0) {
                  $("#show_cheque_cash").text('');
                  $('#cheque_cash').val('');
              }
   
          }
   
          $(document).on("click", '.add_cheque_total', function() {
   
              let flag = 0;
   
              $("input[class *= 'cheque_input_value']").each(function() {
                  if ($(this).val() == '') {
                      flag = 1;
                      toastr.error('Fields Should Not Be Empty');
                  }
              });
   
              if (flag == 0) {
                  cheque();
                  $('.modal').modal('hide');
              }
          });
   
          // $('#add_printed_gift_card').click(function(e) {
          //     printed_gift_card_count++;
          //     $('#add_multiple_printed_gift_card').append(
          //         '<span id="printed_gift_card_data_' + printed_gift_card_count +
          //         '" class="d-flex align-items-center mt-1"><input type="number" class="printed_gift_card_input_value input_card gross_sum margin-unset" id="printed_gift_card_input_value_' +
          //         printed_gift_card_count +
          //         '" data-id="' + printed_gift_card_count +
          //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="printed_gift_card_delete_icon delete_input_icon" id="' +
          //         printed_gift_card_count +
          //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //         );
          //     $('#printed_gift_card_input_value_'+printed_gift_card_count).focus();
          // });
   
          // $( "#printed_gift_card_modal" ).keyup(function(e) {
          //     var code = e.keyCode || e.which;
          //     if (code == '9' || code == '13') {
          //         printed_gift_card_count++;
          //         $('#add_multiple_printed_gift_card').append(
          //             '<span id="printed_gift_card_data_' + printed_gift_card_count +
          //             '" class="d-flex align-items-center mt-1"><input type="number" class="printed_gift_card_input_value input_card gross_sum margin-unset" id="printed_gift_card_input_value_' +
          //             printed_gift_card_count +
          //             '" data-id="' + printed_gift_card_count +
          //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="printed_gift_card_delete_icon delete_input_icon" id="' +
          //             printed_gift_card_count +
          //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //             );
          //         $('#printed_gift_card_input_value_'+printed_gift_card_count).focus();
          //     }
          // });
   
          $(document).on("click", ".printed_gift_card_delete_icon", function() {
              let id = $(this).attr('id');
              $('#printed_gift_card_data_' + id).remove();
   
              printed_gift_card_sum = 0;
   
              printed_gift_card_array = [];
   
              $("input[class *= 'printed_gift_card_input_value']").each(function() {
                  printed_gift_card_sum += +$(this).val();
                  printed_gift_card_array.push($(this).val());
              });
   
              if (printed_gift_card_sum != 0) {
                  printed_gift_card();
              } else {
                  $('#printed_gift_card_show').text(0);
                  $('#printed_gift_card').val(0);
                  $('#total_entries_printed_gift_card').text('');
                  cheque_sale_sum();
                  closing_balance();
              }
   
              printed_gift_card_count--;
   
          });
   
          $(document).on("keyup", ".printed_gift_card_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
                          //$('#printed_gift_card_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  printed_gift_card_sum = 0;
   
                  printed_gift_card_array = [];
   
                  $("input[class *= 'printed_gift_card_input_value']").each(function() {
                      printed_gift_card_sum += +$(this).val();
                      printed_gift_card_array.push($(this).val());
                  });
   
              });
   
          function printed_gift_card() {
              $("input[name = 'printed_gift_card']").val(printed_gift_card_array.filter((a) => a));
   
              $('#printed_gift_card_show').text(Number(printed_gift_card_sum).toFixed(3));
              $('#printed_gift_card').val(Number(printed_gift_card_sum).toFixed(3));
              
              if (printed_gift_card_array.filter((a) => a).length > 0) {
                  $('#total_entries_printed_gift_card').text(printed_gift_card_array.filter((a) => a).length + ' ' + 'SLIPS');
              } else {
                  $('#total_entries_printed_gift_card').text('');
              }
              cheque_sale_sum();
              closing_balance();
          }
   
          $(document).on("click", '.add_printed_gift_card_total', function() {
   
              let flag = 0;
   
              $("input[class *= 'printed_gift_card_input_value']").each(function() {
                  if ($(this).val() == '') {
                      flag = 1;
                      toastr.error('Fields Should Not Be Empty');
                  }
              });
   
              if (flag == 0) {
                  printed_gift_card();
                  $('.modal').modal('hide');
              }
          });
   
   
          //  //e-GIFT CARD
          //  $('#add_E_gift_card').click(function(e) {
          //     E_gift_card_count++;
          //     $('#add_multiple_E_gift_card').append(
          //         '<span id="E_gift_card_data_' + E_gift_card_count +
          //         '" class="d-flex align-items-center mt-1"><input type="number" class="E_gift_card_input_value input_card gross_sum margin-unset" id="E_gift_card_input_value_' +
          //         E_gift_card_count +
          //         '" data-id="' + E_gift_card_count +
          //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="E_gift_card_delete_icon delete_input_icon" id="' +
          //         E_gift_card_count +
          //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //         );
          //     $('#E_gift_card_input_value_'+E_gift_card_count).focus();
          // });
   
          //  $( "#E_gift_card_modal" ).keyup(function(e) {
          //     var code = e.keyCode || e.which;
          //     if (code == '9' || code == '13') {
          //         E_gift_card_count++;
          //         $('#add_multiple_E_gift_card').append(
          //             '<span id="E_gift_card_data_' + E_gift_card_count +
          //             '" class="d-flex align-items-center mt-1"><input type="number" class="E_gift_card_input_value input_card gross_sum margin-unset" id="E_gift_card_input_value_' +
          //             E_gift_card_count +
          //             '" data-id="' + E_gift_card_count +
          //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="E_gift_card_delete_icon delete_input_icon" id="' +
          //             E_gift_card_count +
          //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //             );
          //         $('#E_gift_card_input_value_'+E_gift_card_count).focus();
          //     }
          // });
   
           $(document).on("click", ".E_gift_card_delete_icon", function() {
              let id = $(this).attr('id');
              $('#E_gift_card_data_' + id).remove();
   
              E_gift_card_sum = 0;
   
              E_gift_card_array = [];
   
              $("input[class *= 'E_gift_card_input_value']").each(function() {
                  E_gift_card_sum += +$(this).val();
                  E_gift_card_array.push($(this).val());
              });
   
              if (E_gift_card_sum != 0) {
                  E_gift_card();
              } else {
                  $('#E_gift_card_show').text(0);
                  $('#E_gift_card').val(0);
                  $('#total_entries_E_gift_card').text('');
                  cheque_sale_sum();
                  closing_balance();
              }
   
              E_gift_card_count--;
   
   
          });
   
           function E_gift_card() {
              $("input[name = 'E_gift_card']").val(E_gift_card_array.filter((a) => a));
   
              $('#E_gift_card_show').text(Number(E_gift_card_sum).toFixed(3));
              $('#E_gift_card').val(Number(E_gift_card_sum).toFixed(3));
              
              if (E_gift_card_array.filter((a) => a).length > 0) {
                  $('#total_entries_E_gift_card').text(E_gift_card_array.filter((a) => a).length + ' ' + 'SLIPS');
              } else {
                  $('#total_entries_E_gift_card').text('');
              }
              cheque_sale_sum();
              closing_balance();
          }
   
          $(document).on("keyup", ".E_gift_card_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
                         // $('#E_gift_card_input_value_' + id).val(val);
                     }
                 });
   
                  //  ----------------- //
   
                  E_gift_card_sum = 0;
   
                  E_gift_card_array = [];
   
                  $("input[class *= 'E_gift_card_input_value']").each(function() {
                      E_gift_card_sum += +$(this).val();
                      E_gift_card_array.push($(this).val());
                  });
   
              });
   
          $(document).on("click", '.add_E_gift_card_total', function() {
   
              let flag = 0;
   
              $("input[class *= 'E_gift_card_input_value']").each(function() {
                  if ($(this).val() == '') {
                      flag = 1;
                      toastr.error('Fields Should Not Be Empty');
                  }
              });
   
              if (flag == 0) {
                  E_gift_card();
                  $('.modal').modal('hide');
              }
          });
   
   
          //  //Coupon
          //  $('#add_Coupon_gift_card').click(function(e) {
          //     Coupon_gift_card_count++;
          //     $('#add_multiple_Coupon_gift_card').append(
          //         '<span id="Coupon_gift_card_data_' + Coupon_gift_card_count +
          //         '" class="d-flex align-items-center mt-1"><input type="number" class="Coupon_gift_card_input_value input_card gross_sum margin-unset" id="Coupon_gift_card_input_value_' +
          //         Coupon_gift_card_count +
          //         '" data-id="' + Coupon_gift_card_count +
          //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="Coupon_gift_card_delete_icon delete_input_icon" id="' +
          //         Coupon_gift_card_count +
          //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //         );
          //     $('#Coupon_gift_card_input_value_'+Coupon_gift_card_count).focus();
          // });
   
          //  $( "#Coupon_gift_card_modal" ).keyup(function(e) {
          //     var code = e.keyCode || e.which;
          //     if (code == '9' || code == '13') {
          //         Coupon_gift_card_count++;
          //         $('#add_multiple_Coupon_gift_card').append(
          //             '<span id="Coupon_gift_card_data_' + Coupon_gift_card_count +
          //             '" class="d-flex align-items-center mt-1"><input type="number" class="Coupon_gift_card_input_value input_card gross_sum margin-unset" id="Coupon_gift_card_input_value_' +
          //             Coupon_gift_card_count +
          //             '" data-id="' + Coupon_gift_card_count +
          //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="Coupon_gift_card_delete_icon delete_input_icon" id="' +
          //             Coupon_gift_card_count +
          //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //             );
          //         $('#Coupon_gift_card_input_value_'+Coupon_gift_card_count).focus();
          //     }
          // });
   
   
   
           $(document).on("click", ".Coupon_gift_card_delete_icon", function() {
              let id = $(this).attr('id');
              $('#Coupon_gift_card_data_' + id).remove();
   
              Coupon_gift_card_sum = 0;
   
              Coupon_gift_card_array = [];
   
              $("input[class *= 'Coupon_gift_card_input_value']").each(function() {
                  Coupon_gift_card_sum += +$(this).val();
                  Coupon_gift_card_array.push($(this).val());
              });
   
              if (Coupon_gift_card_sum != 0) {
                  Coupon_gift_card();
              } else {
                  $('#Coupon_gift_card_show').text(0);
                  $('#Coupon_gift_card').val(0);
                  $('#total_entries_Coupon_gift_card').text('');
                  cheque_sale_sum();
                  closing_balance();
              }
   
              Coupon_gift_card_count--;
   
   
          });
   
           $(document).on("keyup", ".Coupon_gift_card_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
                          //$('#Coupon_gift_card_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  Coupon_gift_card_sum = 0;
   
                  Coupon_gift_card_array = [];
   
                  $("input[class *= 'Coupon_gift_card_input_value']").each(function() {
                      Coupon_gift_card_sum += +$(this).val();
                      Coupon_gift_card_array.push($(this).val());
                  });
   
              });
   
           function Coupon_gift_card() {
              $("input[name = 'Coupon_gift_card']").val(Coupon_gift_card_array.filter((a) => a));
   
              $('#Coupon_gift_card_show').text(Number(Coupon_gift_card_sum).toFixed(3));
              $('#Coupon_gift_card').val(Number(Coupon_gift_card_sum).toFixed(3));
   
              if (Coupon_gift_card_array.filter((a) => a).length > 0) {
                  $('#total_entries_Coupon_gift_card').text(Coupon_gift_card_array.filter((a) => a).length + ' ' + 'SLIPS');
              } else {
                  $('#total_entries_Coupon_gift_card').text('');
              }
              cheque_sale_sum();
              closing_balance();
          }
   
          $(document).on("click", '.add_Coupon_gift_card_total', function() {
   
              let flag = 0;
   
              $("input[class *= 'Coupon_gift_card_input_value']").each(function() {
                  if ($(this).val() == '') {
                      flag = 1;
                      toastr.error('Fields Should Not Be Empty');
                  }
              });
   
              if (flag == 0) {
                  Coupon_gift_card();
                  $('.modal').modal('hide');
              }
          });
   
       //cash
   
      //  $('#add_cash_card').click(function(e) {
      //     cash_card_count++;
      //     $('#add_multiple_cash_card').append(
      //         '<span id="cash_card_data_' + cash_card_count +
      //         '" class="d-flex align-items-center mt-1"><input type="number" class="cash_card_input_value input_card gross_sum margin-unset" id="cash_card_input_value_' +
      //         cash_card_count +
      //         '" data-id="' + cash_card_count +
      //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="cash_card_delete_icon delete_input_icon" id="' +
      //         cash_card_count +
      //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
      //         );
      //     $('#cash_card_input_value_'+cash_card_count).focus();
      // });
   
      //  $( "#cash_card_modal" ).keyup(function(e) {
      //     var code = e.keyCode || e.which;
      //     if (code == '9' || code == '13') {
      //         cash_card_count++;
      //         $('#add_multiple_cash_card').append(
      //             '<span id="cash_card_data_' +cash_card_count +
      //             '" class="d-flex align-items-center mt-1"><input type="number" class="cash_card_input_value input_card gross_sum margin-unset" id="cash_card_input_value_' +
      //             cash_card_count +
      //             '" data-id="' + cash_card_count +
      //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="cash_card_delete_icon delete_input_icon" id="' +
      //             cash_card_count +
      //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
      //             );
      //         $('#cash_card_input_value_'+cash_card_count).focus();
      //     }
      // });
   
   
       $(document).on("click", ".cash_card_delete_icon", function() {
          let id = $(this).attr('id');
          $('#cash_card_data_' + id).remove();
   
          cash_card_sum = 0;
   
          cash_card_array = [];
   
          $("input[class *= 'cash_card_input_value']").each(function() {
              cash_card_sum += +$(this).val();
              cash_card_array.push($(this).val());
          });
   
          if (cash_card_sum != 0) {
              cash_card();
          } else {
              $('#cash_card_show').text(0);
              $('#cash_card').val(0);
              $('#total_entries_cash_card').text('');
              cheque_sale_sum();
              closing_balance();
          }
   
          cash_card_count--;
   
   
      });
   
       $(document).on("keyup", ".cash_card_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
                          //$('#cash_card_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  cash_card_sum = 0;
   
                  cash_card_array = [];
   
                  $("input[class *= 'cash_card_input_value']").each(function() {
                      cash_card_sum += +$(this).val();
                      cash_card_array.push($(this).val());
                  });
   
              });
   
       function cash_card() {
          $("input[name = 'cash_equivalent_card']").val(cash_card_array.filter((a) => a));
   
          $('#cash_card_show').text(Number(cash_card_sum).toFixed(3));
          $('#cash_card').val(Number(cash_card_sum).toFixed(3));
              // $('#add_multiple_amex').html('');
              // $('#amex_add_btn').html('');
              if (cash_card_array.filter((a) => a).length > 0) {
                  $('#total_entries_cash_card').text(cash_card_array.filter((a) => a).length + ' ' + 'SLIPS');
              } else {
                  $('#total_entries_cash_card').text('');
              }
              cheque_sale_sum();
              closing_balance();
          }
   
          $(document).on("click", '.add_cash_card_total', function() {
   
              let flag = 0;
   
              $("input[class *= 'cash_card_input_value']").each(function() {
                  if ($(this).val() == '') {
                      flag = 1;
                      toastr.error('Fields Should Not Be Empty');
                  }
              });
   
              if (flag == 0) {
                  cash_card();
                  $('.modal').modal('hide');
              }
   
          });
   
          // //talabat_credit
          // $('#add_talabat_credit_card').click(function(e) {
          //     talabat_credit_count++;
          //     $('#add_multiple_talabat_credit').append(
          //         '<span id="talabat_credit_data_' + talabat_credit_count +
          //         '" class="d-flex align-items-center mt-1"><input type="number" class="talabat_credit_input_value input_card gross_sum margin-unset" id="talabat_credit_input_value_' +
          //         talabat_credit_count +
          //         '" data-id="' + talabat_credit_count +
          //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="talabat_credit_delete_icon delete_input_icon" id="' +
          //         talabat_credit_count +
          //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //         );
          //     $('#talabat_credit_input_value_'+talabat_credit_count).focus();
          // });
   
          //  $( "#talabat_credit_modal" ).keyup(function(e) {
          //     var code = e.keyCode || e.which;
          //     if (code == '9' || code == '13') {
          //         talabat_credit_count++;
          //         $('#add_multiple_talabat_credit').append(
          //             '<span id="talabat_credit_data_' +talabat_credit_count +
          //             '" class="d-flex align-items-center mt-1"><input type="number" class="talabat_credit_input_value input_card gross_sum margin-unset" id="talabat_credit_input_value_' +
          //             talabat_credit_count +
          //             '" data-id="' + talabat_credit_count +
          //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="talabat_credit_delete_icon delete_input_icon" id="' +
          //             talabat_credit_count +
          //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
          //         );
          //         $('#talabat_credit_input_value_'+talabat_credit_count).focus();
          //     }
          // });
   
          //TALABAT CREDIT
          // $(document).on("keyup", ".TGOtalabat_credit_input_value,.TMPtalabat_credit_input_value", function() {
   
          //         // For Input Field Upto 3 Digit //
   
          //         $(this).focusout(function() {
          //             if ($(this).val() != '' && $(this).val() != null) {
          //                 let id = $(this).data('id');
          //                 let val = Number($(this).val());
          //                 val = val.toFixed(3);
          //                 $(this).val(val);
          //                 //$('#talabat_credit_input_value_' + id).val(val);
          //             }
          //         });
   
          //         //  ----------------- //
   
          //         talabat_credit_sumTGO = 0;
   
          //         talabat_credit_arrayTMP = [];
          //         talabat_credit_arrayTGO=[];
   
          //         $("input[class *= 'TGOtalabat_credit_input_value']").each(function() {
          //             talabat_credit_sumTGO += +$(this).val();
          //             talabat_credit_arrayTGO.push($(this).val());
          //         });
   
          //         talabat_credit_sumTMP=0;
          //         $("input[class *= 'TMPtalabat_credit_input_value']").each(function() {
          //             talabat_credit_sumTMP += +$(this).val();
          //             talabat_credit_arrayTMP.push($(this).val());
          //         });
   
          //     });
   
          function talabat_credit() {
              $("input[name = 'talabat_creditTGO']").val(talabat_credit_arrayTGO.filter((a) => a));
              $("input[name = 'talabat_creditTMP']").val(talabat_credit_arrayTMP.filter((a) => a));
   
              $('#talabat_credit_show').text(Number(talabat_credit_sumTMP+talabat_credit_sumTGO).toFixed(3));
              $('#talabat_credit').val(Number(talabat_credit_sumTMP+talabat_credit_sumTGO).toFixed(3));
   
              talabat_credit_array=talabat_credit_arrayTGO.concat(talabat_credit_arrayTMP);
              if (talabat_credit_array.filter((a) => a).length > 0) {
                  $('#total_entries_talabat_credit').text(talabat_credit_array.filter((a) => a).length + ' ' + 'SLIPS');
              } else {
                  $('#total_entries_talabat_credit').text('');
              }
              talabat_credits_sum();
              closing_balance();
          }
   
          function talabat_credits_sum() {
   
            sum_6 = 0;
   
            $("input[class *= 'credits_input_value']").each(function() {
   
              sum_6 += +$(this).val();
          });
   
            $("#show_credit_sale").text('KD' + ' ' + sum_6.toFixed(3));
            $('#credit_sale').val(sum_6.toFixed(3));
            $("#show_total_collection").text('KD' + ' ' + Number(sum_3 + sum_4 + sum_5 + sum_6)
              .toFixed(3));
            $('#total_collection').val(Number(sum_3 + sum_4 + sum_5 + sum_6).toFixed(3));
   
            if (sum_6 == 0) {
              $("#show_credit_sale").text('');
              $("#credit_sale").val('');
          }
   
          if (Number(sum_3 + sum_4 + sum_5 + sum_6) == 0) {
              $("#show_total_collection").text('');
              $('#total_collection').val('');
   
          }
   
          span_entries_fulfilled();
          closing_balance();
   
          if (show_cash_in_hand == 0) {
              entries_get_nullify();
          }
   
      }
   
      $(document).on("click", '.add_talabat_credit_card_total', function() {
   
          let flag = 0;
   
   
          if (flag == 0) {
              talabat_credit();
              $('.modal').modal('hide');
          }
   
      });
   
        //Deliveroo
        // $(document).on("keyup", ".TGOdeliveroo_credit_input_value,.TMPdeliveroo_credit_input_value", function() {
   
        //           // For Input Field Upto 3 Digit //
   
        //           $(this).focusout(function() {
        //               if ($(this).val() != '' && $(this).val() != null) {
        //                   let id = $(this).data('id');
        //                   let val = Number($(this).val());
        //                   val = val.toFixed(3);
        //                   $(this).val(val);
        //                   //$('#talabat_credit_input_value_' + id).val(val);
        //               }
        //           });
   
        //           //  ----------------- //
   
        //           deliveroo_credit_sumTGO = 0;
   
        //           deliveroo_credit_arrayTMP = [];
        //           deliveroo_credit_arrayTGO=[];
   
        //           $("input[class *= 'TGOdeliveroo_credit_input_value']").each(function() {
        //               deliveroo_credit_sumTGO += +$(this).val();
        //               deliveroo_credit_arrayTGO.push($(this).val());
        //           });
   
        //           deliveroo_credit_sumTMP=0;
        //           $("input[class *= 'TMPdeliveroo_credit_input_value']").each(function() {
        //               deliveroo_credit_sumTMP += +$(this).val();
        //               deliveroo_credit_arrayTMP.push($(this).val());
        //           });
   
        //       });
   
        $(document).on("click", '.add_deliveroo_credit_card_total', function() {
   
          // let flag = 0;
   
          // $("input[class *= 'deliveroo_credit_input_value']").each(function() {
          //     if ($(this).val() == '') {
          //         flag = 1;
          //         toastr.error('Fields Should Not Be Empty');
          //     }
          // });
   
          // if (flag == 0) {
          //     deliveroo_credit();
          //    $('.modal').modal('hide');
          // }
   
          let flag = 0;
   
   
          if (flag == 0) {
              deliveroo_credit();
              $('.modal').modal('hide');
          }
   
   
      });
   
        function deliveroo_credit() {
          $("input[name = 'deliveroo_creditTGO']").val(deliveroo_credit_arrayTGO.filter((a) => a));
          $("input[name = 'deliveroo_creditTMP']").val(deliveroo_credit_arrayTMP.filter((a) => a));
   
          $('#deliveroo_credit_show').text(Number(deliveroo_credit_sumTMP+deliveroo_credit_sumTGO).toFixed(3));
          $('#deliveroo_credit').val(Number(deliveroo_credit_sumTMP+deliveroo_credit_sumTGO).toFixed(3));
   
          deliveroo_credit_array=deliveroo_credit_arrayTGO.concat(deliveroo_credit_arrayTMP);
          if (deliveroo_credit_array.filter((a) => a).length > 0) {
              $('#total_entries_deliveroo_credit').text(deliveroo_credit_array.filter((a) => a).length + ' ' + 'SLIPS');
          } else {
              $('#total_entries_deliveroo_credit').text('');
          }
          talabat_credits_sum();
          closing_balance();
      }
   
         //v_thru
   
         // $(document).on("keyup", ".TGOv_thru_credit_input_value,.TMPv_thru_credit_input_value", function() {
   
         //          // For Input Field Upto 3 Digit //
   
         //          $(this).focusout(function() {
         //              if ($(this).val() != '' && $(this).val() != null) {
         //                  let id = $(this).data('id');
         //                  let val = Number($(this).val());
         //                  val = val.toFixed(3);
         //                  $(this).val(val);
         //                  //$('#v_thru_credit_input_value_' + id).val(val);
         //              }
         //          });
   
         //          //  ----------------- //
   
         //          v_thru_credit_sumTGO = 0;
   
         //          v_thru_credit_arrayTMP = [];
         //          v_thru_credit_arrayTGO=[];
   
         //          $("input[class *= 'TGOv_thru_credit_input_value']").each(function() {
         //              v_thru_credit_sumTGO += +$(this).val();
         //              v_thru_credit_arrayTGO.push($(this).val());
         //          });
   
         //          v_thru_credit_sumTMP=0;
         //          $("input[class *= 'TMPv_thru_credit_input_value']").each(function() {
         //              v_thru_credit_sumTMP += +$(this).val();
         //              v_thru_credit_arrayTMP.push($(this).val());
         //          });
   
         //      });
   
         $(document).on("click", '.add_v_thru_credit_card_total', function() {
   
          let flag = 0;
   
          // $("input[class *= 'v_thru_credit_input_value']").each(function() {
          //     if ($(this).val() == '') {
          //         flag = 1;
          //         toastr.error('Fields Should Not Be Empty');
          //     }
          // });
   
          if (flag == 0) {
              v_thru_credit();
              $('.modal').modal('hide');
          }
   
      });
         function v_thru_credit() {
          $("input[name = 'v_thru_creditTGO']").val(v_thru_credit_arrayTGO.filter((a) => a));
          $("input[name = 'v_thru_creditTMP']").val(v_thru_credit_arrayTMP.filter((a) => a));
   
          $('#v_thru_credit_show').text(Number(v_thru_credit_sumTMP+v_thru_credit_sumTGO).toFixed(3));
          $('#v_thru_credit').val(Number(v_thru_credit_sumTMP+v_thru_credit_sumTGO).toFixed(3));
   
          v_thru_credit_array=v_thru_credit_arrayTGO.concat(v_thru_credit_arrayTMP);
          if (v_thru_credit_array.filter((a) => a).length > 0) {
              $('#total_entries_v_thru_credit').text(v_thru_credit_array.filter((a) => a).length + ' ' + 'SLIPS');
          } else {
              $('#total_entries_v_thru_credit').text('');
          }
          talabat_credits_sum();
          closing_balance();
      }
   
       //other credit
       // $(document).on("keyup", ".TGOothers_credit_input_value,.TMPothers_credit_input_value", function() {
   
       //            // For Input Field Upto 3 Digit //
   
       //            $(this).focusout(function() {
       //                if ($(this).val() != '' && $(this).val() != null) {
       //                    let id = $(this).data('id');
       //                    let val = Number($(this).val());
       //                    val = val.toFixed(3);
       //                    $(this).val(val);
       //                    //$('#others_credit_input_value_' + id).val(val);
       //                }
       //            });
   
       //            //  ----------------- //
   
       //            others_credit_sumTGO = 0;
   
       //            others_credit_arrayTMP = [];
       //            others_credit_arrayTGO=[];
   
       //            $("input[class *= 'TGOothers_credit_input_value']").each(function() {
       //                others_credit_sumTGO += +$(this).val();
       //                others_credit_arrayTGO.push($(this).val());
       //            });
   
       //            others_credit_sumTMP=0;
       //            $("input[class *= 'TMPothers_credit_input_value']").each(function() {
       //                others_credit_sumTMP += +$(this).val();
       //                others_credit_arrayTMP.push($(this).val());
       //            });
   
       //        });
   
       $(document).on("click", '.add_others_credit_card_total', function() {
   
          let flag = 0;
   
          // $("input[class *= 'others_credit_input_value']").each(function() {
          //     if ($(this).val() == '') {
          //         flag = 1;
          //         toastr.error('Fields Should Not Be Empty');
          //     }
          // });
   
          if (flag == 0) {
              others_credit();
              $('.modal').modal('hide');
          }
   
      });
       function others_credit() {
          $("input[name = 'others_creditTGO']").val(others_credit_arrayTGO.filter((a) => a));
          $("input[name = 'others_creditTMP']").val(others_credit_arrayTMP.filter((a) => a));
   
          $('#others_credit_show').text(Number(others_credit_sumTMP+others_credit_sumTGO).toFixed(3));
          $('#others_credit').val(Number(others_credit_sumTMP+others_credit_sumTGO).toFixed(3));
   
          others_credit_array=others_credit_arrayTGO.concat(others_credit_arrayTMP);
          if (others_credit_array.filter((a) => a).length > 0) {
              $('#total_entries_others_credit').text(others_credit_array.filter((a) => a).length + ' ' + 'SLIPS');
          } else {
              $('#total_entries_others_credit').text('');
          }
          talabat_credits_sum();
          closing_balance();
      }
   
   //  Amex //
   // $('#add_amex').click(function(e) {
   //    amex_count++;
   //    $('#add_multiple_amex').append(
   //        '<span id="amex_data_' + amex_count +
   //        '" class="d-flex align-items-center mt-1"><input type="number" class="amex_input_value input_card gross_sum margin-unset" id="amex_input_value_' +
   //        amex_count +
   //        '" data-id="' + amex_count +
   //        '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="amex_delete_icon delete_input_icon" id="' +
   //        amex_count +
   //        '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
   //        );
   //    $('#amex_input_value_'+amex_count).focus();
   // });
   
   //        // add input box on tab click
   //        $( "#amex_modal" ).keyup(function(e) {
   //            var code = e.keyCode || e.which;
   //            if (code == '9' || code == '13') {
   //                amex_count++;
   //                $('#add_multiple_amex').append(
   //                    '<span id="amex_data_' + amex_count +
   //                    '" class="d-flex align-items-center mt-1"><input type="number" class="amex_input_value input_card gross_sum margin-unset" id="amex_input_value_' +
   //                    amex_count +
   //                    '" data-id="' + amex_count +
   //                    '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="amex_delete_icon delete_input_icon" id="' +
   //                    amex_count +
   //                    '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
   //                    );
   //                $('#amex_input_value_'+amex_count).focus();
   //            }
   //        });
          //---------------------------
   
          $(document).on("click", ".amex_delete_icon", function() {
   
              let id = $(this).attr('id');
   
              $('#amex_data_' + id).remove();
   
              amex_sum = 0;
   
              amex_array = [];
   
              $("input[class *= 'amex_input_value']").each(function() {
                  amex_sum += +$(this).val();
                  amex_array.push($(this).val());
              });
   
              if (amex_sum != 0) {
                  amex();
              } else {
                  $('#amex_card_show').text(0);
                  $('#amex').val(0);
                  $('#total_entries_amex').text('');
                  card_sum();
                  closing_balance();
              }
   
              amex_count--;
   
              // if (amex_count == 0) {
              //     $('#amex_add_btn').html('');
              // }
   
          });
   
          $(document).on("change", ".amex_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $('#amex_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  amex_sum = 0;
   
                  amex_array = [];
   
                  $("input[class *= 'amex_input_value']").each(function() {
                      amex_sum += +$(this).val();
                      amex_array.push($(this).val());
                  });
   
              });
   
          $(document).on("keyup", ".amex_input_value,.visa_input_value,.master_input_value,.dinner_input_value,.mm_online_link_input_value,.knet_input_value,.other_input_value,.cheque_input_value", function() {
              var val = $(this).val();
              if(val.split('.').length>1){
                  if(val.split('.')[1].length > 3){
                      var new_val = parseFloat(val).toFixed(3);
                      $(this).val(new_val);
                  }
              }
          });
   
          $(document).on("click", '.add_amex_total', function() {
   
              let flag = 0;
   
              $("input[class *= 'amex_input_value']").each(function() {
                  if ($(this).val() == '') {
                      flag = 1;
                      toastr.error('Fields Should Not Be Empty');
                  }
              });
   
              if (flag == 0) {
                  amex();
                  $('.modal').modal('hide');
              }
          });
   
          // point three digit value
          $(document).on("keyup", ".keyupevent", function() {
              var val = $(this).val();
              if(val.split('.').length>1){
                  if(val.split('.')[1].length > 3){
                      var new_val = parseFloat(val).toFixed(3);
                      $(this).val(new_val);
                  }
              }
          });
   
          function amex() {
              $("input[name = 'amex']").val(amex_array.filter((a) => a));
   
              $('#amex_card_show').text(Number(amex_sum).toFixed(3));
              $('#amex').val(Number(amex_sum).toFixed(3));
              // $('#add_multiple_amex').html('');
              // $('#amex_add_btn').html('');
              if (amex_array.filter((a) => a).length > 0) {
                  $('#total_entries_amex').text(amex_array.filter((a) => a).length + ' ' + 'Slip(s)');
              } else {
                  $('#total_entries_amex').text('');
              }
              card_sum();
              closing_balance();
          }
   
   
   
              // Visa //
   
              // $('#add_visa').click(function(e) {
              //     //visa_sum = 0;
              //     visa_count++;
              //     $('#add_multiple_visa').append(
              //         '<span id="visa_data_' + visa_count +
              //         '" class="d-flex align-items-center mt-1"><input type="number" class="visa_input_value input_card gross_sum margin-unset" id="visa_input_value_' +
              //         visa_count +
              //         '" data-id="' + visa_count +
              //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="visa_delete_icon delete_input_icon" id="' +
              //         visa_count +
              //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //         );
              //     $('#visa_input_value_' + visa_count).focus();
              // });
   
              // // add input box on tab click
              // $("#visa_modal").keyup(function(e) {
              //     var code = e.keyCode || e.which;
              //     if (code == '9' || code == '13') {
              //         visa_count++;
              //         $('#add_multiple_visa').append(
              //             '<span id="visa_data_' + visa_count +
              //             '" class="d-flex align-items-center mt-1"><input type="number" class="visa_input_value input_card gross_sum margin-unset" id="visa_input_value_' +
              //             visa_count +
              //             '" data-id="' + visa_count +
              //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="visa_delete_icon delete_input_icon" id="' +
              //             visa_count +
              //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //             );
              //         $('#visa_input_value_' + visa_count).focus();
              //     }
              // });
              //---------------------------
   
              $(document).on("click", ".visa_delete_icon", function() {
                  let id = $(this).attr('id');
                  $('#visa_data_' + id).remove();
   
                  visa_sum = 0;
   
                  visa_array = [];
   
                  $("input[class *= 'visa_input_value']").each(function() {
                      visa_sum += +$(this).val();
                      visa_array.push($(this).val());
                  });
   
                  if (visa_sum != 0) {
                      visa();
                  } else {
                      $('#visa_card_show').text(0);
                      $('#visa').val(0);
                      $('#total_entries_visa').text('');
                      card_sum();
                      closing_balance();
                  }
   
                  visa_count--;
   
                  // if (visa_count == 0) {
                  //     $('#visa_add_btn').html('');
                  // }
   
              });
   
              $(document).on("change", ".visa_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $('#visa_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  visa_sum = 0;
   
                  visa_array = [];
   
                  $("input[class *= 'visa_input_value']").each(function() {
                      visa_sum += +$(this).val();
                      visa_array.push($(this).val());
                  });
   
              });
   
              $(document).on("click", '.add_visa_total', function() {
                  // let previous_visa_sum = Number($('#visa').val());
   
                  let flag = 0;
   
                  $("input[class *= 'visa_input_value']").each(function() {
                      if ($(this).val() == '') {
                          flag = 1;
                          toastr.error('Fields Should Not Be Empty');
                      }
                  });
   
                  if (flag == 0) {
                      visa();
                      $('.modal').modal('hide');
                  }
   
              });
   
   
              function visa() {
                  $("input[name = 'visa']").val(visa_array.filter((a) => a));
   
                  $('#visa_card_show').text(Number(visa_sum).toFixed(3));
                  $('#visa').val(Number(visa_sum).toFixed(3));
                  // $('#add_multiple_visa').html('');
                  // $('#visa_add_btn').html('');
                  if (visa_array.filter((a) => a).length > 0) {
                      $('#total_entries_visa').text(visa_array.filter((a) => a).length + ' ' + 'Slip(s)');
                  } else {
                      $('#total_entries_visa').text('');
                  }
                  card_sum();
                  closing_balance();
              }
   
              // ------- //
   
              // Master //
   
              // $('#add_master').click(function(e) {
              //     //master_sum = 0;
              //     master_count++;
              //     $('#add_multiple_master').append(
              //         '<span id="master_data_' + master_count +
              //         '" class="d-flex align-items-center mt-1"><input type="number" class="master_input_value input_card gross_sum margin-unset" id="master_input_value_' +
              //         master_count +
              //         '" data-id="' + master_count +
              //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="master_delete_icon delete_input_icon" id="' +
              //         master_count +
              //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //         );
              //     $('#master_input_value_' + master_count).focus();
              // });
   
              // // add input box on tab click
              // $("#master_modal").keyup(function(e) {
              //     var code = e.keyCode || e.which;
              //     if (code == '9' || code == '13') {
              //         master_count++;
              //         $('#add_multiple_master').append(
              //             '<span id="master_data_' + master_count +
              //             '" class="d-flex align-items-center mt-1"><input type="number" class="master_input_value input_card gross_sum margin-unset" id="master_input_value_' +
              //             master_count +
              //             '" data-id="' + master_count +
              //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="master_delete_icon delete_input_icon" id="' +
              //             master_count +
              //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //             );
              //         $('#master_input_value_' + master_count).focus();
              //     }
              // });
              //---------------------------
   
              $(document).on("click", ".master_delete_icon", function() {
                  let id = $(this).attr('id');
                  $('#master_data_' + id).remove();
   
                  master_sum = 0;
   
                  master_array = [];
   
                  $("input[class *= 'master_input_value']").each(function() {
                      master_sum += +$(this).val();
                      master_array.push($(this).val());
                  });
   
                  if (master_sum != 0) {
                      master();
                  } else {
                      $('#master_card_show').text(0);
                      $('#master').val(0);
                      $('#total_entries_master').text('');
                      card_sum();
                      closing_balance();
                  }
   
                  master_count--;
   
                  // if (master_count == 0) {
                  //     $('#master_add_btn').html('');
                  // }
   
              });
   
              $(document).on("change", ".master_input_value", function() {
   
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val)
                          // $('#master_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  master_sum = 0;
   
                  master_array = [];
   
                  $("input[class *= 'master_input_value']").each(function() {
                      master_sum += +$(this).val();
                      master_array.push($(this).val());
                  });
   
              });
   
              $(document).on("click", '.add_master_total', function() {
                  // let previous_master_sum = Number($('#master').val());
   
                  let flag = 0;
   
                  $("input[class *= 'master_input_value']").each(function() {
                      if ($(this).val() == '') {
                          flag = 1;
                          toastr.error('Fields Should Not Be Empty');
                      }
                  });
   
                  if (flag == 0) {
                      master();
                      $('.modal').modal('hide');
                  }
   
              });
   
              function master() {
                  $("input[name = 'master']").val(master_array.filter((a) => a));
   
                  $('#master_card_show').text(Number(master_sum).toFixed(3));
                  $('#master').val(Number(master_sum).toFixed(3));
                  // $('#add_multiple_master').html('');
                  // $('#master_add_btn').html('');
                  if (master_array.filter((a) => a).length > 0) {
                      $('#total_entries_master').text(master_array.filter((a) => a).length + ' ' +
                          'Slip(s)');
                  } else {
                      $('#total_entries_master').text('');
                  }
                  card_sum();
                  closing_balance();
              }
   
              // ------- //
   
              // Dinner //
   
              // $('#add_dinner').click(function(e) {
              //     //dinner_sum = 0;
              //     dinner_count++;
              //     $('#add_multiple_dinner').append(
              //         '<span id="dinner_data_' + dinner_count +
              //         '" class="d-flex align-items-center mt-1"><input type="number" class="dinner_input_value input_card gross_sum margin-unset" id="dinner_input_value_' +
              //         dinner_count +
              //         '" data-id="' + dinner_count +
              //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="dinner_delete_icon delete_input_icon" id="' +
              //         dinner_count +
              //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //         );
              //     $('#dinner_input_value_' + dinner_count).focus();
              // });
   
              // // add input box on tab click
              // $("#dinner_modal").keyup(function(e) {
              //     var code = e.keyCode || e.which;
              //     if (code == '9' || code == '13') {
              //         dinner_count++;
              //         $('#add_multiple_dinner').append(
              //             '<span id="dinner_data_' + dinner_count +
              //             '" class="d-flex align-items-center mt-1"><input type="number" class="dinner_input_value input_card gross_sum margin-unset" id="dinner_input_value_' +
              //             dinner_count +
              //             '" data-id="' + dinner_count +
              //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="dinner_delete_icon delete_input_icon" id="' +
              //             dinner_count +
              //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //             );
              //         $('#dinner_input_value_' + dinner_count).focus();
              //     }
              // });
              //---------------------------
   
              $(document).on("click", ".dinner_delete_icon", function() {
                  let id = $(this).attr('id');
                  $('#dinner_data_' + id).remove();
   
                  dinner_sum = 0;
   
                  dinner_array = [];
   
                  $("input[class *= 'dinner_input_value']").each(function() {
                      dinner_sum += +$(this).val();
                      dinner_array.push($(this).val());
                  });
   
                  if (dinner_sum != 0) {
                      dinner();
                  } else {
                      $('#dinner_card_show').text(0);
                      $('#dinner').val(0);
                      $('#total_entries_dinner').text('');
                      card_sum();
                      closing_balance();
                  }
   
                  dinner_count--;
   
                  // if (dinner_count == 0) {
                  //     $('#dinner_add_btn').html('');
                  // }
   
              });
   
              $(document).on("change", ".dinner_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
   
                          //$('#dinner_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  dinner_sum = 0;
   
                  dinner_array = [];
   
                  $("input[class *= 'dinner_input_value']").each(function() {
                      dinner_sum += +$(this).val();
                      dinner_array.push($(this).val());
                  });
   
              });
   
              $(document).on("click", '.add_dinner_total', function() {
                  // previous_dinner_sum = Number($('#dinner').val());
   
                  let flag = 0;
   
                  $("input[class *= 'dinner_input_value']").each(function() {
                      if ($(this).val() == '') {
                          flag = 1;
                          toastr.error('Fields Should Not Be Empty');
                      }
                  });
   
                  if (flag == 0) {
                      dinner();
                      $('.modal').modal('hide');
                  }
   
              });
   
   
              function dinner() {
                  $("input[name = 'dinner']").val(dinner_array.filter((a) => a));
   
                  $('#dinner_card_show').text(Number(dinner_sum).toFixed(3));
                  $('#dinner').val(Number(dinner_sum).toFixed(3));
                  // $('#add_multiple_dinner').html('');
                  // $('#dinner_add_btn').html('');
                  if (dinner_array.filter((a) => a).length > 0) {
                      $('#total_entries_dinner').text(dinner_array.filter((a) => a).length + ' ' +
                          'Slip(s)');
                  } else {
                      $('#total_entries_dinner').text('');
                  }
                  card_sum();
                  closing_balance();
              }
              // ------- //
   
              // MM online Link //
   
              // $('#add_mm_online_link').click(function(e) {
              //     //mm_online_link_sum = 0;
              //     mm_online_link_count++;
              //     $('#add_multiple_mm_online_link').append(
              //         '<span id="mm_online_link_data_' + mm_online_link_count +
              //         '" class="d-flex align-items-center mt-1"><input type="number" class="mm_online_link_input_value input_card gross_sum margin-unset" id="mm_online_link_input_value_' +
              //         mm_online_link_count +
              //         '" data-id="' + mm_online_link_count +
              //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="mm_online_link_delete_icon delete_input_icon" id="' +
              //         mm_online_link_count +
              //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //         );
              //     $('#mm_online_link_input_value_' + mm_online_link_count).focus();
              // });
   
              // // add input box on tab click
              // $("#mm_online_link_modal").keyup(function(e) {
              //     var code = e.keyCode || e.which;
              //     if (code == '9' || code == '13') {
              //         mm_online_link_count++;
              //         $('#add_multiple_mm_online_link').append(
              //             '<span id="mm_online_link_data_' + mm_online_link_count +
              //             '" class="d-flex align-items-center mt-1"><input type="number" class="mm_online_link_input_value input_card gross_sum margin-unset" id="mm_online_link_input_value_' +
              //             mm_online_link_count +
              //             '" data-id="' + mm_online_link_count +
              //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="mm_online_link_delete_icon delete_input_icon" id="' +
              //             mm_online_link_count +
              //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //             );
              //         $('#mm_online_link_input_value_' + mm_online_link_count).focus();
              //     }
              // });
              //---------------------------
   
              $(document).on("click", ".mm_online_link_delete_icon", function() {
                  let id = $(this).attr('id');
                  $('#mm_online_link_data_' + id).remove();
   
                  mm_online_link_sum = 0;
   
                  mm_online_link_array = [];
   
                  $("input[class *= 'mm_online_link_input_value']").each(function() {
                      mm_online_link_sum += +$(this).val();
                      mm_online_link_array.push($(this).val());
                  });
   
                  if (mm_online_link_sum != 0) {
                      mm_online_link();
                  } else {
                      $('#mm_online_link_card_show').text(0);
                      $('#mm_online_link').val(0);
                      $('#total_entries_mm_online_link').text('');
                      card_sum();
                      closing_balance();
                  }
   
                  mm_online_link_count--;
   
                  // if (mm_online_link_count == 0) {
                  //     $('#mm_online_link_add_btn').html('');
                  // }
   
              });
   
              $(document).on("change", ".mm_online_link_input_value", function() {
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
                          //$('#mm_online_link_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  mm_online_link_sum = 0;
   
                  mm_online_link_array = [];
   
                  $("input[class *= 'mm_online_link_input_value']").each(function() {
                      mm_online_link_sum += +$(this).val();
                      mm_online_link_array.push($(this).val());
                  });
   
              });
   
              $(document).on("click", '.add_mm_online_link_total', function() {
                  // previous_mm_online_link_sum = Number($('#mm_online_link').val());
   
                  let flag = 0;
   
                  $("input[class *= 'mm_online_link_input_value']").each(function() {
                      if ($(this).val() == '') {
                          flag = 1;
                          toastr.error('Fields Should Not Be Empty');
                      }
                  });
   
                  if (flag == 0) {
                      mm_online_link();
                      $('.modal').modal('hide');
                  }
   
              });
   
              function mm_online_link() {
                  $("input[name = 'mm_online_link']").val(mm_online_link_array.filter((a) => a));
   
                  $('#mm_online_link_card_show').text(Number(mm_online_link_sum).toFixed(3));
                  $('#mm_online_link').val(Number(mm_online_link_sum).toFixed(3));
                  // $('#add_multiple_mm_online_link').html('');
                  // $('#mm_online_link_add_btn').html('');
                  if (mm_online_link_array.filter((a) => a).length > 0) {
                      $('#total_entries_mm_online_link').text(mm_online_link_array.filter((a) => a).length +
                          ' ' + 'Slip(s)');
                  } else {
                      $('#total_entries_mm_online_link').text('');
                  }
                  card_sum();
                  closing_balance();
              }
   
              // ------- //
   
              // Knet //
   
              // $('#add_knet').click(function(e) {
              //     //knet_sum = 0;
              //     knet_count++;
              //     $('#add_multiple_knet').append(
              //         '<span id="knet_data_' + knet_count +
              //         '" class="d-flex align-items-center mt-1"><input type="number" class="knet_input_value input_card gross_sum margin-unset" id="knet_input_value_' +
              //         knet_count +
              //         '" data-id="' + knet_count +
              //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="knet_delete_icon delete_input_icon" id="' +
              //         knet_count +
              //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //         );
              //     $('#knet_input_value_' + knet_count).focus();
              // });
   
              // // add input box on tab click
              // $("#knet_modal").keyup(function(e) {
              //     var code = e.keyCode || e.which;
              //     if (code == '9' || code == '13') {
              //         knet_count++;
              //         $('#add_multiple_knet').append(
              //             '<span id="knet_data_' + knet_count +
              //             '" class="d-flex align-items-center mt-1"><input type="number" class="knet_input_value input_card gross_sum margin-unset" id="knet_input_value_' +
              //             knet_count +
              //             '" data-id="' + knet_count +
              //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="knet_delete_icon delete_input_icon" id="' +
              //             knet_count +
              //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //             );
              //         $('#knet_input_value_' + knet_count).focus();
              //     }
              // });
              //---------------------------
   
              $(document).on("click", ".knet_delete_icon", function() {
                  let id = $(this).attr('id');
                  $('#knet_data_' + id).remove();
   
                  knet_sum = 0;
   
                  knet_array = [];
   
                  $("input[class *= 'knet_input_value']").each(function() {
                      knet_sum += +$(this).val();
                      knet_array.push($(this).val());
                  });
   
                  if (knet_sum != 0) {
                      knet();
                  } else {
                      $('#knet_card_show').text(0);
                      $('#knet').val(0);
                      $('#total_entries_knet').text('');
                      card_sum();
                      closing_balance();
                  }
   
                  knet_count--;
   
                  // if (knet_count == 0) {
                  //     $('#knet_add_btn').html('');
                  // }
   
              });
   
              $(document).on("change", ".knet_input_value", function() {
   
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
                          //$('#knet_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  knet_sum = 0;
   
                  knet_array = [];
   
                  $("input[class *= 'knet_input_value']").each(function() {
                      knet_sum += +$(this).val();
                      knet_array.push($(this).val());
                  });
   
              });
   
              $(document).on("click", '.add_knet_total', function() {
                  // previous_knet_sum = Number($('#knet').val());
   
                  let flag = 0;
   
                  $("input[class *= 'knet_input_value']").each(function() {
                      if ($(this).val() == '') {
                          flag = 1;
                          toastr.error('Fields Should Not Be Empty');
                      }
                  });
   
                  if (flag == 0) {
                      knet();
                      $('.modal').modal('hide');
                  }
   
              });
   
              function knet() {
                  $("input[name = 'knet']").val(knet_array.filter((a) => a));
   
                  $('#knet_card_show').text(Number(knet_sum).toFixed(3));
                  $('#knet').val(Number(knet_sum).toFixed(3));
                  // $('#add_multiple_knet').html('');
                  // $('#knet_add_btn').html('');
                  if (knet_array.filter((a) => a).length > 0) {
                      $('#total_entries_knet').text(knet_array.filter((a) => a).length + ' ' + 'Slip(s)');
                  } else {
                      $('#total_entries_knet').text('');
                  }
                  card_sum();
                  closing_balance();
              }
   
              // ------- //
   
              // Other //
   
              // $('#add_other').click(function(e) {
              //     //other_sum = 0;
              //     other_cards_count++
              //     $('#add_multiple_other').append(
              //         '<span id="other_cards_data_' + other_cards_count +
              //         '" class="d-flex align-items-center mt-1"><input type="number" class="other_input_value input_card gross_sum margin-unset" id="other_input_value_' +
              //         other_cards_count +
              //         '" data-id="' + other_cards_count +
              //         '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="other_cards_delete_icon delete_input_icon" id="' +
              //         other_cards_count +
              //         '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //         );
              //     $('#other_input_value_' + other_cards_count).focus();
              // });
   
              // // add input box on tab click
              // $("#other_card_modal").keyup(function(e) {
              //     var code = e.keyCode || e.which;
              //     if (code == '9' || code == '13') {
              //         other_cards_count++
              //         $('#add_multiple_other').append(
              //             '<span id="other_cards_data_' + other_cards_count +
              //             '" class="d-flex align-items-center mt-1"><input type="number" class="other_input_value input_card gross_sum margin-unset" id="other_input_value_' +
              //             other_cards_count +
              //             '" data-id="' + other_cards_count +
              //             '" maxlength="100" aria-invalid="false"><a href="javascript:;" class="other_cards_delete_icon delete_input_icon" id="' +
              //             other_cards_count +
              //             '"><i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:16px;cursor:pointer"></i></a></span>'
              //             );
              //         $('#other_input_value_' + other_cards_count).focus();
              //     }
              // });
              //---------------------------
   
              $(document).on("click", ".other_cards_delete_icon", function() {
                  let id = $(this).attr('id');
                  $('#other_cards_data_' + id).remove();
   
                  other_sum = 0;
   
                  other_array = [];
   
                  $("input[class *= 'other_input_value']").each(function() {
                      other_sum += +$(this).val();
                      other_array.push($(this).val());
                  });
   
                  if (other_sum != 0) {
                      other_card();
                  } else {
                      $('#other_card_show').text(0);
                      $('#other_cards').val(0);
                      $('#total_entries_other_cards').text('');
                      card_sum();
                      closing_balance();
                  }
   
                  other_cards_count--;
   
                  // if (other_cards_count == 0) {
                  //     $('#other_add_btn').html('');
                  // }
   
              });
   
              $(document).on("change", ".other_input_value", function() {
   
   
                  // For Input Field Upto 3 Digit //
   
                  $(this).focusout(function() {
                      if ($(this).val() != '' && $(this).val() != null) {
                          let id = $(this).data('id');
                          let val = Number($(this).val());
                          val = val.toFixed(3);
                          $(this).val(val);
                          //$('#other_input_value_' + id).val(val);
                      }
                  });
   
                  //  ----------------- //
   
                  other_sum = 0;
   
                  other_array = [];
   
                  $("input[class *= 'other_input_value']").each(function() {
                      other_sum += +$(this).val();
                      other_array.push($(this).val());
                  });
   
              });
   
              $(document).on("click", '.add_other_total', function() {
                  // previous_other_sum = Number($('#other_cards').val());
   
                  let flag = 0;
   
                  $("input[class *= 'other_input_value']").each(function() {
                      if ($(this).val() == '') {
                          flag = 1;
                          toastr.error('Fields Should Not Be Empty');
                      }
                  });
   
                  if (flag == 0) {
                      other_card();
                      $('.modal').modal('hide');
                  }
   
              });
   
              function other_card() {
                  $("input[name = 'other_cards']").val(other_array.filter((a) => a));
   
                  $('#other_card_show').text(Number(other_sum).toFixed(3));
                  $('#other_cards').val(Number(other_sum).toFixed(3));
                  // $('#add_multiple_other').html('');
                  // $('#other_add_btn').html('');
                  if (other_array.filter((a) => a).length > 0) {
                      $('#total_entries_other_cards').text(other_array.filter((a) => a).length + ' ' +
                          'Slip(s)');
                  } else {
                      $('#total_entries_other_cards').text('');
                  }
                  card_sum();
                  closing_balance();
              }
   
              // ------- //
   
              // ------------------- //
   
          });
   
   $(document).ready(function() {
   
      $('.open_cheque_modal').click(function() {
          $('#cheque_modal').modal('show');
      });
   
      $('.open_printed_gift_card_modal').click(function(){
          $('#printed_gift_card_modal').modal('show');
      });
   
      $('.open_E_gift_card_modal').click(function(){
          $('#E_gift_card_modal').modal('show');
      });
   
      $('.open_Coupon_gift_card_modal').click(function(){
          $('#Coupon_gift_card_modal').modal('show');
      });
   
      $('.open_cash_card_modal').click(function(){
          $('#cash_card_modal').modal('show');
      });
   
      $('.open_talabat_credit_modal').click(function(){
          $('#talabat_credit_modal').modal('show');
      });
   
      $('.open_deliveroo_credit_modal').click(function(){
          $('#deliveroo_credit_modal').modal('show');
      });
   
      $('.open_v_thru_credit_modal').click(function(){
          $('#v_thru_credit_modal').modal('show');
      });
   
      $('.open_others_credit_modal').click(function(){
          $('#others_credit_modal').modal('show');
      });
      $('.open_remarks_modal').click(function() {
          $('#remarks_modal').modal('show');
      });
   
      $('.open_amex_modal').click(function() {
   
          $('#amex_modal').modal('show');
      });
   
      $('.open_visa_modal').click(function() {
          $('#visa_modal').modal('show');
      });
   
      $('.open_master_modal').click(function() {
          $('#master_modal').modal('show');
      });
   
      $('.open_dinner_modal').click(function() {
          $('#dinner_modal').modal('show');
      });
   
      $('.open_mm_online_link_modal').click(function() {
          $('#mm_online_link_modal').modal('show');
      });
      
      $('.open_Complimentary_modal').click(function() {
          $('#Complimentary_modal').modal('show');
      });

      $('.open_knet_modal').click(function() {
          $('#knet_modal').modal('show');
      });
   
      $('.open_other_modal').click(function() {
          $('#other_card_modal').modal('show');
      });
   
      $('.open_upload_income_modal').click(function() {
          $('#upload_invoice_modal').modal('show');
      });
   
      $('.close_modal').click(function() {
          $('.modal').modal('hide');
      });
   
      $('.close_modal_doc').click(function() {
          $('#doc_image_modal').modal('hide');
      });
   
      $('.close_modal_edit_doc').click(function() {
          $('#update_invoice_modal').modal('hide');
      });
   
   
              // Changing All input Fields To Three Decimal //
   
              $('#dine_in_restaurent').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#dine_in_restaurent').val(val);
                  }
              });
   
              $('#dine_in_cabin').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#dine_in_cabin').val(val);
                  }
              });
   
              $('#take_away_self_pickup').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#take_away_self_pickup').val(val);
                  }
              });
   
              $('#home_delivery').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#home_delivery').val(val);
                  }
              });
   
              $('#buffet').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#buffet').val(val);
                  }
              });
   
              $('#talabat_TEM').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#talabat_TEM').val(val);
                  }
              });
   
              $('#talabat_TGO').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#talabat_TGO').val(val);
                  }
              });
              $('#MM_Express_TGO').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#MM_Express_TGO').val(val);
                  }
              });
   
   
              $('#deliveroo_TEM').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#deliveroo_TEM').val(val);
                  }
              });
   
              $('#deliveroo_TGO').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#deliveroo_TGO').val(val);
                  }
              });
   
              $('#v_thru').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#v_thru').val(val);
                  }
              });
   
              $('#mm_online').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#mm_online').val(val);
                  }
              });
   
              $('#osc').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#osc').val(val);
                  }
              });
   
              $('#garden').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#garden').val(val);
                  }
              });
   
              $('#others_gross').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#others_gross').val(val);
                  }
              });
   
              $('#discount').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#discount').val(val);
                  }
              });
   
              $('#complimentary').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#complimentary').val(val);
                  }
              });
   
              $('#sale_Return').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#sale_Return').val(val);
                  }
              });
   
              $('#cash_in_hand_actual').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#cash_in_hand_actual').val(val);
                  }
              });
   
              $('#cheque').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#cheque').val(val);
                  }
              });
   
              $('#printed_gift_card').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#printed_gift_card').val(val);
                  }
              });
   
              $('#e_gift_card').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#e_gift_card').val(val);
                  }
              });
   
              $('#gift_coupon_voucher').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#gift_coupon_voucher').val(val);
                  }
              });
   
              $('#cash_equivalent').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#cash_equivalent').val(val);
                  }
              });
   
              $('#talabat_credit').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#talabat_credit').val(val);
                  }
              });
   
              $('#deliveroo_credit').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#deliveroo_credit').val(val);
                  }
              });
   
              $('#v_thru_credit').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#v_thru_credit').val(val);
                  }
              });
   
              $('#others_credit').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#others_credit').val(val);
                  }
              });
   
              $('#cash_deposit_in_bank').focusout(function() {
                  if ($(this).val() != '' && $(this).val() != null) {
                      let val = Number($(this).val());
                      val = val.toFixed(3);
                      $('#cash_deposit_in_bank').val(val);
                  }
              });
   
          });
   
   
          // ------------------------------------- //
      
</script>
{{-- stop submitting on enter button click --}}
<script>
   $('#cash_deposit_in_bank').on('keyup', function() {
       var deposite_in_bank = parseFloat($(this).val());
       var closing_balance_ = parseFloat($('#cash_in_hand_opening_balance').val()) + parseFloat($(
           '#cash_sales').val());
       if (deposite_in_bank > closing_balance_ || !closing_balance_) {
           $(this).val(Math.floor(deposite_in_bank / 10) == 0 ? '' : Math.floor(deposite_in_bank / 10));
       }
   });
   $(document).on('keypress', '#addReportForm', function(e) {
       var keyCode = e.keyCode || e.which;
       if (keyCode === 13) {
   
           var active_input = e.target;
           var next_id = $('#' + active_input.id).data('next');
           $(next_id).focus();
   
           e.preventDefault();
           return false;
       }
   });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
   // Datatable For Upload  Document //
   
   $('#daily_sales_docs').DataTable({
       "ordering": false,
       columnDefs: [{
           targets: 0,
           render: function(data, type, row) {
               return data.substr(0, 2);
           }
       }],
   });
   
   // -------------------------- //
   
   // On Upload Image Preview Drag And Drop //
   
   $(document).on('change', '#uploadFile', function(e) {
   
       const file = this.files[0];
       const fileType = file['type'];
       const file_size = file['size'];
       const validImageTypes = ['image/jpeg', 'image/png', 'application/pdf', 'text/plain',
       'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
       'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'
       ];
   
       // 'application/pdf'
   
       if (file_size > 5000000) {
           $('#image_base64').val('');
           $('#uploadFile').val('');
           swal("Document Size Should Be Upto 5MB");
       }
   
       if (!validImageTypes.includes(fileType)) {
           $('#image_base64').val('');
           $('#uploadFile').val('');
           swal("Document Type should be of format jpg,jpeg,png,pdf,text,docx,xlsx,csv");
       } else {
           let files = e.target.files;
           let f = files[0];
   
           var fileReader = new FileReader();
           fileReader.onload = (function(e) {
               var file = e.target;
               // console.log(e.target.result);
               $('#image_base64').val(e.target.result);
           });
   
           fileReader.readAsDataURL(f);
   
       }
   
   });
   
   $(document).on('click', '#document_upload_submit', function() {
   
       if ($('#image_base64').val() == '' || $('#image_base64').val() == null) {
           swal("Doc Required");
       } else {
   
           let upload_daily_sales_invoice_domain = $('#upload_daily_sales_invoice_domain').val();
           let image_base64 = $('#image_base64').val();
           // let report_id = $('#daily_sales_report_id').val();
   
           // -------------------------------- //
   
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
   
           $.ajax({
               type: 'POST',
               url: "{{ route('report.doc_upload_save') }}",
               data: {
                   "upload_daily_sales_invoice_domain": upload_daily_sales_invoice_domain,
                   "image_base64": image_base64,
                   'daily_sales_report_id': report_id,
               },
               dataType: "JSON",
               success: function(response) {
                   console.log(response.status);
                   if (response.status) {
                       $("#daily_sales_docs").DataTable().clear().destroy();
                       $('#daily_sales_docs_list').html('');
                       $('#daily_sales_docs_list').html(response.html);
                       $('#image_base64').val('');
                       $('#uploadFile').val('');
                   }
               },
               // error: function(err) {
               //     swal("Error occured !");
               // }
           });
       }
   
   });
   
   
   $(document).on('click', '.view_doc', function() {
   
       let doc_image = $(this).data('id');
   
       let image_type_split = doc_image.split(".").pop();
   
       if (image_type_split == 'jpg' || image_type_split == 'jpeg' || image_type_split == 'png') {
           $('#document_image_pop_up').html(
               '<a class="open_file_in_newtab" href="{{ asset('branch_images/') }}/' + doc_image +
               '"><img src="{{ asset('branch_images/') }}/' + doc_image +
               '" id="current_thumbnail_preview" style="width:300;height:130px;display:block;border-radius: 10px;"></a>'
               );
       } else {
           $('#document_image_pop_up').html(
               '<a class="open_file_in_newtab" href="{{ asset('branch_images/') }}/' + doc_image +
               '"><i class="fas fa-file-pdf" aria-hidden="true"></i></a></span>');
       }
   
       $('#doc_image_modal').modal('show');
   
   });
   
   $(document).on('click', '.open_file_in_newtab', function() {
       window.open(this.href);
       return false;
   });
   
   $(document).on('click', '.delete_doc', function() {
   
       let id = $(this).attr('id');
   
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
   
       $.ajax({
           type: 'POST',
           url: "{{ route('report.delete_doc') }}",
           data: {
               "id": id,
               'daily_sales_report_id': '{{--$daily_sales_report_id--}}'
           },
           dataType: "JSON",
           success: function(response) {
               if (response.status) {
                   $("#daily_sales_docs").DataTable().clear().destroy();
                   $('#daily_sales_docs_list').html('');
                   $('#daily_sales_docs_list').html(response.html);
                   $('#image_base64').val('');
               }
           },
           // error: function(err) {
           //     swal("Error occured !");
           // }
       });
   
   });
   
   //  For Edit Image //
   
   $(document).on('click', '.edit_doc', function() {
   
       let doc_image_id = $(this).attr('id');
   
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
   
       $.ajax({
           type: "POST",
           url: "{{--route('report.get_doc_upload')--}}",
           data: {
               id: doc_image_id,
           },
           dataType: "JSON",
           success: function(response) {
               let html = '';
   
               let $discount = '';
               let $complimentary = '';
               let $cash_deposit_in_bank = '';
               let $report_from_icg = '';
               let $cheque = '';
               let $printed_gift_cards = '';
               let $e_gift_card = '';
               let $gift_coupon_or_voucher = '';
   
               if (response.data.invoice_domain == 'discount') {
                   $discount = 'selected';
               } else if (response.data.invoice_domain == 'complimentary') {
                   $complimentary = 'selected';
               } else if (response.data.invoice_domain == 'cash_deposit_in_bank') {
                   $cash_deposit_in_bank = 'selected';
               } else if (response.data.invoice_domain == 'report_from_icg') {
                   $report_from_icg = 'selected';
               } else if (response.data.invoice_domain == 'cheque') {
                   $cheque = 'selected';
               } else if (response.data.invoice_domain == 'printed_gift_cards') {
                   $printed_gift_cards = 'selected';
               } else if (response.data.invoice_domain == 'e_gift_card') {
                   $e_gift_card = 'selected';
               } else if (response.data.invoice_domain == 'gift_coupon_or_voucher') {
                   $gift_coupon_or_voucher = 'selected';
               }
   
               if (response.status) {
                   html +=
                   '<label class="form-label" for="upload_daily_sales_edit">Invoice Domain </label>';
                   html +=
                   '<select name="update_daily_sales_invoice_domain" id="update_daily_sales_invoice_domain">';
                   html += '<option value="discount" ' + $discount + '> Discount </option>';
                   html += '<option value="complimentary" ' + $complimentary +
                   '> Complimentary </option>';
                   html += '<option value="cash_deposit_in_bank" ' + $cash_deposit_in_bank +
                   '> Cash Deposit In Bank </option>';
                   html += '<option value="report_from_icg" ' + $report_from_icg +
                   '> Report From ICG </option>';
                   html += '<option value="cheque" ' + $cheque +
                   '> Cheque </option>';
                   html += '<option value="printed_gift_cards" ' + $printed_gift_cards +
                   '> Printed Gift Card </option>';
                   html += '<option value="e_gift_card" ' + $e_gift_card +
                   '> E-Gift Card </option>';
                   html += '<option value="gift_coupon_or_voucher" ' + $gift_coupon_or_voucher +
                   '> Gift Coupon/Voucher </option>';
                   html += '</select>';
   
                   $('.invoice_select_edit').html(html);
   
                   $('.invoice_input_edit_doc_image').html(
                       '<input type="file" id="edit_uploadFile" name="edit_uploadFile"/> <input type="hidden" id="image_base64_edit" name="image_base64_edit" />'
                       );
                   $('.update_invoice_btn').html(
                       '<a class="btn btn-sm btn_clr edit_document_submit btn-success ml-0" href="javascript:;" id="edit_document_submit" data-id="' +
                       doc_image_id + '">Update</a>');
   
                   $('#update_invoice_modal').modal('show');
               }
           }
       });
   
   });
   
   
   
   $(document).on('change', '#edit_uploadFile', function(e) {
   
   const file = this.files[0];
   const fileType = file['type'];
   const file_size = file['size'];
   const validImageTypes = ['image/jpeg', 'image/png', 'application/pdf', 'text/plain',
   'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
   'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'
   ];
   
       // 'application/pdf'
   
   
       if (file_size > 5000000) {
           $('#image_base64_edit').val('');
           $('#edit_uploadFile').val('');
           swal("Document Size Should Be Upto 5MB");
       }
   
       if (!validImageTypes.includes(fileType)) {
           $('#image_base64_edit').val('');
           $('#edit_uploadFile').val('');
           swal("Document Type should be of format jpg,jpeg,png,pdf,text,docx,xlsx,csv");
       } else {
           let files = e.target.files;
           let f = files[0];
   
           var fileReader = new FileReader();
           fileReader.onload = (function(e) {
               var file = e.target;
               // console.log(e.target.result);
               $('#image_base64_edit').val(e.target.result);
           });
   
           fileReader.readAsDataURL(f);
   
       }
   
   });
   
   
   $(document).on('click', '#edit_document_submit', function() {
   
   if ($('#image_base64_edit').val() == '' || $('#image_base64_edit').val() == null) {
   swal("Doc Required");
   } else {
   
   let update_daily_sales_invoice_domain = $('#update_daily_sales_invoice_domain').val();
   let image_base64_edit = $('#image_base64_edit').val();
   let report_id = $('#daily_sales_report_id').val();
   let doc_image_id = $(this).data('id');
   
           // -------------------------------- //
   
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
   
           $.ajax({
               type: 'POST',
               url: "{{--route('report.doc_upload_edit')--}}",
               data: {
                   "update_daily_sales_invoice_domain": update_daily_sales_invoice_domain,
                   "image_base64_edit": image_base64_edit,
                   'daily_sales_report_id': report_id,
                   'doc_image_id': doc_image_id
               },
               dataType: "JSON",
               success: function(response) {
                   console.log(response.status);
                   if (response.status) {
                       $("#daily_sales_docs").DataTable().clear().destroy();
                       $('#daily_sales_docs_list').html('');
                       $('#daily_sales_docs_list').html(response.html);
                       $('#image_base64_edit').val('');
                       $('#edit_uploadFile').val('');
                       $('#update_invoice_modal').modal('hide');
                   }
               },
               // error: function(err) {
               //     swal("Error occured !");
               // }
           });
       }
   
   });
   
   //  ------------------ //
   
   $(document).on('click','.back_button',function(){
   
       var url = $(this).data('href');
   
       toastr.options = {
         timeOut: 0,
         extendedTimeOut: 0,
     };
   
     toastr.info("<br/><button class='btn toastr_btn' type='button' value='yes'>Yes</button><button class='btn toastr_btn' type='button' style='margin-left:10px;' value='no'>No</button>",'Are you sure you want to discard the changes?',
     {
       allowHtml: true,
       onclick: function (toast) {
           value = toast.target.value
           if (value == 'yes') {
               window.location = url;
           }else{
               toastr.remove();
           }
       }
   })
   })
</script>
<script>
   $('.dataTables_length, .dataTables_filter').wrapAll('<div class="header_wrapper"/>');
</script>
<script type="text/javascript">
   $(document).ready(function(){
   
   
   
       $('#order-online-users-list').DataTable( {
   
   
       });
   
   
       $('#invoice_document_upload').submit(function(e){
   
         if($('#uploadFileInput').val() == ''){
   
           swal({
             title: "DSR Document",
             text:"Document Image is required !",
             type: "warning",
         },
         function(){ 
   
         });
   
           return false; 
       }
   
   
       e.preventDefault();
   
       $.ajax({
         type: 'post',
         url: "{{route('report.doc_upload_save')}}",
         data: new FormData(this),
         contentType:false,
         processData:false,
         success: function(response) {
           if(response.trim() == 'success'){
   
   
              swal({
                 title: "DSR Document",
                 text:"Document Uploaded Successfully!",
                 type: "success",
             },
             function(){ 
              $('#invoice_document_upload')[0].reset();
              $('#thumbnail_preview').css('display', 'none');
              $('#thumbnail_preview_pdf').css('display', 'none');  
          });
   
              $.ajax({
                 url: "{{ route('report.doc_latest') }}",
                 method: 'post',
                 data: { 
                     id:"{{$daily_report_sales->id}}"
                 },
                 dataType: "JSON",
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 success: function (response) {
                     console.log('response');
                     console.log(response);
   
                     if(response.status) {
                       $('#order-online-users-list').DataTable().clear().destroy();
                       $('#orders_list').html(response.html);
   
                       $('#order-online-users-list').DataTable( {
   
   
                       }); 
   
                   }
               }
           });
   
          }
          else{
            alert('Something went to wrong');
        }
    }
   });
   
   });
   
   
   
   
   
   
   
   
   
       $('#invoice_document_edit').submit(function(e){
   
   
   
        e.preventDefault();
   
        $.ajax({
         type: 'post',
         url: "{{route('report.doc_upload_update')}}",
         data: new FormData(this),
         contentType:false,
         processData:false,
         success: function(response) {
           if(response.trim() == 'success'){
   
   
              swal({
                 title: "DSR Document",
                 text:"Document Updated Successfully!",
                 type: "success",
             },
             function(){ 
              $("#invoice_document_upload").removeClass('d-none');
              $("#invoice_document_edit").addClass('d-none');
          });
   
              $.ajax({
                 url: "{{ route('report.doc_latest') }}",
                 method: 'post',
                 data: {
                     id:"{{$daily_report_sales->id}}"
                 },
                 dataType: "JSON",
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 success: function (response) {
                     console.log('response');
                     console.log(response);
   
                     if(response.status) {
                       $('#order-online-users-list').DataTable().clear().destroy();
                       $('#orders_list').html(response.html);
   
                       $('#order-online-users-list').DataTable( {
   
                       }); 
   
                   }
               }
           });
   
          }
          else{
            alert('Something went to wrong');
        }
    }
   });
   
    });
   
   
   });
   
   
   
   $(document).on('click','.delete-button',function(e){  
   
      var id = $(this).attr('data-id');
   
      var obj = $(this);
   
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this document?",
        type: "warning",
        showCancelButton: true,
    }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            type: 'post',
            url: "{{route('report.delete_doc')}}",
            data: {
              id: id
          },
          dataType: "JSON",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                 $( "#flash-message-2" ).css("display","block");
                 $( "#flash-message-2" ).removeClass("d-none");
                 $( "#flash-message-2" ).addClass("alert-danger");
                 $('#flash-message-2').html('Document Deleted Successfully');
                 obj.parent().parent().remove();
                 setTimeout(() => {
                     $( "#flash-message-2" ).addClass("d-none");
   
                 }, 5000);
             }
             else {
                console.log("FALSE");
                setTimeout(() => {
                  swal('Error','Something went wrong','error');
                // alert("Something went wrong! Please try again.");
            }, 500);
            }
        }
    });
      } 
   });
   });
   
   
   
   
   
   
   
   
   
   
   $(document).on('click','.edit_btn_doc',function(e){  
      var id = $(this).attr('data-id');
      var invoic_domain = $(this).attr('invoic_domain');
   
      $("#invoice_document_upload").addClass('d-none');
   
      $("#invoice_document_edit").removeClass('d-none');
   
      $('#update_doc_select').val(invoic_domain);
      $('#invoice_id').val(id);
   
      $('#thumbnail_preview2').css('display', 'none');
      $('#thumbnail_preview_pdf2').css('display', 'none');
      $('#invoice_document_edit_container').removeClass('d-none');
    //  alert(id); 
   
    $.ajax({
       type:"post",
       url:"{{route('report.doc_upload_edit')}}",
       data:{
           "_token": "{{ csrf_token() }}",
           "id": id
       },
       dataType: "JSON",
       success:function(response){
                       // $('.placed_date').html(order_placed_date);
                       if(response.status) {
                         $('#invoice_document_edit_container').html(response.html);
                      // $('#myModal').modal({
                      //   'show':true,
                      //    backdrop: 'static',
                      //    keyboard: false
                      // });
   
                  }
              }
   
          });
   
   
    
   });
   
   
   
   
   $(document).ready(function(){
       $('#add_new_invoice').click(function(){
           $("#invoice_document_upload").removeClass('d-none');
           $("#invoice_document_edit").addClass('d-none');
       });
   });
   
   $(document).on('keypress', '#talabat_credit_modal,#deliveroo_credit_modal,#v_thru_credit_modal,#others_credit_modal', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
   
        var active_input = e.target;
   
        $(active_input).next().focus();
   
    }
   }); 
   
</script>
<script type="text/javascript">
   function readURL(input) {
   
       var uploaded_data = input.files[0];
   
       if(uploaded_data.type =='application/pdf'){
   
         var blobURL = URL.createObjectURL(uploaded_data);
         //alert(blobURL);
         $('#thumbnail_preview').css('display', 'none');
         $('#thumbnail_preview_pdf').css('display', 'block');
         $('#thumbnail_preview_pdf').attr('href',blobURL);
   
     }else{
   
         if (input.files && input.files[0]) {
   
           var reader = new FileReader();
   
           reader.onload = function (e) {
             $('#thumbnail_preview').css('display', 'block');
             $('#thumbnail_preview_pdf').css('display', 'none');
             $('#thumbnail_preview').attr('src', e.target.result);
         };
   
         reader.readAsDataURL(input.files[0]);
     }
   
   }
   }
</script>
<script type="text/javascript">
   function readURL2(input) {
   
      $('#invoice_document_edit_container').addClass('d-none');
   
      var uploaded_data = input.files[0];
   
      if(uploaded_data.type =='application/pdf'){
   
         var blobURL = URL.createObjectURL(uploaded_data);
         //alert(blobURL);
         $('#thumbnail_preview2').css('display', 'none');
         $('#thumbnail_preview_pdf2').css('display', 'block');
         $('#thumbnail_preview_pdf2').attr('href',blobURL);
   
     }else{
   
         if (input.files && input.files[0]) {
   
           var reader = new FileReader();
   
           reader.onload = function (e) {
             $('#thumbnail_preview2').css('display', 'block');
             $('#thumbnail_preview_pdf2').css('display', 'none');
             $('#thumbnail_preview2').attr('src', e.target.result);
         };
   
         reader.readAsDataURL(input.files[0]);
     }
   
   }
   }
</script>
@endsection
