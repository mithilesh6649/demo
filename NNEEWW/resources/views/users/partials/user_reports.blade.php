 <table style="width:100%" id="report-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>
             <th>S.No</th>
             <th>Test</th>
             <th>Type</th>
             <th>Document</th>
             <th>Uploaded By</th>
             <th>Date</th>


         </tr>
     </thead>
     <tbody>
         @forelse($User->UserReport as $key => $data)
          
             <tr>
                 <td>{{ @$data->report_no ?? '--' }} </td>
                 <td>{{ @$data->testType->name ?? '--' }}</td>
                 <td>{{ \App\Models\User::GetDocType(@$data->document_type) }}</td>
                 <td>
                     {{-- @$data->document_url ?? 'N/A' --}}

                     <!-- <a ><i class="text-success fa fa-download"></i></a> -->
                     <a href="{{ @$data->document_url ?? '--' }}" target="_blank"><i
                             class="text-success fa fa-eye"></i></a>
                 </td>
                 <td>
                    <!-- {{ ucfirst(@$data->uploaded_by_guard) ?? '--' }} -->
                    @if(@$data->uploaded_by_guard=='users')
                      User
                    @else
                      Nutritionist
                    @endif
                </td>
                 <td>{{ date('m/d/Y', strtotime(@$data->created_at)) }}</td>
             </tr>
         @empty
 
         @endforelse
     </tbody>
 </table>
