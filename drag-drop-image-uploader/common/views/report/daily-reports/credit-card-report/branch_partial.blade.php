@foreach($card_reports as $key => $month)

<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{date('M', strtotime($key))}}-{{date('y',strtotime($key))}}</td>

    {!! \App\Models\DailySaleReport::getReportByBranch($selected_branch_id,date('m', strtotime($key)),date('Y',strtotime($key)),\App\Models\DailySaleReport::AMEX) !!}
    
    {!! \App\Models\DailySaleReport::getReportByBranch($selected_branch_id,date('m', strtotime($key)),date('Y',strtotime($key)),\App\Models\DailySaleReport::VISA) !!}
    
     {!! \App\Models\DailySaleReport::getReportByBranch($selected_branch_id,date('m', strtotime($key)),date('Y',strtotime($key)),\App\Models\DailySaleReport::MASTER) !!}
    
    {!! \App\Models\DailySaleReport::getReportByBranch($selected_branch_id,date('m', strtotime($key)),date('Y',strtotime($key)),\App\Models\DailySaleReport::DINNER) !!}
    
    {!! \App\Models\DailySaleReport::getReportByBranch($selected_branch_id,date('m', strtotime($key)),date('Y',strtotime($key)),\App\Models\DailySaleReport::PAYMENT_GATEWAY) !!}
    
    {!! \App\Models\DailySaleReport::getReportByBranch($selected_branch_id,date('m', strtotime($key)),date('Y',strtotime($key)),\App\Models\DailySaleReport::KNET) !!}
    
    {!! \App\Models\DailySaleReport::getReportByBranch($selected_branch_id,date('m', strtotime($key)),date('Y',strtotime($key)),\App\Models\DailySaleReport::MONTH_TOTAL) !!} 

</tr>
@endforeach