@extends('adminlte::page')

@section('title', 'Deleted Specialization')

@section('content_header')
@stop

@section('content')

<div id="flash-message" class="alert alert-success alert d-none" role="alert">
    <a href="javascript:void(0)" id="close_button" class="float-right text-white close" data-dismiss="alert"
    aria-label="Close">X</a>
</div>

<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Deleted Specialization</h3>
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
                                        <th>{{ __('adminlte::adminlte.name') }}</th>



                                        @if (Gate::check('restore_specialization') || Gate::check('permanent_deleted_specialization')  )
                                        <th>Actions</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count((is_countable($Specialization) ? $Specialization : [])); $i++) {?>
                                        <tr>
                                            <td class="display-none"></td>
                                            <td>{{ $Specialization[$i]->name }}</td>
                                            
                                            @if (Gate::check('restore_specialization') || Gate::check('permanent_deleted_specialization')  )
                                            <td>
                                                @can('restore_specialization')
                                                <a class="action-button restore-button" title="Restore" href="javascript:void(0)"
                                                data-id="{{ $Specialization[$i]->id }}"><i
                                                class="text-success fa fa-undo-alt"></i></a>
                                                @endcan


                                                @can('permanent_deleted_specialization')
                                                <a class="action-button delete-button" title="Permanent Delete"
                                                href="javascript:void(0)" data-id="{{ $Specialization[$i]->id }}"><i
                                                class="text-danger fa fa-trash-alt"></i></a>
                                                @endcan

                                            </td>
                                            @endif
                                        </tr>
                                    <?php }?>
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
<script type="text/javascript">
    $(".datatable").on("click", ".restore-button", function() {
        var id = $(this).attr('data-id');
        var obj = $(this);
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to Permanent Restore this record?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: true,
            closeOnCancel: false
        }, function(willRestore) {
            if (willRestore) {
                $.ajax({
                    url: "{{ route('restore_specializations') }}",
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

                            $("#flash-message").css("display", "block");
                            $("#flash-message").removeClass("d-none");
                            $("#flash-message").addClass("alert-danger");
                            $('#flash-message').html(
                                'Specializations has been Restored Successfully');

                            setTimeout(() => {
                                $("#flash-message").addClass("d-none");
                            }, 5000);


                        } else {
                            console.log("FALSE");
                            swal("Error!", "Something went wrong! Please try again.",
                                "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Specializations not Restored", "error");
            }
        });
    });
    $(".datatable").on("click", ".delete-button", function() {
        var id = $(this).attr('data-id');
        var obj = $(this);
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
                    url: "{{ route('permanent_delete_specializations') }}",
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

                            $("#flash-message").css("display", "block");
                            $("#flash-message").removeClass("d-none");
                            $("#flash-message").addClass("alert-danger");
                            $('#flash-message').html(
                                'Specializations has been Deleted Successfully');

                            setTimeout(() => {
                                $("#flash-message").addClass("d-none");
                            }, 5000);


                        } else {
                            console.log("FALSE");
                            swal("Error!", "Something went wrong! Please try again.",
                                "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Specializations is Safe", "error");
            }
        });
    });
</script>
@stop
