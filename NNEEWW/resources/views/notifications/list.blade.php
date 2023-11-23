@extends('adminlte::page')

@section('title', 'Super Admin | Notifications')

@section('content_header')

@section('content')


    <div class="container-fluid p-0">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>
            <div class="col-md-12">
                <div class="card order_outer rounded_circle">
                    <div class="card-body rounded_circle table p-0 mb-0">
                        <div class="order_details">
                            <div class="card-main pt-3">
                                <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">Notifications</h3>
                                 <div>
                                  <a class="btn btn-sm btn-success add-advance-options" href="{{ route('send_notification') }}">Send Notification </a>

                                    <a class="btn btn-sm btn-success add-advance-options" href="{{ route('add_notification') }}">Add Notification</a>
                                  </div>
                                </div>
                                <div class="">
                                    <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Title</th>
                                            
                                                
                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allNotifications as $AllSpecialization)
                                                <tr>
                                                    <td class="display-none"></td>
                                                    <td>{{ $AllSpecialization->title }}</td>
                                            
                                                    @if ($AllSpecialization->status == 1)
                                                        <td class="text-success"><span class="active_text_success">Active</span></td>
                                                    @else
                                                    <td class="text-warning"><span class="inactive_text_warning">Inactive</span></td>
                                                    @endif


                                                    <td>

                                                        <a class="action-button" title="View"
                                                            href="{{ route('view_notification', ['id' => $AllSpecialization->id]) }}"><i
                                                                class="text-success fa fa-eye"></i></a>

                                                        <a href="{{ route('edit_notification', ['id' => $AllSpecialization->id]) }}"
                                                            title="Edit"><i class="text-warning fa fa-edit"></i></a>

                                                        <a class="action-button delete-button" title="Delete"
                                                            href="javascript:void(0)" data-id="{{ $AllSpecialization->id }}"><i
                                                                class="text-danger fa fa-trash-alt"></i></a>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
@stop

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $('#pages-list').DataTable({
            columnDefs: [{
                targets: 0,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }]
        });


        // delete
        //$('.delete-button').click(function(e) {
        $(document).on("click", ".delete-button", function() {
            var id = $(this).attr('data-id');
            var obj = $(this);

            // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to  delete this Notification ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_notification') }}",
                        type: 'post',
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
                                $('#flash-message').html(
                                    'Notification  Deleted Successfully');
                                obj.parent().parent().remove();
                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);
                            } else {
                                console.log("FALSE");
                                setTimeout(() => {
                                    swal('Error',
                                        "Something went wrong! Please try again.",
                                        'error');
                                }, 500);
                                // swal("Error!", "Something went wrong! Please try again.", "error");
                                // swal("Something went wrong! Please try again.");
                            }
                        }
                    });
                }
            });
        });
        // delete
    </script>
    <script type="text/javascript">
        //Active and incactive choices

        $(document).ready(function() {
            $(document).on('change', '.change_status_of_status', function() {
                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "post",
                    url: " ",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                        //toastr.success(response.message);
                        console.log(response);
                    }
                });
            })

            //        $('.change_status_of_group').change(function(){

            // });



        });
    </script>
    <script type="text/javascript">
        //Active and incactive choices

        $(document).ready(function() {
            $(document).on('change', '.change_status_of_popup', function() {
                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                        //toastr.success(response.message);
                        console.log(response);
                    }
                });
            })

            //        $('.change_status_of_group').change(function(){

            // });



        });
    </script>


@stop
