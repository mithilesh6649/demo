@forelse ($allTickets as $ticket)
    <tr>
        <th class="display-none"></th>
        <td>{{ $ticket->unique_ticket_id }}</td>
        <td>

            {{ $ticket->category }}
        </td>
        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
        </td>




        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


        <td> <a title="View" href="view/{{ $ticket->id }}"><i class="text-success fa fa-eye"></i></a>



        </td>


    </tr>
@empty
@endforelse
