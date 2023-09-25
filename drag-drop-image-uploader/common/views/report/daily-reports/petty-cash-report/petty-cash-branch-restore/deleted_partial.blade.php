  @foreach($allBranchDeletedReports as $data)
   
        <tr> 
                <td>{{ optional($data->branch)->title_en}}</td>
                <td>{{date('D',strtotime($data->created_at))}}</td>
                <td>{{date('d/M/Y',strtotime($data->created_at))}}</td>
                
              <!-- @if(Gate::check('restore_dsr') || Gate::check('permanent_deleted_dsr')) 
               -->        
                        <td>

                            <!-- @can('restore_dsr') -->
                            <a data-id="{{$data->id}}" class="action-button restore-button" title="Restore" href="javascript:void(0)"  branch-id="{{$data->branch_id}}"  data-date="{{$data->created_at}}"><i class="text-success fa fa-undo"  ></i></a>
                           <!--  @endcan -->

                             <!-- @can('permanent_deleted_dsr') -->
                            <a data-id="{{$data->id}}" class="action-button delete-button " title=" Permanent Delete" href="javascript:void(0)" branch-id="{{$data->branch_id}}"  data-date="{{$data->created_at}}"><i class="text-danger fa fa-trash-alt" ></i></a>
                          <!--  @endcan -->
                        </td>

              <!-- @endif --> 
                
                      
                      
               </tr>
             
  @endforeach