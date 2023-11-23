<table>
    <tr>

        <!-- <th>Date</th> -->
        <th>Start Time</th>
        <th>End Time</th>
        <th>Duration</th>
    </tr>
    @forelse($AppointmentLists as $AppointmentList)
        @if ($AppointmentList->AppointmentMetaData)
            <tr>

                <!-- <td>{{ date('m/d/Y', strtotime($AppointmentList->AppointmentMetaData->appointment_time)) }}</td> -->
                <td>{{ date('g:i A', strtotime($AppointmentList->AppointmentMetaData->appointment_time)) }}</td>
                <td>{{ date('g:i A', strtotime($AppointmentList->AppointmentMetaData->appointment_end_time)) }}</td>
                <td>{{ round(abs(strtotime($AppointmentList->AppointmentMetaData->start_time) - strtotime($AppointmentList->AppointmentMetaData->end_time)) / 60, 2) }}
                    Min</td>
            </tr>
        @endif
    @empty
        <td colspan="4" class="font-weight-bold">No Appoinments</td>
    @endforelse
</table>
