@extends('adminlte::page')

@section('title', 'Super Admin | Maintenance Report ')

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
            <h3>Deleted Maintenance Report</h3>
          </div>

            <div class="advance_filter text-right mb-3">
                <div class="advance-options" style="">
                   <div class="title">
                     <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                   </div>                      
                   <div class="left_option">
                     <div class="left_inner">
                       <h6>Select Date Range</h6>
                       <div class="button_input_wrap">
                           <select class="form-control" id="select_branch" style="width: auto;">
                            <option value="0">For All Branch</option>
                             @forelse($branch as $key=>$bname)
                              <option value="{{$key}}">{{$bname}}</option>
                             @empty
                              <option disabled>No Branch</option>
                             @endforelse
                              
                           </select>
                        <div class="date_range_wrapper wrap-align-input">

                         <i class="fas fa-calendar-alt mx-2"></i>
                         <input type="text" class="input-wrap w-100 col-10" name="date_range" placeholder="Date" autocomplete="off"/> 

                        </div>
                         
                        
 
                        <div class="apply_reset_btn">
                           <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                           <button class="btn btn-primary reset-button mr-1" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>
                             
                          <!--  &nbsp;&nbsp; -->
                        </div>                             
                       </div>                                                    
                     </div>                 
                  </div>
                </div>
            </div>
        

          <div class="card-body table form mb-0" >
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
           @endif 
          
             
              <table style="width:100%" id="users-list" class="table table-bordered table-hover yajra-datatable">
              <thead>
                <tr>
                
                   <th>Branch Name</th>
                  <th>Day</th>
                  <th>Date</th>
                  
                
              @if(Gate::check('restore_maintenance_report') || Gate::check('permanent_delete_maintenance_report')) 
                <th>Actions</th>  
              @endif 
                </tr>
              </thead>
              <tbody id="orders_list">
               @foreach($allBranchDeletedReports as $data)
                 
               <tr> 
                <td>{{ optional($data->branch)->title_en}}</td>
                <td>{{date('D',strtotime($data->created_at))}}</td>
                <td>{{date('d/M/Y',strtotime($data->created_at))}}</td>
                
             @if(Gate::check('restore_maintenance_report') || Gate::check('permanent_delete_maintenance_report'))  
                        <td>

                            @can('restore_maintenance_report')
                            <a data-id="{{$data->id}}" class="action-button restore-button" title="Restore" href="javascript:void(0)"  branch-id="{{$data->branch_id}}"  data-date="{{$data->created_at}}"><i class="text-success fa fa-undo"  ></i></a>
                            @endcan

                             @can('permanent_delete_maintenance_report')
                            <a data-id="{{$data->id}}" class="action-button delete-button " title=" Permanent Delete" href="javascript:void(0)" branch-id="{{$data->branch_id}}"  data-date="{{$data->created_at}}"><i class="text-danger fa fa-trash-alt" ></i></a>
                           @endcan
                        </td>

              @endif 
                
                      
                      
               </tr>
             
                @endforeach
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
 <script src="https://momentjs.com/downloads/moment.js"></script>

 

<script>
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
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
      });

      $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });
      
    });

 
    $(document).ready(function() {


       $('#order-online-users-list').DataTable({
        "ordering": false
       });

        $('#select_branch').on('change',function(){
          var date_range = $('input[name="date_range"]').val('');
            var branch_id = $(this).val();
              $.ajax({
              url:"{{route('maintenance.report.deleted.filter')}}",
              method:"POST",
              data:{
                    'branch_id':branch_id,
                    'with':'only_branch_id'
                    },
              dataType:"JSON",
              success:function(response){
                console.log(response);
                 $('#users-list').DataTable().clear().destroy();
                  $('#orders_list').html(response.html);
                 $('#users-list').DataTable({
                  "ordering": false
                 });
              } 
            });

        });

   
 

       $('.apply-filter').on('click',function(e){
            e.preventDefault();

            var date_range = $('input[name="date_range"]').val().split('-');
            var branch_id=$('#select_branch').val();
           //  alert(branch_id);
            if(date_range.length>0){
         
            $.ajax({
              url:"{{route('maintenance.report.deleted.filter')}}",
              method:"POST",
              data:{
                     'date_range':date_range,
                     'branch_id':branch_id,
                     'with':'apply_filter'
                 
                    },
              dataType:"JSON",
              success:function(response){
                console.log(response);
                 $('#users-list').DataTable().clear().destroy();
                  $('#orders_list').html(response.html);
                 $('#users-list').DataTable({
                  "ordering": false
                 });
              } 
            });
          }

       });

        $('.reset-button').on('click',function(e){

            e.preventDefault();
             var date_range = $('input[name="date_range"]').val('');
             var branch_id=$('#select_branch_id').val();
             $('#select_branch').val(0);

                   $.ajax({
              url:"{{route('maintenance.report.deleted.reset')}}",
              method:"POST",
              data:{
                    'branch_id':branch_id,
                    },
              dataType:"JSON",
              success:function(response){
                console.log(response);
                 $('#users-list').DataTable().clear().destroy();
                  $('#orders_list').html(response.html);
                 $('#users-list').DataTable({
                  "ordering": false
                 });
              } 
            });


 
       });
    });


 
 
</script>



  <script>
   
   $(document).ready(function(){

    $(document).ready(function() {
      $('#users-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 100 );
          }
        }]
      });
    });


//Restore Users.........    


   $(document).on('click','.restore-button',function(){
       //  var id = $(this).attr('data-id');
          var dates   = $(this).attr('data-date');
         var id= $(this).attr('data-id');
         var obj = $(this);
         
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to restore this Maintenance Report ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{route('maintenance.report.restore')}}",
            type: 'post',
            data: {
              
              id:id,  
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                   $( "#flash-message" ).css("display","block");
                   $( "#flash-message" ).removeClass("d-none");
                   $( "#flash-message" ).addClass("alert-danger");
                   $('#flash-message').html('Maintenance Report Restore Successfully');
                   obj.parent().parent().remove();
                   setTimeout(() => {
                   $( "#flash-message" ).addClass("d-none");
                   }, 5000);
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                swal('Error',"Something went wrong! Please try again.",'error');
                }, 500);
                
              }
            }
          });
        } 
      });
    });  



 
//Permanent Delete

   $(document).on('click','.delete-button',function(){
       //  var id = $(this).attr('data-id');
          var dates   = $(this).attr('data-date');
         var branch_id= $(this).attr('branch-id');
         var obj = $(this);
            var id= $(this).attr('data-id');
         
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to Permanently Delete this Record ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{route('maintenance.report.delete.permanently')}}",
            type: 'post',
            data: {
               
              id:id,  
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                   $( "#flash-message" ).css("display","block");
                   $( "#flash-message" ).removeClass("d-none");
                   $( "#flash-message" ).addClass("alert-danger");
                   $('#flash-message').html('Maintenance Report   Deleted Successfully');
                   obj.parent().parent().remove();
                   setTimeout(() => {
                   $( "#flash-message" ).addClass("d-none");
                   }, 5000);
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                swal('Error',"Something went wrong! Please try again.",'error');
                }, 500);
                
              }
            }
          });
        } 
      });
    });  

 


});
 
  </script>
@stop