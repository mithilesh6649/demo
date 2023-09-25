@extends('adminlte::page')
@section('title', 'Super Admin | Car Fule Report')
@section('content_header')
@section('content')




<?php 

$gift_cards_report_start_date = Session::get('gift_cards_report_start_datess');
$gift_cards_report_end_date = Session::get('gift_cards_report_end_datess');
$gift_cards_report_branch_id = Session::get('gift_cards_report_branch_idss');

?>

<div class="container">
    <div class="alert d-none" role="alert" id="flash-message">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-main">
                    <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                        <h3>Car Wise Fule Report</h3>

                    </div>
                    <!--start filter -->
                    <div class="advance_filter text-right mb-3 collapse show" id="advanceOptions">
                        <div class="advance-options" style="">
                            <div class="title">
                                <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                            </div>

                            <div class="left_option">
                                <div class="left_inner">
                                    <div class="button_input_wrap">
                                        <div class="date_range_wrapper wrap-align-input"> 



                                        <div class="selected_branch mr-2">
                                            <div class="d-block text-left">
                                                <label class="text-left w-100" for="city">Select Branch </label>
                                                <select
                                                class=" catselect form-select text-center"
                                                data-type="branch" id="branch" name="branch_id">

                                                @forelse ($all_active_branches as $branch)

                                                <option {{ $gift_cards_report_branch_id==$branch->id ? 'selected':''}}  value="{{ $branch->id }}"> {{$branch->short_name}}  
                                                </option>
                                                @empty
                                                <option disabled>Branch Not Found</option>
                                                @endforelse
                                            </select>
 


                                        </div>
                                    </div>


                    
                                        <div class="selected_branch mr-2">
                                            <div class="d-block text-left">
                                                <label class="text-left w-100" for="city">Select Cars </label>
                                                <select
                                                class="advance_branch_search catselect form-select text-center"
                                                data-type="branch" id="cars" name="branch_id">

                                                @forelse ($all_active_branches_cars as $all_active_branches_car)
                                                <option {{ $gift_cards_report_branch_id==$branch->id ? 'selected':''}}  value="{{ $all_active_branches_car->id }}"> {{$all_active_branches_car->model ?? ''}} ({{ $all_active_branches_car->no_plate }}) 
                                                </option>
                                                @empty
                                                <option disabled>Car Not Found</option>
                                                @endforelse
                                            </select>

                                            <input type="hidden" id="gift_cards_report_filter" start_date="{{$gift_cards_report_start_date ==''?'':date('d/m/y',strtotime($gift_cards_report_start_date))}}" end_date="{{$gift_cards_report_end_date ==''?'':date('d/m/y',strtotime($gift_cards_report_end_date))}}">


                                        </div>
                                    </div>


                                    <div class="date_range_wrapper wrap-align-input">
                                        <div class="d-block text-left">
                                            <label class="text-left" for="city">Select Date </label>
                                            <input class="input-wrap" data-type="date" type="text"
                                            id="date" name="date_range" style="min-width:300px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <h6 class="d-block p-0 mb-3" style="opacity: 0;">Select Date Range</h6>
                                    <div class="apply_reset_btn sales">
                                        <button class="apply apply-filter mr-1"
                                        style="background-color: red !important;border: none;border-radius:4px;"><i
                                        class="fas fa-paper-plane mr-2"></i>Apply</button>
                                        <button class="btn btn-primary reset-button mr-1 d-none"
                                        id="reset_filter_btn"
                                        style="background-color:#000000;border: none;color: #ffffff;"><i
                                        class="fas fa-sync-alt mr-2"
                                        style="color: #ffffff;"></i>Reset</button>
                                        <!--                        &nbsp;&nbsp; -->
                                       
                                        @can('download_car_wise_fule_report_report')
                                        <button
                                        class="action-button download-cashdeposit btn btn-danger downloaded download-report"
                                        href="javascript:void(0)" title="Download Report"><i
                                        class="download fa fa-download "></i></button>
                                        @endcan

                                        <div class="full_options" id="full_screen_btn">
                                            <button onclick="goFullScreen()">Full Screen</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!--end filter -->
            <div class="card-body table form mb-0">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
 
                <div class="card-body table form mb-0">

                    <div class="table-responsive" id="full">
                        <table id="order-online-users-list"
                        class="table table-bordered table-hover yajra-datatable">
                        <thead>
                            <tr>
                                <th style="white-space:nowrap" class="first align-top sorting_disabled">Sl.No</th>
                                <th style="white-space:nowrap" class="first align-top sorting_disabled">Date
                                </th>
                                <th style="white-space:nowrap" class="first align-top sorting_disabled">
                                Branch Name</th>
                                <th style="white-space:nowrap" class="first align-top sorting_disabled">
                                Vehicle  No</th>
                                <th style="white-space:nowrap" class="first align-top sorting_disabled">
                                Driver Name</th>
                                <th style="white-space:nowrap" class="first align-top sorting_disabled">Fule Quantity</th>
                                <th style="white-space:nowrap" class="first align-top sorting_disabled">KM</th>

                                 

                                <th style="white-space:nowrap" class="first align-top sorting_disabled"> 
                                Amount</th>

                                  <th style="white-space:nowrap" class="align-top sorting_disabled">Action</th>



                                @if (Gate::check('view_gift_card_report') || Gate::check('delete_gift_card_report'))
                                                  <!--   <th style="white-space:nowrap" class="first align-top sorting_disabled">
                                                  Actions</th> -->
                                                  @endif
                                              </tr>
                                          </thead>
                                          <tbody class=" " id="orders_list">
                                             @include('report.car-fule-reports.car-fule-partial')
                                         </tbody>
                                     </table>
                                 </div>

                                 {{--  ---- --}}
                             </div>

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
                            Document
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

     @endsection
     @section('css')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
     <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
     rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

     <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
       <link rel="stylesheet" href="{{ asset('jQuery-Plugin-For-Image-Zoom-On-Hover-picZoomer/css/jquery-picZoomer.css') }}">

     <style type="text/css">
        input[type="search"] {
            margin-bottom: 20px;
        }

        .advance_filter_right {
            text-align-last: right;
            padding-bottom: 20px;
        }

        #advanceOptions {
            text-align-last: left;
        }

        .separator {
            padding: 20px !important;
            font-size: 20px !important;
            font-weight: 600 !important;
        }

        .error {
            font-size: 12px !important;
            font-weight: 400 !important;
            color: red !important;
        }

        .date_heading {
            background-color: #fff1c5;
            border: 1px solid #ffcd00 !important;
        }

        th {
            padding: 10px 5px !important;
        }
    </style>

    <style type="text/css">
        select option:disabled {
            color: #000;
            font-weight: normal;
            background-color: #ddd;
        }

        #full {
            overflow: auto;
            background-color: white !important;
        }

        .toastr_btn {
            font-size: 15px;
            border: 1px solid;
            padding: 2px 10px;
        }

        /* .maintenance_submit {
                        margin: 20px auto 15px;
                        line-height: 0;
                        font-size: 14px;
                        padding: 20px;
                        text-transform: capitalize;
                        height: 45px;
                        font-weight: 700;
                        border-radius: 5px;
                        text-decoration: none;
                        text-align: center;
                        display: block;
                        background-color: #F43127;
                        border: 1px solid #F43127;
                        margin: 20px auto;
                    } */ 


                    .zoomContainer {
                        z-index: 9999;
                    }

                    .zoomWindow {
                        z-index: 9999;
                    }
                </style>
                @stop
                @section('js')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
                <script src='https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js'></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

                <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                  <script src="{{ asset('elevatezoom-master/jquery.elevatezoom.js') }}"></script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        var table = $('#order-online-users-list').DataTable({
                            "ordering": false,
                            scrollCollapse: true,
                            paging: true,
                        });
                    });


                    var runPixelTests = true;

                    function init() {
                        if (Element.prototype.webkitRequestFullScreen == undefined) {
                            logResult(false, "Element.prototype.webkitRequestFullScreen == undefined");
                            endTest();
                        } else {
                            waitForEventAndEnd(document, 'webkitfullscreenchange');
                            runWithKeyDown(goFullScreen);
                        }
                    }

                    function goFullScreen() {
                        document.getElementById('full').webkitRequestFullScreen();
                    }
                </script>



                <script>
                    $(document).ready(function() {

                        //Check sessions.........
                        var check_session_value_parent = $('#gift_cards_report_filter');
                        var check_session_value_start_date = $(check_session_value_parent).attr('start_date');
                        var check_session_value_end_date = $(check_session_value_parent).attr('end_date');
      //alert(check_session_value_end_date.length);
      if(check_session_value_start_date.length == 0){

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = dd + '/' + mm + '/' + yyyy;

            var start = 01 + '/' + mm + '/' + yyyy;

            $('input[name="date_range"]').daterangepicker({
                "startDate": start,
                "endDate": today,
                "autoApply": true,
                // autoUpdateInput: false,
                disableDates: ["we", "th"],
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD/MM/YYYY',
                    separator: " - "
                },
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            filter_apply();
            
        }else{

         $('input[name="date_range"]').daterangepicker({
            "startDate": check_session_value_start_date,
            "endDate": check_session_value_end_date,
            "autoApply": true,
                // autoUpdateInput: false,
                disableDates: ["we", "th"],
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD/MM/YYYY',
                    separator: " - "
                },
            });

         $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                'DD/MM/YYYY'));
        });

         $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

         $('#reset_filter_btn').removeClass('d-none');

         filter_apply();



     }

 });

                    function filter_apply() {

                        var branch_id = $('#branch').val();
                        var car_id = $('#cars').val();
                        var date = $('input[name="date_range"]').val().split('-');

                        $.ajax({
                            url: "{{ route('car.fule.report.filter') }}",
                            method: 'post',
                            data: {
                                branch_id: branch_id,
                                car_id:car_id,
                                date: date,
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log('response');
                                console.log(response);
                                if (response.status) {
                                    $('#orders_list').html(response.html);
                                }
                            }
                        });

                    }

                    $(document).ready(function() {
            // $(document).on('change', '.advance_branch_search', function() {

            //     var branch_id = $('#branch').val();
            //     var date = $('#date').val();

            //     $.ajax({
            //         url: "{{ route('gift.card.report.filter') }}",
            //         method: 'post',
            //         data: {
            //             branch_id: branch_id,
            //             date: date,
            //         },
            //         dataType: "JSON",
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(response) {
            //             console.log('response');
            //             console.log(response);
            //             if (response.status) {
            //                 $('#orders_list').html(response.html);
            //             }
            //         }
            //     });
            // });

            $(document).on('click', '.apply-filter', function() {
                $('#reset_filter_btn').removeClass('d-none');
                filter_apply();
            });

            $(document).on('click', '.reset-button', function() {
                $('#reset_filter_btn').addClass('d-none');

                 
                 $.ajax({
               type:"post",
               url:"{{route('car.fule.report.car.filter')}}",
               data:{
                 "_token": "{{ csrf_token() }}",
                 "branch_id":"{{ $all_active_branches[0]->id }}"
             },
             dataType: "JSON",
             success:function(response){
            //  $('.placed_date').html(order_placed_date);
              if(response.status) {
                 $('#cars').html(response.html);
                //  $('#quick_view_container').html(response.html);
                //  $('#myModal').modal({
                //     'show':true,
                //     backdrop: 'static',
                //     keyboard: false
                // });

             }
         }

     });   


                $('#branch').val("{{ $all_active_branches[0]->id }}").trigger('change.select2');
                $('#cars').val("{{ @$all_active_branches_car[0]->id }}").trigger('change.select2'); 
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = dd + '/' + mm + '/' + yyyy;

                var start = 01 + '/' + mm + '/' + yyyy;

                $('input[name="date_range"]').daterangepicker({
                    "startDate": start,
                    "endDate": today,
                    "autoApply": true,
                    // autoUpdateInput: false,
                    disableDates: ["we", "th"],
                    locale: {
                        cancelLabel: 'Clear',
                        format: 'DD/MM/YYYY',
                        separator: " - "
                    },
                });

                var branch_id = $('#branch').val();
                var car_id = $('#cars').val();
                var date = [start, today];

                $.ajax({
                    url: "{{ route('car.fule.report.filter') }}",
                    method: 'post',
                    data: {
                        branch_id: branch_id,
                        car_id:car_id,
                        date: date,
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('response');
                        console.log(response);
                        if (response.status) {
                            $('#orders_list').html(response.html);
                        }
                    }
                });
            });

        });
    </script>

    {{-- <script src="{{ asset('session.js') }}"></script> --}}
    {{-- <script>
        $(document).on('click', '.download-report', function() {
            var branch_id = $('#branch').val();
            var date = $('#date').val();
            var url = "{{ url('reports/daily-reports/petty-cash-report/sales-and-petty-report-download') }}";
            url = url + '/' + branch_id + '/' + btoa(date);
            window.location = url;
        })
    </script> --}}

    <script type="text/javascript">
        $(".catselect").select2();
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-button', function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to Permanently delete this report  ?",
                type: "warning",
                showCancelButton: true,

            }, function(willDelete) {

                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('gift.card.report.delete') }}",
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
                                    ' Gift Card Report Deleted  Successfully');

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

    <script>
        $(document).on('click', '.download-report', function() {
            var branch_id = $('#branch').val();
            var car_id = $('#cars').val();
            var date = $('input[name="date_range"]').val().split('-');

            if (date[0] != null && date[0] != '') {
                var url = "{{ url('reports/fule-report/car-fule-report-download') }}";
                url = url + '/' + branch_id + '/' + car_id + '/' + btoa(date);
                window.location = url;
            } else {
                toastr.options = {
                    timeOut: 0,
                    extendedTimeOut: 0,
                };

                toastr.error('Please Select Date');
            }

        })
    </script>
 
 

 <script type="text/javascript">
     $(document).ready(function(){
           $('#branch').on('change',function(){
              var branch_id = $(this).val();
              $.ajax({
               type:"post",
               url:"{{route('car.fule.report.car.filter')}}",
               data:{
                 "_token": "{{ csrf_token() }}",
                 "branch_id": branch_id
             },
             dataType: "JSON",
             success:function(response){
            //  $('.placed_date').html(order_placed_date);
              if(response.status) {
                 $('#cars').html(response.html);
                //  $('#quick_view_container').html(response.html);
                //  $('#myModal').modal({
                //     'show':true,
                //     backdrop: 'static',
                //     keyboard: false
                // });

             }
         }

     });
 
              // $('#cars').html('');
           });
      });
 </script>


<script type="text/javascript">
            $('body').on('click', '.quick_view', function(e) {

            var data_id = $(this).attr('data-id');
            

            var obj = $(this);

            $.ajax({
                type: "post",
                url: "{{ route('preview-doc-fule') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": data_id
                },
                dataType: "JSON",
                success: function(response) {
                    

                    if (response.status) {
                        $('#quick_view_container').html(response.html);
                        $('#myModal').modal({
                            'show': true,
                            // backdrop: 'static',
                            // keyboard: false
                        });
                    }

                    
                }
            });
        });


               function carso() {
            $('.carousel').carousel({
                interval: false,
            });
        }

        // setInterval(function() {
        //     carso();
        // }, 100);
        
</script>
    @stop
