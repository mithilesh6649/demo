@extends('adminlte::page')

@section('title', 'Super Admin | Sales Reporting')

@section('content_header')

@section('content')


 
 
 <?php 
  
  $cash_deposite_branch_wise_month = Session::get('cash_deposite_branch_wise_month');
  $cash_deposite_branch_wise_year = Session::get('cash_deposite_branch_wise_year');  
 
?> 
 

 

 

<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">
  </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Cash Deposite Branch Wise</h3>

          </div>
               <input type="hidden" id="cash_deposite_filter" start_month="{{$cash_deposite_branch_wise_month ==''?'': $cash_deposite_branch_wise_month }}" start_year="{{$cash_deposite_branch_wise_year ==''?'': $cash_deposite_branch_wise_year }}">

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


                          <div class="form-group">
                            <select id="selected_year" class="form-control col-12">
                            <!-- @for($year=env('YEAR'); $year<=date('Y'); $year++)
                              <option value="{{$year}}" @if(date('Y')==$year) selected @endif>{{$year}}</option>
                            @endfor -->
                             @for($i=2022;$i<=date('Y');$i++)
                                            <option value="{{$i}}" @if($i==date('Y')) selected @endif>{{$i}}</option>
                             @endfor
                          </select>
                        </div>
                      &nbsp;&nbsp;
                         <div class="form-group">
                           <select id="selected_month" class="form-control col-12" style="width: 300px;">
                            @for($m=1; $m<=12; $m++)
                              <option value="{{(int)date('m', mktime(0,0,0,$m))}}" @if(date('m')==date('m', mktime(0,0,0,$m))) selected @endif>{{date('F', mktime(0,0,0,$m))}}</option>
                            @endfor

                          </select>
                        </div>



                        </div>

                        <div class="apply_reset_btn">
                           <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                           <button class="btn btn-primary reset-button mr-1 d-none" id="reset_filter_btn" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>
                           @can('download_cash_deposite_branch_wise_report')
                           <button class="action-button download-cashdeposit btn btn-danger downloaded" title="Download Report" data-url="{{route('cash-deposit.download')}}" ><i class="download fa fa-download "></i></button>
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

          <div class="card-body table form full_wrap mb-0">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif


            <div class="table-responsive" id="full">
              <table style="width:100%" id="order-online-users-list" class="table table-bordered table-hover yajra-datatable">
                  <thead>

                         {!! $html_design !!}
                    <tr>
                    <!-- <th class="order-first align-top sorting_disabled">S.No</th> -->
                    <th class="order-first align-top sorting_disabled headdisn" >Date</th>
                    <th class="order-first align-top sorting_disabled headdisn">Day</th>
                    @forelse($branch as $branch_name)
                     <th class="align-top sorting_disabled headdisn" >{{$branch_name}}</th>
                    @empty
                    @endforelse
                    <th>Total</th>
                    <!-- <th class="first align-top sorting_disabled">Action</th> -->
                    </tr>
                  </thead>
                  <tbody class="filter_date_show" id="orders_list">

                    @foreach($aDates as $dates)


                        @if(in_array($dates,array_keys($dailymonthdepositbank)))

                          <?php

                          $total_sum = 0;

                          ?>

                           <tr>

                           <td class="table_td">{{date('d/M/Y',strtotime($dates))}}</td>
                           <td class="table_td">{{date('D',strtotime($dates))}}</td>

                          @foreach($branch as $bkey=>$branch_name)

                            @if(in_array($bkey,array_keys($dailymonthdepositbank[$dates])))

                            <?php

                            $total_sum = $total_sum + $dailymonthdepositbank[$dates][$bkey]['cash_deposit_in_bank'];

                            ?>


                             <td class="table_td">{{$dailymonthdepositbank[$dates][$bkey]['cash_deposit_in_bank'] == 0 ? '-' :number_format( (float) $dailymonthdepositbank[$dates][$bkey]['cash_deposit_in_bank'], 3, '.', '')}}</td>
                               @else
                            <td class="table_td">-</td>
                            @endif

                          @endforeach

                            <td>{{ $total_sum == 0 ? '-' : number_format( (float)$total_sum, 3, '.', '')}}</td>
                        @else

                         <!--  @foreach($branch as $bkey=>$branch_name)
                             <td class="table_td">{{number_format( (float) 0, 3, '.', '')}}</td>
                          @endforeach -->

                        @endif
                           </tr>
                        <!-- <td><a class="action-button" title="View" href="#" data-date="{{$dates}}"><i class="text-info fa fa-eye eye_green"></i></a></td> -->

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
.dataTables_wrapper {
   display: block;
}

