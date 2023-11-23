@extends('adminlte::page')

@section('title', 'Social Links')

@section('content_header')
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
                                <h3 class="mb-0"> Social Links </h3>

                                @can('add_social_links')
                                    <a class="btn btn-sm btn-success add-advance-options" href="{{ route('add.social_media') }}">Add Social Links</a>
                                @endcan

                            </div>
                            <div class="">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <table style="width:100%" id="review-list"
                                    class="table table-bordered table-hover yajra-datatable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Profile URL</th>
                                            <th>Status</th>


                                            @if (Gate::check('view_social_links') || Gate::check('edit_social_links') || Gate::check('delete_social_links'))
                                                <th>Actions</th>
                                            @endif


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($social_links as $link)
                                            <tr>
                                                <td>{{ ucwords($link->name) ?? '--' }}</td>
                                                <td>{{ $link->social_url ?? '--' }}</td>



                                                @if ($link->status == 1)
                                                    <td class="text-success"><span class="active_text_success">Active</span>
                                                    </td>
                                                @else
                                                    <td class="text-warning"><span class="inactive_text_warning">Inactive</span>
                                                    </td>
                                                @endif


                                                @if (Gate::check('view_social_links') || Gate::check('edit_social_links') || Gate::check('delete_social_links'))
                                                    <td>

                                                        @can('view_social_links')
                                                            <a class="action-button" title="View"
                                                                href="view/{{ $link->id }}"><i
                                                                    class="text-info fa fa-eye"></i></a>
                                                        @endcan

                                                        @can('edit_social_links')
                                                            <a class="action-button" title="Edit"
                                                                href="edit/{{ $link->id }}"><i
                                                                    class="text-warning fa fa-edit"></i></a>
                                                        @endcan


                                                        @can('delete_social_links')
                                                            <a data-id="{{ $link->id }}" class="action-button delete-button"
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
            $('#review-list').DataTable({
                stateSave: true,
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data;
                    }
                }]
            });
        });


        $(document).on('click', '.delete-button', function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);

            swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete this Social Link ?",
                type: "warning",
                showCancelButton: true,

            }, function(willDelete) {

                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('delete.social_media') }}",
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
                                    'Social Link Deleted Successfully');

                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);
                            } else {

                                setTimeout(() => {
                                    swal('Error', 'Something went wrong', 'error');
                                }, 500);

                            }
                        }

                    });
                }
            });
        });
    </script>
@stop
