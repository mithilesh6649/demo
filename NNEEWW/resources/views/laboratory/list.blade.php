@extends('adminlte::page')

@section('title', 'Destinations')

@section('content_header')


@section('content')

    <div class="container-fluid p-0">
        <div class="alert d-none" id="flash-message"></div>
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0" style="display:inline;">Laboratories</h3>
                                @can('add_laboratories')
                                    <a class="btn btn-sm btn-success add-advance-options" href="add">Add Laboratory </a>
                                @endcan
                            </div>
                            <div class="card-body main_body form p-3">
                                <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th>Opening Time</th>
                                            <th>Closing Time</th>
                                            <th>Charges ($)</th>
                                            <th>Lab Verification</th>
                                            <th>Status</th>

                                            @if (Gate::check('view_laboratories') || Gate::check('edit_laboratories') || Gate::check('delete_laboratories'))
                                                <th>Actions</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($allLaboratories as $allLaboratorie)
                                            <tr>

                                                <td>{{ $allLaboratorie->first_name ?? '--' }}
                                                    {{ $allLaboratorie->last_name ?? '--' }}</td>
                                                <td>{{ $allLaboratorie->LaboratoryMetadata->open_time ?? '--' }}</td>
                                                <td>{{ $allLaboratorie->LaboratoryMetadata->close_time ?? '--' }}</td>
                                                <td>{{ $allLaboratorie->LaboratoryMetadata->charges ?? '--' }}</td>

                                                <td>

                                                    @if ($allLaboratorie->status == 1 && @$allLaboratorie->lab_status == 7)
                                                        <i title="Verified Lab" class="fa fa-check-circle text-success"
                                                            aria-hidden="true" style="font-size:18px;"></i>
                                                    @elseif($allLaboratorie->status == 0 && @$allLaboratorie->lab_status == 8)
                                                        <i title="Rejected Laboratory"
                                                            class="fa fa-times-circle text-danger" aria-hidden="true"
                                                            style="font-size:18px;"></i>
                                                    @else
                                                        <span class="status_contain"
                                                            style="background-color:{{ @$allLaboratorie->labVerificationStatus->color ?? '--' }}">
                                                            {{ @$allLaboratorie->labVerificationStatus->name ?? '--' }}</span>

                                                        <hr>

                                                        <span class="badge badge-pill badge-warning approve_document"
                                                            data-id="{{ $allLaboratorie->id }}">Approve</span>
                                                        <span class="badge badge-pill badge-danger  reject_document"
                                                            data-id="{{ $allLaboratorie->id }}">Reject</span>
                                                    @endif


                                                </td>
                                                @if ($allLaboratorie->status == 1)
                                                    <td class="text-success"><span class="active_text_success">Active</span>
                                                    </td>
                                                @else
                                                    <td class="text-warning"><span
                                                            class="inactive_text_warning">Inactive</span></td>
                                                @endif



                                                @if (Gate::check('view_laboratories') || Gate::check('edit_laboratories') || Gate::check('delete_laboratories'))
                                                    <td>
                                                        @can('view_laboratories')
                                                            <a title="View"
                                                                href="{{ route('view_laboratory', $allLaboratorie->id) }}"><i
                                                                    class="text-success fa fa-eye"></i></a>
                                                        @endcan

                                                        @can('edit_laboratories')
                                                            <a title="Edit"
                                                                href="{{ route('edit_laboratory', $allLaboratorie->id) }}"><i
                                                                    class="text-warning fa fa-edit"></i></a>
                                                        @endcan

                                                        @can('delete_laboratories')
                                                            <a class="action-button delete-button" title="Delete"
                                                                href="javascript:void(0)"
                                                                data-id="{{ $allLaboratorie->id }}"><i
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
    </div>



@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#roles-list').DataTable({
              
                "order": [],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data;
                    }
                }]
            });
        });


        // delete
        //$('.delete-button').click(function(e) {
        $(document).on("click", ".delete-button", function() {
            var id = $(this).attr('data-id');
            var obj = $(this);

            // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to  delete this Laboratory ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_laboratory') }}",
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
                                    ' Laboratory  Deleted Successfully');
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




        $(document).ready(function() {
            //Document Approved .......  

            $(document).on('click', '.approve_document', function() {
                var btn = this;
                var getId = $(this).attr('data-id');
                //  alert(getId);  
                //  get Status TD and Actions TD
                var actionTd = btn.parentElement;
                var parentt_TR = btn.parentElement.parentElement;
                var statusTd = parentt_TR.getElementsByTagName('TD')[5];
                swal({
                    title: "Are You Sure ?",
                    text: "Do you want to Approve this lab ?",
                    type: "warning",
                    confirmButtonText: "Approve  ",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {


                        $.ajax({
                            type: "POST",
                            url: "{{ route('verify_laboratory') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": getId,
                                "action": "approve",
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status == 'success') {
                                    $(statusTd).html(
                                        '<span class="active_text_success">Active</span>'
                                        );
                                    $(actionTd).html(
                                        ' <i title="Approved Document" class="fa fa-check-circle text-success" aria-hidden="true" style="font-size:18px;"></i>'
                                        );
                                    Swal.fire(
                                        'Success',
                                        'Laboratory Approved Successfully !',
                                        'success'
                                    )
                                    //   alert(response.message);
                                }

                            }
                        });

                    }
                });
            });







            //Document Approved .......  

            $(document).on('click', '.reject_document', function() {
                var btn = this;
                var getId = $(this).attr('data-id');
                // /alert(btn);  
                //get Status TD and Actions TD
                var actionTd = btn.parentElement;
                var parentt_TR = btn.parentElement.parentElement;
                var statusTd = parentt_TR.getElementsByTagName('TD')[2];
                swal({
                    title: "Are You Sure ?",
                    text: "Do you want to Reject this Laboratory ?",
                    type: "warning",
                    confirmButtonText: "Reject",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {


                        $.ajax({
                            type: "POST",
                            url: "{{ route('verify_laboratory') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": getId,
                                "action": "reject",
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status == 'success') {
                                    // $(statusTd).html('<span class="status_contain" style="background-color:#90EE90">Approved</span>');
                                    $(actionTd).html(
                                        '   <i title="Rejected Laboratory" class="fa fa-times-circle text-danger" aria-hidden="true" style="font-size:18px;"></i>'
                                        );
                                    Swal.fire(
                                        'Success',
                                        'Laboratory Rejected Successfully !',
                                        'success'
                                    )
                                    //   alert(response.message);
                                }

                            }
                        });

                    }
                });
            });


        });
    </script>
@stop
