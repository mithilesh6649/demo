<style type="text/css">
    *{
    padding: 0;
    margin: 0;
    list-style: none;
    color: #000000; 
    outline-style: none;
    font-size: 14px;
    font-family: 'libre_baskervillebold';
}
.Branch-statement .table td, .table th {
    vertical-align: top;
    border: 1px solid #dee2e6;
}
.Branch-statement {
    width: 100%;
    background-color: #f6f7fb;
}
.Branch-statement table {
    background-color: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 0px;
    text-align: center;
    width: 100%;
}
.Branch-statement .table td {
    padding: 6px 6px !important;
}
.Branch-statement .table td {
    font-size: 14px;
    vertical-align: middle;
    color: #212529;
    text-align: right;
}
.Branch-statement .table th {
    font-size: 14px;
    font-weight: 600;
    padding: 6px 6px;
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
.sale_content_box input::placeholder {
    font-weight: bold;
}
.sale_content_box{
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
tbody.t_body .body_head {
    font-weight: 400;
    padding-top: 12px;
    padding-bottom: 12px;
    font-size: 14px;
    border-top: 0px solid transparent !important;
    text-align: center;
}
.manual_system {
    color: #f43127;
    font-weight: 400;
    font-size: 14px;
}
.amount-sale, .manual_system span {
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
    padding: 0px 2px;
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
.card-header center h3 {
    padding: 15px;
}
.Branch-statement .table td p.orders_count {
    font-size: 14px;
}
.Branch-statement .table td span {
    font-size: 14px;
}
.form-group.mb-0 label {
    font-size: 14px;
    font-weight: 600;
    color: #000;
    text-align: left;
    vertical-align: inherit;
}
.card-main {
    padding: 0px 15px 15px;
    background-color: #dee2e63b;
}
.form-group.mb-0 {
    padding-top: 10px;
}
.wrapper canvas {
    background-color: #ffffff;
    width: 100%;
    height: 200px;
}
.wrapper {
    margin-top: 10px;
    width: 100%;
    display: block;
    background-color: #ffffff;
}
</style>


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
               <div class="top_bar-wrapper" style="width:100%">
               <img src="https://server3.rvtechnologies.in/MMMission22/Branch/public/images/report_logo.png" alt="" style="width:100%">
               </div>
                           <center>
                           <h3 class="mb-0">Daily Sales Reports Details</h3>
                           </center>
                        </div>
                        <div class="Branch-statement branch_wrapper">
                           <form id="addReportForm" method="post"
                               >
                              @csrf
                              <input type="hidden" id="daily_sales_report_id"
                                 value="{{ $daily_report_sales->id }}">
                              <table class="table border Responsive-table m-0">
                                  
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
                                          {{$daily_report_sales->branch->title_en}} 
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
                                          <p class="orders_count">No. of orders: {{$daily_report_sales->dine_in_restaurant_count}} </p>
                                              
                                       </td>
                                       <td>
                                               <span> {{ number_format($daily_report_sales->dine_in_restaurent, 3, '.', '') }} </span>
                                       </td>
                                    </tr>

                                    

                                    <tr style="pointer-events: none;">
                                       <td>Dine-In Cabin</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->dine_in_cabin_count ?? '0' }}</p>
                                         
                                        
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->dine_in_cabin, 3, '.', '') }}</span>
                                           
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Take Away/Self Pickup</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->self_pickup_count ?? '0' }}</p>
                                           
                                           
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->take_away_self_pickup, 3, '.', '') }}</span> 
                                          
                                       </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Home Delivery</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->home_delivery_count ?? '0' }} </p>
                                         
                                          
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->home_delivery, 3, '.', '') }}</span>
                                          
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Buffet</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->buffet_count ?? '0' }}</p>
                                                                                   
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->buffet, 3, '.', '') }}</span>
                                    
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Talabat(TMP)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->talabat_TEM_count ?? '0' }}</p>
                                          
                                         
                                       </td>
                                       <td>
                                           <span>{{ number_format($daily_report_sales->talabat_TEM, 3, '.', '') }}</span>
                                   </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Talabat(TGO)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->talabat_TGO_count ?? '0' }} </p>
                                           
                                      
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->talabat_TGO, 3, '.', '') }}</span>
                                           </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>MM Express(TGO)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->MM_Express_TGO_count ?? '0' }}</p>
                                           
                                          
                                       </td>
                                       <td>
                                            <span>{{ number_format($daily_report_sales->MM_Express_TGO, 3, '.', '') }}</span>
                                         </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Deliveroo(TMP)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->deliveroo_TEM_count ?? '0' }}</p>
                                         
                                          
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->deliveroo_TEM, 3, '.', '') }}</span>
                                    </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Deliveroo(TGO)</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->deliveroo_TGO_count ?? '0' }} </p>
                                       
                                      
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->deliveroo_TGO, 3, '.', '') }}</span>
                                         </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>V-Thru</td>
                                       <td  class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->v_thru_count ?? '0' }}</p>
                                       
                                           
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->v_thru, 3, '.', '') }}</span>
                                       </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>MM Online</td>
                                       <td  class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->mm_online_count ?? '0' }}</p>
                                        
                                         
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->mm_online, 3, '.', '') }}</span>
                                           </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>OSC</td>
                                       <td  class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->osc_count ?? '0' }}</p>
                                           
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->osc, 3, '.', '') }}</span>
                                          </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Garden</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->garden_count ?? '0' }}</p>
                                           
                                        
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->garden, 3, '.', '') }}</span>
                                          </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Others</td>
                                       <td class="orders_count_wrap">
                                          <p class="orders_count">No. of orders: {{ $daily_report_sales->others_gross_count ?? '0' }}</p>
                                          
                                       
                                       </td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->others_gross, 3, '.', '') }}</span>
                                       </td>
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
                                       <td>
                                          <span>{{ number_format($daily_report_sales->discount, 3, '.', '') }}</span>
                                         </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Complimentary</td>
                                       <td></td>
                                       <td>
                                           <span>{{ number_format($daily_report_sales->complimentary, 3, '.', '') }}</span>
                                          </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Sale & Return</td>
                                       <td></td>
                                       <td>
                                           <span>{{ number_format($daily_report_sales->sale_Return, 3, '.', '') }}</span>
                                          </td>
                                    </tr>
                                    <tr class="sale_content">
                                       <th>NET SALE (After Discount & Return)</th>
                                       <td></td>
                                       <td class="sale_content_box">
                                          <p class="show_net_sale amount-sale gross_sum"
                                             id="show_net_sale">KD
                                             {{ number_format($daily_report_sales->net_sale, 3, '.', '') }}
                                          </p>
                                        
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
                                          
                                       </td>
                                    </tr>
                                    <tr style="pointer-events: none;">
                                       <td>Cash In Hand-Actual</td>
                                       <td></td>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->cash_in_hand_actual, 3, '.', '') }}</span>
                                          
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="disable_text">Cash-Shortage</td>
                                       <td></td>
                                       <td class="last_numbers">
                                          <p class="cash_shortage para-table" id="cash_shortage">
                                             {{ number_format($daily_report_sales->cash_shortage, 3, '.', '') }}
                                          </p>
                                        
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="disable_text">Cash-Overage</td>
                                       <td></td>
                                       <td class="main_numbers">
                                          <p class="cash_overage para-table" id="cash_overage">
                                             {{ number_format($daily_report_sales->cash_overage, 3, '.', '') }}
                                          </p>
                                          
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
                                       <td>Amex 
                                          
                                       </td>
                                       <td>
                                          <p class="total_entries_amex amount-sale field_add_text"
                                             id="total_entries_amex">      {{ count($amex) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="amex_card_show amount-sale" id="amex_card_show">
                                             {{ number_format(@$sum_amex, 3, '.', '') }}
                                          </p>
                                          
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           Visa 
                                          
                                       </td>
                                       <td>
                                          <p class="total_entries_visa amount-sale field_add_text"
                                             id="total_entries_visa">    {{ count(@$visa) }} Slip(s)</p>
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="visa_card_show amount-sale" id="visa_card_show">
                                             {{ number_format(@$sum_visa, 3, '.', '') }}
                                          </p>
                                          
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           Master 
                                       
                                       </td>
                                       <td>
                                          <p class="total_entries_master amount-sale field_add_text"
                                             id="total_entries_master">   {{ count(@$master) }} Slip(s)
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="master_card_show amount-sale" id="master_card_show">
                                             {{ number_format(@$sum_master, 3, '.', '') }} 
                                          </p>
                                         
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           Diner 
                                        
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
                                           
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           MM
                                          Online Link 
                                          
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
                                          
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> Knet 
                                          
                                       </td>
                                       <td>
                                          <p class="total_entries_knet amount-sale field_add_text"
                                             id="total_entries_knet">   {{ count($knet) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="knet_card_show amount-sale" id="knet_card_show">
                                             {{ number_format(@$sum_knet, 3, '.', '') }}
                                          </p>
                                         
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                           Other Cards 
                                         
                                       </td>
                                       <td>
                                          <p class="total_entries_other_cards amount-sale field_add_text"
                                             id="total_entries_other_cards">   {{ count($other_cards) }}
                                             Slip(s)
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="other_card_show amount-sale" id="other_card_show">
                                             {{ number_format(@$sum_other_cards, 3, '.', '') }}
                                          </p>
                                          
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
                                           
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <p class="printed_gift" >Printed Gift Card</p>
                                           
                                       </td>
                                       <td>
                                          <p class="total_entries_printed_gift_card amount-sale field_add_text"
                                             id="total_entries_printed_gift_card">  {{ $daily_report_sales->printed_count }}
                                             Printed Gift Card 
                                          </p>
                                          <input type="hidden" name="printed_count" step="any" aria-invalid="false" id="printed_count" value="{{ $daily_report_sales->printed_count }}">
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="printed_gift_card_show amount-sale" id="printed_gift_card_show">{{ number_format(@$printed_gift_card_total, 3, '.', '') }}
                                          </p>
                                          
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>  Cheque 
                                          <input type="hidden" name="cheque"
                                             class="cheque_inserted_values" step="any" id="cheque_inserted_values" value="">
                                       </td>
                                       <td>
                                          <p class="total_entries_cheque amount-sale field_add_text"
                                             id="total_entries_cheque">  {{ count(@$cheque) }}
                                             Slip(s)
                                          </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="cheque_card_show amount-sale" id="cheque_card_show">
                                             {{ number_format(@$cheque_total, 3, '.', '') }}
                                          </p>
                                        
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>  E-Gift Card 
                                          
                                       </td>
                                       <td>
                                          <p class="total_entries_E_gift_card amount-sale field_add_text"
                                             id="total_entries_E_gift_card">   {{ count(@$e_gift_card) }} Slip(s) </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="E_gift_card_show amount-sale" id="E_gift_card_show">
                                             {{ number_format(@$e_gift_card_total, 3, '.', '') }}
                                          </p>
                                     
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>  Coupon/Voucher 
                                          
                                       </td>
                                       <td>
                                          <p class="total_entries_Coupon_gift_card amount-sale field_add_text"
                                             id="total_entries_Coupon_gift_card">     {{ count(@$gift_coupon_voucher) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="Coupon_gift_card_show amount-sale" id="Coupon_gift_card_show">{{ number_format(@$gift_coupon_voucher_total, 3, '.', '') }}
                                          </p>
                                           
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>  Cash Equivalent(others) 
                                          
                                       </td>
                                       <td>
                                          <p class="total_entries_cash_card amount-sale field_add_text"
                                             id="total_entries_cash_card">     {{ count(@$cash_equivalent_c) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="cash_card_show amount-sale" id="cash_card_show">
                                             {{ number_format(@$cash_equivalent_c_total, 3, '.', '') }}
                                          </p>
                                           
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
                                         
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> 
                                           Talabat Credit 
                                          
                                       </td>
                                       <td>
                                          <p class="total_entries_talabat_credit amount-sale field_add_text d-none" 
                                             id="total_entries_talabat_credit"> 

                                             
                                               {{ count(@$talabat_credit_TMP)+count(@$talabat_credit_TGO) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="talabat_credit_show amount-sale" id="talabat_credit_show"> {{ number_format(@$talabat_credit_TMP_total+@$talabat_credit_TGO_total, 3, '.', '') }}
                                          </p>
                                          
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> 
                                           Deliveroo Credit 
                                       
                                       </td>
                                       <td>
                                          <p class="total_entries_deliveroo_credit amount-sale field_add_text d-none"
                                             id="total_entries_deliveroo_credit"> 
                                            
                                               {{ count(@$deliveroo_credit_TMP)+count(@$deliveroo_credit_TGO) }} Slip(s) </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="deliveroo_credit_show amount-sale" id="deliveroo_credit_show">{{ number_format(@$deliveroo_credit_TMP_total+@$deliveroo_credit_TGO_total, 3, '.', '') }}
                                          </p>
 
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> 
                                           V Thru Credit 
                                       
                                       </td>
                                       <td>
                                          <p class="total_entries_v_thru_credit amount-sale field_add_text d-none"
                                             id="total_entries_v_thru_credit"> <div>  

                                                {{ count(@$v_thru_credit_TMP)+count(@$v_thru_credit_TGO) }} Slip(s)</p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="v_thru_credit_show amount-sale" id="v_thru_credit_show">{{ number_format(@$v_thru_credit_TMP_total+@$v_thru_credit_TGO_total, 3, '.', '') }}
                                          </p>
                                        
                                       </td>
                                    </tr>
                                    <tr>
                                       <td> 
                                           Others 
                                      
                                       </td>
                                       <td>
                                          <p class="total_entries_others_credit amount-sale field_add_text d-none"
                                             id="total_entries_others_credit"> 
                                             

                                               {{ count(@$others_credit_TMP)+count(@$others_credit_TGO) }} Slip(s) </p>
                                       </td>
                                       <td class="last_number sale_content_box">
                                          <p class="others_credit_show amount-sale" id="others_credit_show">{{ number_format(@$others_credit_TMP_total+@$others_credit_TMP_total, 3, '.', '') }}
                                          </p>
                                         
                                       </td>
                                    </tr>
                                    <tr class="sale_content">
                                       <th>Total Collection</th>
                                       <td></td>
                                       <td class="last_number sale_content_box">
                                         
                                       </td>
                                    </tr>
                                    <tr class="table_second_heading">
                                       <td >
                                           Remarks 
                                          <div> @foreach($remarks_list  as $datas ) <span style="border:1px solid #ddd;"> {{$datas}} </span>  @endforeach </div>
                                       </td>
                                       <th>Cash in Hand Opening Balance = </th>
                                       <td class="sale_content_box">
                                          <p id="cash_in_hand_tag" class="cash_in_hand_tag amount-sale">
                                             {{ @$daily_report_sales->cash_in_hand_opening_balance == null ? 'KD ' .'0.000': number_format(@$daily_report_sales->cash_in_hand_opening_balance, 3, '.', '') }}
                                          </p>
                                        
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
                                        
                                       </td>
                                    </tr>
                                    <tr class="table_second_heading" style="pointer-events: none;">
                                       <td></td>
                                       <th>(-)Cash Deposit In Bank</th>
                                       <td>
                                          <span>{{ number_format($daily_report_sales->cash_deposit_in_bank, 3, '.', '') }}</span>
                                         
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
                                        
                                       </td>
                                    </tr>
                                   
                                 </tbody>
                                 <tfoot>
                                    
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

 @dd('dfdsfsd');