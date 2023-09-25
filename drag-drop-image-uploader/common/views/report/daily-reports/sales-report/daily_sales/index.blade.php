@extends('adminlte::page')

@section('title', 'Super Admin | Sales Reporting')

@section('content_header')

@section('content')
<?php 
  
  $daily_sales_report_start_date = Session::get('daily_sales_report_start_date');
  $daily_sales_report_end_date = Session::get('daily_sales_report_end_date');
  $daily_sales_report_branch_id = Session::get('daily_sales_report_branch_id');

?>

<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">
  </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Daily Sales Report (DSR)</h3>
             
                 <div class="d-flex align-items-center justify-content-center ml-0">
                   <div class="mr-2">
                    <label class="text-left" for="city">Select Date </label>
                    <input class="input-wrap" data-type="date" type="text"
                        id="date" name="date" value="{{date('d/m/Y')}}"
                        style="min-width:300px;"> 
                    </div>
                   
                   <button class="action-button download-dsr-for-all-branch btn btn-danger downloaded" title="MGMT Report"><i class="download fas fa-paper-plane mr-2"></i> Apply</button>
                </div>       
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
                  <div class="date_range_wrapper wrap-align-input"> 
                   <div class="selected_branch">
                     <select class="form-select" id="select_branch">
                       @forelse($branch as $key=>$bname)
                       <option  value="{{$key}}" @if($selbranch->id==$key) selected @endif  {{ $daily_sales_report_branch_id==$key ? 'selected':''}}>{{$bname}}</option>
                       @empty
                       <option>No Branch</option>
                       @endforelse
                       <input type="hidden" id="select_branch_id" value="{{$selbranch->id}}">
                       <input type="hidden" id="daily_sales_report_filter" start_date="{{$daily_sales_report_start_date ==''?'':date('d/m/y',strtotime($daily_sales_report_start_date))}}" end_date="{{$daily_sales_report_end_date ==''?'':date('d/m/y',strtotime($daily_sales_report_end_date))}}">
                     </select>
                   </div>

                   <div class="date_range_wrapper wrap-align-input">
                     <i class="fas fa-calendar-alt mx-2"></i>
                     <input type="text" class="input-wrap w-100 col-10" name="date_range" placeholder="Date" autocomplete="off"/> 
                   </div>
                 </div>

                 <div class="apply_reset_btn ml-0">
                   <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                   <button class="btn btn-primary reset-button mr-1 d-none" id="reset_filter_btn" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>

                   <!--  &nbsp;&nbsp; -->
                   @can('download_daily_sales_report')
                   <button class="action-button download-cashdeposit btn btn-danger downloaded" title="Download Report" data-url="{{route('daily-sales.download')}}" ><i class="download fa fa-download"></i></button>
                   @endcan
                   <div class="full_options mb-0 ml-1" id="full_screen_btns">
                    <button onclick="goFullScreen()">Full Screen</button>
                  </div>
                </div>                             
              </div>                                                    
            </div>                 
          </div>
        </div>
      </div>

      <div class="card-body table form full_wrap mb-0"   >
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif
        <div class="table-responsive" id="full">

          <table style="width:100%" id="order-online-users-list" class="table table-bordered table-hover yajra-datatable table-responsive">
            <thead>
              <tr>
                <!-- <th class="order-first align-top sorting_disabled">S.No</th> -->
                <!--   <th class="order-first align-top sorting_disabled" style="white-space: nowrap;padding: 5px;">Day</th> -->
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding: 5px;">Date</th>
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding: 5px;">Rv No</th>
                @forelse($headerscolumn as $headers)
                <th class="align-top sorting_disabled" title="dfsd"  style="white-space: nowrap;padding: 5px;">{{$headers}}</th>
                @empty
                @endforelse 
                @if(Gate::check('download_daily_sales_report') || Gate::check('view_daily_sales_report') || Gate::check('delete_daily_sales_report') || Gate::check('edit_daily_sales_report') )      
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding: 5px;">Actions</th>
                @endif    

                <!-- <th class="first align-top sorting_disabled">Action</th> -->
              </tr>
            </thead>
            <tbody class="filter_date_show" id="orders_list">  



              @foreach($data as $keys => $AllData)         

              @if($keys==0)
              <tr> 
                <td style="display:none"></td>
                <td style="display:none"></td>
                <td style="display:none"></td>
                <td style="display:none"></td>
                <td style="display:none"></td>
                <td style="display:none"></td>
                <td style="display:none"></td>
                 @if(Gate::check('download_daily_sales_report') || Gate::check('view_daily_sales_report') || Gate::check('delete_daily_sales_report') || Gate::check('edit_daily_sales_report') )    
                <td style="display:none"></td>
                 @endif    

                <td colspan="10" class="separator font-weight-bold">{{date('F Y',strtotime($AllData->report_date ))}}</td>
              </tr> 
              @endif 

              <tr>
               <!--  <td class="table_td" style="white-space: nowrap; padding: 5px;" >{{date('D', strtotime($AllData->report_date))}}</td> -->
               <td class="table_td" style="white-space: nowrap; padding: 5px;" >{{date('d/m/Y', strtotime($AllData->report_date))}}</td>
               <td class="table_td" style="white-space: nowrap; padding: 5px;" >
                {{--$AllData->rv_number ?? 'N/A'--}}

                <span class="mr-2 reports_rv_number">{{$AllData->rv_number }}</span> 

                   @can('edit_daily_sales_report')
                <span> 
                 <i class="text-warning fa fa-edit reports_rv_number_edit" report-id='{{$AllData->id}}' style="font-size:15px;cursor: pointer;" title="Edit Rv No"></i>
                 <i class="text-success fa fa-save reports_rv_number_save d-none" report-id='{{$AllData->id}}' style="font-size:22px;cursor: pointer;" title="Update Rv No"></i>
               </span>
                  @endcan

             </td>
             <td class="table_td" style="white-space: nowrap; padding: 5px;" >
              {{   $AllData->gross_sale==''? '-':  "KD ".number_format($AllData->gross_sale,3, '.','')}}
            
            </td>
             <td class="table_td" style="white-space: nowrap; padding: 5px;" >
              {{   $AllData->discount_return==''? '-':  "KD ".number_format($AllData->discount_return,3, '.','')}}</td>
             <td class="table_td" style="white-space: nowrap; padding: 5px;" >
              {{   $AllData->net_sale==''? '-':  "KD ".number_format($AllData->net_sale,3, '.','')}}
            
            </td>
 
             <td style="white-space: nowrap; padding: 5px;">
              {{   $AllData->cash_in_hand_opening_balance==''? '-':  "KD ".number_format($AllData->cash_in_hand_opening_balance,3, '.','')}}
 
             <td style="white-space: nowrap; padding: 5px;">

           {{   $AllData->cash_deposit_in_bank==''? '-':  "KD ".number_format($AllData->cash_deposit_in_bank,3, '.','')}}
            
           </td>

             <td style="white-space: nowrap; padding: 5px;">
              {{   $AllData->cash_in_hand_closing_balance==''? '-':  "KD ".number_format($AllData->cash_in_hand_closing_balance,3, '.','')}}

 </td> 

             <td class="table_td" style="white-space: nowrap; padding: 5px;">
               
                @can('download_daily_sales_report')
               <a class="m-1" title="Download" href="{{route('download-dsr-pdf',['id' =>$AllData->id])}}"><i class="fa fa-download"></i></a>
               @endcan
                 @can('view_daily_sales_report')
               <a class="action-button" title="View" href="{{route('daily-sales.view',['id' =>$AllData->id])}}"><i class="text-info fa fa-eye"></i></a>    
               @endcan

               @can('edit_daily_sales_report')
               <a class="action-button" title="Edit" href="{{route('daily-sales.edit',['id' =>$AllData->id])}}"><i class="text-warning fa fa-edit"></i></a>   
               @endcan

               @can('delete_daily_sales_report')
               <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$AllData->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
               @endcan

             </td> 


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
 </div>

