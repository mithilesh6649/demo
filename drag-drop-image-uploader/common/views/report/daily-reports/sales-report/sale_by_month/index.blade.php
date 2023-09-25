@extends('adminlte::page')

@section('title', 'Super Admin | Sales Reporting')

@section('content_header')

@section('content')


                     
<?php 
  
  $sales_by_month_start_year = Session::get('sales_by_month_start_year');
  $sales_by_month_branch_id = Session::get('sales_by_month_branch_id');

?>
 
  



<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">
  </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Sales By Month</h3>
            <!-- <div class="d-flex align-items-center justify-content-start">
              <div class="card-header p-0" style="display: none; border: none;">
                <h3></h3>
                <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
              </div>
              <span class="font-weight-bold"></span>
              <a class="action-button download-cashdeposit" title="Download Report" href="#" data-url="{{route('cash-deposit.download')}}" ><i class="text-warning fa fa-download "></i></a>
            </div>  -->
          </div>

            <div class="advance_filter text-right mb-3 " >
                <div class="advance-options" style="">
                   <div class="title">
                     <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                   </div>
                   <div class="left_option">
                     <div class="left_inner">
                       <h6>Select Date Range</h6>
                         <div class="button_input_wrap">
                        <div class="date_range_wrapper wrap-align-input">
                         <div class="selected_branch mr-2">
                            <select class="form-select" id="select_branch">
                             @forelse($branch as $key=>$bname)
                              <option value="{{$key}}" @if($selbranch->id==$key) selected @endif   

                               {{ $sales_by_month_branch_id==$key ? 'selected':''}}
                                >{{$bname}}</option>
                             @empty
                              <option>No Branch</option>
                             @endforelse
                           </select>
                           <input type="hidden" id="select_branch_id" value="{{$selbranch->id}}">

                           <input type="hidden" id="sales_by_month_filter"  start_year="{{$sales_by_month_start_year ==''?'': $sales_by_month_start_year }}">

                         </div>
                         <div class="date_range_wrapper wrap-align-input">
                          <div class="selected_branch mr-2 w-100">
                            <select id="selected_year">
                              <!-- @for($year=env('YEAR'); $year<=date('Y'); $year++)
                               <option value="{{$year}}" @if(date('Y')==$year) selected @endif>{{$year}}</option>
                              @endfor -->

                               @for($i=2022;$i<=date('Y');$i++)
                                            <option value="{{$i}}" @if($i==date('Y')) selected @endif>{{$i}}</option>
                                        @endfor
                            </select>
                          <!--  <input type="text" class="input-wrap w-100 col-10" style="min-width:300px" name="date_range" placeholder="Date" autocomplete="off"/> -->
                         </div>
                          </div>
                        </div>
                        <div class="apply_reset_btn ml-0">
                           <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                           <button class="btn btn-primary reset-button mr-1 d-none" id="reset_filter_btn" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>

                          <!--  &nbsp;&nbsp; -->
                             @can('download_sales_by_month_report')

                              <button class="action-button download-cashdeposit btn btn-danger downloaded" title="Download Report" data-url="{{route('sales-by-month.download')}}" ><i class="download fa fa-download"></i></button>

                              @endcan

                          <div class="full_options d-none" id="full_screen_btn">
                          <button onclick="goFullScreen()">Full Screen</button>
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

         <div id="full">

            <table style="width:100%" id="order-online-users-list" class="table table-bordered table-hover yajra-datatable table-responsive">
                <thead>
                  <tr>
                  <!-- <th class="order-first align-top sorting_disabled">S.No</th> -->
                 <!--  <th class="order-first align-top sorting_disabled" style="white-space: nowrap;padding: 20px;">Day</th> -->
                  <th class="order-first align-top sorting_disabled" style="white-space: nowrap; padding:10px;">Month</th>
                  @forelse($headerscolumn as $headers)
                   <th class="align-top sorting_disabled" style="white-space: nowrap;padding: 10px;">{{$headers}}</th>
                  @empty
                  @endforelse

                  <!-- <th class="first align-top sorting_disabled">Action</th> -->
                  </tr>
                </thead>
                <tbody class="filter_date_show" id="orders_list">

                  @foreach($allmonth as $mkey=>$month)
                    <tr>

                      <td class="table_td" style="white-space: nowrap;">{{$month}}</td>
                      @if(in_array($mkey,array_keys($month_datavalue)))

                        @foreach($headerscolumn as $bkey=>$daily_salse)

                           <td class="table_td" title="{{$daily_salse}}">{{ $month_datavalue[$mkey][$bkey] == 0 ? '-' : number_format( (float) $month_datavalue[$mkey][$bkey], 3, '.', '')}}</td>


                        @endforeach

                      @else

                        @foreach($headerscolumn as $bkey=>$daily_salse)
                            <td class="table_td">-</td>
                        @endforeach

                      @endif
                      <!-- <td><a class="action-button" title="View" href="#" data-date=""><i class="text-info fa fa-eye eye_green"></i></a></td> -->
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

