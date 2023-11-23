@extends('adminlte::page')

@section('title', 'Deleted Roles')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid p-0">
            <div class="col-md-12">
                <div class="card order_outer rounded_circle">
                    <div class="card-body rounded_circle table p-0 mb-0">
                        <div class="order_details">
                            <div class="card-main pt-3">
                                <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">Deleted Roles</h3>
                                </div>
                                <div class="">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>{{ __('adminlte::adminlte.role_name') }}</th>
                                                @can('restore_roles')
                                                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i=0; $i < count($deletedRoles); $i++) { ?>
                                            <tr>
                                                <td class="display-none"></td>
                                                <td>{{ $deletedRoles[$i]->name }}</td>
                                                <td>
                                                    @can('restore_roles')
                                                        <a class="action-button restore-button" title="Restore" href="javascript:void(0)"
                                                            data-id="{{ $deletedRoles[$i]->id }}"><i
                                                                class="text-success fa fa-undo-alt"></i></a>
                                                    @endcan

                                                    @can('permanent_delete_roles')
                                                        <a class="action-button delete-button" title="Permanent Delete"
                                                            href="javascript:void(0)" data-id="{{ $deletedRoles[$i]->id }}"><i
                                                                class="text-danger fa fa-trash-alt"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            <?php } ?>
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
    <style>
        .confirm {
            background-color: #2d8427 !important;
            box-shadow: #2d8427 0px 0px 2px, rgb(0 0 0 / 5%) 0px 0px 0px 1px inset !important;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(".datatable").on("click", ".restore-button", function() {
            var id = $(this).attr('data-id');
            var obj = $(this);
            // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to Restore this record?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(willRestore) {
                if (willRestore) {
                    $.ajax({
                        url: "{{ route('restore_role') }}",
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
                                window.location.reload();
                            } else {
                                swal("Error!", response.message, "error");
                            }
                        }
                    });
                }else {
                    swal("Cancelled", "Admin Role not Restored", "error");
                }
            });
        });
        $(".datatable").on("click", ".delete-button", function() {
            var id = $(this).attr('data-id');
            var obj = $(this);
            // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to Permanently Delete this record?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('permanent_delete_role') }}",
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
                                window.location.reload();
                            } else {
                                swal("Error!", response.message, "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "Admin Role is Safe", "error");
                }
            });
        });
    </script>
@stop