.reports_rv_number:focus {
    border: 1px solid red;
    padding: 2px;
     }

      .headdisn{
         white-space: nowrap; padding-left:5px;padding-right: 5px;padding-bottom:10px;padding-top: 10px;
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
       $('#order-online-users-list').DataTable({
       // "ordering": false,
        "order":    [[ 0, "DESC" ]],
        scrollY: '70vh',
        scrollCollapse: true,
        paging: false,
       });

       $('.download-cashdeposit').on('click',function(){
             var month=$('#selected_month').val();
             var year=$('#selected_year').val();
             var url=$(this).attr('data-url')+"/"+month+"/"+year;
            window.location.href=url;
       });


       $('.apply-filter').on('click',function(e){
             $('#reset_filter_btn').removeClass('d-none');

            var month=$('#selected_month').val();
            var year=$('#selected_year').val();

            e.preventDefault();
            $.ajax({
              url:"{{route('cash-deposit.filter')}}",
              method:"POST",
              data:{
                     'year':year,
                     'month':month
                    },
              dataType:"JSON",
              success:function(response){
                console.log(response);
                 $('#order-online-users-list').DataTable().clear().destroy();
                  $('#show_total_amt').html(response.html_design);
                  $('#orders_list').html(response.html);
                 $('#order-online-users-list').DataTable({
                   "order":    [[ 0, "DESC" ]],
                  //"ordering": false,
                  scrollY: '70vh',
                  scrollCollapse: true,
                  paging: false,
                 });
              }
            });

       });

        $('.reset-button').on('click',function(e){
            $('#reset_filter_btn').addClass('d-none');

            var month=<?=date('m')?>;
            var year=<?=date('Y')?>;

            $('#selected_year').val(year);
            $('#selected_month').val(month);

            e.preventDefault();
            $.ajax({
              url:"{{route('cash-deposit.filter')}}",
              method:"POST",
              data:{
                     'year':year,
                     'month':month,
                     'from_filter':'reset'
                    },
              dataType:"JSON",
              success:function(response){ 
                console.log(response);
                 $('#order-online-users-list').DataTable().clear().destroy();
                  $('#show_total_amt').html(response.html_design);
                  $('#orders_list').html(response.html);
                 $('#order-online-users-list').DataTable({
                    "order":    [[ 0, "DESC" ]],
                   //"ordering": false,
                    scrollY: '70vh',
                    scrollCollapse: true,
                    paging: false,
                 });

              }
          });
       });
    });
</script>


<script type="text/javascript">
  $(document).ready(function(){
     
     //Check sessions.........
      var check_session_value_parent = $('#cash_deposite_filter');
      var check_session_value_start_month = $(check_session_value_parent).attr('start_month');
      var check_session_value_start_year = $(check_session_value_parent).attr('start_year');
       if(check_session_value_start_month.length != 0){
             $('#reset_filter_btn').removeClass('d-none');
             var month=$('#selected_month').val(check_session_value_start_month);
             var year=$('#selected_year').val(check_session_value_start_year);

            $.ajax({
              url:"{{route('cash-deposit.filter')}}",
              method:"POST",
              data:{
                     'year':check_session_value_start_year,
                     'month':check_session_value_start_month
                    },
              dataType:"JSON",
              success:function(response){
                console.log(response);
                 $('#order-online-users-list').DataTable().clear().destroy();
                  $('#show_total_amt').html(response.html_design);
                  $('#orders_list').html(response.html);
                 $('#order-online-users-list').DataTable({
                    "order":    [[ 0, "DESC" ]],
                 // "ordering": false,
                  scrollY: '70vh',
                  scrollCollapse: true,
                  paging: false,
                 });
              }
            });


       }

  });
</script>
@stop
