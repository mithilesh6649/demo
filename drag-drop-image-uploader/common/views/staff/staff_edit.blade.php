@extends('adminlte::page')
@section('title', 'Super Admin | Edit Staff')
@section('content_header')
@section('content') 
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Edit Staff    
                  </h3>
                  <a class="btn btn-sm btn-success"
                     href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
               </div>
               <div class="card-body table p-0 mb-0">
                  <!-- tab content here -->
                  <div class="tab_wrapper">
                     <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <!--  <a class="nav-link nav_link   {{ Request::segment(2) == 'edit' && Request::segment(1) == 'staff' ? 'active' : '' }}   " id="pills-home-tab" data-toggle="pill"
                              href="#pills-home"   href="{{ route('edit_staff', ['id' => $staff->id]) }}"  role="tab" aria-controls="pills-home"
                              aria-selected="true">Staff</a> -->

                              <a class="nav-link nav_link {{ Request::segment(2) == 'edit' && Request::segment(1) == 'staff' ? 'active' : '' }} "
                                            id="pills-home-tab" href="{{ route('edit_staff', ['id' => $staff->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Staff</a>

                        </li>
                        <li class="nav-item">
                         <!--   <a class="nav-link nav_link  {{ Request::segment(2) == 'edit' && Request::segment(1) == 'branch-staff-leave' ? 'active' : '' }}  " id="pills-transactions-tab"  
                              href="#pills-transactions" href="{{ route('branch-staff-leave.edit', ['id' => $staff->id]) }}" role="tab" aria-controls="pills-transactions"
                              aria-selected="false">Staff Leave</a> -->
                          

                              <a class="nav-link nav_link {{ Request::segment(2) == 'edit' && Request::segment(1) == 'branch-staff-leave' ? 'active' : '' }} "
                                            id="#pills-transactions" href="{{ route('branch-staff-leave.edit', ['id' => $staff->id]) }}"
                                            aria-controls="pills-transactions" aria-selected="true">Staff Leave</a>

                        </li>
                     </ul>
                     <hr>
                     <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  {{ Request::segment(2) == 'edit' && Request::segment(1) == 'staff' ? ' show active' : '' }} " id="pills-home" role="tabpanel"
                           aria-labelledby="pills-home-tab" >
                           <div class="card-body table form mb-0">
                              @if (session('status'))
                              <div class="alert alert-success" role="alert">
                                 {{ session('status') }}
                              </div>
                              @endif
                              <form id="updateStaffForm" method="post" action="{{ route('update_staff') }}">
                                 @csrf
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                          <div class="form-group">
                                             <label for="staff_code">Staff Code<span class="text-danger">
                                             *</span></label>
                                             <input type="text" name="staff_code" class="form-control" id="staff_code"
                                                value="{{ $staff->staff_code }}" maxlength="100">
                                             @if ($errors->has('staff_code'))
                                             <div class="error">{{ $errors->first('staff_code') }}</div>
                                             @endif
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                          <div class="form-group">
                                             <label for="staff_name">Staff Name<span class="text-danger">
                                             *</span></label>
                                             <input type="text" name="staff_name" class="form-control" id="staff_name"
                                                value="{{ $staff->staff_name }}" maxlength="100">
                                             @if ($errors->has('staff_name'))
                                             <div class="error">{{ $errors->first('staff_name') }}</div>
                                             @endif
                                          </div>
                                       </div>
                                       <input type="hidden" name="id" value="{{ $staff->id }}" id="id">
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                          <div class="form-group ">
                                             <label for="designation">Designation<span class="text-danger">
                                             *</span></label>
                                             <select name="designation" class="form-control" placeholder=" "
                                                id="designation">
                                                <option value="" disabled>Select Designation</option>
                                                @foreach ($designation_list as $key => $role)
                                                <option value="{{ $role->id }}"
                                                @if ($role->id == $staff->designation_id) selected @endif>
                                                {{ $role->designation }}
                                                </option>
                                                @endforeach
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                          <div class="form-group">
                                             <label for="points">Points</label>
                                             <input type="number" name="points" class="form-control" id="points"
                                                value="{{ $staff->points }}" maxlength="100">
                                             @if ($errors->has('points'))
                                             <div class="error">{{ $errors->first('points') }}</div>
                                             @endif
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                          <div class="form-group">
                                             <label for="points">Residency / Civil ID No.</label>
                                             <input type="text" name="civil_id"   value="{{ $staff->civil_id }}"  class="form-control" id="points"
                                                value="" maxlength="100">
                                             @if ($errors->has('points'))
                                             <div class="error">{{ $errors->first('points') }}</div>
                                             @endif
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                          <div class="form-group  ">
                                             <label for="status">Status</label>
                                             <select class="form-select" name="status">
                                             @foreach ($status as $status_data)
                                             <option value="{{ $status_data->value }}"
                                             @if ($status_data->value == $staff->status) selected @endif>
                                             {{ $status_data->name }}
                                             </option>
                                             @endforeach
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /.card-body -->
                                 <div class="card-footer">
                                    <button type="submit"
                                       class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.update') }}</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="tab-pane fade  {{ Request::segment(2) == 'edit' && Request::segment(1) == 'branch-staff-leave' ? ' show active' : '' }} "  " id="pills-transactions" role="tabpanel"
                           aria-labelledby="pills-transactions-tab">
                           <div class="card-body table items">
                              <div class="alert d-none" role="alert" id="flash-message-leaves">
                              </div>
                              <div class="card-header alert d-flex justify-content-between align-items-center m-0"
                                 style="border-bottom: none;">
                                 <h3></h3>
                                  <!-- a class="btn btn-sm btn-success" href="javascript:;"
                                    data-toggle="modal" data-target="#add_cars_modal">Add Cars </a> -->
                                 <button type="button" class="btn btn-xl btn-danger " data-toggle="modal" data-target="#myModal">Add Leave</button>
                              </div>
                              <div class="card-body items">
                                 @if (session('status'))
                                 <div class="alert alert-success" role="alert"> {{ session('status') }}
                                 </div>
                                 @endif
                                 <table style="width:100%" id="choice-list" class="table table-bordered table-hover">
                                    <thead>
                                       <tr>
                                          
                                       
                                          <th>Branch Name</th>
                                          <th>Leave Form</th>
                                          <th>Leave To</th>
                                          <th>Days</th>
                                          <th>Reason</th>
                                          <th>Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      

                                       @foreach ($staffLeaveHistory as $staffLeaves)
                                           
                                           @php

                              $date = \Carbon\Carbon::parse($staffLeaves->start_leave_date);
                              $now = \Carbon\Carbon::parse($staffLeaves->end_leave_date);

                              $diff = $date->diffInDays($now);
                                             

                                           @endphp  

                                          <tr>
                                          <td>{{$staffLeaves->branch->title_en}}</td>
                                          <td> {{ date('d/m/Y', strtotime($staffLeaves->start_leave_date)) }}</td>
                                          <td>{{ date('d/m/Y', strtotime($staffLeaves->end_leave_date)) }}</td>
                                          <td><span class=" p-2 alert-success"> @php echo ++$diff @endphp  days</span></td>
                                          <td>{{$staffLeaves->reason ?? 'N/A' }}</td>
                                          <td>
                                             <a data-id="{{$staffLeaves->id}}"
                                                leave-start-date="{{ date('d/m/Y', strtotime($staffLeaves->start_leave_date)) }}"
                                                leave-end-date="{{ date('d/m/Y', strtotime($staffLeaves->end_leave_date)) }}" leave-reason="{{$staffLeaves->reason??''}}"
                                                class="action-button edit-button edit_leave" title="Edit"
                                                href="javascript:void(0)"><i
                                                class="text-warning fa fa-edit"></i></a>
                                             <a data-id="{{$staffLeaves->id}}"
                                                class="action-button delete-leave-button" title="Delete"
                                                href="javascript:void(0)"><i
                                                class="text-danger fa fa-trash-alt"></i></a>
                                          </td>
                                       </tr> 
                                       @endforeach

                                    </tbody>
                                 </table> 
                              </div>
                           </div>
                        </div>
                        <!-- current offers modules -->
                     </div>
                  </div>
                  <!-- tab content here --> 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Leave </h4>
         </div>
         <div class="modal-body">
            <!-- start leave form   -->
            <form id="StaffLeaveForm" method="post" action="{{route('branch-staff-leave.save')}}">
               @csrf
               <input type="hidden" name="id" value="{{ $staff->id }}" id="id">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12   mb-3">
                        <div class="form-group">
                           <label for="staff_code">Staff Name<span class="text-danger">
                           *</span></label>
                           <input type="text" name="staff_code" class="form-control" id="staff_code"
                              value="{{ $staff->staff_name }}" maxlength="100">
                           @if ($errors->has('staff_code'))
                           <div class="error">{{ $errors->first('staff_code') }}</div>
                           @endif
                        </div>
                     </div>
                     <div class="d-none col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                        <div class="form-group">
                           <div class="form-group mb-0">
                              <label for="leave_type">Leave Type<span
                                 class="text-danger">*</span></label>
                              <select name="leave_type" id="leave_type" class="form-control"  >
                                 <option value="">Select Leave Type</option>
                                 <option value="0">Single Leave</option>
                                 <option value="1">Multiple Leaves</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12   mb-3">
                        <div class="form-group">
                           <label for="start_leave_date" class="mb-3">Leave Date From<span class="text-danger"> * </span></label>
                           <input type="text" name="start_leave_date"
                              id="start_leave_date" class=""
                              autocomplete="off">
                           <label for="" class="mb-3">Leave Date To<span class="text-danger"> * </span></label>
                           <input type="text" name="end_leave_date"
                              id="end_leave_date" class=""
                              autocomplete="off">  
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12   mb-3">
                        <div class="form-group">
                           <div class="form-group mb-0">
                              <label for="reason" class="mb-3">Leave Reason </label>
                              <textarea class="form-control" name="reason"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit"
                     class="button btn_bg_color common_btn text-white">Add</button>
               </div>
            </form>
            <!-- end leave form -->
         </div>
      </div>
   </div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModalEdit" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Leave </h4>
         </div>
         <div class="modal-body">
            <!-- start leave form   -->
            <form id="StaffLeaveFormEdit" method="post" action="{{route('branch-staff-leave.update')}}">
               @csrf
               <input type="hidden" name="id" value="{{ $staff->id }}" id="id">
               <input type="hidden" name="current_leave_id"  id="leave_id">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12   mb-3">
                        <div class="form-group">
                           <label for="staff_code">Staff Name<span class="text-danger">
                           *</span></label>
                           <input type="text" name="staff_code" class="form-control" id="staff_code"
                              value="{{ $staff->staff_name }}" maxlength="100">
                           @if ($errors->has('staff_code'))
                           <div class="error">{{ $errors->first('staff_code') }}</div>
                           @endif
                        </div>
                     </div>
                     <div class="d-none col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                        <div class="form-group">
                           <div class="form-group mb-0">
                              <label for="leave_type">Leave Type<span
                                 class="text-danger">*</span></label>
                              <select name="leave_type" id="leave_type" class="form-control"  >
                                 <option value="">Select Leave Type</option>
                                 <option value="0">Single Leave</option>
                                 <option value="1">Multiple Leaves</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12   mb-3">
                        <div class="form-group">
                           <label for="start_leave_date" class="mb-3">Leave Date From<span class="text-danger"> * </span></label>
                           <input type="text" name="start_leave_date"
                              id="start_leave_date_edit" class=""
                              autocomplete="off">
                           <label for="" class="mb-3">Leave Date To<span class="text-danger"> * </span></label>
                           <input type="text" name="end_leave_date"
                              id="end_leave_date_edit" class=""
                              autocomplete="off">  
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12   mb-3">
                        <div class="form-group">
                           <div class="form-group mb-0">
                              <label for="reason" class="mb-3">Leave Reason </label>
                              <textarea class="form-control" name="reason" id="leave_reason"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit"
                     class="button btn_bg_color common_btn text-white">Update</button>
               </div>
            </form>
            <!-- end leave form -->

