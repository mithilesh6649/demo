@extends('adminlte::page')
@section('title', 'Super Admin | Sales Reporting')
@section('content_header')
@section('content')
<?php
   $sales_by_branch_netsales_year = Session::get('sales_by_branch_netsales_year');

   ?>
<div class="container">
   <div class="alert d-none" role="alert" id="flash-message">
   </div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>  Net Sale Monthly</h3>
                  <!-- <div class="d-flex align-items-center justify-content-start">
                     <div class="card-header p-0" style="display: none; border: none;">
                       <h3></h3>
                       <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
                     </div>
                     <span class="font-weight-bold"></span>
                     <a class="action-button download-cashdeposit" title="Download Report" href="#" data-url="{{ route('cash-deposit.download') }}" ><i class="text-warning fa fa-download "></i></a>
                     </div>  -->
               </div>
               <div class="advance_filter text-right mb-3 collapse show" id="advanceOptions">
                  <div class="advance-options" style="">
                     <div class="title">
                        <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                     </div>
                     <div class="left_option">
                        <div class="left_inner d-flex align-items-center flex-wrap">
                           <div class="selected_date w-100">
                              <h6 class="d-block p-0 mb-3">Select Month & Year</h6>
                              <div class="button_input_wrap">
                                 <div class="date_range_wrapper wrap-align-input"
                                    style="width: auto !important;">
                                    <select class="form-control month mr-2" name="year" id="year">
                                    @for ($i = 2022; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}"
                                    @if ($i == date('Y')) selected @endif>
                                    {{ $i }}</option>
                                    @endfor
                                    </select>
                                    <input type="hidden" id="sales_by_branch_filter" start_year="{{$sales_by_branch_netsales_year ==''?'':date('Y',strtotime($sales_by_branch_netsales_year))}}">
                                 </div>
                                 <div class="apply_reset_btn">
                                    <button class="apply apply-filter mr-1"
                                       style="background-color: red !important;border: none;border-radius:4px;"><i
                                       class="fas fa-paper-plane mr-2"></i>Apply</button>
                                    <button class="btn btn-primary reset-button mr-1 d-none"
                                       id="reset_filter_btn"
                                       style="background-color:#000000;border: none;color: #ffffff;"><i
                                       class="fas fa-sync-alt mr-2"
                                       style="color: #ffffff;"></i>Reset</button>
                                    @can('download_sales_by_branch_net_sale_monthly_report')
                                    <button
                                       class="action-button download-cashdeposit btn btn-danger downloaded"
                                       title="Download Report"
                                       data-url="{{ route('sales-by-branch-net-sale-monthly.download') }}"><i
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
                           <tr class="total_template">
                           </tr>
                           <tr>
                              <!-- <th class="order-first align-top sorting_disabled">S.No</th> -->
                              <td class="d-none">Key</td>
                              <th class="order-first align-top sorting_disabled headdisn"
                                 style="white-space: nowrap; padding-left:5px;padding-right: 5px;padding-bottom:10px;padding-top: 10px;">
                                 Months/Year
                              </th>
                              @forelse($branch as $branch_name)
                              <th class="align-top sorting_disabled headdisn"
                                 style="white-space: nowrap; padding-left:5px;padding-right: 5px;padding-bottom:10px;padding-top: 10px;">
                                 {{ $branch_name }}
                              </th>
                              @empty
                              @endforelse
                              <th class="order-first align-top sorting_disabled headdisn"
                                 style="white-space: nowrap; padding-left:5px;padding-right: 5px;padding-bottom:10px;padding-top: 10px;">
                                 Total
                              </th>
                              <!-- <th class="first align-top sorting_disabled">Action</th> -->
                           </tr>
                        </thead>
                        <tbody class="filter_date_show" id="orders_list">
                           @include('report.daily-reports.sales-report.sale_by_branch_net_sales_monthly.partial')
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
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script>
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
       var check_session_value_start_year = $(check_session_value_parent).attr('start_year');
       console.log(check_session_value_start_year);
       if (check_session_value_start_year.length == 0) {

           filter_apply();
           header_total();

       } else {

           $('#year').val(check_session_value_start_year);

           $('#reset_filter_btn').removeClass('d-none');

           filter_apply();
           header_total();


       }

   });

   function filter_apply(reset = null) {

       var year = $('#year').val();

       $.ajax({
           url: "{{ route('sales-by-branch-net-sale-monthly.filter') }}",
           method: "POST",
           data: {
               year: year,
               reset: reset
           },
           dataType: "JSON",
           success: function(response) {
               console.log(response);
               $('#order-online-users-list').DataTable().clear().destroy();
               $('#orders_list').html(response.html);
               $('#order-online-users-list').DataTable({
                   "order": [
                       [0, "DESC"]
                       ],
   // "ordering": false,
                   scrollResize: true,
                   scrollY: '70vh',
                   scrollCollapse: true,
                   paging: false,
               });
           }
       });

   }


   function header_total() {

   var year = $('#year').val();

   $.ajax({
   url: "{{ route('sales-by-branch-net-sale-monthly.header-total') }}",
   method: "POST",
   data: {
   year: year,
   },
   dataType: "JSON",
   success: function(response) {
   // console.log(response);
   $('.total_template').html(response.total_header);
   }
   });

   }

   $(document).ready(function() {

   //  Initialise Datatable //

   $('#order-online-users-list').DataTable({
   "order": [
   [0, "DESC"]
   ],
   // "ordering": false,
   scrollResize: true,
   scrollY: '70vh',
   scrollCollapse: true,
   paging: false,
   });


   //  -------------------- //

   });

   $(document).on('click', '.download-cashdeposit', function() {
   var year = $('#year').val();

   var url = $(this).attr('data-url') + "/" + year;

   window.location.href = url;

   });

   $(document).on('click', '.apply-filter', function(e) {
   $('#reset_filter_btn').removeClass('d-none');
   filter_apply();
   header_total();
   });

   $(document).on('click', '.reset-button', function(e) {
   e.preventDefault();
   $('#reset_filter_btn').addClass('d-none');
   $("#year").val(parseInt("{{ date('Y') }}"))
   filter_apply('reset');
   header_total();
   });
</script>
@stop
