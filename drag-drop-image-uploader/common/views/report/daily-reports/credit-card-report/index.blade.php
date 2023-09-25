@extends('adminlte::page')
@section('title', 'Super Admin | Credit Card Reporting')
@section('content_header')
@section('content')


<?php

  $credit_card_commission_report_start_date = Session::get('credit_card_commission_report_start_date');
  $credit_card_commission_report_end_date = Session::get('credit_card_commission_report_end_date');
  $credit_card_commission_report_branch_id = Session::get('credit_card_commission_report_branch_id');

 //dd($credit_card_commission_report_branch_id)
?>

    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Credit Card Commission Report</h3>

                        </div>
                        <div class="advance_filter text-right mb-3 collapse show" id="advanceOptions">
                            <div class="advance-options" style="">
                                <div class="title">
                                    <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                                </div>
                                <div class="left_option">
                                    <div class="left_inner">
                                        <h6>Select Date Range</h6>
                                        <div class="button_input_wrap">
                                            <div class="date_range_wrapper wrap-align-input">
                                                <div class="selected_branch mr-2">
                                                    <select class="form-select" name="branch" id="branch">
                                                        @foreach ($branches as $branch)
                                                            <option {{ $credit_card_commission_report_branch_id==$branch->id ? 'selected':''}}  value="{{ $branch->id }}">{{ $branch['short_name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                     <input type="hidden" id="credit_card_commission_report_filter" start_date="{{$credit_card_commission_report_start_date ==''?'':date('d/m/y',strtotime($credit_card_commission_report_start_date))}}" end_date="{{$credit_card_commission_report_end_date ==''?'':date('d/m/y',strtotime($credit_card_commission_report_end_date))}}">

                                                </div>
                                                <div class="date_range_wrapper wrap-align-input">
                                                    <i class="fas fa-calendar-alt mr-2"></i>
                                                    <input type="text" class="input-wrap" name="date_range"
                                                        placeholder="Date" autocomplete="off"/ style="width: 300px;">
                                                </div>
                                            </div>
                                            <div class="apply_reset_btn ml-2">
                                                <button class="apply apply-filter mr-1"
                                                    style="background-color: red !important;border: none;border-radius:4px;"><i
                                                        class="fas fa-paper-plane mr-2"></i>Apply</button>
                                                <button class="btn btn-primary reset-button mr-1 d-none"
                                                    id="reset_filter_btn"
                                                    style="background-color:#000000;border: none;color: #ffffff;"><i
                                                        class="fas fa-sync-alt mr-2"
                                                        style="color: #ffffff;"></i>Reset</button>
                                                @can('download_credit_card_report')
                                                    <button
                                                        class="action-button download-report download-cashdeposit btn btn-danger downloaded"
                                                        title="Download Report"
                                                        data-url="https://server3.rvtechnologies.in/MMMission22/Super-Admin/public/reports/daily-reports/sales-report/daily-sales/download"><i
                                                            class="download fa fa-download"></i></button>
                                                @endcan

                                                <div class="full_options" id="full_screen_btn">
                                                    <button
                                                        onclick="document.getElementById('table_wrapper').webkitRequestFullScreen()">Full
                                                        Screen</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table form mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <div id="table_wrapper">
                                <table style="width:100%" id="order-online-users-list"
                                    class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr id="credit_card_table_head">
                                            <th colspan="2">Card Type</th>
                                            <th colspan="3">CC AMEX
                                               {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::amex)}}
                                            </th>
                                            <th colspan="3">CC VISA
                                             {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::visa)}}
                                            </th>
                                            <th colspan="3">CC MSTER
                                              {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::master_card)}}
                                            </th>
                                            <th colspan="3">CC DINERS  {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::diner)}}

                                            </th>
                                            <th colspan="3">PAYMENT GETWAY
                                                {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::payment_getway)}}
                                             </th>
                                            <th colspan="3">DR KNET {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::k_net)}}</th>
                                            <th colspan="3">MONTH TOTAL</th>
                                        </tr>
                                        <tr>
                                            <th class="order-first align-top sorting_disabled">S.NO</th>
                                            <th class="first align-top sorting_disabled">DATE</th>
                                            <th class="first align-top sorting_disabled">Inv Day TTL</th>
                                            <th class="first align-top sorting_disabled">comm</th>
                                            <th class="first align-top sorting_disabled">After Com TTL</th>
                                            <th class="first align-top sorting_disabled">Inv Day TTL</th>
                                            <th class="first align-top sorting_disabled">comm</th>
                                            <th class="first align-top sorting_disabled">After Com TTL</th>
                                            <th class="first align-top sorting_disabled">Inv Day TTL</th>
                                            <th class="first align-top sorting_disabled">comm</th>
                                            <th class="first align-top sorting_disabled">After Com TTL</th>
                                            <th class="first align-top sorting_disabled">Inv Day TTL</th>
                                            <th class="first align-top sorting_disabled">comm</th>
                                            <th class="first align-top sorting_disabled">After Com TTL</th>
                                            <th class="first align-top sorting_disabled">Inv Day TTL</th>
                                            <th class="first align-top sorting_disabled">comm</th>
                                            <th class="first align-top sorting_disabled">After Com TTL</th>
                                            <th class="first align-top sorting_disabled">Inv Day TTL</th>
                                            <th class="first align-top sorting_disabled">comm</th>
                                            <th class="first align-top sorting_disabled">After Com TTL</th>
                                            <th class="first align-top sorting_disabled">Inv Day TTL</th>
                                            <th class="first align-top sorting_disabled">comm</th>
                                            <th class="first align-top sorting_disabled">After Com TTL</th>
                                        </tr>
                                    </thead>
                                    <tbody class="filter_date_show" id="orders_list">
                                        @include('report.daily-reports.credit-card-report.partial')
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

        .reports_rv_number:focus {
            border: 1px solid red;
            padding: 2px;
        }

        th {
            white-space: nowrap;
            padding: 12px 10px !important;
        }

        #table_wrapper {
            overflow: auto;
            background-color: white !important;
        }

        #full {
            overflow: auto;
            background-color: white !important;
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


    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#order-online-users-list').DataTable({
                "ordering": false,
                scrollY: '70vh',
                scrollCollapse: true,
                paging: false,

            });
        });


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
    </script>


    <script>
        $(document).ready(function() {

            //Check sessions.........
      var check_session_value_parent = $('#credit_card_commission_report_filter');
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


            // filter

            function filter_apply() {

                $.ajax({
                    url: "{{ route('credit.card.report.filter') }}",
                    method: 'post',
                    data: {
                        branch_id: $('#branch').val(),
                        date_range: $('input[name="date_range"]').val().split('-'),
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('response');
                        console.log(response);
                        if (response.status) {
                            $('#orders_list').html(response.data);
                            $('#credit_card_table_head').html(response.header);

                        }
                    }
                });

            }

            function branchFilter(date, reset = null) {

                $.ajax({
                    url: "{{ route('credit.card.report.filter') }}",
                    method: 'post',
                    data: {
                        branch_id: $('#branch').val(),
                        date_range: date,
                        from_filter: reset
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('response');
                        console.log(response);
                        if (response.status) {
                            $('#orders_list').html(response.data);
                            $('#credit_card_table_head').html(response.header);
                        }
                    }
                });
            }

            // $(document).on('change', '#branch', function() {
            //     branchFilter();
            // })

            $(document).on('click', '.apply-filter', function() {
                $('#reset_filter_btn').removeClass('d-none');
                filter_apply();
            })

            $(document).on('click', '.reset-button', function() {
                $('#reset_filter_btn').addClass('d-none');
                $("#branch").val($("#branch option:first").val());

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

                var date = [start, today];

                branchFilter(date,"reset");
            })


            $(document).on('click', '.download-report', function() {
                var branch_id = $('#branch').val();
                var date_range = $('input[name="date_range"]').val().split('-');

                date_range = date_range.length != 1 ? date_range : 0;

                var url = "{{ url('reports/daily-reports/credit-card-report/download') }}";
                url = url + '/' + btoa(branch_id) + '/' + btoa(date_range);
                window.location = url;
            })

        });
    </script>
@stop
