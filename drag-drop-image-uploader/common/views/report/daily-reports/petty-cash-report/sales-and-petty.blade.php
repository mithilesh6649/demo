@extends('adminlte::page')
@section('title', 'Super Admin | Daily Petty cash Report')
@section('content_header')
@section('content')



<?php

  $sales_and_petty_r_start_date = Session::get('sales_and_petty_r_start_date');
  $sales_and_petty_r_branch_id = Session::get('sales_and_petty_r_branch_id');

?> 

 <input type="hidden" id="sales_and_petty_r_filter" start_date="{{$sales_and_petty_r_start_date ==''?'':date('d/m/y',strtotime($sales_and_petty_r_start_date))}}">

    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Daily Petty cash Report</h3>

                            
                           <input type="hidden" id="ImageUrl">
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
                                                            data-type="branch" id="branch" name="branch_id">

                                                            @forelse ($branches as $branch)
                                                                <option {{ $sales_and_petty_r_branch_id==$branch->id ? 'selected':''}}  value="{{ $branch->id }}">{{ $branch->title_en }}
                                                                </option>
                                                            @empty
                                                                <option disabled>Branch Not Found</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="date_range_wrapper wrap-align-input">
                                                    <div class="d-block text-left">
                                                        <label class="text-left" for="city">Select Date </label>
                                                        <input class="input-wrap" data-type="date" type="text"
                                                            id="date" name="date" value="{{$sales_and_petty_r_start_date ==null?date('d/m/Y'):date('d/m/Y',strtotime($sales_and_petty_r_start_date))}}"
                                                            style="min-width:300px;">
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

                                                    @can('download_sales_petty_report')
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

                                <div class="closing_balance">
                                    @include('report.daily-reports.petty-cash-report.closing_balance_partial')
                                </div>

                                <table id="order-online-users-list"
                                    class="table table-bordered table-hover yajra-datatable">
                                    <thead>
                                        <tr>
                                            <th style="white-space:nowrap" class="order-first align-top sorting_disabled">
                                                Sr. No.</th>
                                            <th style="white-space:nowrap" class="align-top sorting_disabled">Category</th>
                                            <th style="white-space:nowrap" class="align-top sorting_disabled">Sub Category
                                            </th>
                                            <th style="white-space:nowrap" class="align-top sorting_disabled">Invoice Number
                                            </th>
                                            <th style="white-space:nowrap" class="align-top sorting_disabled">Doc Ref No
                                            </th>
                                            <th style="white-space:nowrap" class="align-top sorting_disabled">Amount</th>
                                            <th style="white-space:nowrap" class="align-top sorting_disabled">Attachment
                                            </th>
                                            <th style="white-space:nowrap" class="align-top sorting_disabled">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" " id="orders_list">
                                        @include('report.daily-reports.petty-cash-report.sales-and-petty-partial')
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

        .separator {
            padding: 10px !important;
            font-size: 20px !important;
            font-weight: 600 !important;
        }

        th {
            padding: 10px 5px !important;
        }

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
        $('body').on('click', '.quick_view', function(e) {

            var data_id = $(this).attr('data-id');
            var invoice_num = $(this).attr('data-invoice');
            var data_doc = $(this).attr('data-doc-ref');
            var data_amount = $(this).attr('data-amount');

            var obj = $(this);

            $.ajax({
                type: "post",
                url: "{{ route('preview-doc-sale-and-petty') }}",
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

        function carso() {
            $('.carousel').carousel({
                interval: false,
            });
        }

        setInterval(function() {
            carso();
        }, 100);
    </script>

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
            // var session_branch_id = "{{ \Session::get('petty_branch_id') }}";
            // var session_date = "{{ \Session::get('petty_date') }}";

            // if (session_branch_id != '') {
            //     $('#reset_filter_btn').removeClass('d-none');
            //     $("#branch").val(session_branch_id).change();
            //     filter($('#branch').val(), $('#date').val());
            //     setSearchSession(session_branch_id, 'branch_id')
            // }
            // if (session_date != '') {
            //     $('#reset_filter_btn').removeClass('d-none');
            //     $('#date').val(session_date);
            //     filter($('#branch').val(), $('#date').val());
            //     setSearchSession(session_date, 'date')
            // }

            //Check sessions.........
      var check_session_value_parent = $('#sales_and_petty_r_filter');
      var check_session_value_start_date = $(check_session_value_parent).attr('start_date');

       if(check_session_value_start_date.length != 0){
              var branch_id = $('#branch').val();
                var date = $('#date').val();
                $('#reset_filter_btn').removeClass('d-none');
                filter(branch_id, date);
       }

            function filter(branch_id, date, reset=null) {
                $.ajax({
                    url: "{{ route('sales-and-petty-filter') }}",
                    method: 'post',
                    data: {
                        branch_id: branch_id,
                        date: date,
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
                            $('#orders_list').html(response.html);
                            $('.closing_balance').html(response.closing_balance);
                        }
                    }
                });
            }

            $(document).on('click', '.apply-filter', function() {
                var branch_id = $('#branch').val();
                var date = $('#date').val();
                $('#reset_filter_btn').removeClass('d-none');
                filter(branch_id, date);
            });

            $(document).on('click', '.reset-button', function() {
                $('#reset_filter_btn').addClass('d-none');
                $('#branch').val("{{ $branches[0]->id }}").trigger('change.select2');
                var branch_id = $('#branch').val();
                $('#date').val("{{ date('d/m/Y') }}")
                var date = $('#date').val();
                filter(branch_id, date, "reset");
               // setSearchSession(branch_id, 'reset');
            });

            // function setSearchSession(param, type) {
            //     $.ajax({
            //         url: "{{ route('set-search-session') }}",
            //         method: 'post',
            //         data: {
            //             param: param,
            //             type: type,
            //         },
            //         dataType: "JSON",
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(response) {
            //             console.log('response');
            //             console.log(response);
            //         }
            //     });
            // }

            // $(document).on('change', '#branch', function() {
            //     var branch_id = $(this).val();
            //     setSearchSession(branch_id, 'branch_id');
            // })
            // $(document).on('change', '#date', function() {
            //     var date = $(this).val();
            //     setSearchSession(date, 'date');
            // })
        });
    </script>

    <script>
        $(document).on('click', '.download-report', function() {
            var branch_id = $('#branch').val();
            var date = $('#date').val();
            var url = "{{ url('reports/daily-reports/petty-cash-report/sales-and-petty-report-download') }}";
            url = url + '/' + branch_id + '/' + btoa(date);
            window.location = url;
        })
    </script>

    <script type="text/javascript">
        $(".catselect").select2();
    </script>

    {{-- date picker --}}
    <script>
        $("#date").datepicker({
            dateFormat: 'dd/mm/yy',
            maxDate: new Date()
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
                        url: "{{ route('sales-and-petty-delete') }}",
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
                                $('#flash-message').html('Daily Petty Cash Report Deleted Successfully');
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
        $(document).on('click', '.add_amount', function() {
            var amount = $('#received_amount').val();
            var cash_received_by = $('#cash_received_by').val();
            var cheque_number = $('#cheque_number').val();

            var flag = true;

            if ($.trim(amount) == "" || $.trim(amount) == null) {
                $('.amount_error').css('display', 'block');
                flag = false;
            } else {
                $('.amount_error').css('display', 'none');
            }

            if (cash_received_by == 'cheque') {
                if (cheque_number == "" || cheque_number == null) {
                    $('.cheque_number_error').css('display', 'block');
                    flag = false;
                } else {
                    $('.cheque_number_error').css('display', 'none');
                }
            } else {
                $('.cheque_number_error').css('display', 'none');
            }

            if (!flag) return false;

            $.ajax({
                url: "{{ route('add-received-amount') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": $('#balance_id').val(),
                    "received_amount": amount,
                    "cheque_number": cheque_number,
                    "cash_received_by": cash_received_by,
                    "branch_id": $('#branch').val()
                },
                dataType: "JSON",
                success: function(response) {
                    console.log('response ---');
                    console.log(response);
                    if (response.status) {
                        $('#add_receive_amount').modal('hide');
                        setTimeout(() => {
                            $('.closing_balance').html(response.html);
                        }, 1000);
                    }
                }
            });
        })

        $(document).on('click', '#total_recieved_amount', function() {
            $("#cash_received_by").val($("#cash_received_by option:first").val());
            $(".cheque_number").css('display', 'none');

            $('.edit_balance').parent().parent().css('background', 'white');
            $('.edit_balance').parent().parent().removeClass('active');
            $('#received_amount').val('');
            $('#cheque_number').val('');

            $('#add_receive_amount').modal('show');
        })

        $(document).on('click', '.close_modal', function() {
            $('#add_receive_amount').modal('hide');
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

                var type = $(this).data('type');
                var cheque_number = $(this).data('cheque');
                if (type == 'cheque') {
                    $('.cheque_number').css('display', 'block');
                    $('#cheque_number').val(cheque_number);
                } else {
                    $('.cheque_number').css('display', 'none');
                    $('#cheque_number').val('');
                }
                $('#cash_received_by').val(type);

            } else {

                $('.edit_balance').parent().parent().css('background', 'white');
                $('.edit_balance').parent().parent().removeClass('active');
                $('#received_amount').val(0.000);
                $('#balance_id').val(0);

                $('#cash_received_by').val('cash');
                $('#cheque_number').val('');
                $('.cheque_number').css('display', 'none');
            }
        })

        $(document).on('change', '#cash_received_by', function() {
            if ($(this).val() == 'cheque') {
                $('.cheque_number').css('display', 'block');
            } else {
                $('.cheque_number').css('display', 'none');
            }
        })

        $(document).on('change', '#year,#month', function() {
            $.ajax({
                url: "{{ route('get-monthly-expense') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    year: $('#year').val(),
                    month: $('#month').val()
                },
                dataType: "JSON",
                success: function(response) {
                    console.log('response ---');
                    console.log(response);
                    if (response.status)
                        $('#monthly_expense').text('KD ' + response.expense);
                }
            });
        })
    </script>
 




    <script>

         // Download Report in pdf
        $(document).on('click', '.petty_pdf_download', function() {

           

           //start get screen url
              let region = document.getElementById('order-online-users-list'); // whole screen
            
         html2canvas(region, {
    onrendered: function(canvas) {
      let pngUrl = canvas.toDataURL(); // png in dataURL format
    //  console.log(pngUrl);
      //let img = document.querySelector(".screen");
      //img.src = pngUrl; 
      ImageUrl = pngUrl;
      $('#ImageUrl').val(pngUrl); 

            var branch_id = $('#branch').val();
            var date = $('#date').val();
            var imageUrl = pngUrl;
            //alert(branch_id);


        $.ajax({
         type:"post",
         url:"{{route('download-all-daily-petty-pdf')}}",
         data:{
           "_token": "{{ csrf_token() }}",
           "branch_id":branch_id,
           "date":date,
           "imageUrl":imageUrl,
         },
                 xhrFields: {
        responseType: 'blob'
        },   beforeSend:function(){
         $('.petty_pdf_download').html('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:yellow;"></i> <span style="color:white;">Downloading...</span>');
          },
        
         success:function(response){
             var blob = new Blob([response]);
var link = document.createElement('a');
link.href = window.URL.createObjectURL(blob);
link.download = "Daily_Petty_cash_Report.pdf";
link.click(); 
 $('.petty_pdf_download').html('<i class="download fa fa-download "></i>');   
       }

     });



       
    },
  });

 
            // var branch_id = $('#branch').val();
            // var date = $('#date').val();
            // var imageUrl = $('#ImageUrl').val();
            // console.log(imageUrl);
            // if (date != null) {
            //     var url = "{{ url('reports/daily-reports/petty-cash-report/download-daily-petty-pdf') }}";
            //     url = url + '/' + branch_id + '/' + btoa(date)+ '/' + btoa(imageUrl);
            //  console.log(url);
            //     return false;
            //    // window.location = url;
            // } else {
            //     toastr.options = {
            //         timeOut: 0,
            //         extendedTimeOut: 0,
            //     };

            //     toastr.error('Please Select Date');
            // }

        })
    </script>




    <script type="text/javascript">
        
        function report() {
          
  let region = document.getElementById('order-online-users-list'); // whole screen
 console.log(region);
 
  html2canvas(region, {
    onrendered: function(canvas) {
      let pngUrl = canvas.toDataURL(); // png in dataURL format
      console.log(pngUrl);
     let img = document.querySelector(".screen");
      img.src = pngUrl; 

      console.log(pngUrl);

      // here you can allow user to set bug-region
      // and send it with 'pngUrl' to server
    },
  });
}

    </script>
@stop
