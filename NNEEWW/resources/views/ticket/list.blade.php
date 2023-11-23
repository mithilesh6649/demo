@extends('adminlte::page')

@section('title', 'Advertisement')

@section('content_header')


@section('content')

<div class="container">
    <div class="alert d-none" id="flash-message"></div>
    @if (session()->has('message'))
    <p class="alert alert-success">{{ session('message') }}</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center ">
                    <h3 style="display:inline;">Help & Support</h3>

                    {{-- <a class=" btn btn-sm btn-success float-right clear" href="{{ route('ticket.add') }}">Add New </a> --}}

                </div>
                <div class="card-body">
                    <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="display-none"></th>
                                <th>Ticket Id</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Author Name</th>
                                <th>Author Email</th>
                                <th>Current Nutiritionist</th>
                                 @if (Gate::check('view_help_and_support') || Gate::check('edit_help_and_support')  )
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allTickets as $ticket)

                            <tr>
                                <th class="display-none"></th>
                                <td>{{ $ticket->unique_ticket_id }}</td>
                                <td>
                                    {{-- <a href="{{ route('ticket.view', ['id' => $ticket->id]) }}">{{ $ticket->category }}
                                        (6)
                                    </a> --}}
                                    {{ $ticket->category }}
                                </td>
                                <td > <span  
                                    style="background-color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                                </td>
                                <td> <span
                                    style="color:{{ @$ticket->priority->color }}">{{ Str::ucfirst(@$ticket->priority) }}</span>
                                </td>

                                <td>{{ @$ticket->user->name ?? '--' }}</td>
                                <td>{{ @$ticket->user->email ?? '--' }}</td>

                                <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>  
                                {{-- <td>
                                    <select  {{ $ticket->ticket_assigned_to != null ? 'disabled' : '' }} class="form-control NutritionistSelect ticket_assigned_to"
                                        data-id="{{ $ticket->id }}" id="ticket_assigned_to">
                                        <option>
                                        Assign to Nutritionist</option>
                                        @forelse($activeNutiritionist  as $allNutritionist)
                                        <option
                                        {{ $ticket->ticket_assigned_to == $allNutritionist->id ? 'selected' : '' }}
                                        value="{{ $allNutritionist->id }}">
                                        {{ $allNutritionist->name }}</option>
                                        @empty
                                        <option disabled>Nutritionist Not Found</option>
                                        @endforelse

                                    </select>
                                </td> --}}
                                @if (Gate::check('view_help_and_support') || Gate::check('edit_help_and_support')  )
                                <td> 
                                  
                                  @can('view_help_and_support')
                                  <a title="View" href="view/{{ $ticket->id }}"><i
                                    class="text-success fa fa-eye"></i></a>
                                    @endcan
                                 @can('edit_help_and_support')
                                    <a class="action-button" title="Edit" href="edit/{{ $ticket->id }}"><i
                                        class="text-warning fa fa-edit"></i></a>
                                        @endcan


                                    </td>
                                    @endif


                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection

    @section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    @stop

    @section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#roles-list').DataTable({
                
                "ordering": false,
                // columnDefs: [{
                //     targets: 0,
                //     render: function(data, type, row) {
                //         return data.substr(0, 2);
                //     }
                // }]
            });
        });

        $(document).ready(function() {
            $('.ticket_assigned_to').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('change', '.ticket_assigned_to', function() {
                var id = $(this).data("id");
                var nutritionist_id = $(this).val();


                if (nutritionist_id != '') {
                    $.ajax({
                        type: "post",
                        url: "{{ route('assign_tickets') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id,
                            nutritionist_id: nutritionist_id,
                        },
                        success: function(response) {
                            toastr.success('Ticket assigned Successfully');
                        }
                    });
                }
            });
        });
    </script>
    @stop
