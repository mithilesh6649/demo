@extends('adminlte::page')

@section('title', 'Faq')

@section('content_header')


@section('content')



  <div id="flash-message" class="alert alert-success alert d-none" role="alert">
     <a href="javascript:void(0)" id="close_button" class="float-right text-white close" data-dismiss="alert" aria-label="Close">X</a>
    </div>

    <div class="container">
            <div class="col-md-12">
                <div class="card order_outer rounded_circle">
                    <div class="card-body rounded_circle table p-0 mb-0">
                        <div class="order_details">
                            <div class="card-main pt-3">
                                <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">Faq</h3>
                                    <div>
                                        <a class="btn btn-sm btn-success add-advance-options" href="add">Add Faq </a>
                                        <a class="btn btn-sm btn-success add-advance-options"
                                            href="{{route('website_pages_list')}}">{{ __('adminlte::adminlte.back') }}</a>
                                    </div>
                                </div>
                                <div class="">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <table style="width:100%" id="jobseekers-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>

                                                <th>Question</th>



                                                <th>Status</th>


                                                @can('view_user', 'edit_user')
                                                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($mobilePagesFaqList); $i++) {?>
                                            <tr>

                                                <td>{{ ucfirst($mobilePagesFaqList[$i]->question) }}</td>



                                                @if ($mobilePagesFaqList[$i]->status == 1)
                                                    <td class="text-success"><span class="active_text_success">Active</span></td>
                                                @else
                                                    <td class="text-warning"><span class="inactive_text_warning">Inactive</span></td>
                                                @endif

                                                <td>
                                                    @can('view_user')
                                                        <a class="action-button" title="View" href="view/{{ $mobilePagesFaqList[$i]->id }}"><i
                                                                class="text-success fa fa-eye"></i></a>
                                                    @endcan

                                                    @can('edit_user')
                                                        <a class="action-button" title="Edit" href="edit/{{ $mobilePagesFaqList[$i]->id }}"><i
                                                                class="text-warning fa fa-edit"></i></a>
                                                    @endcan

                                                    <a class="action-button delete-button" title="Delete" href="javascript:void(0)"
                                                        data-id="{{ $mobilePagesFaqList[$i]->id }}"><i
                                                            class="text-danger fa fa-trash-alt"></i></a>

                                                </td>
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
@stop

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#jobseekers-list').DataTable({

                // dom: 'Bfrtip',

                // buttons: [

                //     {

                //         extend: 'copyHtml5',

                //         text: '<i class="fa fa-copy mr-1"></i> Copy',

                //         titleAttr: 'Copy',

                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5]
                //         },

                //     },

                //     {

                //         extend: 'excelHtml5',

                //         text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                //         titleAttr: 'Excel',

                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5]
                //         },

                //     },

                //     {

                //         extend: 'csvHtml5',

                //         text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                //         titleAttr: 'CSV',

                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5]
                //         },

                //     },

                //     {

                //         extend: 'pdfHtml5',

                //         text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                //         titleAttr: 'PDF',

                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5]
                //         },

                //     }

                // ],
                // oLanguage: {
                //     sEmptyTable: "No User"
                // },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 50);
                    }
                }]
            });
        });
    </script>




    <!-- my delete is my delete non of ur delete -->
    <script type="text/javascript">
        $('.delete-button').click(function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);

            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this User to the Recycle Bin?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_user') }}",
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
                                obj.parent().parent().remove();

                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html(
                                    'Faq has been Deleted Successfully');

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
                    swal("Cancelled", "Faq is Safe", "error");
                }
            });
        });
    </script>
    <!-- my delete is my delete non of ur delete -->
@endpush
