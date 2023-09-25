@extends('adminlte::page')

@section('title', 'Super Admin | Order Prepartion Time Report Part 3-3')

@section('content_header')
 
@section('content')


<?php
 
 $daily_report_sales = [];
 
 ?>


<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">
  </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Order Prepartion Time Report Part 3-3</h3>
            <div class="card-header p-0 m-0" style="display: none; border: none;">
              <h3></h3>
              <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
            </div>              
          </div>

          <div class="advance_filter text-right mb-3 collapse" id="advanceOptions">
            <div class="advance-options" style="">
               <div class="title">
                 <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
               </div>                      
               <div class="left_option">
                 <div class="left_inner">
                   <h6>Select Date Range</h6>
                   <div class="button_input_wrap">
                    <div class="date_range_wrapper wrap-align-input date_select">
                     <i class="fas fa-calendar-alt mr-2"></i>
                     <input type="text" class="input-wrap" name="date_range" placeholder="Date" autocomplete="off"/>
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

          <div class="card-body table form mb-0">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif


            <table style="width:100%" id="order-online-users-list" class="table table-bordered table-hover yajra-datatable">
                       <thead>
                      <tr>
                      <th class="order-first align-top sorting_disabled">S.No</th>
                     <!--  <th class="order-first align-top sorting_disabled">Branch Name</th>
                      <th class="order-first align-top sorting_disabled">Rv No</th>
                        <th class="first align-top sorting_disabled">Total Collection</th> -->
                       <!-- <th class="first align-top sorting_disabled">Created At</th> -->
                      <th class="first align-top sorting_disabled">Action</th>
                      </tr>
                </thead>
                  <tbody class="filter_date_show" id="orders_list">
                     
                  @forelse ($daily_report_sales as $report)
                  <tr>
                      <th class="table_th">{{ $report->id }}.</th>
                       <td class="table_td">{{ optional($report->branch)->title_en ?? 'N/A' }}</td>
                        <td class="table_td">
                          <span class="mr-2 reports_rv_number">{{ $report->rv_number }}</span> 
                          <span> 
                             <i class="text-warning fa fa-edit reports_rv_number_edit" report-id='{{$report->id}}' style="font-size:20px;cursor: pointer;" title="Edit Rv No"></i>
                             <i class="text-success fa fa-save reports_rv_number_save d-none" report-id='{{$report->id}}' style="font-size:22px;cursor: pointer;" title="Update Rv No"></i>
                          </span>
                        

                       </td>
                      <td class="table_td">KD {{ $report->total_collection }}</td>
                       <td class="table_td">{{ date('d/m/Y', strtotime($report->updated_at)) }}</td>
                      <td class="table_td"><a class="action-button" title="View"
                              href="{{ route('report.view', ['id' => $report->id]) }}"><i
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
 
 

<script>
  $(document).ready(function() {

  
      

 $('#order-online-users-list').DataTable( {

      // dom: 'Bfrtip',
      //   buttons: [
      //       {
      //           extend:    'copyHtml5',
      //           text:      '<i class="fa fa-copy mr-1"></i> Copy',
      //           titleAttr: 'Copy',
      //           exportOptions: {
      //               columns: [ 0, 1, 2,3,4,5,6,7,8,9,10]
      //           },
      //       },
      //       {
      //           extend:    'excelHtml5',
      //           text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
      //           titleAttr: 'Excel',
      //           exportOptions: {
      //                 columns: [ 0, 1, 2,3,4,5,6,7,8,9,10]
      //           },
      //       },
      //       {
      //           extend:    'csvHtml5',
      //           text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
      //           titleAttr: 'CSV',
      //           exportOptions: {
      //               columns: [ 0, 1, 2,3,4,5,6,7,8,9,10]
      //           },
      //       },
      //       {
      //           extend:    'pdfHtml5',
      //           text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
      //           titleAttr: 'PDF',
      //           exportOptions: {
      //               columns: [ 0, 1, 2,3,4,5,6,7,8,9,10]
      //           },
      //       }
      //   ],
      //   select: {
      //       style: 'multi'
      //   }
    });


 


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
    $('body').on('click','.apply-filter',function(){
      console.log('filter now');
      var date_range = $('input[name="date_range"]').val().split('-');

      // alert(date_range);
      // console.log('date range');
      console.log(date_range);
      // return false;

      if(date_range.length==1)
        return false;
      $.ajax({
           url: " ",
           method: 'post',
           data: {
               date_range: date_range
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               
               if(response.status) {
                 $('#order-online-users-list').DataTable().clear().destroy();
                $('#orders_list').html(response.html);

                 $('#order-online-users-list').DataTable( {

      // dom: 'Bfrtip',
      //   buttons: [
      //       {
      //           extend:    'copyHtml5',
      //           text:      '<i class="fa fa-copy mr-1"></i> Copy',
      //           titleAttr: 'Copy',
      //           exportOptions: {
      //               columns: [ 0, 1, 2]
      //           },
      //       },
      //       {
      //           extend:    'excelHtml5',
      //           text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
      //           titleAttr: 'Excel',
      //           exportOptions: {
      //                 columns: [ 0, 1, 2]
      //           },
      //       },
      //       {
      //           extend:    'csvHtml5',
      //           text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
      //           titleAttr: 'CSV',
      //           exportOptions: {
      //               columns: [ 0, 1, 2]
      //           },
      //       },
      //       {
      //           extend:    'pdfHtml5',
      //           text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
      //           titleAttr: 'PDF',
      //           exportOptions: {
      //               columns: [ 0, 1, 2]
      //           },
      //       }
      //   ],
      //   select: {
      //       style: 'multi'
      //   }
    }); 

          
 

  

              }
           }
       });
    });





   $('body').on('click','.reset-button',function(){
       $('input[name="date_range"]').val('');
       
       //$('.advance_options_btn').hide();


        // update table data
        $.ajax({
           url:" ",
           method: 'post',
           data: {
               reset: true
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               if(response.status) {
                 $('#order-online-users-list').DataTable().clear().destroy();
                  $('#orders_list').html(response.html);
                  $('#order-online-users-list').DataTable( {
                      // dom: 'Bfrtip',
                      //   buttons: [
                      //       {
                      //           extend:    'copyHtml5',
                      //           text:      '<i class="fa fa-copy mr-1"></i> Copy',
                      //           titleAttr: 'Copy',
                      //           exportOptions: {
                      //               columns: [ 0, 1, 2, 3, 4]
                      //           }
                      //       },
                      //       {
                      //           extend:    'excelHtml5',
                      //           text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                      //           titleAttr: 'Excel',
                      //           exportOptions: {
                      //                 columns: [ 0, 1, 2, 3, 4]
                      //           },
                      //       },
                      //       {
                      //           extend:    'csvHtml5',
                      //           text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                      //           titleAttr: 'CSV',
                      //           exportOptions: {
                      //               columns: [ 0, 1, 2, 3, 4]
                      //           },
                      //       },
                      //       {
                      //           extend:    'pdfHtml5',
                      //           text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                      //           titleAttr: 'PDF',
                      //           exportOptions: {
                      //               columns: [ 0, 1, 2, 3, 4]
                      //           },
                      //       }
                      //   ],
                      //   select: {
                      //       style: 'multi'
                      //   }
                    });

               }
           }
        });
        // update table data

     })
    // filter




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
      url:" ",
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
 
@stop