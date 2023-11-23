 <table style="width:100%" id="report-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>
             <th>Plan Name</th>
             <th>Payment For</th>
             <th>Duration</th>
             <th>   Total Amount</th>
             <th>Date of Purchase</th>
             <th>Expiry Date</th>
             <th>Status</th>
             <th>Action</th>  
         </tr>
     </thead> 
     <tbody>
         @forelse($User->userPaymentTransaction as $key => $data)
         
         <tr>
             <td>{{ @$data->dietPlanSubscription->name ?? '--' }} </td>
             <td>
              @forelse($data->paymentTransactionItem as $allDiets)
              
              <span class="badge badge-pill badge-primary">{{$allDiets->type}}</span>
              @empty
              --
              @endforelse

          </td>
          <td> {{ucfirst($data->payment_for_time_period) ?? 'Monthly'}} Months</td>
          <td>{!!rupeeSymbol()!!}  {{  @$data->amount ?? '--'  }}</td>
          <td>{{ date('m/d/Y', strtotime(@$data->created_at)) }}</td>
          <!-- <td>{{ @$data->diet_plan_subscription->user_diet_plan_subscription}} {{ date('m/d/Y G:h A', strtotime(@$data->created_at)) }}</td> -->
          <td>{{ date('m/d/Y', strtotime(@$data->userDietPlanSubscription->expire_at)) }}</td>
          <td>
            @if(@$data->userDietPlanSubscription->expire_at < now())
            <span class="inactive_text_warning">Plan Expired</span>
            @else
            <!-- <span class="active_text_success" style="font-size:12px">  {{ @$data->created_at->diffInDays(@$data->userDietPlanSubscription->expire_at) }} Days Remaining </span>   -->
            <span class="active_text_success" style="font-size:12px">Active</span>
            @endif

        </td>
        
        <td>
            
            <i class="fa fa-eye  user_plan_details"
            title="View Details"
            transaction-id="{{ @$data->id }}"></i>
        </td>
    </tr>
    @empty
    
    @endforelse
</tbody>
</table>


