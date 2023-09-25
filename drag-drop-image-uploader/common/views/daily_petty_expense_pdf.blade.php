<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    <title>PV Voucher</title>
</head>
<style>
    body {
        margin: 0;
        font-family: DejaVu Sans , sans-serif;
    }

    .bottom_note {
        margin: 30px 0 0;
        text-align: center;
    }

    .top_bar-wrapper img {
        width: 100%;
    }

    .bottom_note label {
        font-size: 18px;
    }


</style>

<body lang="ar" style="border: 1px solid #000000;margin: 0px 10px;">

        <div class="top_bar-wrapper" style="width:100%">
        <img src="https://server3.rvtechnologies.in/MMMission22/Branch/public/images/report_logo.png" alt="" style="width:100%">
        </div>
        <hr>
         <div style="width: 100%;height:60px;">
             
         </div>
      <img style="width:100%" src="{{$imageUrl}}">
  
       <div style="width: 100%;height:100px;">
             
       </div>

@forelse($daily_petty_expense_reports as $daily_petty_expense_report)
{{--\App\Models\DailyPettyExpense::NORMAL--}} 
@if($daily_petty_expense_report->report_type == \App\Models\DailyPettyExpense::VOUCHER)
{{--$daily_petty_expense_report--}}
<div class="top_bar-wrapper" style="padding-bottom: 10px; margin-top: 10px;margin-left: 10px; margin-right: 10px;">
    <img src="https://server3.rvtechnologies.in/MMMission22/Branch/public/images/top_bar-1.png" alt="">
</div> 

<?php

$doc_ref_no = '';

if(isset($daily_petty_expense_report->doc_ref_no)){
    $ref = explode('-', @$daily_petty_expense_report->doc_ref_no);
    
    $ref_1 = explode('/',$ref[0]);
    
    $ref_2 = explode('/',$ref[1]);



    if($ref_1[0] == 'ME'){
        $doc_ref_no = $ref[0].'-'.$ref_2[0];
    }

}


?>


<table cellpadding="0" cellspacing="0" style="width: 90%;
margin: 0 auto 30px;">
<tbody>
    <tr>
        <th>
            <p
            style="
            color: #000000;
            font-size: 20px;
            margin-bottom: 0;
            margin-top: 0;text-align: left;">
            Invoice Number : <span
            style="color: #F43127;font-size: 13px;">{{ $doc_ref_no != '' ? $doc_ref_no : @$daily_petty_expense_report->voucher_number }}</span></p>
        </th>
    </tr>
    <tr>
        <th>
            <p
            style="
            color: #000000;
            font-size: 19px;
            margin-bottom: 15px;
            margin-top: -43px;text-align: right;">
            Branch: <input type="text" value="{{ @$daily_petty_expense_report['branch']['title_en'] }}"
            style="outline: none;border: none;border-bottom: 1px dotted #000000;width: 22.555%;border-radius: 2px;text-align:left;white-space:nowrap;margin-bottom:-5px;">
        </p>
        <p
        style="
        color: #000000;
        font-size: 19px;
        margin-bottom: 0;
        margin-top: 0;text-align: right;">
        Date: <input type="text" value="{{ date('d/m/Y', strtotime(@$daily_petty_expense_report['report_date'])) }}"
        style=" border: none; border-bottom: 1px dotted #000000;outline: none;width: 24.222%;text-align:left;margin-bottom:-5px;">
    </p>
</th>
</tr>
</tbody>
</table>

<table cellpadding="0" cellspacing="0"
style="width: 95%;
border-top: 1px solid #000;
border-bottom: 1px solid #000;
margin: 0 auto;">
<tr>
    <th rowspan="2"
    style="text-align: left;
    font-size: 18px;
    display: flex;align-items: center;padding: 10px;border-bottom:1px solid #000;">
    <span>Description</span><span style="float:right; margin-top: 26px;"></span>
</th>
<th colspan="2"
style="padding: 10px;
border-left: 1px solid #000;
font-style: italic;
font-size: 18px;border-bottom:1px solid #000;">
Amount (KD)</th>
</tr>

@php
$total_amount = 0.0;
@endphp



<tr>
    <td style="padding: 12px;
    text-align: left;
    border-bottom: 1px dotted #000;"><span style="font-weight:600;">{{ @$daily_petty_expense_report['expense_desc'] }}</span></td>
    <td colspan="2"
    style="padding: 12px;
    text-align: center;
    border-bottom: 1px dotted #000;border-left: 1px solid #000;"><span  >{{number_format(@$daily_petty_expense_report['amount'],3,'.','')}}</span></td>
