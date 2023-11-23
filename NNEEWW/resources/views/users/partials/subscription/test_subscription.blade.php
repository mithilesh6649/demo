 <table style="width:100%" id="report-list" class="table table-bordered table-hover yajra-datatable">
   <thead>
       <tr>
           <th>Test Name</th>
           <th>Payment For</th>
           <th>Duration</th>
           <th>Amount</th>
           <th>Date of Purchase</th>
           
           <!-- <th>Status</th> -->
       </tr>
   </thead> 
   <tbody>
       @forelse($User->userTestSubscription as $key => $data)
       
       <tr>
         <td>
              @forelse($data->UserTest as $key => $allTest)
              <span class="badge badge-pill badge-dark">{{@$allTest->test->name}}</span> 
              @empty
                N/A
              @endforelse
         </td>
         <td>Test</td>
          <td>One Time </td>
           <td>{{ @$data->amount ?? '--'  }}</td>
             <td>{{ date('m/d/Y G:h A', strtotime(@$data->created_at)) }}</td>
             
      </tr>
      @empty
      
      @endforelse
  </tbody>
</table>


