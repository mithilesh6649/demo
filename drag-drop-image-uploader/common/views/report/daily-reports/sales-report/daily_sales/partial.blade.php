  @foreach($data as $keys => $AllData)         
  
  @if($keys==0)
  <tr> 
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    
    
    <td colspan="10" class="separator font-weight-bold">{{date('F Y',strtotime($AllData->report_date ))}}</td>
  </tr> 
  @endif 
  
  <tr>
   <!--  <td class="table_td" style="white-space: nowrap; padding: 5px;" >{{date('D', strtotime($AllData->report_date))}}</td> -->
   <td class="table_td" style="white-space: nowrap; padding: 5px;" >{{date('d/m/Y', strtotime($AllData->report_date))}}</td>
   <td class="table_td" style="white-space: nowrap; padding: 5px;" >
    {{--$AllData->rv_number ?? 'N/A'--}}
    
    <span class="mr-2 reports_rv_number">{{$AllData->rv_number  }}</span> 
    @can('edit_daily_sales_report')
    <span> 
     <i class="text-warning fa fa-edit reports_rv_number_edit" report-id='{{$AllData->id}}' style="font-size:20px;cursor: pointer;" title="Edit Rv No"></i>
     <i class="text-success fa fa-save reports_rv_number_save d-none" report-id='{{$AllData->id}}' style="font-size:22px;cursor: pointer;" title="Update Rv No"></i>
   </span>
   @endcan

   
 </td>
 

 <td class="table_td" style="white-space: nowrap; padding: 5px;" >
  {{   $AllData->gross_sale==''? '-':  "KD ".number_format($AllData->gross_sale,3, '.','')}}
  
</td>
<td class="table_td" style="white-space: nowrap; padding: 5px;" >
  {{   $AllData->discount_return==''? '-':  "KD ".number_format($AllData->discount_return,3, '.','')}}</td>
  <td class="table_td" style="white-space: nowrap; padding: 5px;" >
    {{   $AllData->net_sale==''? '-':  "KD ".number_format($AllData->net_sale,3, '.','')}}
    
  </td>
  
  <td style="white-space: nowrap; padding: 5px;">
    {{   $AllData->cash_in_hand_opening_balance==''? '-':  "KD ".number_format($AllData->cash_in_hand_opening_balance,3, '.','')}}
    
    <td style="white-space: nowrap; padding: 5px;">

     {{   $AllData->cash_deposit_in_bank==''? '-':  "KD ".number_format($AllData->cash_deposit_in_bank,3, '.','')}}
     
   </td>

   <td style="white-space: nowrap; padding: 5px;">
    {{   $AllData->cash_in_hand_closing_balance==''? '-':  "KD ".number_format($AllData->cash_in_hand_closing_balance,3, '.','')}}

  </td>
  
  <td class="table_td" style="white-space: nowrap; padding: 5px;">
    

   
    @can('download_daily_sales_report')
    <a class="m-1" title="Download" href="{{route('download-dsr-pdf',['id' =>$AllData->id])}}"><i class="fa fa-download"></i></a>
    @endcan
    @can('view_daily_sales_report')
    <a class="action-button" title="View" href="{{route('daily-sales.view',['id' =>$AllData->id])}}"><i class="text-info fa fa-eye"></i></a>    
    @endcan
    
    
    @can('edit_daily_sales_report')
    <a class="action-button" title="Edit" href="{{route('daily-sales.edit',['id' =>$AllData->id])}}"><i class="text-warning fa fa-edit"></i></a>   
    @endcan
    
    @can('delete_daily_sales_report')
    <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$AllData->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
    @endcan
    
  </td> 

  
</tr>



@endforeach



















