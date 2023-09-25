@extends('adminlte::page')
@section('title', 'Super Admin | Maintenance Report')
@section('content_header')
@section('content')


    <?php

    $maintenance_reports_start_date = Session::get('maintenance_reports_start_date');
    $maintenance_reports_end_date = Session::get('maintenance_reports_end_date');
    $maintenance_reports_branch_id = Session::get('maintenance_reports_branch_id');

    ?>



    <div class="rightside_content">
        <div class="container-fluid p-0">
            <div class="alert d-none" role="alert" id="flash-message">
            </div>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card order_outer rounded_circle">
                        <div class="card-body rounded_circle table p-0 mb-0" style="padding: 0 !important;">
                            <div class="order_details">
                                <div class="card-main">
                                    <div class="tabs_header">
                                        <div class="tab-content">
                                            <div class="tab-pane toptab active" id="dailyTabs-1" role="tabpanel">
                                                <!-- start section one -->

                                                <div
                                                    class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                                                    <h3 class="mb-0">Maintenance Reports</h3>
                                                </div>

                                                <!--start filter -->

                                                <div class="advance_filter text-right mb-3">
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
                                                                                <label class="text-left w-100"
                                                                                    for="city">Select Branch </label>
                                                                                <select
                                                                                    class="advance_branch_search catselect form-select text-center"
                                                                                    data-type="branch" id="branch"
                                                                                    name="branch_id">

                                                                                    @forelse ($all_active_branches as $branch)
                                                                                        <option
                                                                                            {{ $maintenance_reports_branch_id == $branch->id ? 'selected' : '' }}
                                                                                            value="{{ $branch->id }}">
                                                                                            {{ $branch->title_en }}
                                                                                        </option>
                                                                                    @empty
                                                                                        <option disabled>Branch Not Found
                                                                                        </option>
                                                                                    @endforelse
                                                                                </select>


                                                                                <input type="hidden"
                                                                                    id="maintenance_reports_filter"
                                                                                    start_date="{{ $maintenance_reports_start_date == '' ? '' : date('d/m/y', strtotime($maintenance_reports_start_date)) }}"
                                                                                    end_date="{{ $maintenance_reports_end_date == '' ? '' : date('d/m/y', strtotime($maintenance_reports_end_date)) }}">



                                                                            </div>
                                                                        </div>

                                                                        <div class="date_range_wrapper wrap-align-input">
                                                                            <div class="d-block text-left">
                                                                                <label class="text-left"
                                                                                    for="city">Select Date </label>
                                                                                <input type="text"
                                                                                    class="input-wrap w-100 col-10"
                                                                                    id="date" name="date_range"
                                                                                    placeholder="Date" autocomplete="off"
                                                                                    style="min-width:200px;" />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="w-100">
                                                                        <h6 class="d-block p-0 mb-3" style="opacity: 0;">
                                                                            Select Date Range</h6>
                                                                        <div class="apply_reset_btn sales">
                                                                            <button class="apply apply-filter mr-1"
                                                                                style="background-color: red !important;border: none;border-radius:4px;"><i
                                                                                    class="fas fa-paper-plane mr-2"></i>Apply</button>
                                                                            <button
                                                                                class="btn btn-primary reset-button mr-1 d-none"
                                                                                id="reset_filter_btn"
                                                                                style="background-color:#000000;border: none;color: #ffffff;"><i
                                                                                    class="fas fa-sync-alt mr-2"
                                                                                    style="color: #ffffff;"></i>Reset</button>

                                                                                @can('download_maintenance_report')  
                                                                            <button
                                                                                class="action-button download-cashdeposit btn btn-danger downloaded download-report"
                                                                                href="javascript:void(0)"
                                                                                title="Download Report"><i
                                                                                    class="download fa fa-download "></i></button>
                                                                              @endcan  



                                                                            <div class="full_options" id="full_screen_btn">
                                                                                <button onclick="goFullScreen()">Full
                                                                                    Screen</button>
                                                                            </div>

                                                                              <button
                                                                                class="btn download-report-pdf mr-2" style="background-color: red;border: none;"
                                                                                href="javascript:void(0)"
                                                                                title="Download Report In PDF Format"><i
                                                                                    class="download fa fa-download "></i></button> 

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!--end filter -->

                                                <div class="card-body table form mb-0">

                                                    {{-- Table  --}}

                                                    <div class="table-responsive" id="full">

                                                        {{-- opening and closing balance --}}

                                                        <div class="closing_balance">
                                                            @include('report.maintenance-reports.closing_balance_partial')
                                                        </div>

                                                        {{-- opening and closing balance --}}

                                                        <table id="order-online-users-list"
                                                            class="table table-bordered table-hover yajra-datatable">
                                                            <thead>
                                                                <tr>
                                                                <tr>
                                                                    <th style="white-space:nowrap"
                                                                        class="first align-top sorting_disabled">
                                                                        Category
                                                                    </th>
                                                                    <th style="white-space:nowrap"
                                                                        class="first align-top sorting_disabled">Sub
                                                                        Category</th>
                                                                    <th style="white-space:nowrap"
                                                                        class="first align-top sorting_disabled">Invoice
                                                                        Number
                                                                    </th>
                                                                    <th style="white-space:nowrap"
                                                                        class="first align-top sorting_disabled">Voucher
                                                                        Number
                                                                    </th>
                                                                    <th style="white-space:nowrap"
                                                                        class="first align-top sorting_disabled">Amount
                                                                    </th>
                                                                    <th style="white-space:nowrap"
                                                                        class="first align-top sorting_disabled">
                                                                        Attachment
                                                                    </th>
                                                                    {{-- @if (Gate::check('view_maintenance_report') || Gate::check('delete_maintenance_report')) --}}
                                                                    <th style="white-space:nowrap"
                                                                        class="first align-top sorting_disabled">
                                                                        Action
                                                                    </th>
                                                                    {{-- @endif --}}
                                                                </tr>
                                                                </tr>
                                                            </thead>
                                                            <tbody class=" " id="orders_list">
                                                                @include('report.maintenance-reports.maintenance-partial')
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
                            Invoice Number : <span class="invoice_number"></span> || Doc Ref No : <span
                                class="doc_ref_no"></span> || Amount : <span class="amount"> </span>
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
       <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        //  For View Document //

        $('body').on('click', '.quick_view', function(e) {

            var data_id = $(this).attr('data-id');
            var invoice_num = $(this).attr('data-invoice');
            var data_doc = $(this).attr('data-doc-ref');
            var data_amount = $(this).attr('data-amount');

            var obj = $(this);

            $.ajax({
                type: "post",
                url: "{{ route('maintenance-preview') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": data_id
                },
                dataType: "JSON",
                success: function(response) {
                    $('.invoice_number').html(invoice_num);
                    $('.doc_ref_no').html(data_doc);
                    $('.amount').html(data_amount);

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

        $(document).on('keyup', function(evt) {
            if (evt.keyCode == 27) {
                $('#myModal').modal('hide');
            }
        });

        // ------------------- //


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
            var check_session_value_parent = $('#maintenance_reports_filter');
            var check_session_value_start_date = $(check_session_value_parent).attr('start_date');
            var check_session_value_end_date = $(check_session_value_parent).attr('end_date');
            //alert(check_session_value_end_date.length);
            if (check_session_value_start_date.length == 0) {
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

            } else {

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

        // $(document).ready(function() {
        //     $('.apply-filter').click();
        // });

        function filter_apply() {

            var branch_id = $('#branch').val();

            $('#get_branch_id').val(branch_id);
            var date = $('input[name="date_range"]').val().split('-');
            $('#get_date').val(date);
            $.ajax({
                url: "{{ route('maintenance.report.filter') }}",
                method: 'post',
                data: {
                    branch_id: branch_id,
                    date: date,
                },
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // console.log('response');
                    // console.log(response);
                    if (response.status) {
                        $('#orders_list').html(response.html);
                    }
                }
            });

            filter(branch_id, date);
        }

        function filter(branch_id, date) {
            $.ajax({
                url: "{{ route('maintenance-closing-balance-filter') }}",
                method: 'post',
                data: {
                    branch_id: branch_id,
                    date: date,
                },
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // console.log('response');
                    // console.log(response);
                    if (response.status) {
                        $('.closing_balance').html(response.closing_balance);
                    }
                }
            });
        }

        $(document).ready(function() {

            $(document).on('click', '.apply-filter', function() {
                $('#reset_filter_btn').removeClass('d-none');
                filter_apply();

            });

            $(document).on('click', '.reset-button', function() {
                $('#reset_filter_btn').addClass('d-none');
                $('#branch').val("{{ $all_active_branches[0]->id }}").trigger('change.select2');

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
                $('#get_branch_id').val(branch_id);
                var date = [start, today];

                $.ajax({
                    url: "{{ route('maintenance.report.filter') }}",
                    method: 'post',
                    data: {
                        branch_id: branch_id,
                        date: date,
                        from_filter: "reset"
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // console.log('response');
                        // console.log(response);
                        if (response.status) {
                            $('#orders_list').html(response.html);
                        }
                    }
                });

                filter(branch_id, date);
            });

        });
    </script>

    <script>
        $(document).on('click', '.download-report', function() {
            var branch_id = $('#branch').val();
            var date = $('input[name="date_range"]').val().split('-');

            if (date[0] != null && date[0] != '') {
                var url = "{{ url('reports/maintenance-report/maintenance-report-download') }}";
                url = url + '/' + branch_id + '/' + btoa(date);
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
   



    <script>

      //    // Download Report in pdf
      //   $(document).on('click', '.download-report-pdf', function() {
      //       var branch_id = $('#branch').val();
      //       var date = $('input[name="date_range"]').val().split('-');
      // // alert(date); 
      //       if (date[0] != null && date[0] != '') {
      //           var url = "{{ url('reports/maintenance-report/maintenance-report-download-pdf') }}";
      //           url = url + '/' + branch_id + '/' + btoa(date);
      //           window.location = url;
      //       } else {
      //           toastr.options = {
      //               timeOut: 0,
      //               extendedTimeOut: 0,
      //           };

      //           toastr.error('Please Select Date');
      //       }

      //   })
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.download-report-pdf').click(function(){
             
            $('.download-report-pdf').html('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:yellow;"></i> <span style="color:white;">Downloading...</span>');
                

             //start get screen url
              let region = document.getElementById('order-online-users-list'); // whole screen
            
         html2canvas(region, {
    onrendered: function(canvas) {
      let pngUrl = canvas.toDataURL(); // png in dataURL format
      //console.log(pngUrl);
      //let img = document.querySelector(".screen");
      //img.src = pngUrl; 
      // ImageUrl = pngUrl;
      // $('#ImageUrl').val(pngUrl); 

            var branch_id = $('#branch').val();
            var date = $('input[name="date_range"]').val().split('-'); 
            var imageUrl = pngUrl;
            //alert(imageUrl);


        $.ajax({
         type:"post",
         url:"{{route('maintenance-report-download-pdf')}}",
         data:{
           "_token": "{{ csrf_token() }}",
           "branch_id":branch_id,
           "date":date,
           "imageUrl":imageUrl,
         },
                 xhrFields: {
        responseType: 'blob'
        },
        beforeSend:function(){
         $('.download-report-pdf').html('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:yellow;"></i> <span style="color:white;">Downloading...</span>');
          },
         success:function(response){
             var blob = new Blob([response]);
var link = document.createElement('a');
link.href = window.URL.createObjectURL(blob);
link.download = "MaintenanceReport.pdf";
link.click();  
 $('.download-report-pdf').html('<i class="download fa fa-download "></i>'); 
       }

     });



       
    },
  });

            });
        });
    </script>




    <script type="text/javascript">
        $(document).on('click', '.delete-button', function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this report to the Recycle Bin ?",
                type: "warning",
                showCancelButton: true,

            }, function(willDelete) {

                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('report.maintenance.delete_maintenance') }}",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            if (response.success == 1) {

                                obj.parent().parent().parent().remove();
                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html(
                                    'Maintenance Report Deleted  Successfully');

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

    <script type="text/javascript">
        $(document).ready(function() {

            $('#received_amount_form').validate({
                rules: {
                    received_amount: {
                        required: true,
                        valuecheck: true,
                    }
                },
                messages: {
                    received_amount: {
                        required: 'This field is required'
                    }
                }
            });


            jQuery.validator.addMethod("valuecheck", function(value, element) {
                return (parseFloat(value) > 0);
            }, "Amount must be greater than zero");

        });


        $(document).on('click', '#total_recieved_amount', function() {
            $('#add_receive_amount').modal('show');
        })

        $(document).on('click', '.close_modal', function() {
            $('#add_receive_amount').modal('hide');
        })

        $(document).on('click', '.edit_balance', function() {

            if (!$(this).parent().parent().hasClass('active')) {

                $('.edit_balance').parent().parent().css('background', 'white');
                $('.edit_balance').parent().parent().removeClass('active');

                $(this).parent().parent().css('background', '#fbcc75');
                $(this).parent().parent().addClass('active');
                var id = $(this).data('id');
                var amount = $(this).data('amount');
                $('#received_amount').val(amount.toFixed(3));
                $('#balance_id').val(id);

            } else {

                $('.edit_balance').parent().parent().css('background', 'white');
                $('.edit_balance').parent().parent().removeClass('active');
                $('#received_amount').val(0.000);
                $('#balance_id').val(0);
            }
        })

        $(document).on('focusout', '#received_amount', function() {
            var val = $(this).val();
            val = parseFloat(val);
            $(this).val(val.toFixed(3));
        })

        $(document).on('keyup', '#received_amount', function() {
            var val = $(this).val();
            if (val.split('.').length > 1) {
                if (val.split('.')[1].length > 3) {
                    var new_val = parseFloat(val).toFixed(3);
                    $(this).val(new_val);
                }
            }
        })
    </script>

    <script type="text/javascript">
        $(".catselect").select2();
    </script>

@stop
