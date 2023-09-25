@extends('adminlte::page')
@section('title', 'Super Admin | Petty Cash  Reporting')
@section('content_header')
@section('content')


 <?php 
  
  $petty_cash_report_by_branch_month_wise_month = Session::get('petty_cash_report_by_branch_month_wise_month');
  $petty_cash_report_by_branch_month_wise_year = Session::get('petty_cash_report_by_branch_month_wise_year');  
 
?> 
 

<div class="container">
   <div class="alert d-none" role="alert" id="flash-message">
   </div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Petty Cash Report By Branch Month Wise</h3>
                     <input type="hidden" id="petty_cash_report_by_branch_month_wise_filter" start_month="{{$petty_cash_report_by_branch_month_wise_month ==''?'': $petty_cash_report_by_branch_month_wise_month }}" start_year="{{$petty_cash_report_by_branch_month_wise_year ==''?'': $petty_cash_report_by_branch_month_wise_year }}">

               </div>
               <!--start filter -->
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
                                 <div class="date_range_wrapper wrap-align-input" style="width: auto !important;">

                                    <select class="form-control month mr-2" name="year" id="year">
                                        @for($i=2022;$i<=date('Y');$i++)
                                            <option value="{{$i}}" @if($i==date('Y')) selected @endif>{{$i}}</option>
                                        @endfor
                                    </select>

                                    <select class="form-control month" name="month" id="month">
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthNumber => $month)
                                            <option value="{{++$monthNumber}}" @if($monthNumber==date('m')) selected @endif>{{$month}}</option>
                                        @endforeach
                                    </select>

                                 </div>
                                 <div class="apply_reset_btn">
		                           <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
		                           <button class="btn btn-primary reset-button mr-1 d-none" id="reset_filter_btn" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>
		                          @can('download_petty_cash_by_branch_report')
		                           <button class="action-button download-cashdeposit btn btn-danger downloaded download-report" href="javascript:void(0)" title="Download Report"><i class="download fa fa-download "></i></button>
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


                  <table id="order-online-users-list" class="table table-bordered table-hover yajra-datatable table-responsive">
					<thead>
					   <tr>
						   <th>Branch</th>
                           <th>Total</th>
						   @foreach($categories as $category)
							   @foreach($category->subcategories as $subcategory)
								   <th class="order-first align-top sorting_disabled" style="white-space: nowrap;padding:10px">{{$subcategory->sub_cat_name}}</th>
							   @endforeach
						   @endforeach

					   </tr>
					</thead>
					<tbody class=" " id="orders_list">
                        {!! $html !!}
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
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
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


    #full{
      overflow: auto;
      background-color:white !important;
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
<script type="text/javascript"src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src='https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript">
   $(document).ready(function(){
        var table = $('#order-online-users-list').DataTable( {
         "ordering": false,
        scrollY: '70vh',
        scrollCollapse: true,
        paging: false,

    } );
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
   function filter(reset=null){

      var month = $('#month').val();
      var year = $('#year').val();

		$.ajax({
			url: "{{route('petty-cash-by-branch-month-wise-filter')}}",
			method: 'post',
			data: {
				month: month,
				year: year,
            reset : reset
			},
			// dataType: "JSON",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
				console.log('response');
				console.log(response);
				if(response.status) {
					$('#orders_list').html(response.data);
				}
			}
		});
   }

	$(document).on('click', '.apply-filter', function() {
      $('#reset_filter_btn').removeClass('d-none');
      filter();
	});

   $(document).on('click','.reset-button',function(){
      $('#reset_filter_btn').addClass('d-none');
      $("#month").val(parseInt("{{date('m')}}"))
      $("#year").val(parseInt("{{date('Y')}}"))
      filter('reset');
   })

   $(document).on('click','.download-report',function(){
      var month = $('#month').val();
		var year = $('#year').val();

		var url = "{{url('reports/daily-reports/petty-cash-report/branch-month-wise/download')}}";
		url = url+'/'+btoa(month)+'/'+btoa(year);
		window.location = url;
   })
});
</script>
<script type = "text/javascript">
   $(".catselect").select2();
</script>


<script type="text/javascript">
   $(document).ready(function(){
     

     //Check sessions.........
      var check_session_value_parent = $('#petty_cash_report_by_branch_month_wise_filter');
      var check_session_value_start_month = $(check_session_value_parent).attr('start_month');
      var check_session_value_start_year = $(check_session_value_parent).attr('start_year');
        if(check_session_value_start_month.length != 0){
               $('#reset_filter_btn').removeClass('d-none');
            var month = $('#month').val(check_session_value_start_month);
            var year = $('#year').val(check_session_value_start_year);
            
            $.ajax({
               url: "{{route('petty-cash-by-branch-month-wise-filter')}}",
               method: 'post',
               data: {
                  month: check_session_value_start_month,
                  year: check_session_value_start_year,
                  reset :null
               },
               // dataType: "JSON",
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function(response) {
                  console.log('response');
                  console.log(response);
                  if(response.status) {
                     $('#orders_list').html(response.data);
                  }
               }
            });


        }

   });
</script>

@stop
