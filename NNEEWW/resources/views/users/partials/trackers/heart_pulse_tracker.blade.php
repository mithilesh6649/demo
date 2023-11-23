 <table style="width:100%" id="water-tracker-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>
             <th>Beats Per Minute ( BPM )</th>
             <th>Date</th>


         </tr>
     </thead>
     <tbody>
         @forelse($User->PulseTracker as $key => $data)
             <tr>
                 <td>{{ @$data->bpm ?? ' -- ' }}</td>
                 <td>{{ date('m/d/Y', strtotime(@$data->created_at)) }}</td>
             </tr>
         @empty
          
         @endforelse
     </tbody>
 </table>
