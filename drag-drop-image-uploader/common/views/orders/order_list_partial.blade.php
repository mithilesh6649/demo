@foreach($orders as $allOrders)
       <tr>

                   
                  
                 <!-- Customer Details --> 
                  <td>
                    <a href="{{route('view_user',['id' =>$allOrders->user->id])}}">
                      <span>{{$allOrders->user->first_name ?? 'N/A'}} {{$allOrders->user->last_name ?? ' '}}</span>
                      <span>({{$allOrders->user->phone_number ?? 'N/A'}})</span>
                    </a>
                  </td>
                  

                <td>
                    

                    @if($allOrders->delivery_type == 'take_away')
                       <span class="badge badge-success bg-primary p-2 border">Take Away</span>
                    @else 
                       <span class="badge badge-success bg-warning p-2 border">Delivery</span>
                    @endif    
                </td>

            




               

                  


                   
                  
                  <td>
                   <!--  <span class="badge badge-success">
                      @php $Orderdata = $allOrders->orderLogs @endphp

                      @if(isset($allOrders->orderLogs[0])) 
                        {{$allOrders->orderLogs[0]->status}}
                      @endif
                    </span> -->
                         

                            <select class="form-control changestatus" name="status" data-id="{{$allOrders->id}}">

                        @foreach($order_summary_logs as $order_summary)
                          @if(isset($allOrders->orderLogs[0])) 
                          <option value="{{ $order_summary->value }}" {{ $order_summary->value == $allOrders->orderLogs[0]->status ? 'selected':'' }} > {{ $order_summary->name }}</option> 
                          @endif        
                        @endforeach
 
            
 
                      </select>


                     

                  </td>

                  <td>{{ date('d/m/Y h:i A',strtotime($allOrders->created_at))}}  </td>
                  @if(Gate::check('view_order')) 
                  
                  <td>
                    <a class="btn info_btn" data-toggle="tooltip" data-placement="right" title="Quick View">
               <i class="fa fa-question-circle quick_view" data-id="{{ $allOrders->id }}" order-placed-on="{{ date('d/m/Y h:i A',strtotime($allOrders->created_at))}}"></i>
               </a>

                      <a class="action-button" title="View" href="{{route('orders.view',['id'=>$allOrders->id])}}"><i class="text-info fa fa-eye"></i></a>
                  </td>
                  @endif
                </tr>
 
@endforeach
