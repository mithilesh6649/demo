@extends('adminlte::page')
@section('title', 'Super Admin | View Staff')
@section('content_header')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Staff Details</h3>
                  <a class="btn btn-sm btn-success"
                     href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
               </div>
               <div class="card-body table p-0 mb-0">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                  </div>
                  @endif 
                  <!-- tab content here -->
                  <div class="tab_wrapper">
                     <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link nav_link   active   " id="pills-home-tab" data-toggle="pill"
                              href="#pills-home" role="tab" aria-controls="pills-home"
                              aria-selected="true">Staff</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link nav_link   " id="pills-transactions-tab" data-toggle="pill"
                              href="#pills-transactions" role="tab" aria-controls="pills-transactions"
                              aria-selected="false">Staff Branch History</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link nav_link   " id="pills-transactions-tab" data-toggle="pill"
                              href="#pills-current_offers" role="tab" aria-controls="pills-current_offers"
                              aria-selected="false">Staff Leaves History</a>
                        </li>
                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  show active " id="pills-home" role="tabpanel"
                           aria-labelledby="pills-home-tab" >
                           <div class="card-body table form mb-0">
                              <div class="row">
                                 <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                    <div class="form-group">
                                       <label for="staff_code">Staff Code </label>
                                       <input type="text" name="staff_code" class="form-control" id="staff_code"
                                          value="{{ $staff->staff_code }}" maxlength="100" readonly>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                    <div class="form-group">
                                       <label for="staff_name">Staff Name</label>
                                       <input type="text" name="staff_name" class="form-control" id="staff_name"
                                          value="{{ $staff->staff_name }}" maxlength="100" readonly>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                    <div class="form-group ">
                                       <label for="designation">Designation </label>
                                       <input type="text" value="{{ $staff->designation_name->designation }}" readonly>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                    <div class="form-group">
                                       <label for="points">Points</label>
                                       <input type="number" name="points" class="form-control" id="points"
                                          value="{{ $staff->points }}" maxlength="100" readonly>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                    <div class="form-group">
                                       <label for="points">Residency / Civil ID No.</label>
                                       <input type="text" name="civil_id" class="form-control" id="points"
                                          value="{{ $staff->civil_id ?? 'N/A' }}" maxlength="100" readonly>
                                       @if ($errors->has('points'))
                                       <div class="error">{{ $errors->first('points') }}</div>
                                       @endif
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                    <div class="form-group  ">
                                       <label for="status">Status</label>
                                       <select class="form-select" name="status" disabled>
                                       @foreach ($status as $status_data)
                                       <option value="{{ $status_data->value }}"
                                       @if ($status_data->value == $staff->value) selected @endif>
                                       {{ $status_data->name }}
                                       </option>
                                       @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="tab-pane fade" id="pills-transactions" role="tabpanel"
                           aria-labelledby="pills-transactions-tab">
                           <div class="card-body table items">
                              <table style="width:100%" id="history-list"
                                 class="table table-bordered table-hover">
                                 <thead>
                                    <tr>
                                        
                                       <th>Staff Code</th>
                                       <th>Staff Name</th>
                                       <th>Branch Name</th>
                                       <th>In Session</th>
                                       <th>Out Session</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                     @foreach ($branchStaffHistory as $branchStaff)
                                    
                                       <tr  >
                                      
                                       <td>{{ $staff->staff_code ?? '' }}</td>
                                       <td>{{ $staff->staff_name ?? '' }}</td>
                                       <td>{{ @$branchStaff->StaffBranch->title_en}}</td>
                                       <td>{{ date('d/m/Y', strtotime($branchStaff->start_date)) }}</td>

                                       <td>{{ $branchStaff->end_date == null ? ' - ' : date('d/m/Y', strtotime($branchStaff->end_date)) }}</td>
                                       
                                       <td>@if($branchStaff->end_date == null)<span class=" p-2 alert-success"> Active </span> @else <span class=" p-2 alert-warning"> In Active </span> @endif</td>
                                    </tr>

                                     @endforeach
                                  
                                   
                                 </tbody>
                              </table>
                           </div>
                        </div>





                        <div class="tab-pane fade  " id="pills-current_offers" role="tabpanel"
                           aria-labelledby="pills-current_offers-tab">
                           <div class="card-body table items">
                              <table style="width:100%" id="choice-list"
                                 class="table table-bordered table-hover">
                                 <thead> 
                                    <tr>
                                       
                                       <th>Staff Code</th>
                                       <th>Staff Name</th>
                                       <th>Branch Name</th>
                                       <th>Leave Form</th>
                                       <th>Leave To</th>
                                       <th>Days</th>
                                       <th>Reason</th>
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
                                           <td>{{ $staff->staff_code ?? '' }}</td>
                                           <td>{{ $staff->staff_name ?? '' }}</td>   
                                          <td>{{@$staffLeaves->branch->title_en}}</td>
                                          <td> {{ date('d/m/Y', strtotime($staffLeaves->start_leave_date)) }}</td>
                                          <td>{{ date('d/m/Y', strtotime($staffLeaves->end_leave_date)) }}</td>
                                          <td><span class=" p-2 alert-success"> @php echo ++$diff @endphp  days</span></td>
                                          <td>{{$staffLeaves->reason ?? 'N/A' }}</td>
                                          
                                       </tr> 
                                       @endforeach

                               
                                   
                                 </tbody>
                              </table>
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
@endsection
@section('css')
@stop
@section('js')


     <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>

     $('#choice-list').DataTable({
          
         });

      $('#history-list').DataTable({
         
         });

   $("input").attr("autocomplete", "new-password");
   $(document).ready(function() {
   
       $('#addStaffForm').validate({
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
</script>
@stop
