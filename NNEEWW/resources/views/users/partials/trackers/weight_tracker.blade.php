 <table style="width:100%" id="weight-tracker-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>
             <th>Weight</th>
             <th>Unit</th>
             <th>Date</th>


         </tr>
     </thead>
     <tbody>
         @forelse($User->WeightTracker as $key => $data)
             <tr>
                 <td>{{ @$data->weight ?? '--' }}</td>
                 <td>{{ @$data->weight_unit ?? '--' }}</td>
                 <td>{{ date('m/d/Y', strtotime(@$data->created_at)) }}</td>
             </tr>
         @empty
         @endforelse
     </tbody>
 </table>
