@foreach($branches as $branch)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$branch['short_name']}}</td>

    {!! \App\Models\DailySaleReport::getReportByMonth($branch->id,$month,$year,\App\Models\DailySaleReport::AMEX) !!}
    
    {!! \App\Models\DailySaleReport::getReportByMonth($branch->id,$month,$year,\App\Models\DailySaleReport::VISA) !!}
    
    {!! \App\Models\DailySaleReport::getReportByMonth($branch->id,$month,$year,\App\Models\DailySaleReport::MASTER) !!}
    
    {!! \App\Models\DailySaleReport::getReportByMonth($branch->id,$month,$year,\App\Models\DailySaleReport::DINNER) !!}
    
    {!! \App\Models\DailySaleReport::getReportByMonth($branch->id,$month,$year,\App\Models\DailySaleReport::PAYMENT_GATEWAY) !!}
    
    {!! \App\Models\DailySaleReport::getReportByMonth($branch->id,$month,$year,\App\Models\DailySaleReport::KNET) !!}
    
    {!! \App\Models\DailySaleReport::getReportByMonth($branch->id,$month,$year,\App\Models\DailySaleReport::MONTH_TOTAL) !!}

</tr>
@endforeach