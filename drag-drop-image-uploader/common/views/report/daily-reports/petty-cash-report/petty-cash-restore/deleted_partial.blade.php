  @foreach($allBranchDeletedReports as $data)
 
        <tr> 
                <td>{{ optional($data->branch)->title_en}}</td>
                <td>{{date('D',strtotime($data->report_date))}}</td>
                <td>{{date('d/M/Y',strtotime($data->report_date))}}</td>
                
                @if(Gate::check('restore_sales_and_petty') || Gate::check('permanent_deleted_sales_and_petty'))    
                        <td>

                            @can('restore_sales_and_petty')
                            <a data-id="{{$data->id}}" class="action-button restore-button" title="Restore" href="javascript:void(0)"  branch-id="{{$data->branch_id}}"  data-date="{{$data->report_date}}"><i class="text-success fa fa-undo"  ></i></a>
                            @endcan

                             @can('permanent_deleted_sales_and_petty')
                            <a data-id="{{$data->id}}" class="action-button delete-button " title=" Permanent Delete" href="javascript:void(0)" branch-id="{{$data->branch_id}}"  data-date="{{$data->report_date}}"><i class="text-danger fa fa-trash-alt" ></i></a>
                           @endcan
                        </td>

              @endif 
 
             
  @endforeach