@endsection
@section('css')
<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready(function() {
   
       $('#updateStaffForm').validate({
           ignore: [],
           debug: false,
           rules: {
               staff_name: {
                   required: true
               },
               staff_code: {
                   required: true,
                   remote: {
                       url: "{{ route('staff.staff_code_check') }}",
                       type: "post",
                       data: {
                           "_token": "{{ csrf_token() }}",
                           'staff_code': function() {
                               return $('#staff_code').val()
                           },
                           'id': function() {
                               return $('#id').val()
                           },
                       },
   
                       dataFilter: function(data) {
                           var json = JSON.parse(data);
                           if (json.msg == "true") {
                               return "\"" + "Staff Code already exists" +
                                   "\"";
                           } else {
                               return 'true';
                           }
                       }
                   }
               },
               designation: {
                   required: true
               },
           },
   
           messages: {
               staff_name: {
                   required: "Staff Name is required"
               },
               staff_code: {
                   required: "Staff Code is required"
               },
               designation: {
                   required: "Designation is required",
               },
           }
       });
   
   
   
   
   });
   
   
   
   
   
      $( function() {
   var dateFormat = "dd/mm/yy",
   from = $( "#start_leave_date" )
    .datepicker({
      defaultDate: "+1w",
       dateFormat: "dd/mm/yy",
      changeMonth: true,
      numberOfMonths: 1
    })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );
    }),
   to = $( "#end_leave_date" ).datepicker({
    defaultDate: "+1w",
     dateFormat: "dd/mm/yy",
    changeMonth: true,
    numberOfMonths: 1
   })
   .on( "change", function() {
    from.datepicker( "option", "maxDate", getDate( this ) );
   });
   
   function getDate( element ) {
   var date;
   try {
    date = $.datepicker.parseDate( dateFormat, element.value );
   } catch( error ) {
    date = null;
   }
   
   return date;
   }
   } );
   
   
   
   


         $( function() {
   var dateFormat = "dd/mm/yy",
   from = $( "#start_leave_date_edit" )
    .datepicker({
      defaultDate: "+1w",
       dateFormat: "dd/mm/yy",
      changeMonth: true,
      numberOfMonths: 1
    })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );
    }),
   to = $( "#end_leave_date_edit" ).datepicker({
    defaultDate: "+1w",
     dateFormat: "dd/mm/yy",
    changeMonth: true,
    numberOfMonths: 1
   })
   .on( "change", function() {
    from.datepicker( "option", "maxDate", getDate( this ) );
   });
   
   function getDate( element ) {
   var date;
   try {
    date = $.datepicker.parseDate( dateFormat, element.value );
   } catch( error ) {
    date = null;
   }
   
   return date;
   }
   } );
   
   
        $('#StaffLeaveForm').validate({
        rules: {
            staff_id: {
                required: true,
            },
            
            start_leave_date: {
                required: true
            },
            end_leave_date: {
                required: true
            },
            pos_invoice_amount: {
                required: true
            },
            card_amount: {
                required: true
            },
        },
        messages: {
            staff_id: {
                required: "Staff  name is required",
            },
             
            start_leave_date: {
                required: "Start leave date is required"
            },
            end_leave_date: {
                required: "End leave date is required"
            },
   
        }
    });
   



        $('#StaffLeaveFormEdit').validate({
        rules: {
            staff_id: {
                required: true,
            },
            
            start_leave_date: {
                required: true
            },
            end_leave_date: {
                required: true
            },
            pos_invoice_amount: {
                required: true
            },
            card_amount: {
                required: true
            },
        },
        messages: {
            staff_id: {
                required: "Staff  name is required",
            },
             
            start_leave_date: {
                required: "Start leave date is required"
            },
            end_leave_date: {
                required: "End leave date is required"
            },
   
        }
    });
   


         //delete leave


            $(document).on('click', '.delete-leave-button', function(e) {
                var id = $(this).attr('data-id');
                var obj = $(this);
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to  this Permanently delete this record ?",
                    type: "warning",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {
                        $.ajax({
                            type: 'post',
                            url: "{{ route('branch-staff-leave.delete') }}",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                if (response.success == 1) {
                                    $("#flash-message-leaves").css("display", "block");
                                    $("#flash-message-leaves").removeClass("d-none");
                                    $("#flash-message-leaves").addClass(
                                    "alert-danger");
                                    $('#flash-message-leaves').html(
                                        'Leave Deleted Successfully');
                                    obj.parent().parent().remove();
                                    setTimeout(() => {
                                        $("#flash-message-leaves").addClass(
                                            "d-none");
                                        location.reload();
                                    }, 3000);
                                } else {

                                    setTimeout(() => {
                                        swal('Error', 'Something went wrong',
                                            'error');
                                        // alert("Something went wrong! Please try again.");
                                    }, 500);
                                }
                            }
                        });
                    }
                });
            });

   //Edit Leaves......................................................
       

                        

     $(document).on('click', '.edit_leave', function(e) {
       
         
                var data_id = $(this).attr('data-id');
                var leave_start_date = $(this).attr('leave-start-date');
                var leave_end_date = $(this).attr('leave-end-date');
                var leave_reason = $(this).attr('leave-reason');


                $('#myModalEdit').modal({
                                'show': true,
                                backdrop: 'static',
                                keyboard: false
                            });

                $('#start_leave_date_edit').val(leave_start_date);
                $('#end_leave_date_edit').val(leave_end_date);
                $('#leave_reason').val(leave_reason);
                $('#leave_id').val(data_id);  
                 //alert(data_id+" "+leave_start_date+" "+leave_end_date+" "+leave_reason);


     });
   



         $('#choice-list').DataTable({
             
         });



</script>
@stop
