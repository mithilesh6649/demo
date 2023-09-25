@extends('adminlte::page')

@section('title', 'Super Admin | Branch Managers List')

@section('content_header')


@section('content')
    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Branch Managers</h3>
                            @can('add_branch_manager')
                                <a class="btn btn-sm btn-success" href="{{ route('add_manager') }}">Add Branch Manager</a>
                            @endcan
                        </div>
                        <div class="card-body table p-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table style="width:100%" id="jobseekers-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>{{ __('adminlte::adminlte.email') }}</th>
                                        <th>{{ __('adminlte::adminlte.contact_number') }}</th>
                                        <th>Status</th>
                                        <th>Block</th>
                                        @if (Gate::check('view_branch_manager') ||
                                            Gate::check('edit_branch_manager') ||
                                            Gate::check('delete_branch_manager'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($users as $user)
                                        <tr>

                                            <th class="display-none"></th>
                                            <td>{{ $user->first_name ?? '' }}</td>
                                            <td>{{ $user->last_name ?? '' }}</td>
                                            <td>{{ $user->email ?? 'N/A' }}</td>
                                            <td> {{ $user->phone_number ?? 'N/A' }}</td>
                                            <td>

                                                @foreach ($status as $status_data)
                                                    @if ($status_data->value == $user->status)
                                                        <span
                                                            class="badge badge-pill {{ $user->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $status_data->name }}</span>
                                                    @endif
                                                @endforeach

                                            </td>
                                            <td>
                                                @foreach ($block as $block_data)
                                                    @if ($block_data->value == $user->is_user_locked)
                                                        <span
                                                            class="badge badge-pill {{ $user->is_user_locked == 0 ? 'badge-success' : 'badge-danger' }}">{{ $block_data->name }}</span>
                                                    @endif
                                                @endforeach


                                            </td>


                                            @if (Gate::check('view_branch_manager') ||
                                                Gate::check('edit_branch_manager') ||
                                                Gate::check('delete_branch_manager'))
                                                <td>
                                                    @can('view_branch_manager')
                                                        <a class="action-button" title="View"
                                                            href="view/{{ $user->id }}"><i
                                                                class="text-info fa fa-eye"></i></a>
                                                    @endcan
                                                    @can('edit_branch_manager')
                                                        <a class="action-button" title="Edit"
                                                            href="edit/{{ $user->id }}"><i
                                                                class="text-warning fa fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete_branch_manager')
                                                        <a data-id="{{ $user->id }}" class="action-button delete-button"
                                                            title="Delete" href="javascript:void(0)"><i
                                                                class="text-danger fa fa-trash-alt"></i></a>
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
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#jobseekers-list').DataTable({
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }]
            });
        });


        $(document).on('click', '.delete-button', function(e) {
            var id = $(this).attr('data-id');

            var obj = $(this);

            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this Branch Manager to the Recycle Bin?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('delete_manager') }}",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log("Response", response);
                            if (response.success == 1) {
                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html('Branch Manager Deleted Successfully');
                                obj.parent().parent().remove();
                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);
                            } else {
                                console.log("FALSE");
                                setTimeout(() => {
                                    swal('Error', 'Something went wrong', 'error');
                                    // alert("Something went wrong! Please try again.");
                                }, 500);
                            }
                        }
                    });
                }
            });
        });

        // block
        $(document).on('click', '.block-button', function(e) {

            toastr.options = {
                "closeButton": true,
                "newestOnTop": false,
                "positionClass": "toast-top-right"
            };

            var id = $(this).attr('data-id');
            var status_value = $(this).attr('status') == 0 ? 1 : 0;

            var notice = $(this).attr('status') == 0 ? "Are you sure you want to block this  Manager ?" :
                "Are you sure you want to Unblock this Manager ?";

            var obj = $(this);
            swal({
                title: "Are you sure?",
                text: notice,
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('block_manager') }}",

                        data: {
                            id: id,
                            status_value: status_value
                        },
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log("Response", response);

                            if (response.success == 1) {
                                toastr.warning("Manager Blocked");
                                // window.location.reload();
                                // var current_td = obj.parent().parent();
                                setTimeout(function() {
                                    window.location = window.location.href;
                                }, 500);

                            } else if (response.success == 0) {
                                toastr.success("Manager Unblockd");

                                setTimeout(function() {
                                    window.location = window.location.href;
                                }, 500);

                            } else {
                                console.log("FALSE");
                                setTimeout(() => {
                                    swal('Error', 'Something went wrong', 'error');
                                    // alert("Something went wrong! Please try again.");
                                }, 500);
                            }
                        }
                    });
                }
            });
        });
        // block


        $(document).ready(function() {

            $('.user_status').change(function() {

                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 0 : 1;

                $.ajax({
                    type: "post",
                    url: "{{ route('change.manager.status') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                        // toastr.success(response.message);
                        console.log(response);
                    }
                });
            });
        });
    </script>
@stop
