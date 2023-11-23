               @foreach ($AppointmentList as $data)
                                <tr>

                                    <td class="display-none"></td>
                                    <td>{{@$data->appointment->User->name}}</td>




                                    <td>{{@$data->appointment->Nutritionist->name}}</td>



                                    <td>{{date('d/m/Y',strtotime(@$data->appointment_time))}}</td> 

                                    <td>{{@$data->start_time==null ?"--":date('g:i A', strtotime(@$data->start_time))}}</td>

                                    <td>{{@$data->end_time==null?"--":date('g:i A', strtotime(@$data->end_time))}}</td>

                                    <td>
                                        @if(!empty(@$data->start_time) && !empty(@$data->end_time))
                                        {{@$data->calculated_duration}} Min
                                        @else
                                        --  
                                        @endif
                                    </td>

                                    <td>
                                       @if(!empty(@$data->start_time) && !empty(@$data->end_time))



                                       <span class="badge badge-pill badge-dark mb-1 copy_btn" style="font-size:12px;" data-link="{{@$data->appointment_join_url}}" title="{{@$data->appointment_join_url}}" >Copy  </span>

                                       @else
                                       --  
                                       @endif

                                   </td>


                                   <td>{{@$data->AppointmentStatus->name}}</td>






                                   @if(!empty(@$data->start_time) && !empty(@$data->end_time))

                                   <td>

                                    <i title="Notify both by sending mail" class="fa fa-bell notify_btn" aria-hidden="true" data-id="{{@$data->id}}"></i>

                                    <a class="action-button" title="View"
                                    href="{{ route('view_appointment', ['id' => $data->id]) }}"><i
                                    class="text-success fa fa-eye"></i></a>

                                    <a href="{{ route('edit_appointment', ['id' => @$data->id]) }}"
                                        title="Edit"><i class="text-warning fa fa-edit"></i></a>

                                        <a class="action-button delete-button" title="Delete"
                                        href="javascript:void(0)" data-id="{{ $data->id }}" meeting-id="{{@$data->meeting_id}}"><i
                                        class="text-danger fa fa-trash-alt"></i></a>

                                    </td>


                                    @else

                                    <td>

                                     <a class="action-button scheduled-appoinment-button" title="Schedule Appointment"
                                     href="javascript:void(0)" data-id="{{ $data->id }}" meeting-id="{{@$data->meeting_id}}"><i
                                     class="text-dark fa fa-calendar" style="font-size:16px;"></i></a>


                                     <a class="action-button delete-button" title="Delete"
                                     href="javascript:void(0)" data-id="{{ $data->id }}" meeting-id="{{@$data->meeting_id}}"><i
                                     class="text-danger fa fa-trash-alt"></i></a>

                                 </td>

                                 @endif


                             </tr>
                             @endforeach