</tr>

@if (@$daily_petty_expense_report['person'])    
<tr>
    <td style="padding: 12px;
    border-bottom: 1px dotted #000;"><span style="font-weight:600;">Being Paid to </span> <span> {{ @$daily_petty_expense_report['person'] }}</span></td>
    <td colspan="2"
    style="padding: 12px;
    text-align: center;
    border-bottom: 1px dotted #000;border-left: 1px solid #000;"><span style="opacity: 0;"></span></td>
</tr>
@endif
@if (@$daily_petty_expense_report['description'])    
<tr>
    <td style="padding: 12px;
    border-bottom: 1px dotted #000;"><span style="font-weight:600;">For </span> <span> {{ @$daily_petty_expense_report['description'] }}</span></td>
    <td colspan="2"
    style="padding: 12px;
    text-align: center;
    border-bottom: 1px dotted #000;border-left: 1px solid #000;"><span style="opacity: 0;"></span></td>
</tr>
@endif

@php
$total_amount = $total_amount + number_format(@$daily_petty_expense_report['amount'],3,'.','');
@endphp


<tr style="font-weight:600">
    <td style="padding: 12px;
    text-align: left;"><span>Total</span><span style="float:right;"></span></td>
    <td colspan="2" style="padding: 12px;
    border-left: 1px solid #000;text-align:center">{{number_format(@$total_amount,3,'.','')}}</td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" style="width: 90%; margin: 80px auto 60px;">
    <tbody>
        <tr>
            <td>
                <p style="
                color: #000000;
                font-size: 20px;
                margin-bottom: 0;
                margin-top: -45px;text-align: left;">
                <label style="display: block; margin-bottom: 5px;font-weight: 400;">Receiver's </label>
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="
            color: #000000;
            font-size: 20px;
            margin-bottom: 0px;
            margin-top: -45px;text-align: center;">
            <label style="display: block; margin-bottom: 5px;font-weight: 400;">Verified by </label>
        </p>
    </td>
</tr>
<tr>
    <td>
        <p style="
        color: #000000;
        font-size: 20px;
        margin-bottom: 0;
        margin-top: -45px;text-align: right;">
        <label style="display: block;margin-bottom: 5px;font-weight: 400;">Approved by </label>
    </p>
</td>
</tr>
</tbody>
</table>
<table cellpadding="0" cellspacing="0" style="width: 90%; margin: 40px auto;">
    <tbody>
        <tr>
            <td>
                <p style="
                margin-bottom: 0;
                margin-top: -40px;text-align: left;margin-left: -15px;">
                <img src="{{$daily_petty_expense_report['receiver_signature']}}" alt="" style="width:160px;">
            </p>
        </td>
    </tr>
    <tr>


        <td>
            <p style="
            margin-bottom: 0px;
            margin-top: -40px;text-align: center;margin-left: 80px;">
            <img src="{{$daily_petty_expense_report['verified_by']}}" alt="" style="width:160px;">
        </td>
    </tr>
    <tr>
        <td>
            <p style="
            margin-bottom: 0;
            margin-top: -40px;text-align: right;margin-right: -35px;">
            <img src="{{$daily_petty_expense_report['approved_by']}}" alt="" style="width:160px;">
        </p>
    </td>
</tr>
</tbody>
</table>  


@endif
@empty
<p>No Data Found</p>
@endforelse 





  
    

 


@forelse($daily_petty_expense_reports as $daily_petty_expense_report)

@if($daily_petty_expense_report->report_type == \App\Models\DailyPettyExpense::NORMAL)
 


@forelse ($daily_petty_expense_report->docs as $key=>$document)
{{--$document->doc--}}

{{--env('PETTY_DOCS_PATH').$document->doc--}} 

<p>{{--$daily_petty_expense_report--}}</p>



<div style="width:50%;;margin-left:25%;margin-right:25%;">
    <img src="{{env('PETTY_DOCS_PATH').$document->doc}}" alt="" style="width:75%">
</div>





@empty
<div class="col-md-4 border text-center font-weight-bold">
  <p class='p-2'>No Document available</p>
</div>
@endforelse 


@endif 
@empty
<p>No Data Found</p>
@endforelse






</body>
</html>


