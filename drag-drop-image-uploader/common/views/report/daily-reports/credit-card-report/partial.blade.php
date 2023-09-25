@foreach($card_report as $key => $data)
  <tr>
    <td>{{$loop->iteration}}</td>
    <td>{{date('d-M-y',strtotime($key))}}</td>

    {!! \App\Models\DailySaleReport::getAmexReport($selected_branch_id,$key,\App\Models\DailySaleReport::AMEX) !!}

    {!! \App\Models\DailySaleReport::getAmexReport($selected_branch_id,$key,\App\Models\DailySaleReport::VISA) !!}

    {!! \App\Models\DailySaleReport::getAmexReport($selected_branch_id,$key,\App\Models\DailySaleReport::MASTER) !!}

    {!! \App\Models\DailySaleReport::getAmexReport($selected_branch_id,$key,\App\Models\DailySaleReport::DINNER) !!}

    {!! \App\Models\DailySaleReport::getAmexReport($selected_branch_id,$key,\App\Models\DailySaleReport::PAYMENT_GATEWAY) !!}

    {!! \App\Models\DailySaleReport::getAmexReport($selected_branch_id,$key,\App\Models\DailySaleReport::KNET) !!}

    {!! \App\Models\DailySaleReport::getAmexReport($selected_branch_id,$key,\App\Models\DailySaleReport::MONTH_TOTAL) !!}

</tr>
@endforeach
