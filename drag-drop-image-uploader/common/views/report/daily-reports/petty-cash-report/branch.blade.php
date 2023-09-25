@extends('adminlte::page')
@section('title', 'Super Admin | Petty Cash Reporting')
@section('content_header')
@section('content')

<?php 
  
  $petty_cash_report_branch_start_date = Session::get('petty_cash_report_branch_start_date');
  $petty_cash_report_branch_end_date = Session::get('petty_cash_report_branch_end_date');
  $petty_cash_report_branch_branch_id = Session::get('petty_cash_report_branch_branch_id');

?>
 
 



    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Branch Petty Cash Reporting</h3>

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
                                                            class="advance_branch_search catselect form-select text-center"
                                                            id="branch" name="branch_id">
                                                            {{-- <option value="0">For All Branch</option> --}}
                                                            @forelse ($branches as $branch)
                                                                <option value="{{ $branch->id }}" {{ $petty_cash_report_branch_branch_id==$branch->id ? 'selected':''}}>{{ $branch->title_en }}
                                                                </option>
                                                            @empty
                                                                <option class="disabled">Branch Not Found</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="date_range_wrapper wrap-align-input">
                                                    <div class="d-block text-left">
                                                        <h6 class="d-block p-0 mb-3" style="opacity: 0;">Select Date Range
                                                        </h6>

                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt mr-2"></i>
                                                            <input type="text" class="input-wrap" name="date_range"
                                                                placeholder="Date" autocomplete="off"/
                                                                style="min-width:300px;">

                                                            <input type="hidden" id="petty_cash_report_branch_filter" start_date="{{$petty_cash_report_branch_start_date ==''?'':date('d/m/y',strtotime($petty_cash_report_branch_start_date))}}" end_date="{{$petty_cash_report_branch_end_date ==''?'':date('d/m/y',strtotime($petty_cash_report_branch_end_date))}}">       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <h6 class="d-block p-0 mb-3" style="opacity: 0;">Select Date Range</h6>
                                                <div class="apply_reset_btn">
                                                    <button class="apply apply-filter mr-1"
                                                        style="background-color: red !important;border: none;border-radius:4px;"><i
                                                            class="fas fa-paper-plane mr-2"></i>Apply</button>
                                                    <button class="btn btn-primary reset-button mr-1 d-none"
                                                        id="reset_filter_btn"
                                                        style="background-color:#000000;border: none;color: #ffffff;"><i
                                                            class="fas fa-sync-alt mr-2"
                                                            style="color: #ffffff;"></i>Reset</button>
                                                    <!--                        &nbsp;&nbsp; -->
                                                    @can('download_branch_petty_cash_report')
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


                            <div class="table-responsive" id="full">
                                <table style="width:100%;" id="order-online-users-list"
                                    class="table table-bordered table-hover yajra-datatable table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            @foreach ($categories as $category)
                                                @foreach ($category->subcategories as $subcategory)
                                                    <th class="order-first align-top sorting_disabled"
                                                        style="white-space: nowrap;padding:10px">
                                                        {{ $subcategory->sub_cat_name }}</th>
                                                @endforeach
                                            @endforeach
                                            @if (Gate::check('edit_branch_petty_cash_report') || Gate::check('delete_branch_petty_cash_report'))
                                                <!-- <th>Action</th> -->
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class=" " id="orders_list">
                                        @include('report.daily-reports.petty-cash-report.partial')
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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



        //Start date range picker code
        $(document).ready(function() {

               //Check sessions.........
      var check_session_value_parent = $('#petty_cash_report_branch_filter');
      var check_session_value_start_date = $(check_session_value_parent).attr('start_date');
      var check_session_value_end_date = $(check_session_value_parent).attr('end_date');
     if(check_session_value_start_date.length == 0){

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = dd + '/' + mm + '/' + yyyy;

            start = 01 + '/' + mm + '/' + yyyy;

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
        // filter

        function filter_apply() {
            var date_range = $('input[name="date_range"]').val().split('-');
            var branch_id = $('.advance_branch_search').val();

            // if(date_range.length == 1) return false;

            $.ajax({
                url: "{{ route('petty.cash.report.filter') }}",
                method: 'post',
                data: {
                    date_range: date_range,
                    branch_id: branch_id,
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

        $('body').on('click', '.apply-filter', function() {
            $('#reset_filter_btn').removeClass('d-none');
            filter_apply();
        });

        $('body').on('click', '.reset-button', function() {
            $('#reset_filter_btn').addClass('d-none');
            $('#branch').val("{{ $branches[0]->id }}").trigger('change.select2');

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
            var date_range = [start, today];

            $.ajax({
                url: "{{ route('petty.cash.report.filter') }}",
                method: 'post',
                data: {
                    date_range: date_range,
                    branch_id: branch_id,
                    'from_filter':'reset'
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
        })
        // filter
    </script>

    {{-- downlload report --}}
    <script>
        $(document).on('click', '.download-report', function() {
            var branch_id = $('#branch').val();
            var date_range = $('input[name="date_range"]').val().split('-');

            var url = "{{ url('reports/daily-reports/petty-cash-report/branch/download') }}";
            url = url + '/' + branch_id + '/' + btoa(date_range);
            window.location = url;
        })
    </script>

    <script type="text/javascript">
        $(".catselect").select2();
    </script>


    {{-- delete report --}}
    <script>
        // $('.delete-button').click(function(e) {
        $(document).on('click', '.delete-button', function() {
            var id = $(this).attr('data-id');
            var obj = $(this);
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this report to the Recycle Bin?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('petty.cash.report.branch.delete') }}",
                        type: 'POST',
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.status) {
                                swal("", response.message, "success");
                                obj.parent().parent().remove();
                            } else {
                                swal("", response.message, "error");
                            }
                        }
                    });
                }
            });
        });
    </script>

@stop
