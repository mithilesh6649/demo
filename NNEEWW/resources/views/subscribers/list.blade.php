@extends('adminlte::page')

@section('title', 'Subscribers')

@section('content_header')
@stop

@section('content')
<div class="container-fluid p-0">
    <div class="col-lg-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Subscribers</h3>
                            <!-- <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> -->
                        </div>
                        <div class="">
                            <table id="pages-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>

                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Subscribed at</th>


                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php for ($i=0; $i < count($newsletters); $i++) { ?>
                                        <tr>
                                            <td>{{ $i + 1 }}</td>

                                            <td>{{ $newsletters[$i]->email }}</td>  

                                                    @if ($newsletters[$i]->status == 1)
                                                        <td style="color:green;"> <span class="active_text_success">Active</span>
                                                        </td>
                                                    @else
                                                        <td style="color:orange;"> <span
                                                                class="inactive_text_warning">Inactive</span> </td>
                                                    @endif
                                                    </td>
                                                    <td>{{ date('m/d/Y', strtotime($newsletters[$i]->created_at)) }}</td>   
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

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $('#pages-list').DataTable({

        //dom: 'Bfrtip',

        // buttons: [

        // {

        //     extend: 'copyHtml5',

        //     text: '<i class="fa fa-copy mr-1"></i> Copy',

        //     titleAttr: 'Copy',

        //     exportOptions: {
        //         columns: [0, 1, 2, 3]
        //     },

        // },

        // {

        //     extend: 'excelHtml5',

        //     text: '<i class="fa fa-file-excel mr-1"></i>Excel',

        //     titleAttr: 'Excel',

        //     exportOptions: {
        //         columns: [0, 1, 2, 3]
        //     },

        // },

        // {

        //     extend: 'csvHtml5',

        //     text: '<i class="fa fa-file-csv mr-1"></i>CSV',

        //     titleAttr: 'CSV',

        //     exportOptions: {
        //         columns: [0, 1, 2, 3]
        //     },

        // },

        // {

        //     extend: 'pdfHtml5',

        //     text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

        //     titleAttr: 'PDF',

        //     exportOptions: {
        //         columns: [0, 1, 2, 3]
        //     },

        // }

        // ],

        oLanguage: {
            sEmptyTable: "No Contact"
        },

        columnDefs: [{
            targets: 0,
            render: function(data, type, row) {
                return data.substr(0, 2);
            }
        }]
    });
</script>


<!-- update status -->
<script type="text/javascript">
    $(document).on('change', '#status', function() {

        var id = $(this).attr('data-id');
        var status = $(this).val();

        $.ajax({
            url: "#",
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log("Response", response);
                if (response.status) {
                    window.location.reload();
                } else {
                    console.log("FALSE");
                    setTimeout(() => {
                        alert("Something went wrong! Please try again.");
                    }, 500);
                }
            }
        });
    })
</script>
<!-- update status -->


<script>
    $('body').on('click', '.show-advance-options', function(e) {
        e.preventDefault();
        $('.advance-options').slideToggle();
    });
</script>
<!-- filter by status -->
@endpush
