@extends('adminlte::page')

@section('title', 'Super Admin | Test Reports')

@section('content_header')

@section('content')

<div class="container-fluid p-0">
    <div class="alert d-none" role="alert" id="flash-message">
    </div>
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0"> Genetic Test </h3>


                        </div>
                        <div class="">
                            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th>User ID</th>
                                        <th style="max-width:max-width: 200px;">Purchased Test</th>
                                        <!-- <th>Status</th> -->

                                        <!-- <th>Assign</th> -->
                                        <th>Upload Report</th>

                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allTickets as $allTicket)
                                    <tr>

                                        <td class="display-none"></td>
                                        <td> GHX -{{ $allTicket->ticket_owner_id ?? '--' }}</td>

                                        <td>
                                            @forelse($allTicket->userTest as $allUserTest)
                                            @if ($allUserTest->test_done == 1)
                                            <span class="badge badge-pill badge-white border"
                                            title="Report  Uplaoded "> {{ @$allUserTest->test->name }}
                                            <i class="fa fa-check" style="color:#379911;"
                                            title="Report Uplaoded "></i> </span>
                                            @else
                                            <span class="badge badge-pill badge-white border"
                                            title="Report Not Uplaoded Yet">
                                            {{ @$allUserTest->test->name }}</i> <i
                                            class="fa fa-times text-danger"
                                            aria-hidden="true"></i></span>
                                            @endif

                                            @empty
                                            <span class="badge badge-pill badge-dark">N/A</span>
                                            @endforelse

                                        </td>

                                        <!-- @if ($allTicket->status->slug == 'ticket_closed')
                                        <td id="yes-{{ $allTicket->id }}">
                                            <span class="active_text_success">Assigned</span>
                                        </td>
                                        @else
                                        <td id="not-{{ $allTicket->id }}">
                                            <span class="inactive_text_warning">Not Assigned</span>
                                        </td>
                                        @endif -->


                                       
                                  <!--       <td>
                                            <select class="form-control NutritionistSelect"
                                            data-id="{{ $allTicket->id }}">
                                            <option
                                            {{ $allTicket->ticket_assigned_to != null ? 'disabled' : '' }}>
                                        Assign to Nutritionist</option>
                                        @forelse($allNutritionists  as $allNutritionist)
                                        <option
                                        {{ $allTicket->ticket_assigned_to == $allNutritionist->id ? 'selected' : '' }}
                                        value="{{ $allNutritionist->id }}">
                                        {{ $allNutritionist->name }}</option>
                                        @empty
                                        <option disabled>Nutritionist Not Found</option>
                                        @endforelse

                                    </select>
                                </td> -->
                                <td  id="upload-icon-{{ $allTicket->id }}" transaction-id="{{@$allTicket->payment_transation_id }}">
                                    
                                    <i class="fa fa-upload upload_user_reports"
                                    title="Upload Reports"
                                    transaction-id="{{ @$allTicket->payment_transation_id }}"></i>
                                    
                                </td>
                                <td>
                                    {{ date('m/d/Y h:i A', strtotime($allTicket->created_at)) }} <br>
                                    {{ $allTicket->created_at->diffForHumans() }}
                                </td>
                                 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Upload Test Report For</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{ route('upload_reports_data') }}" enctype="multipart/form-data">
            <div class="modal-body" id="quick_view_container">

                <!-- oooooooo -->



                <!-- 00000000 -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Uplaod</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $('#pages-list').DataTable({
        columnDefs: [{
            targets: 0,
            render: function(data, type, row) {
                return data.substr(0, 2);
            }
        }]
    });


        // delete
        //$('.delete-button').click(function(e) {
    $(document).on("click", ".delete-button", function() {
        var id = $(this).attr('data-id');
        var obj = $(this);

            // console.log({id});
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to  delete this exercise ?",
            type: "warning",
            showCancelButton: true,
        }, function(willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('delete_exercise') }}",
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
                                ' Exercise  Deleted Successfully');
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
</script>
<script type="text/javascript">
        //Active and incactive choices

    $(document).ready(function() {
        $(document).on('change', '.NutritionistSelect', function() {

            var id = $(this).data("id");
            var nutritionist_id = $(this).val();
            var getTransactionId =  $('#upload-icon-' + id).attr('transaction-id');


            if (nutritionist_id != '') {
                $.ajax({
                    type: "post",
                    url: "{{ route('assign_reports') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        nutritionist_id: nutritionist_id,
                    },
                    success: function(response) {
                        toastr.success('Test Report assigned Successfully');
                        $('#not-' + id).html(
                            ' <span  class="active_text_success">Assigned</span>');
                        $('#upload-icon-' + id).html(`<i class="fa fa-upload upload_user_reports" title="Upload Reports" transaction-id="`+getTransactionId+`"></i>`);    
                            //console.log(response);
                    }
                });
            }
        });




    });

    $(".NutritionistSelect").select2();
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.upload_user_reports', function() {
            $('#exampleModalCenter').modal('show');
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '.upload_user_reports', function(e) {
            $('#exampleModalCenter').modal({
                'show': true,
                backdrop: 'static',
                keyboard: false
            });

            var transaction_id = $(this).attr('transaction-id');
            var obj = $(this);

            $.ajax({
                type: "post",
                url: "{{ route('get_reports_data') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "transaction_id": transaction_id
                },
                dataType: "JSON",
                success: function(response) {
                    // alert(response);
                    if (response.status) {
                        $('#quick_view_container').html(response.html);
                        $('#myModal').modal({
                            'show': true,
                            backdrop: 'static',
                            keyboard: false
                        });
                    }
                }
            });
        });
    });
</script>

@stop
