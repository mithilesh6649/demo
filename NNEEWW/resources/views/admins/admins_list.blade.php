@extends('adminlte::page')

@section('title', 'Admins')

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
                                <h3 class="mb-0">Admins</h3>

                                @can('add_admin')
                                    <a class="btn btn-sm btn-success add-advance-options" href="add">Add Admin</a>
                                @endcan
                            </div>
                            <div class="">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <table style="width:100%" id="admin-list"
                                    class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            
                                            <th>{{ __('adminlte::adminlte.email') }}</th>
                                            <th>{{ __('adminlte::adminlte.name') }}</th>
                                            <th>{{ __('adminlte::adminlte.role') }}</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Last updated at</th>

                                            @if (Gate::check('view_admin') || Gate::check('edit_admin') || Gate::check('delete_admin'))
                                                <th>{{ __('adminlte::adminlte.actions') }}</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <?php for ($i = 0; $i < count((is_countable($adminsList) ? $adminsList : [])); $i++) {
                                            $role = \App\Models\Role::where('id', $adminsList[$i]->role_id)->get();
                                            ?>
                                        <tr>
                                            
                                            <td>{{ $adminsList[$i]->email }}</td>
                                            <td>{{ ucfirst($adminsList[$i]->full_name) }}</td>
                                            <td>{{ $adminsList[$i]->role->name }}</td>
                                            @if ($adminsList[$i]->status == 1)
                                                <td style="color:green;"> <span class="active_text_success">Active</span>
                                                </td>
                                            @else
                                                <td style="color:orange;"> <span
                                                        class="inactive_text_warning">Inactive</span> </td>
                                            @endif
                                            </td>
                                            <td>{{ date('m/d/Y', strtotime($adminsList[$i]->created_at)) }}</td>
                                            <td>{{ date('m/d/Y', strtotime($adminsList[$i]->updated_at)) }}</td>
                                            @if (Gate::check('view_admin') || Gate::check('edit_admin') || Gate::check('delete_admin'))
                                                <td>

                                                    @can('view_admin')
                                                        <a class="action-button" title="View"
                                                            href="view/{{ $adminsList[$i]->id }}"><i
                                                                class="text-success fa fa-eye"></i></a>
                                                    @endcan

                                                    @can('edit_admin')
                                                        <a class="action-button" title="Edit"
                                                            href="edit/{{ $adminsList[$i]->id }}"><i
                                                                class="text-warning fa fa-edit"></i></a>
                                                    @endcan

                                                    @can('delete_admin')
                                                        <a class="action-button delete-button" title="Delete"
                                                            href="javascript:void(0)" data-id="{{ $adminsList[$i]->id }}"><i
                                                                class="text-danger fa fa-trash-alt"></i></a>
                                                    @endcan

                                                </td>
                                            @endif

                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>{{ __('adminlte::adminlte.name') }}</th>
                                            <th>{{ __('adminlte::adminlte.email') }}</th>
                                            <th>{{ __('adminlte::adminlte.role') }}</th>
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
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

@stop

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <!-- date filter -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#admin-list').DataTable({

                dom: 'Bfrtip',
                "order": [],
                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5 ]
                        },
                         title: 'Admin Details'

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5 ]
                        },
                         title: 'Admin Details'

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5 ]
                        },
                         title: 'Admin Details'

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                         title: 'Admin Details'

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Admin"
                },
                columnDefs: [{
                    targets: 0,
                    // render: function(data, type, row) {
                    //     return data.substr(0, 2);
                    // }
                }]
            });
        });

        $(document).ready(function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = mm + '/' + dd + '/' + yyyy;

            $('input[name="date_range"]').daterangepicker({
                "startDate": today,
                "endDate": today,
                "autoApply": true,
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
            $('body').on('click', '.show-advance-options', function(e) {
                e.preventDefault();
                $('.advance-options').slideToggle();
            });


        });
    </script>
    <!-- date filter -->

    <!-- my delete is my delete non of ur delete -->
    <script type="text/javascript">
        $('.delete-button').click(function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);

            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this Admin to the Recycle Bin?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_admin') }}",
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
                                    'Admin has been Deleted Successfully');

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
                    // swal("Cancelled", "Admin Data is Safe", "error");
                }
            });
        });
    </script>
    <!-- my delete is my delete non of ur delete -->
@endpush
