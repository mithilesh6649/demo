@extends('adminlte::page')
@section('title', 'Super Admin | Petty Cash  Reporting')
@section('content_header')
@section('content')
<div class="container">
   <div class="alert d-none" role="alert" id="flash-message">
   </div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Petty Cash Monthly Reporting</h3>
                  <div class="d-flex align-items-center justify-content-start">
                     <div class="card-header p-0" style="display: none; border: none;">
                        <h3></h3>
                        <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
                     </div>
                     <span class="font-weight-bold"></span> 
                     <a class="action-button" title="Download Report" href="{{route('petty.cash.report.download-monthly')}}"><i class="text-warning fa fa-download "></i></a>
                  </div>
               </div>
               <!--start filter -->
               <div class="advance_filter text-right mb-3 collapse" id="advanceOptions">
                  <div class="advance-options" style="">
                     <div class="title">
                        <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                     </div>
                     <div class="left_option">
                        <div class="left_inner d-flex align-items-center flex-wrap">
                           <div class="form-group pr-2 w-25">
                              <label class="text-left w-100" for="city">Select Branch </label>
                              <select class="advance_branch_search catselect form-control text-center" name="branch_id" >
                                 <option value="0">For All Branch</option>
                                 @forelse ($all_active_branches as $branch)
                                 <option value="{{$branch->id}}">{{ $branch->title_en }}</option>
                                 @empty
                                 <option class="disabled">Branch Not Found</option>
                                 @endforelse
                              </select>
                           </div>
                           <div class="selected_date w-75">
                              <h6 class="d-block p-0 mb-3" style="opacity: 0;">Select Date Range</h6>
                              <div class="button_input_wrap">
                                 <div class="date_range_wrapper wrap-align-input w-auto">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <input type="text" class="input-wrap" name="date_range" placeholder="Date" autocomplete="off"   />
                                 </div>
                                 <div class="apply_reset_btn">
                                    <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                                    <button class="btn btn-primary reset-button" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>                          
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
                  <table   id="order-online-users-list" class="table table-bordered table-hover yajra-datatable">
                     <thead>
                        <tr>
                           <th >S.No</th>
                           <th class="order-first align-top sorting_disabled">Branch Name</th>
                           <th class="order-first align-top sorting_disabled">Voucher Number</th>
                           <th class="order-first align-top sorting_disabled">Category</th>
                           <th class="order-first align-top sorting_disabled">Sub Category</th>
                           <th class="order-first align-top sorting_disabled">Amount</th>
                           <!--<th class="order-first align-top sorting_disabled">Rv No</th>
                              <th class="first align-top sorting_disabled">Total Collection</th> -->
                           <th >Created At</th>
                           <th >Actions</th>
                        </tr>
                     </thead>
                     <tbody class=" " id="orders_list">
                        @forelse ($daily_petty_expense_report as $report)
                        <tr>
                           <td class="table_th">{{ $report->id }}</td>
                           <td class="table_th">{{ optional($report->Branch)->title_en }}</td>
                           <td class="table_td">{{ $report->doc_ref_no }}</td>
                           <td class="table_td">{{ optional($report->category)->cat_name }}</td>
                           <td class="table_td">{{ optional($report->sub_category)->sub_cat_name }}</td>
                           <td class="table_td">KD {{ $report->amount }}</td>
                           <td class="table_td">{{ date('d/m/Y', strtotime($report->updated_at)) }}</td>
                           <td><a class="m-1" title="View"
                              href="{{route('petty.cash.report.view',$report->id)}}"><i
                              class="text-info fa fa-eye eye_green"></i>
                              </a>
                           </td>
                        </tr>
                        @empty
                        @endforelse  
                     </tbody>
                  </table>
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

<script> 
$(document).ready(function() {
	var branch_id = 0;
	var date_range = 0;
	//Data filter by branch
	$(document).on('change', '.advance_branch_search', function() {
		branch_id = this.value;
		$('input[name="date_range"]').val('');
		$.ajax({
			url: "{{route('petty.cash.report.filter')}}",
			method: 'post',
			data: {
				date_range: date_range,
				branch_id: branch_id,
				filter_type: 'branch',
			},
			dataType: "JSON",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
				console.log('response');
				console.log(response);
				if(response.status) {
					$('#order-online-users-list').DataTable().clear().destroy();
					$('#orders_list').html(response.html);
					$('#order-online-users-list').DataTable({});
				}
			}
		});
	});
	$('#order-online-users-list').DataTable({});
});
//Start date range picker code
$(document).ready(function() {
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();
	today = mm + '/' + dd + '/' + yyyy;
	$('input[name="date_range"]').daterangepicker({
		"startDate": today,
		"endDate": today,
		"autoApply": true,
		autoUpdateInput: false,
		disableDates: ["we", "th"],
		locale: {
			cancelLabel: 'Clear'
		}
	});
	$('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
	});
	$('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
});
// filter
$('body').on('click', '.apply-filter', function() {
	console.log('filter now');
	var date_range = $('input[name="date_range"]').val().split('-');
	var branch_id = $('.advance_branch_search').val();
	
	if(date_range.length == 1) return false;
	$.ajax({
		url: "{{route('petty.cash.report.filter')}}",
		method: 'post',
		data: {
			date_range: date_range,
			branch_id: branch_id,
			filter_type: 'date',
		},
		dataType: "JSON",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function(response) {
			console.log('response');
			console.log(response);
			if(response.status) {
				$('#order-online-users-list').DataTable().clear().destroy();
				$('#orders_list').html(response.html);
				$('#order-online-users-list').DataTable({});
			}
		}
	});
});
$('body').on('click', '.reset-button', function() {
		$('input[name="date_range"]').val('');
		//$('.advance_options_btn').hide();
		// update table data
		$.ajax({
			url: "{{route('petty.cash.report.reset')}}",
			method: 'post',
			data: {
				reset: true
			},
			dataType: "JSON",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
				console.log('response');
				console.log(response);
				if(response.status) {
					$('#order-online-users-list').DataTable().clear().destroy();
					$('#orders_list').html(response.html);
					$('#order-online-users-list').DataTable({});
				}
			}
		});
		// update table data
	})
	// filter
	</script> 
  <script type = "text/javascript"> 
  $(document).ready(function() {
		$(document).on('click', '.reports_rv_number_edit', function() {

			var getFistSpanEdit = this;
			var report_id = $(this).attr('report-id');
			var parent_td = this.parentElement.parentElement;
			var editParent = this.parentElement;
			var getFistSpanSave = parent_td.getElementsByClassName('reports_rv_number_save')[0];
			var getFistSpan = parent_td.getElementsByClassName('reports_rv_number')[0];
		
			getFistSpan.setAttribute('contenteditable', true);
			getFistSpan.focus();

			$(getFistSpanEdit).addClass('d-none');
			$(getFistSpanSave).removeClass('d-none');
			$(getFistSpanSave).click(function() {
				var updated_value = $(getFistSpan).text();
				$.ajax({
					url: " ",
					method: "POST",
					data: {
						report_id: report_id,
						rv_number: updated_value,
					},
					dataType: "JSON",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function(response) {
						if(response.success) {
							toastr.success('Rv Number Updated Successfully');
						} else {
							toastr.error('Something Went To Wrong');
						}
					}
				});
				$(getFistSpanSave).addClass('d-none');
				getFistSpan.setAttribute('contenteditable', false);
				$(getFistSpanEdit).removeClass('d-none');
			});
		});
	}); 
  </script> 
  <script type = "text/javascript"> 
    $(".catselect").select2(); 
  </script>

@stop