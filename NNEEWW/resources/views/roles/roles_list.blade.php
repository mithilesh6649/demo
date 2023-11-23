@extends('adminlte::page')

@section('title', 'Roles')

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
                                    <h3 class="mb-0">{{ __('adminlte::adminlte.roles') }}</h3>
                                    @can('add_role')
                                        <a class="btn btn-sm btn-success add-advance-options" href="add">Create New Role</a>
                                    @endcan
                                </div>
                                <div class="">
                                    <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>{{ __('adminlte::adminlte.name') }}</th>

                                                @can('view_role', 'edit_role', 'delete_role')
                                                    <th>Actions</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i=0; $i < count($roles); $i++) { ?>
                                            <tr>
                                                <th class="display-none"></th>
                                                <td>{{ $roles[$i]->name }}</td>

                                                <td>
                                                    @can('view_role')
                                                        <a href="{{ route('view_role', ['id' => $roles[$i]->id]) }}" title="View"><i
                                                                class="text-success fa fa-eye"></i></a>
                                                    @endcan

                                                    @can('edit_role')
                                                        <a title="Edit" href="{{ route('edit_role', ['id' => $roles[$i]->id]) }}"><i
                                                                class="text-warning fa fa-edit"></i></a>
                                                    @endcan

                                                    @can('delete_role')
                                                        <a class="action-button delete-button" title="Delete" href="javascript:void(0)"
                                                            data-id="{{ $roles[$i]->id }}"><i class="text-danger fa fa-trash-alt"></i></a>
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
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $('.delete-button').click(function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this Role to the Recycle Bin?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_role') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                obj.parent().parent().remove();
                            } else {
                                console.log(response);
                                setTimeout(() => {
                                    swal("Warning!", response.message, "warning");
                                }, 500);
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
