@extends('adminlte::page')

@section('title', 'Super Admin | Daily Sales Report Details')

@section('content_header')

@section('content')

<div class="rightside_content">
    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table p-0 mb-0">

                        <div class="order_details">
                            <div class="order_heading d-flex align-items-center justify-content-between mb-4">
                                <h4>Daily Sales Report Details</h4>
                                
                                <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back</a>
                            </div>

                            <div class="Branch-statement">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-center">MUGAL MAHAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3" class="text-center">BRANCH-STATEMENT OF DALIY SALES &
                                                CASH IN
                                            HAND</th>
                                        </tr>
                                        <tr>
                                            <th>SL:<span class="manual_system"> System Generated</span></th>
                                            <th>Date:<span
                                                class="manual_system"> {{ date('d/m/Y', strtotime($daily_report_sales->updated_at)) }}</span>
                                            </th>
                                            <th>Branch: {{ optional($daily_report_sales->branch)->title_en ?? 'N/A' }}  
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>RV NO:<span
                                                class="manual_system"> <input type="text" value="{{ $daily_report_sales->rv_number }}" style="width:120px;margin-right:10px;" disabled ></span> <i class="text-warning fa fa-edit" style="font-size:20px;" title="Edit Rv No"></i>
                                                        <!-- <span
                                                            class="manual_system">{{ $daily_report_sales->rv_number }}</span> -->
                                                        </th>
                                                        <td></td>
                                                        <th class="text-center">Amounts</th>
                                                    </tr>
                                                    <tr>
                                                        <th>GROSS SALE</th>
                                                        <td></td>
                                                        <td>
                                                            <span class="show_gross_sale" id="show_gross_sale">KD
                                                                {{ $daily_report_sales->gross_sale }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dine-In Restaurent</td>
                                                            <td></td>
                                                            <td><input type="number" step="0.01" name="dine_in_restaurent"
                                                                class="gross_sum" placeholder="200.000" id="dine_in_restaurent"
                                                                maxlength="100" aria-invalid="false"
                                                                value="{{ $daily_report_sales->dine_in_restaurent }}" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Dine-In Cabin</td>
                                                                <td></td>
                                                                <td><input type="number" step="0.01" name="dine_in_cabin"
                                                                    class="gross_sum" placeholder="200.000" id="dine_in_cabin"
                                                                    maxlength="100" aria-invalid="false"
                                                                    value="{{ $daily_report_sales->dine_in_cabin }}" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Take Away/Self Pickup</td>
                                                                    <td></td>
                                                                    <td><input type="number" step="0.01" name="take_away_self_pickup"
                                                                        class="gross_sum" placeholder="200.000" id="take_away_self_pickup"
                                                                        maxlength="100" aria-invalid="false"
                                                                        value="{{ $daily_report_sales->take_away_self_pickup }}" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Home Delivery</td>
                                                                    <td></td>
                                                                    <td><input type="number" step="0.01" name="home_delivery"
                                                                        class="gross_sum" placeholder="200.000" id="home_delivery"
                                                                        maxlength="100" aria-invalid="false"
                                                                        value="{{ $daily_report_sales->home_delivery }}" readonly></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Buffet</td>
                                                                        <td></td>
                                                                        <td><input type="number" step="0.01" name="buffet" class="gross_sum"
                                                                            placeholder="200.000" id="buffet" maxlength="100"
                                                                            aria-invalid="false" value="{{ $daily_report_sales->buffet }}"
                                                                            readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Talabat(TEM)</td>
                                                                        <td></td>
                                                                        <td><input type="number" name="talabat_TEM" class="gross_sum"
                                                                            placeholder="200.000" id="talabat_TEM" maxlength="100"
                                                                            aria-invalid="false" value="{{ $daily_report_sales->talabat_TEM }}"
                                                                            readonly></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Talabat(TGO)</td>
                                                                            <td></td>
                                                                            <td><input type="number" step="0.01" name="talabat_TGO"
                                                                                class="gross_sum" placeholder="200.000" id="talabat_TGO"
                                                                                maxlength="100" aria-invalid="false"
                                                                                value="{{ $daily_report_sales->talabat_TGO }}" readonly></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Deliveroo(TEM)</td>
                                                                                <td></td>
                                                                                <td><input type="number" step="0.01" name="deliveroo_TEM"
                                                                                    class="gross_sum" placeholder="200.000" id="deliveroo_TEM"
                                                                                    maxlength="100" aria-invalid="false"
                                                                                    value="{{ $daily_report_sales->deliveroo_TEM }}" readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Deliveroo(TGO)</td>
                                                                                <td></td>
                                                                                <td><input type="number" step="0.01" name="deliveroo_TGO"
                                                                                    class="gross_sum" placeholder="200.000" id="deliveroo_TGO"
                                                                                    maxlength="100" aria-invalid="false"
                                                                                    value="{{ $daily_report_sales->deliveroo_TGO }}" readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>V-Thru</td>
                                                                                <td></td>
                                                                                <td><input type="number" step="0.01" name="v_thru"
                                                                                    class="gross_sum" placeholder="200.000" id="v_thru"
                                                                                    maxlength="100" aria-invalid="false"
                                                                                    value="{{ $daily_report_sales->v_thru }}" readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>MM Online</td>
                                                                                <td></td>
                                                                                <td><input type="number" step="0.01" name="mm_online"
                                                                                    class="gross_sum" placeholder="200.000" id="mm_online"
                                                                                    maxlength="100" aria-invalid="false"
                                                                                    value="{{ $daily_report_sales->mm_online }}" readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>OSC</td>
                                                                                <td></td>
                                                                                <td><input type="number" step="0.01" name="osc"
                                                                                    class="gross_sum" placeholder="200.000" id="osc"
                                                                                    maxlength="100" aria-invalid="false"
                                                                                    value="{{ $daily_report_sales->osc }}" readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Garden</td>
                                                                                <td></td>
                                                                                <td><input type="number" step="0.01" name="garden"
                                                                                    class="gross_sum" placeholder="200.000" id="garden"
                                                                                    maxlength="100" aria-invalid="false"
                                                                                    value="{{ $daily_report_sales->garden }}" readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Others</td>
                                                                                <td></td>
                                                                                <td><input type="number" step="0.01" name="others_gross"
                                                                                    class="gross_sum" placeholder="200.000" id="others_gross"
                                                                                    maxlength="100" aria-invalid="false"
                                                                                    value="{{ $daily_report_sales->others_gross }}" readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Discount & Return</th>
                                                                                <td></td>
                                                                                <td class="last_number">
                                                                                    <span class="show_discount_return" id="show_discount_return">KD
                                                                                        {{ $daily_report_sales->discount_return }}</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Discount</td>
                                                                                    <td></td>
                                                                                    <td><input type="number" step="0.01" name="discount"
                                                                                        class="discount_sum" placeholder="50.000" id="discount"
                                                                                        maxlength="100" aria-invalid="false"
                                                                                        value="{{ $daily_report_sales->discount }}" readonly>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Complimentary</td>
                                                                                    <td></td>
                                                                                    <td><input type="number" step="0.01" name="complimentary"
                                                                                        class="discount_sum" placeholder="50.000" id="complimentary"
                                                                                        maxlength="100" aria-invalid="false"
                                                                                        value="{{ $daily_report_sales->complimentary }}" readonly>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Sale & Return</td>
                                                                                    <td></td>
                                                                                    <td><input type="number" step="0.01" name="sale_Return"
                                                                                        class="discount_sum" placeholder="200.000" id="sale_Return"
                                                                                        maxlength="100" aria-invalid="false"
                                                                                        value="{{ $daily_report_sales->sale_Return }}" readonly>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="sale_content">
                                                                                    <th>NET SALE (After Discount & Return)</th>
                                                                                    <td></td>
                                                                                    <td>
                                                                                        <span class="show_net_sale" id="show_net_sale">KD
                                                                                            {{ $daily_report_sales->net_sale }}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3" class="text-center"></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Method Of Payment(cash/Cheque & Cash Equivalent)</th>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Cash In Hand-schedule</th>
                                                                                        <td></td>
                                                                                        <td class="sale_content_box last_number">
                                                                                            <span class="show_cash_in_hand" id="show_cash_in_hand">KD
                                                                                                {{ $daily_report_sales->cash_in_hand }}</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Cash In Hand-Actual</td>
                                                                                            <td></td>
                                                                                            <td class="last_number"><input type="number" step="0.01"
                                                                                                name="cash_in_hand_actual" class="cash_in_hand_sum"
                                                                                                placeholder="1700.000" id="cash_in_hand_actual" maxlength="100"
                                                                                                aria-invalid="false"
                                                                                                value="{{ $daily_report_sales->cash_in_hand_actual }}" readonly>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Cash-Shortage</td>
                                                                                            <td></td>
                                                                                            <td class="last_number"><input type="number" step="0.01"
                                                                                                name="cash_shortage" class="cash_in_hand_sum"
                                                                                                placeholder="60.000" id="cash_shortage" maxlength="100"
                                                                                                aria-invalid="false"
                                                                                                value="{{ $daily_report_sales->cash_shortage }}" readonly>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Cash-Overage</td>
                                                                                            <td></td>
                                                                                            <td class="main_numbers"><input type="number" step="0.01"
                                                                                                name="cash_overage" class="cash_in_hand_sum text-danger" placeholder="60.000"
                                                                                                id="cash_overage" maxlength="100" aria-invalid="false"
                                                                                                value="{{ $daily_report_sales->cash_overage }}" readonly>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Card Sale</th>
                                                                                            <td></td>
                                                                                            <td class="sale_content_box">
                                                                                                <span class="show_cards_sale" id="show_cards_sale">KD
                                                                                                    {{ $daily_report_sales->cards_sale }}</span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Amex</td>
                                                                                                <td></td>
                                                                                                <td class="last_number"><input type="number" step="0.01"
                                                                                                    name="amex" class="sum_card_sale" placeholder="20.000"
                                                                                                    id="amex" maxlength="100" aria-invalid="false"
                                                                                                    value="{{ $daily_report_sales->amex }}" readonly>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Visa</td>
                                                                                                <td></td>
                                                                                                <td class="last_number"><input type="number" step="0.01"
                                                                                                    name="visa" class="sum_card_sale" placeholder="50.000"
                                                                                                    id="visa" maxlength="100" aria-invalid="false"
                                                                                                    value="{{ $daily_report_sales->visa }}" readonly>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Master</td>
                                                                                                <td></td>
                                                                                                <td class="last_number"><input type="number" step="0.01"
                                                                                                    name="master" class="sum_card_sale" placeholder="50.000"
                                                                                                    id="master" maxlength="100" aria-invalid="false"
                                                                                                    value="{{ $daily_report_sales->master }}" readonly>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Dinner</td>
                                                                                                <td></td>
                                                                                                <td class="last_number"><input type="number" step="0.01"
                                                                                                    name="dinner" class="sum_card_sale" placeholder="50.000"
                                                                                                    id="dinner" maxlength="100" aria-invalid="false"
                                                                                                    value="{{ $daily_report_sales->dinner }}" readonly>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>MM Online Link</td>
                                                                                                <td></td>
                                                                                                <td class="last_number"><input type="number" step="0.01"
                                                                                                    name="mm_online_link" class="sum_card_sale" placeholder="60.000"
                                                                                                    id="mm_online_link" maxlength="100" aria-invalid="false"
                                                                                                    value="{{ $daily_report_sales->mm_online_link }}" readonly>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Knet</td>
                                                                                                <td></td>
                                                                                                <td class="last_number"><input type="number" step="0.01"
                                                                                                    name="knet" class="sum_card_sale" placeholder="500.000"
                                                                                                    id="knet" maxlength="100" aria-invalid="false"
                                                                                                    value="{{ $daily_report_sales->knet }}" readonly>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Other Cards</td>
                                                                                                <td></td>
                                                                                                <td class="last_number"><input type="number" step="0.01"
                                                                                                    name="other_cards" class="sum_card_sale" placeholder="20.000"
                                                                                                    id="other_cards" maxlength="100" aria-invalid="false"
                                                                                                    value="{{ $daily_report_sales->other_cards }}" readonly>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Cheque/Cash Equivalent</th>
                                                                                                <td></td>
                                                                                                <td class="sale_content_box">
                                                                                                    <span class="show_cheque_cash" id="show_cheque_cash">KD
                                                                                                        {{ $daily_report_sales->cheque_cash }}</span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Cheque</td>
                                                                                                    <td></td>
                                                                                                    <td class="last_number"><input type="number" step="0.01"
                                                                                                        name="cheque" class="sum_cheque" placeholder="20.000"
                                                                                                        id="cheque" maxlength="100" aria-invalid="false"
                                                                                                        value="{{ $daily_report_sales->cheque }}" readonly>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Printed Gift Card</td>
                                                                                                    <td></td>
                                                                                                    <td class="last_number"><input type="number" step="0.01"
                                                                                                        name="printed_gift_card" class="sum_cheque" placeholder="20.000"
                                                                                                        id="printed_gift_card" maxlength="100" aria-invalid="false"
                                                                                                        value="{{ $daily_report_sales->printed_gift_card }}" readonly>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>E-Gift Card</td>
                                                                                                    <td></td>
                                                                                                    <td class="last_number"><input type="number" step="0.01"
                                                                                                        name="e_gift_card" class="sum_cheque" placeholder="20.000"
                                                                                                        id="e_gift_card" maxlength="100" aria-invalid="false"
                                                                                                        value="{{ $daily_report_sales->e_gift_card }}" readonly>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Gift Coupon/Voucher</td>
                                                                                                    <td></td>
                                                                                                    <td class="last_number"><input type="number" step="0.01"
                                                                                                        name="gift_coupon_voucher" class="sum_cheque"
                                                                                                        placeholder="20.000" id="gift_coupon_voucher" maxlength="100"
                                                                                                        aria-invalid="false"
                                                                                                        value="{{ $daily_report_sales->gift_coupon_voucher }}" readonly>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Cash Equivalent(others)</td>
                                                                                                    <td></td>
                                                                                                    <td class="last_number"><input type="number" step="0.01"
                                                                                                        name="cash_equivalent" class="sum_cheque" placeholder="20.000"
                                                                                                        id="cash_equivalent" maxlength="100" aria-invalid="false"
                                                                                                        value="{{ $daily_report_sales->cash_equivalent }}" readonly>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Credit Sale</th>
                                                                                                    <td></td>
                                                                                                    <td class="sale_content_box">
                                                                                                        <span class="show_credit_sale" id="show_credit_sale">KD
                                                                                                            {{ $daily_report_sales->credit_sale }}</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Talabat Credit</td>
                                                                                                        <td></td>
                                                                                                        <td class="last_number"><input type="number" step="0.01"
                                                                                                            name="talabat_credit" class="credit_sum" placeholder="50.000"
                                                                                                            id="talabat_credit" maxlength="100" aria-invalid="false"
                                                                                                            value="{{ $daily_report_sales->talabat_credit }}" readonly>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Deliveroo Credit</td>
                                                                                                        <td></td>
                                                                                                        <td class="last_number"><input type="number" step="0.01"
                                                                                                            name="deliveroo_credit" class="credit_sum" placeholder="50.000"
                                                                                                            id="deliveroo_credit" maxlength="100" aria-invalid="false"
                                                                                                            value="{{ $daily_report_sales->deliveroo_credit }}" readonly>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>V Thru Credit</td>
                                                                                                        <td></td>
                                                                                                        <td class="last_number"><input type="number" step="0.01"
                                                                                                            name="v_thru_credit" class="credit_sum" placeholder="50.000"
                                                                                                            id="v_thru_credit" maxlength="100" aria-invalid="false"
                                                                                                            value="{{ $daily_report_sales->v_thru_credit }}" readonly>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Others</td>
                                                                                                        <td></td>
                                                                                                        <td class="last_number"><input type="number" step="0.01"
                                                                                                            name="others_credit" class="credit_sum" placeholder="50.000"
                                                                                                            id="others_credit" maxlength="100" aria-invalid="false"
                                                                                                            value="{{ $daily_report_sales->others_credit }}" readonly>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr class="sale_content">
                                                                                                        <th>Total Collection</th>
                                                                                                        <td></td>
                                                                                                        <td class="last_number">
                                                                                                            <span class="show_total_collection" id="show_total_collection">KD
                                                                                                                {{ $daily_report_sales->total_collection }}</span>
                                                                                                            </td>
                                                                                                        </tr>

                                                                                                        <tr>
                                                                                                            <th colspan="3" class="text-center"></th>
                                                                                                        </tr>
                                                                                                        <tr class="table_second_heading">
                                                                                                            <td></td>
                                                                                                            <th>Cash in Hand Opening Balance = </th>
                                                                                                            <td><input type="number" step="0.01"
                                                                                                                name="cash_in_hand_opening_balance" class="total_cash_handel"
                                                                                                                placeholder="10000" id="cash_in_hand_opening_balance"
                                                                                                                maxlength="100" aria-invalid="false"
                                                                                                                value="{{ $daily_report_sales->cash_in_hand_opening_balance }}"
                                                                                                                readonly></td>
                                                                                                            </tr>
                                                                                                            <tr class="table_second_heading">
                                                                                                                <td></td>
                                                                                                                <th>(+)Cash Sales</th>
                                                                                                                <td><input type="number" step="0.01" name="cash_sales"
                                                                                                                    class="total_cash_handel" placeholder="1760" id="cash_sales"
                                                                                                                    maxlength="100" aria-invalid="false"
                                                                                                                    value="{{ $daily_report_sales->cash_sales }}" readonly></td>
                                                                                                                </tr>
                                                                                                                <tr class="table_second_heading">
                                                                                                                    <td></td>
                                                                                                                    <th>(-)Cash Deposit In Bank</th>
                                                                                                                    <td><input type="number" step="0.01" name="cash_deposit_in_bank"
                                                                                                                        class="total_cash_handel" placeholder="800"
                                                                                                                        id="cash_deposit_in_bank" maxlength="100" aria-invalid="false"
                                                                                                                        value="{{ $daily_report_sales->cash_deposit_in_bank }}" readonly>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr class="table_second_heading sale_content">
                                                                                                                    <td></td>
                                                                                                                    <th>Cash in Hand Closing Balance =</th>
                                                                                                                    <td>
                                                                                                                        <span class="show_cash_in_hand_closing_balance"
                                                                                                                        id="show_cash_in_hand_closing_balance">KD
                                                                                                                        {{ $daily_report_sales->cash_in_hand_closing_balance }}</span>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                
                                                                                                            </tbody>
                                                                                                            <tfoot>
                                                                                                                
                                                                                                            </tfoot>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endsection

                                                                        @push('styles')
                                                                        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/branch_style.css') }}">
                                                                        @endpush
