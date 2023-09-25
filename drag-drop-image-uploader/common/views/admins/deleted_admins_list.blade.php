@extends('adminlte::page')

@section('title', 'Super Admin | Deleted Admins')

@section('content_header')
@stop

@section('content')
    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <div class="d-flex align-items-center">
                                <h3> Deleted Admins</h3>
                            </div>
                        </div>
                        <div class="card-body table p-0 mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <!-- <div class="main-title">
                      <h5 class="text-center mb-4">Total Admins: {{ count($adminsList) }}</h5>
                      </div> -->
                            <table style="width:100%" id="admins-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>{{ __('adminlte::adminlte.email') }}</th>
                                        @if (Gate::check('restore_admin') || Gate::check('permanent_deleted_admin'))

                                            <th>{{ __('adminlte::adminlte.actions') }}</th>
                                        @endcan
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=0; $i < count((is_countable($adminsList)?$adminsList:[])); $i++) {
                        ?>
                                <tr>
                                    <td class="display-none"></td>
                                    <td>{{ $adminsList[$i]->first_name ?? 'N/A' }}</td>
                                    <td>{{ $adminsList[$i]->last_name ?? 'N/A' }}</td>
                                    <td>{{ $adminsList[$i]->email ?? 'N/A' }}</td>
                                    @if (Gate::check('restore_admin') || Gate::check('permanent_deleted_admin'))

                                        <td>
                                            @can('restore_admin')
                                                <a class="action-button restore-button" title="Restore"
                                                    href="javascript:void(0)" data-id="{{ $adminsList[$i]->id }}"><i
                                                        class="text-success fa fa-undo"></i></a>

                                            @endcan

                                            @can('permanent_deleted_admin')
                                                <a class="action-button delete-button" title=" Permanent Delete"
                                                    href="javascript:void(0)" data-id="{{ $adminsList[$i]->id }}"><i
                                                        class="text-danger fa fa-trash-alt"></i></a>
                                            @endcan
                                        </td>
                                </tr>
                            @endcan

                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>{{ __('adminlte::adminlte.name') }}</th>
                                <th>{{ __('adminlte::adminlte.email') }}</th>
                                <th>{{ __('adminlte::adminlte.actions') }}</th>
                            </tr>
                        </tfoot>
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
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#admins-list').DataTable({
            stateSave: true,
            columnDefs: [{
                targets: 0,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }]
        });
    });



    //Restore Admin.........
    $('body').on('click', '.restore-button', function(e) {

        var id = $(this).attr('data-id');
        var obj = $(this);

        swal({
            title: "Are you sure?",
            text: "Are you sure you want to restore the Admin ?",
            type: "warning",
            showCancelButton: true,
        }, function(willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('restore_admin') }}",
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(response) {

                        if (response.trim() == 'success') {

                            $("#flash-message").css("display", "block");
                            $("#flash-message").removeClass("d-none");
                            $("#flash-message").addClass("alert-success");
                            $('#flash-message').html('Admin Restore Successfully');
                            obj.parent().parent().remove();
                            setTimeout(() => {
                                $("#flash-message").addClass("d-none");
                            }, 5000);

                        } else {
                            console.log("FALSE");
                            setTimeout(() => {
                                alert("Something went wrong! Please try again.");
                            }, 500);

                        }



                    }
                });
            }
        });
    });



    //Permanent Delete Admin
    $('body').on('click', '.delete-button', function(e) {
        var id = $(this).attr('data-id');
        var obj = $(this);

        swal({
            title: "Are you sure ?",
            text: "Are you sure you want to Permanently Delete this Record ?",
            type: "warning",
            showCancelButton: true,
        }, function(willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('permanent_delete_admin') }}",
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(response) {

                        if (response.trim() == 'success') {

                            $("#flash-message").css("display", "block");
                            $("#flash-message").removeClass("d-none");
                            $("#flash-message").addClass("alert-danger");
                            $('#flash-message').html('Admin Deleted Successfully');
                            obj.parent().parent().remove();
                            setTimeout(() => {
                                $("#flash-message").addClass("d-none");
                            }, 5000);

                        } else {
                            console.log("FALSE");
                            setTimeout(() => {
                                alert("Something went wrong! Please try again.");
                            }, 500);

                        }

                    }
                });
            }
        });
    });
</script>
@stop
