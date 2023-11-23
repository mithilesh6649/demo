 <table style="width:100%" id="water-tracker-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>
             <th>Step Count </th>
             <th>Date</th>


         </tr>
     </thead>
     <tbody>
         @forelse($User->StepTracker as $key => $data)
             <tr>
                 <td>{{ @$data->step_count ?? ' -- ' }}</td>
                 <td>{{ date('m/d/Y', strtotime(@$data->created_at)) }}</td>
             </tr>
         @empty
          
         @endforelse
     </tbody>
 </table>
