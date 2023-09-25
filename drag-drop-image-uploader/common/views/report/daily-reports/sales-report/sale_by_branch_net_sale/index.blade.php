@extends('adminlte::page')

@section('title', 'Super Admin | Sales Reporting')

@section('content_header')

@section('content')


<?php

   $sales_by_branch_start_date = Session::get('sales_by_branch_net_start_date');
   $sales_by_branch_end_date = Session::get('sales_by_branch_net_end_date');

?>


    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Sales By Branch ( Net Sale) </h3>
                           
                        </div>

                        <div class="advance_filter text-right mb-3 ">
                            <div class="advance-options" style="">
                                <div class="title">
                                    <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                                </div>
                                <div class="left_option">
                                    <div class="left_inner">
                                        <h6>Select Date Range</h6>
                                        <div class="button_input_wrap">
                                            <div class="date_range_wrapper wrap-align-input">

                                                <i class="fas fa-calendar-alt mr-2"></i>
                                                <input type="text" class="input-wrap w-100 col-10"
                                                    style="min-width:300px" name="date_range" placeholder="Date"
                                                    autocomplete="off" />

                                            </div>

                                              <input type="hidden" id="sales_by_branch_filter" start_date="{{$sales_by_branch_start_date ==''?'':date('d/m/y',strtotime($sales_by_branch_start_date))}}" end_date="{{$sales_by_branch_end_date ==''?'':date('d/m/y',strtotime($sales_by_branch_end_date))}}">


                                            <div class="apply_reset_btn">
                                                <button class="apply apply-filter mr-1"
                                                    style="background-color: red !important;border: none;border-radius:4px;"><i
                                                        class="fas fa-paper-plane mr-2"></i>Apply</button>
                                                <button class="btn btn-primary reset-button mr-1 d-none"
                                                    id="reset_filter_btn"
                                                    style="background-color:#000000;border: none;color: #ffffff;"><i
                                                        class="fas fa-sync-alt mr-2"
                                                        style="color: #ffffff;"></i>Reset</button>

                                                <!--  &nbsp;&nbsp; -->
                                                @can('download_sales_by_branch_net_sale_report')
                                                    <button class="action-button download-cashdeposit btn btn-danger downloaded"
                                                        title="Download Report"
                                                        data-url="{{ route('sales-by-branch-net-sale.download') }}"><i
                                                            class="download fa fa-download"></i></button>
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

                        <div class="card-body table form full_wrap mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="table-responsive" id="full">
                                <table style="width:100%" id="order-online-users-list"
                                    class="table table-bordered table-hover yajra-datatable">
                                    <thead>

                                              {!! $html_design !!}


                                        <tr>
                                            <!-- <th class="order-first align-top sorting_disabled">S.No</th> -->
                                             <td class="d-none">Key</td>
                                            <th class="order-first align-top sorting_disabled headdisn"
                                                style="white-space: nowrap; padding-left:5px;padding-right: 5px;padding-bottom:10px;padding-top: 10px;">
                                                Date</th>
                                            <th class="order-first align-top sorting_disabled headdisn"
                                                style="white-space: nowrap; padding-left:5px;padding-right: 5px;padding-bottom:10px;padding-top: 10px;">
                                                Day</th>
                                            @forelse($branch as $branch_name)
                                                <th class="align-top sorting_disabled headdisn"
                                                    style="white-space: nowrap; padding-left:5px;padding-right: 5px;padding-bottom:10px;padding-top: 10px;">
                                                    {{ $branch_name }}</th>
                                            @empty
                                            @endforelse
                                            <th class="order-first align-top sorting_disabled headdisn"
                                                style="white-space: nowrap; padding-left:5px;padding-right: 5px;padding-bottom:10px;padding-top: 10px;">
                                                Total</th>


                                            <!-- <th class="first align-top sorting_disabled">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="filter_date_show" id="orders_list">

                                    @include('report.daily-reports.sales-report.sale_by_branch_net_sale.partial')

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
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style type="text/css">
        select option:disabled {
            color: #000;
            font-weight: normal;
            background-color: #ddd;
        }

        .dataTables_wrapper {
            display: block;
        }

        .headdisn {
            white-space: nowrap;
            padding-left: 5px;
            padding-right: 5px;
            padding-bottom: 10px;
            padding-top: 10px;
        }


        #full {
            overflow: auto;
            background-color: white !important;
        }

        .reports_rv_number:focus {
            border: 1px solid red;
            padding: 2px;
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
    <script src="https://momentjs.com/downloads/moment.js"></script>



    <script>
        var runPixelTests = true;

        function init() {
            // Bail out early if the full screen API is not enabled or is missing:
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

        $(document).ready(function() {

              var check_session_value_parent = $('#sales_by_branch_filter');
              var check_session_value_start_date = $(check_session_value_parent).attr('start_date');
              var check_session_value_end_date = $(check_session_value_parent).attr('end_date');
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
            var date_range = $('input[name="date_range"]').val().split('-');

            $.ajax({
                url: "{{ route('sales-by-branch-net-sale.filter') }}",
                method: "POST",
                data: {
                    'date_range': date_range,

                },
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    $('#order-online-users-list').DataTable().clear().destroy();
                     $('#show_total_amt').html(response.html_design);
                    $('#orders_list').html(response.html);
                    $('#order-online-users-list').DataTable({
                       "order":    [[ 0, "DESC" ]],
                       // "ordering": false,
                        scrollResize: true,
                        scrollY: '70vh',
                        scrollCollapse: true,
                        paging: false,
                    });
                }
            });

        }

        $(document).ready(function() {

            $('#order-online-users-list').DataTable({
               "order":    [[ 0, "DESC" ]],
               // "ordering": false,
                scrollResize: true,
                scrollY: '70vh',
                scrollCollapse: true,
                paging: false,
            });

            $('.download-cashdeposit').on('click', function() {
                var date_range = $('input[name="date_range"]').val();

                if (date_range != "") {
                    date_range = date_range.split('-');
                    var url = $(this).attr('data-url') + "/" + date_range[0].replaceAll('/', '-')
                        .replaceAll(' ', '') + "/" + date_range[1].replaceAll('/', '-').replaceAll(' ', '');

                    window.location.href = url;
                } else {
                    var date = new Date();
                    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                    let start = moment(firstDay).format('DD-MM-YYYY');
                    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                    let end = moment(lastDay).format('DD-MM-YYYY');
                    var url = $(this).attr('data-url') + "/" + start + "/" + end;

                    window.location.href = url;
                }

            });


            $('.apply-filter').on('click', function(e) {
                $('#reset_filter_btn').removeClass('d-none');
                filter_apply();
            });

            $('.reset-button').on('click', function(e) {

                e.preventDefault();
                $('#reset_filter_btn').addClass('d-none');

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

                var date_range = [start, today];

                $.ajax({
                    url: "{{ route('sales-by-branch-net-sale.filter') }}",
                    method: "POST",
                    data: {
                        'date_range': date_range,
                        'from_filter': "reset"
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        $('#order-online-users-list').DataTable().clear().destroy();
                        $('#show_total_amt').html(response.html_design);
                        $('#orders_list').html(response.html);
                        $('#order-online-users-list').DataTable({
                           "order":    [[ 0, "DESC" ]],
                           // "ordering": false,
                            scrollResize: true,
                            scrollY: '70vh',
                            scrollCollapse: true,
                            paging: false,
                        });

                    }
                });
            });
        });
    </script>
@stop
