@extends('adminlte::page')

@section('title', 'Nutritionist')

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
                                <h3 class="mb-0">Nutritionists</h3>
                                @can('add_nutritionist')
                                    <a class="btn btn-sm btn-success add-advance-options" href="add">Add Nutritionist </a>
                                @endcan
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

                                            <th>Name</th>

                                            <th>{{ __('adminlte::adminlte.email') }}</th>
                                            <th>Phone number</th>
                                            <th>Reviews</th>
                                            <th>Status</th>

                                            @if (Gate::check('view_nutritionist') || Gate::check('edit_nutritionist') || Gate::check('delete_nutritionist'))
                                                <th>{{ __('adminlte::adminlte.actions') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($NutritionistsList); $i++) {?>
                                        <tr>

                                            <td>{{ ucfirst($NutritionistsList[$i]->name) }}

                                            </td>

                                            <td>{{ $NutritionistsList[$i]->email ?? '--' }}</td>
                                            <td>
                                                @if (!empty($NutritionistsList[$i]->phone_number))
                                                    (+{{ $NutritionistsList[$i]->country_code }}){{ $NutritionistsList[$i]->phone_number }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>


                                                @for ($j = 0; $j < 5; $j++)
                                                    @if (floor(@$NutritionistsList[$i]->review->avg_rating) > $j)
                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star text-warning" aria-hidden="true"
                                                            style="color:#d5d5d5 !important;"></i>
                                                    @endif
                                                @endfor
                                                (
                                                {{ \App\Models\ReviewComment::TotalReviews(@$NutritionistsList[$i]->review->id) }}
                                                )

                                            </td>
                                            @if ($NutritionistsList[$i]->UserAction == null)
                                                <td class="text-success"><span class="active_text_success">Active</span>
                                                </td>
                                            @else
                                                <td class="text-warning"><span class="inactive_text_warning">Inactive</span>
                                                </td>
                                            @endif

                                            @if (Gate::check('view_nutritionist') || Gate::check('edit_nutritionist') || Gate::check('delete_nutritionist'))
                                                <td>
                                                    @can('view_nutritionist')
                                                        <a class="action-button" title="View"
                                                            href="view/{{ $NutritionistsList[$i]->id }}"><i
                                                                class="text-success fa fa-eye"></i></a>
                                                    @endcan

                                                    @can('edit_nutritionist')
                                                        <a class="action-button" title="Edit"
                                                            href="edit/{{ $NutritionistsList[$i]->id }}"><i
                                                                class="text-warning fa fa-edit"></i></a>
                                                    @endcan

                                                    @can('delete_nutritionist')
                                                        <a class="action-button delete-button" title="Delete"
                                                            href="javascript:void(0)"
                                                            data-id="{{ $NutritionistsList[$i]->id }}"><i
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

                dom: 'Bfrtip',
                "order": [],

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        title: 'Nutritionist Details'

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        title: 'Nutritionist Details'

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        title: 'Nutritionist Details'

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        title: 'Nutritionist Details'

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No User"
                },
                columnDefs: [{
                    targets: 0,
                    // render: function(data, type, row) {
                    //     return data.substr(0, 2);
                    // }
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
                closeOnCancel: true
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_nutritionist') }}",
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
                                    'Nutritionist has been Deleted Successfully');

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
                    //swal("Cancelled", "Nutritionist is Safe", "error");
                }
            });
        });
    </script>
    <!-- my delete is my delete non of ur delete -->
@endpush