#full{
      overflow: auto;
      background-color:white !important;
     }
/*.align-top{
  font-weight: bold;
  font-size:15px !important;
}
.reports_rv_number:focus {
    border: 1px solid red;
    padding: 2px;
     }*/
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
         
       // "ordering": false,
         scrollResize: true,
         scrollY: '70vh',
         scrollCollapse: true,
         paging: false

       });

       $('.download-cashdeposit').on('click',function(){
             var year = $('#selected_year').val();
             var branch_id=$('#select_branch').val();

           if(year!="")
           {

              var url=$(this).attr('data-url')+"/"+year+"/"+branch_id;

               window.location.href=url;
           }else{
                var date = new Date();
                var year =date.getFullYear();

               var url=$(this).attr('data-url')+"/"+year+"/"+branch_id;

            window.location.href=url;
          }

       });


       $('.apply-filter').on('click',function(e){
            e.preventDefault();

            //var date_range = $('input[name="date_range"]').val().split('-');
            var year=$('#selected_year').val();
            var branch_id=$('#select_branch').val();
              $('#reset_filter_btn').removeClass('d-none');
            $('#full_screen_btn').removeClass('d-none');
            if(year.length>0){

            $.ajax({
              url:"{{route('sales-by-month.filter')}}",
              method:"POST",
              data:{
                     'year':year,
                     'branch_id':branch_id

                    },
              dataType:"JSON",
              success:function(response){
                console.log(response);
                 $('#order-online-users-list').DataTable().clear().destroy();
                  $('#orders_list').html(response.html);
                 $('#order-online-users-list').DataTable({
                  //"ordering": false,
                   scrollResize: true,
                   scrollY: '70vh',
                   scrollCollapse: true,
                   paging: false
                 });
              }
            });
          }

       });

        $('.reset-button').on('click',function(e){

            e.preventDefault();
            $('#reset_filter_btn').addClass('d-none');
              $('#full_screen_btn').addClass('d-none');
             var year=new Date().getFullYear();
             $('#selected_year').val(year);
             var branch_id=$('#select_branch_id').val();
             $('#select_branch').val(branch_id);

            $.ajax({
              url:"{{route('sales-by-month.filter')}}",
              method:"POST",
              data:{
                     'year':year,
                     'branch_id':branch_id,
                       'from_filter':'reset'
                    },
              dataType:"JSON",
              success:function(response){
                console.log(response);
                 $('#order-online-users-list').DataTable().clear().destroy();
                  $('#orders_list').html(response.html);
                 $('#order-online-users-list').DataTable({
                 // "ordering": false,
                  scrollResize: true,
                   scrollY: '70vh',
                   scrollCollapse: true,
                   paging: false
                 });

              }
          });
       });
    });
</script>

<script type="text/javascript"> 
    $(document).ready(function(){
         //Check sessions.........
      var check_session_value_parent = $('#sales_by_month_filter');
      var check_session_value_start_year = $(check_session_value_parent).attr('start_year');
    //  alert(check_session_value_start_year);
         if(check_session_value_start_year.length != 0){
             
                     var year=check_session_value_start_year;
            var branch_id=$('#select_branch').val();
              $('#reset_filter_btn').removeClass('d-none');
            $('#full_screen_btn').removeClass('d-none');
            if(year.length>0){

            $.ajax({
              url:"{{route('sales-by-month.filter')}}",
              method:"POST",
              data:{
                     'year':year,
                     'branch_id':branch_id

                    },
              dataType:"JSON",
              success:function(response){
                console.log(response);
                 $('#order-online-users-list').DataTable().clear().destroy();
                  $('#orders_list').html(response.html);
                 $('#order-online-users-list').DataTable({
                 // "ordering": false,
                   scrollResize: true,
                   scrollY: '70vh',
                   scrollCollapse: true,
                   paging: false
                 });
              }
            });
          }


         }
    });
</script>
@stop
