@extends('adminlte::page')

@section('title', 'Super Admin | Gift Cards')

@section('content_header')

@section('content')
    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message"></div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Gift Cards</h3>
                            <div class="d-flex align-items-center">
                                @can('add_gift_card')
                                    <a class="btn btn-sm btn-success gift-card" href="{{ route('gift.card.add') }}">Add Gift
                                        Cards</a>
                                @endcan

                                @can('delete_gift_card')
                                    <a href="#" data-toggle="collapse" data-target="#advanceOptions"
                                        class="advance-option-margin show-advance-options ml-2">Bulk Action<i
                                            class="fa fa-caret-down"></i></a>
                                @endcan
                            </div>
                        </div>

                        <div class="advance_filter mb-3 collapse" id="advanceOptions">
                            <div class="advance-options" style="">
                                <div class="title">
                                    <h5><i class="fa fa-filter mr-1"></i>Select Batch </h5>
                                </div>
                                <div class="left_option">
                                    <div class="left_inner">
                                        <h6>Select Date Range</h6>
                                        <div class="button_input_wrap">
                                            <div class="date_range_wrapper wrap-align-input">
                                                <i class="fas fa-calendar-alt mr-2"></i>
                                                <select class="form-control mr-2" id="badge_select">
                                                    <option value="select_badge">Select Batch</option>
                                                    @forelse ($all_badges as $all_badge)
                                                        <option value="{{ $all_badge->badge }}">{{ $all_badge->badge }}
                                                        </option>
                                                    @empty
                                                        <option disabled>No Batch</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="apply_reset_btn">
                                                <button class="apply apply-filter mr-1"
                                                    style="background-color: red !important;border: none;border-radius:4px;"><i
                                                        class="fa fa-trash-alt mr-2"
                                                        style="color: #ffffff;"></i>Delete</button>
                                                <button class="btn btn-primary reset-button"
                                                    style="background-color:#000000;border: none;color: #ffffff;"><i
                                                        class="fas fa-sync-alt mr-2"
                                                        style="color: #ffffff;"></i>Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="card-body table p-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table class="table table-bordered" id="users-table">
                                <thead>

                                    <tr>
                                        <th>Card Number</th>
                                        <th>Batch</th>
                                        <th>Type</th>
                                        <th>Title {{ labelEnglish() }} </th>
                                        <th>Is Gift Card Used</th>


                                        <th>Status</th>

                                        <th>{{ __('adminlte::adminlte.actions') }}</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="myModal" class="modal  fade  " role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <div>
                            Used Gift Card Details
                        </div>

                    </h4>
                </div>
                <div class="modal-body">

                    <!--start container -->
                    <div class="model-back container-fluid" id="quick_view_container">



                    </div>

                    <!--end container -->

                </div>

            </div>

        </div>
    </div>

    <!--end modal -->

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> -->

    <style type="text/css">
        .ui-sortable-helper {
            display: table;
        }
    </style>

@stop

@section('js')
    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
          <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
           -->

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('gift.card.list.data') !!}',
                columns: [{
                        data: 'card_number',
                        name: 'card_number'
                    },
                    {
                        data: 'badge',
                        name: 'badge'
                    },
                    {
                        data: 'statusType',
                        name: 'statusType'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'IsCardUsed',
                        name: 'IsCardUsed'
                    },
                    {
                        data: 'statusActive',
                        name: 'status',
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: true
                    },



                ]
            });
        });
    </script>




    <script type="text/javascript">
        //Change Status

        $(document).on('click', '.apply-filter', function() {

            var badge_select = $('#badge_select').val();

            if (badge_select.trim() != 'select_badge') {

                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete this batch all Gift Cards ?",
                    type: "warning",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {
                        $.ajax({
                            type: 'post',
                            url: "{{ route('gift.card.bulk.delete') }}",
                            data: {
                                id: badge_select
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html('Gift Card Deleting......');
                            },
                            success: function(response) {
                                console.log("Response", response);
                                if (response.success == 1) {
                                    $("#flash-message").css("display", "block");
                                    $("#flash-message").removeClass("d-none");
                                    $("#flash-message").addClass("alert-danger");
                                    $('#flash-message').html('Gift Card Deleted Successfully');

                                    setTimeout(() => {
                                        $("#flash-message").addClass("d-none");
                                        location.reload();
                                    }, 5000);
                                } else {
                                    console.log("FALSE");
                                    setTimeout(() => {
                                        swal('Error', 'Something went wrong', 'error');
                                        // alert("Something went wrong! Please try again.");
                                    }, 500);
                                }
                            }
                        });
                    }
                });

            }


        });




        $(document).on('click', '.reset-button', function() {

            var badge_select = $('#badge_select').val('select_badge');



        });





        $(document).on('click', '.delete-button', function(e) {
            var id = $(this).attr('data-id');

            var obj = $(this);

            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this Gift Card to the Recycle Bin?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('gift.card.delete') }}",
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
                                $('#flash-message').html('Gift Card Deleted Successfully');
                                obj.parent().parent().remove();
                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);
                            } else {
                                console.log("FALSE");
                                setTimeout(() => {
                                    swal('Error', 'Something went wrong', 'error');
                                    // alert("Something went wrong! Please try again.");
                                }, 500);
                            }
                        }
                    });
                }
            });
        });




        $(document).on('change', '.change_status_of_cards', function() {
            var obj = $(this)[0];
            var id = $(this).data("id");
            var status_value = $(this).prop('checked') == true ? 1 : 0;
            var parentElementTR = obj.parentElement.parentElement.parentElement;
            var CurrentTD = parentElementTR.getElementsByTagName('TD')[5];

            $.ajax({
                type: "post",
                url: "{{ route('gift.card.status.change') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    status_value: status_value,
                },

                success: function(response) {
                    if (response.status == "success") {
                        $(CurrentTD).html(response.message);
                        // alert(response.message);
                    }
                    toastr.success(response.message);
                    console.log(response);
                }
            });

        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {


            $('body').on('click', '.quick_view', function(e) {

                // $('#myModal').modal({
                //    'show':true,
                //    backdrop: 'static',
                //    keyboard: false
                //  });

                var used_card_number = $(this).attr('data-card-id');



                var obj = $(this);

                $.ajax({
                    type: "post",
                    url: "{{ route('gift.card.used.details') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": used_card_number
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);

                        if (response.status) {

                            var design = `
             <div class="order_modal">
   <div class="row">
      <div class="col-md-12">
        <div class="card p-3">
          <div class="d-flex">

            <div class="card-body table p-0 mb-0" style="padding: 0 !important;">
               <div class="mb-0">
                  <label class="text-dark">Card Number</label> :- <span class="">` + response.card_number + `</span>
               </div>
               <div class="mb-0">
                  <label class="text-dark">Branch Name</label> :- <span class="">` + response.branch_name + `</span>
               </div>

                 <div class="mb-0">
                  <label class="text-dark">Card Used Date</label> :- <span class="">` + response.used_date + `</span>
               </div>

            </div>
          </div>
        </div>
      </div>
   </div>
</div>


           `;

                            $('#quick_view_container').html(design);
                            $('#myModal').modal({
                                'show': true,
                                // backdrop: 'static',
                                // keyboard: false
                            });

                        }
                    }

                });

            });


        });
    </script>
@stop
