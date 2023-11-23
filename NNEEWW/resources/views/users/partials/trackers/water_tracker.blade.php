 <table style="width:100%" id="water-tracker-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>
             <th>Glass out of ({{ @$User->UserMetadata->water_glass_goal ?? '--' }})</th>
             <th>Unit</th>
             <th>Date</th>


         </tr>
     </thead>
     <tbody>
         @forelse($User->WaterTracker as $key => $data)
             <tr>
                 <td>{{ @$data->glass_count ?? '0' }} Glass</td>
                 <td>{{ @$data->unit }}</td>
                 <td>{{ date('m/d/Y', strtotime(@$data->created_at)) }}</td>
             </tr>
         @empty
          
         @endforelse
     </tbody>
 </table>
