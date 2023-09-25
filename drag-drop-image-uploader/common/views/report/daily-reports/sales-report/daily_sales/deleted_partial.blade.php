  @foreach($allBranchDeletedReports as $data)
               <tr> 
                <td>{{ optional($data->branch)->title_en}}</td>
                <td>{{date('D',strtotime($data->date))}}</td>
                <td>{{date('d/M/Y',strtotime($data->date))}}</td>
               
              
                        <td>

                            @can('restore_dsr')
                            <a class="action-button restore-button" title="Restore" href="javascript:void(0)"  branch-id="{{$data->branch_id}}"  data-date="{{$data->date}}"><i class="text-success fa fa-undo"  ></i></a>
                            @endcan

                             @can('permanent_deleted_dsr')
                            <a class="action-button delete-button " title=" Permanent Delete" href="javascript:void(0)" branch-id="{{$data->branch_id}}"  data-date="{{$data->date}}"><i class="text-danger fa fa-trash-alt" ></i></a>
                           @endcan
                        </td>


                      
                      
               </tr>
             
                @endforeach