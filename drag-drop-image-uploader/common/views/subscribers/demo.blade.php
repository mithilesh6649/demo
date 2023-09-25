<style type="text/css">
	 *{
    padding: 0;
    margin: 0;
    list-style: none;
    color: #000000; 
    outline-style: none;
    font-size: 16px;
    font-family: 'libre_baskervillebold';
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
    padding: 8px 20px;
    text-decoration: auto;
    font-size: 14px;
    top: 0;
    order: 2;
    border-radius: 5px;
    white-space: nowrap;
}
input.gross_sum {
    text-align: center !important;
    width: 155px !important;
    padding: 9px 2px;
    border: 1px solid #dfe1eb !important;
    background: #fff;
    border-radius: 5px;
}
thead.t_head th{
    font-size: 20px !important;
    padding-top: 20px !important;
    padding-bottom: 20px !important;
}
tbody.t_body{
    border-top: 0px solid transparent !important;
}
tbody.t_body .body_head{
    font-weight: 400;
    padding-top: 16px;
    padding-bottom: 16px;
    font-size: 14px;
    border-top: 0px solid transparent !important;
}
.manual_system {
    color: #f43127;
    font-weight: 400;
    font-size: 14px;
}
.amount-sale{
    font-size: 14px !important;
}
.Branch-statement .table td.disable_text{
    padding: 8px 10px !important;
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
td.sale_content_box p {
    margin-left: auto;
    padding: 5px 2px;
    text-align: right;
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


<?php
error_reporting(0);
?>

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
                                       <th colspan="3" class="text-center">MUGAL MAHAL</th>
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
                                         <!--  <input type="number" name="dine_in_restaurant_count"
                                             class="gross_sum" id="dine_in_restaurant_count"
                                             maxlength="100" aria-invalid="false"
                                             value="{{ $daily_report_sales->dine_in_restaurant_count }}"
                                             data-next="#dine_in_cabin_count"> -->
                                             <span> {{$daily_report_sales->dine_in_restaurant_count}} </span>
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
                                    <tr style="pointer-events: none;">
                                       <td>Complimentary</td>
                                       <td></td>
                                       <td><input type="number" name="complimentary"
                                          class="discount_sum gross_sum keyupevent " step="any"
                                          id="complimentary" maxlength="100" aria-invalid="false"
                                          value="{{ number_format($daily_report_sales->complimentary, 3, '.', '') }}"
                                          data-next="#sale_Return"></td>
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
                                             aria-hidden="true"></i>Remarks </a>
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
 
 hii
