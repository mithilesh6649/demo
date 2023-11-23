@foreach($transactionList as $key => $data)
              
             <tr>
               <td>GHX -{{$data->user_id}}</td>
              <td>{{ $data->razorpay_order_id  ?? '--'}}</td>
              <!-- <td>{{ $data->payment_for  ?? ''}}</td> -->
              <td>
              @if($data->payment_for=='diet_plans')
                Diet Plan
              @else
               Test
              @endif</td>
              <td>Monthly</td>
              <th>{{ $data->amount  ?? ''}}</th>
                <td>
                @if($data->transaction_status=='success'||$data->transaction_status=='created')<span class="badge badge-info p-1">Success</span>@else
                <span class="badge badge-danger p-1">{{$data->transaction_status ?? '--'}}</span> @endif</td>
              <td> {!! date('m/d/Y H:i', strtotime($data->created_at)) !!} </td>
        
                    
                      <td>
                     
                    
                          <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a>
        
                      </td>

                       
                    
             </tr>
             @endforeach