 <table style="width:100%" id="documents-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>
             <th>S.No</th>

             <th>Document</th>
             <th>Status</th>
             <th>Uploaded Date</th>
             <th>Actions</th>
             <i class="fas fa-badge-check"></i>
         </tr>
     </thead>
     <tbody>
         @forelse($Nutritionist->NutritionistDocuments as $key => $data)
             <tr>
                 <td>{{ @$data->id ?? '--' }} </td>
                 <td>
                     <a href="{{ @$data->document_url ?? '--' }}" target="_blank"><i
                             class="text-success fa fa-eye"></i></a>
                 </td>

                 <td>
                     <span class="status_contain"
                         style="background-color:{{ @$data->documentStatus->color }}">{{ @$data->documentStatus->name }}</span>
                 </td>

                 <td>{{ date('m/d/Y', strtotime(@$data->created_at)) }}</td>
                 <td>
                     @if (@$data->documentStatus->slug == 'document_under_review')
                         <span class="badge badge-pill badge-warning p-2 approve_document"
                             data-id="{{ $data->id }}">Approve</span>
                         <span class="badge badge-pill badge-danger p-2 reject_document"
                             data-id="{{ $data->id }}">Reject</span>
                     @elseif(@$data->documentStatus->slug == 'document_approved')
                         <i title="Approved Document" class="fa fa-check-circle text-success" aria-hidden="true"
                             style="font-size:18px;"></i>
                     @elseif(@$data->documentStatus->slug == 'document_rejected')
                         <i title=" Reason :- {{ $data->reason ?? ' Not Available' }}"
                             class="fa fa-times-circle text-danger" aria-hidden="true" style="font-size:18px;"></i>
                     @endif
                 </td>
             </tr>
         @empty
         @endforelse
     </tbody>
 </table>
