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
            <h3>Complimentary Report</h3>
            <!-- <div class="d-flex align-items-center justify-content-start"> 
              <div class="card-header p-0" style="display: none; border: none;">
                <h3></h3>
                <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
              </div>
              <span class="font-weight-bold"></span> 
              <a class="action-button download-cashdeposit" title="Download Report" href="#" data-url="{{route('cash-deposit.download')}}" ><i class="text-warning fa fa-download "></i></a>
            </div>  -->       
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
                   @can("download_sales_by_complimentary_report")
                   <button class="action-button download-cashdeposit btn btn-danger downloaded" title="Download Report" data-url="{{route('complimentary.download')}}" ><i class="download fa fa-download"></i></button>
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
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap;padding: 5px;">Date</th>
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding: 5px;">Name</th>
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding: 5px;">Contact</th>
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding: 5px;">Invoice</th>
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding: 5px;">Amount</th>
                <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding: 5px;">Ref</th>

                <!-- <th class="first align-top sorting_disabled">Action</th> -->
              </tr>
            </thead>
            <tbody class="filter_date_show" id="orders_list">  


             @php $month="";@endphp

             @foreach($data as $keys => $AllData)         
             
             @if($keys==0 || $month!=date('F Y',strtotime($AllData->report_date )) )
             <tr> 
              <td style="display:none"></td>
              <td style="display:none"></td>
              <td style="display:none"></td>
              <td style="display:none"></td>
              <td style="display:none"></td>
              <td colspan="6" class="separator font-weight-bold">
                @php $month=date('F Y',strtotime($AllData->report_date )); @endphp {{date('F Y',strtotime($AllData->report_date ))}}</td>
              </tr> 
              @endif 

              @if($AllData->complimentary_amount!=null)
              
              @php $i=0;@endphp
              @foreach(json_decode($AllData->complimentary_amount) as $amount)
              <tr>
               <td class="table_td" style="white-space: nowrap; padding: 5px;" >
                {{date('d/m/Y',strtotime($AllData->report_date))}}
                
              </td>
              <td>{{json_decode($AllData->complimentary_name)[$i]}}</td>
              <td>{{json_decode($AllData->complimentary_contact)[$i]}}</td>
              <td>{{json_decode($AllData->complimentary_invoice)[$i]}}</td>
              <td>{{number_format($amount, 3, '.', '')}}</td>
              <td>{{json_decode($AllData->complimentary_ref)[$i]}}</td>
            </tr>
            @php $i++;@endphp
            @endforeach

            @else
            <tr>
             <td class="table_td" style="white-space: nowrap; padding: 5px;" >
              {{date('d/m/Y',strtotime($AllData->report_date))}}
              
            </td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          @endif
          
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
        
        $('#reset_filter_btn').removeClass('d-none');
        $('#full_screen_btn').removeClass('d-none');

        $.ajax({
          url:"{{route('complimentary.filter')}}",
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
      url:"{{route('complimentary.filter')}}",
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
            url:"{{route('complimentary.filter')}}",
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

@stop
