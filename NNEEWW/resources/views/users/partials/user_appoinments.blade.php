  @php
   $appointment_requested = \App\Models\Appointment::appointment_requested;
   $appointment_scheduled = \App\Models\Appointment::appointment_scheduled;
   $appointment_end = \App\Models\Appointment::appointment_end;
   
 @endphp
 <table style="width:100%" id="appoinment-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>
             <th>Nutritionists </th>
             <th> Date</th>
             <th>Start Time</th>
             <th>End Time</th>
             <th>Duration</th>
             <th>Zoom Link</th>
             <th>Status</th>

         </tr>
     </thead>
     <tbody>
         @forelse($User->Appointments as $key => $data)
             <tr>
                 <td>{{ @$data->nutritionist->name ?? '--' }} <span class="badge badge-pill badge-primary"
                         style="font-size:12px;">{{ @$data->nutritionist->NutritionistSpecialization->Specialization->name }}</span>
                 </td>

                 <!--    <td>{{ date('d/m/Y g:i A', strtotime(@$data->AppointmentMetaData->appointment_time)) }}
                        </td>
                        <td>{{ date('g:i A', strtotime(@$data->AppointmentMetaData->end_time)) }}
                        </td> -->

                 <td>{{ date('m/d/Y', strtotime(@$data->AppointmentMetaData->appointment_time)) }}
                 </td>

                 <td>{{ @$data->AppointmentMetaData->start_time == null ? '--' : date('g:i A', strtotime(@$data->AppointmentMetaData->start_time)) }}
                 </td>



                 <td>{{ @$data->AppointmentMetaData->end_time == null ? '--' : date('g:i A', strtotime(@$data->AppointmentMetaData->end_time)) }}
                 </td>
 
                 <td>
                     @if (!empty(@$data->AppointmentMetaData->start_time) && !empty(@$data->AppointmentMetaData->end_time))
                         {{ @$data->AppointmentMetaData->calculated_duration }} Min
                     @else
                         --
                     @endif
                 </td>

                 <td>

                      @if(@$data->AppointmentMetaData->status != $appointment_requested && @$data->AppointmentMetaData->appointment_join_url !='')
                         <span class="border p-1 px-2 bg-dark copy_btn"
                             data-link="{{ @$data->AppointmentMetaData->appointment_join_url }}"
                             title="{{ @$data->AppointmentMetaData->appointment_join_url }}">Copy</span>
                     @else
                         --
                     @endif
                 </td>
                  <td>{{ @$data->AppointmentMetaData->AppointmentStatus->name }}</td>

             </tr>
         @empty
         @endforelse
     </tbody>
 </table>
