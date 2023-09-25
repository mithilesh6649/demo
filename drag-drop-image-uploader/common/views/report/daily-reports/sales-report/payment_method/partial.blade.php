 @foreach ($data as $key => $p_data)

     <tr>
         <td class="table_td">{{ date('D', strtotime($p_data->date)) }}</td>
         <td class="table_td">{{ date('d/M/Y', strtotime($p_data->date)) }}</td>
         <td class="d-none">{{$key}}</td>
         
         @foreach ($headerscolumn as $bkey => $daily_salse)
             @if ($bkey == 'amex')
                 <td class="table_td" title="{{ $daily_salse }}">
                     {{ \App\Models\DailySaleReport::getTotalAmexPay($branchs_ids, $p_data->date) }}
                 </td>
             @elseif($bkey == 'visa')
                 <td class="table_td" title="{{ $daily_salse }}">
                     {{ \App\Models\DailySaleReport::getTotalVisaaPay($branchs_ids, $p_data->date) }}
                 </td>
             @elseif($bkey == 'master')
                 <td class="table_td" title="{{ $daily_salse }}">
                     {{ \App\Models\DailySaleReport::getTotalMastersPay($branchs_ids, $p_data->date) }}
                 </td>
             @elseif($bkey == 'dinner')
                 <td class="table_td" title="{{ $daily_salse }}">
                     {{ \App\Models\DailySaleReport::getTotalDinnerPay($branchs_ids, $p_data->date) }}
                 </td>
             @elseif($bkey == 'mm_online_link')
                 <td class="table_td" title="{{ $daily_salse }}">
                     {{ \App\Models\DailySaleReport::getTotalPaymentGetwaysPay($branchs_ids, $p_data->date) }}
                 </td>
             @elseif($bkey == 'knet')
                 <td class="table_td" title="{{ $daily_salse }}">
                     {{ \App\Models\DailySaleReport::getTotalKnetsPay($branchs_ids, $p_data->date) }}
                 </td>
             @elseif($bkey == 'other_cards')
                 <td class="table_td" title="{{ $daily_salse }}">
                     {{ \App\Models\DailySaleReport::getOthercardsPay($branchs_ids, $p_data->date) }}
                 </td>
             @else
                 <td class="table_td" title="{{ $daily_salse }}">
                     {{ $paymentmethod[$p_data->date][$bkey] == 0 ? '-' : number_format((float) $paymentmethod[$p_data->date][$bkey], 3, '.', '') }}</td>
             @endif
         @endforeach

         <!-- <td><a class="action-button" title="View" href="#" data-date="{{ $p_data->date }}"><i class="text-info fa fa-eye eye_green"></i></a></td> -->
     </tr>
 @endforeach
