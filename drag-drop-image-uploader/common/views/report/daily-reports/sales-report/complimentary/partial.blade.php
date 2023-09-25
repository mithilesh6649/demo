@php $month="";@endphp

  @foreach($data as $keys => $AllData)         
        
      @if($keys==0 || $month!=date('F Y',strtotime($AllData->report_date )) )
      <tr> 
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td colspan="6" class="separator font-weight-bold">
          @php $month=date('F Y',strtotime($AllData->report_date )); @endphp {{date('F Y',strtotime($AllData->report_date ))}}</td>
      </tr> 
      @endif 

        @if($AllData->complimentary_amount!=null)
          
          @php $i=0;@endphp
          @foreach(json_decode($AllData->complimentary_amount) as $amount)
            <tr>
               <td class="table_td" style="white-space: nowrap; padding: 5px;" >
              {{date('d/m/Y',strtotime($AllData->report_date))}}
            
             </td>
              <td>{{json_decode($AllData->complimentary_name)[$i]}}</td>
              <td>{{json_decode($AllData->complimentary_contact)[$i]}}</td>
              <td>{{json_decode($AllData->complimentary_invoice)[$i]}}</td>
              <td>{{number_format($amount, 3, '.', '')}}</td>
              <td>{{json_decode($AllData->complimentary_ref)[$i]}}</td>
             </tr>
            @php $i++;@endphp
          @endforeach

        @else
         <tr>
           <td class="table_td" style="white-space: nowrap; padding: 5px;" >
          {{date('d/m/Y',strtotime($AllData->report_date))}}
        
          </td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
         </tr>
        @endif
  @endforeach