<div class="modal fade" id="dsrmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="btn btn-danger download-image" data-dismiss="modal"><i class="fas fa-download mr-2"></i>Download Now</button>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
          <div class="bg-white pt-3" id="dsr_image">
                 
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
  <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
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

  .dataTables_wrapper {
   display: block;
 }


 .reports_rv_number:focus { 
  border: 3px solid yellow;
  padding: 2px;
}
.dataTables_wrapper .table-bordered {
  display: inline-table;
  margin-bottom: 0;
}
.dataTables_filter {
  width: 100%;
  display: flex;
  justify-content: end;
}
.dataTables_wrapper .dataTables_filter label {
  width: 20%;
}
@media screen and (max-width: 1500px) {
  .dataTables_scroll .dataTables_scrollHeadInner {
    overflow-x: scroll;
    width: 100% !important;
  }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
     <script>
        $("#date").datepicker({
            dateFormat: 'dd/mm/yy',
            maxDate: new Date()
        });
    </script>

<script>
 $(document).ready(function() {
   
  //Check sessions.........
      var check_session_value_parent = $('#daily_sales_report_filter');
      var check_session_value_start_date = $(check_session_value_parent).attr('start_date');
      var check_session_value_end_date = $(check_session_value_parent).attr('end_date');
      //alert(check_session_value_end_date.length);
      
      if(check_session_value_start_date.length == 0){
         
       var today = new Date();
       var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

    //  today = mm + '/' + dd + '/' + yyyy;
    today = dd + '/' + mm + '/' + yyyy;
    var start = 01 + '/' + mm + '/' + yyyy;

 




    $('input[name="date_range"]').daterangepicker({
      "startDate": start,
      "endDate": today,
      "autoApply": true,
        //autoUpdateInput: false,
        disableDates: ["we", "th"],
        locale: {
         cancelLabel: 'Clear',
         format: 'DD/MM/YYYY',
                    separator: " - "
       }
     });

    $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });


            
    }else{
       

      $('input[name="date_range"]').daterangepicker({
        "startDate": check_session_value_start_date,
        "endDate": check_session_value_end_date,
        "autoApply": true,
        //autoUpdateInput: false,
        disableDates: ["we", "th"],
        locale: {
         cancelLabel: 'Clear',
         format: 'DD/MM/YYYY',
                    separator: " - "
       }
     });

      $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
      });

      $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });
       


          

          var date_range = $('input[name="date_range"]').val().split('-');
          var branch_id=$('#select_branch').val();

            // if(date_range.length>1){
              console.log('consoel------');

              $('#reset_filter_btn').removeClass('d-none');
              $('#full_screen_btn').removeClass('d-none');

              $.ajax({
                url:"{{route('daily-sales.filter')}}",
                method:"POST",
                data:{
                 'date_range':date_range,
                 'branch_id':branch_id

               },
               dataType:"JSON",
               success:function(response){
                console.log(response);
                $('#order-online-users-list').DataTable().clear().destroy();
                $('#orders_list').html(response.html);
                $('#order-online-users-list').DataTable({
                  "ordering": false,
                  scrollY: '70vh',
                  scrollCollapse: true,
                  paging: false,
                 
                });
              } 
            }); 


        

      }  

  //Check sessions.........


  
      
    });


 $(document).ready(function(){
   $('#order-online-users-list').on('search.dt', function() {
    var value = $('.dataTables_filter input').val();
    localStorage.setItem("dsr_search_key",value); 
}); 
 });

 
 $(document).ready(function() {  

  var table = $('#order-online-users-list').DataTable( {
   "ordering": false,
   scrollY: '70vh',
   scrollCollapse: true,
   paging: false,
 

 });

  $('.download-cashdeposit').on('click',function(){
   var date_range = $('input[name="date_range"]').val();
   var branch_id=$('#select_branch').val();

   if(date_range!="")
   {
    date_range=date_range.split('-');
    var url=$(this).attr('data-url')+"/"+date_range[0].replaceAll('/','-').replaceAll(' ','')+"/"+date_range[1].replaceAll('/','-').replaceAll(' ','')+"/"+branch_id;

    window.location.href=url;
  }else{
    var date = new Date();
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    let start = moment(firstDay).format('DD-MM-YYYY');
    var lastDay =  new Date(date.getFullYear(), date.getMonth() + 1, 0);
    let end = moment(lastDay).format('DD-MM-YYYY');
    var url=$(this).attr('data-url')+"/"+start+"/"+end+"/"+branch_id;

    window.location.href=url;
  }

});
 

       // $('.apply-filter').on('click',function(e){
         $(document).on('click','.apply-filter',function(e){

          console.log('hello--1');
          e.preventDefault();
          console.log('hello--2');

          var date_range = $('input[name="date_range"]').val().split('-');
          var branch_id=$('#select_branch').val();

            // if(date_range.length>1){
              console.log('consoel------');

              $('#reset_filter_btn').removeClass('d-none');
              $('#full_screen_btn').removeClass('d-none');

              $.ajax({
                url:"{{route('daily-sales.filter')}}",
                method:"POST",
                data:{
                 'date_range':date_range,
                 'branch_id':branch_id

               },
               dataType:"JSON",
               success:function(response){
                console.log(response);
                $('#order-online-users-list').DataTable().clear().destroy();
                $('#orders_list').html(response.html);
                $('#order-online-users-list').DataTable({
                  "ordering": false,
                  scrollY: '70vh',
                  scrollCollapse: true,
                  paging: false,
                 
                });
              } 
            });
            

          }); 

         $('.reset-button').on('click',function(e){

          e.preventDefault();
          $('#reset_filter_btn').addClass('d-none');
          $('#full_screen_btn').addClass('d-none');
          var date_range = $('input[name="date_range"]').val('');
          var branch_id=$('#select_branch_id').val();
          $('#select_branch').val(branch_id);

          var date = new Date();

          var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
          let start = moment(firstDay).format('DD/MM/YYYY');

          var lastDay =  new Date(date.getFullYear(), date.getMonth() + 1, 0);
          let end = moment(lastDay).format('DD/MM/YYYY');

          var date_range=[start,end];

          var today = new Date();
       var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

    //  today = mm + '/' + dd + '/' + yyyy;
    today = dd + '/' + mm + '/' + yyyy;
    
         
            $('input[name="date_range"]').daterangepicker({
        "startDate": start,
        "endDate": today,
        "autoApply": true,
        //autoUpdateInput: false,
        disableDates: ["we", "th"],
        locale: {
         cancelLabel: 'Clear',
         format: 'DD/MM/YYYY',
                    separator: " - "
       }
     });



          $.ajax({
            url:"{{route('daily-sales.filter')}}",
            method:"POST",
            data:{
             'date_range':date_range,
             'branch_id':branch_id,
             'from_filter':'reset'
           },
           dataType:"JSON",
           success:function(response){
            console.log(response);
            $('#order-online-users-list').DataTable().clear().destroy();
            $('#orders_list').html(response.html);
            $('#order-online-users-list').DataTable({
             "ordering": false, 
             scrollResize: true,
             scrollY: '70vh',
             scrollCollapse: true,
             paging: false,
            
           });

          } 
        });
        });
       });










 $(document).on('click','.delete-button',function(){
   var id = $(this).attr('data-id');

       //  var dates = $(this).attr('data-date');
         //var branch_id=$('#select_branch').val();
         var obj = $(this);
         //alert("branch_id ="+branch_id+"dates ="+dates);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to  delete this Daily Sales Report(DSR) ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{route('daily-sales.delete')}}",
            type: 'post',
            data: {
              id:id,
             // branch_id:branch_id,  
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
             $('#flash-message').html('Daily Sales Report(DSR)   Deleted Successfully');
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



      <script type="text/javascript">

        $(document).ready(function(){

         $(document).on('click','.reports_rv_number_edit',function(){
           var getFistSpanEdit = this;
           var report_id = $(this).attr('report-id');
           var parent_td = this.parentElement.parentElement;
           var editParent = this.parentElement; 
           var getFistSpanSave = parent_td.getElementsByClassName('reports_rv_number_save')[0]; 

           var getFistSpan = parent_td.getElementsByClassName('reports_rv_number')[0]; 
         //console.log(parent_td);
         //console.log(getFistSpanSave);
         getFistSpan.setAttribute('contenteditable',true);
         getFistSpan.focus();


         $(getFistSpanEdit).addClass('d-none');
         $(getFistSpanSave).removeClass('d-none');


         $(getFistSpanSave).click(function(){
          var updated_value = $(getFistSpan).text();
              //alert(updated_value); 
              //ajax request here
      // alert(report_id+""+updated_value);


      $.ajax({
        url:"{{route('edit.rv.no')}}",
        method:"POST",
        data:{
          report_id:report_id,
          rv_number:updated_value,
        },
        dataType:"JSON",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){

          if(response.success)
          {
            toastr.success('Rv Number Updated Successfully');
            
          }else{
            toastr.error('Something Went To Wrong');
          }


        }
      });




      $(getFistSpanSave).addClass('d-none');
      getFistSpan.setAttribute('contenteditable',false);
             // getFistSpan.focus(false);
             $(getFistSpanEdit).removeClass('d-none');  


           });


       });

       });


     </script>



        <script>
        $(document).on('click', '.download-dsr-for-all-branch', function() {
           var date = $('#date').val();
            // var url = "{{ url('reports/daily-reports/sales-report/daily-sales/download-dsr-image') }}";
            // url = url + '/' + btoa(date);
            // window.location = url;



                $.ajax({
            url:"{{route('download-dsr-image')}}",
            method:"POST",
            data:{
             
             'date':date,
             
           },
           dataType:"JSON",
           success:function(response){
            console.log(response);
          
          

               $('#dsrmodal').modal({
                'show':true,
                 backdrop: 'static',
                 keyboard: false
              });

               $('#dsr_image').html(response.html);  
          
           //------------
         
          function downloadReport(){
       
  let region = document.getElementById('dsr_image');  
 
  html2canvas(region, {
    onrendered: function(canvas) {
      let pngUrl = canvas.toDataURL(); // png in dataURL format
      console.log(pngUrl);
   

      console.log(pngUrl);
      
        var a = document.createElement("a"); //Create <a>
    a.href = pngUrl //Image Base64 Goes here
    a.download = "Image.png"; //File name Here
    a.click();

      // here you can allow user to set bug-region
      // and send it with 'pngUrl' to server
    },
  });
         }


     $('.download-image').on('click',function(){
        downloadReport();
     });    

            //---------------

            
          } 
        });


        });




    </script>


     @stop