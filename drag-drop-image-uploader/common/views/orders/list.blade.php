@extends('adminlte::page')

@section('title', 'Super Admin | Orders')

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
            <h3>Orders</h3>
            <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
          </div>
          <div class="advance_filter mb-3 collapse" id="advanceOptions">
            <div class="advance-options" style="">
             <div class="title">
               <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
             </div>
             <div class="left_option">
               <div class="left_inner">
                 <h6>Select Date Range</h6>
                 <div class="button_input_wrap">
                  <div class="date_range_wrapper wrap-align-input">
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
      <div class="card-body table p-0 mb-0">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif


        <table style="width:100%" id="order-online-users-list" class="table table-bordered table-hover yajra-datatable">
         <thead>
          <tr>


            <th>Customer Info</th>


            <th>Delivery type</th>

            <th>Status</th>
            <th>Placed At</th>
            @if(Gate::check('view_order'))

            <th>{{ __('adminlte::adminlte.actions') }}</th>
            @endif
          </tr>
        </thead>
        <tbody class="filter_date_show" id="orders_list">
          @foreach($allOrdersList as $allOrders)

          <tr>

           <!-- Customer Details -->
           <td>
            <a href="@if(isset($allOrders->user->id)) {{route('view_user',['id' =>$allOrders->user->id])}} @else javascript:0; @endif">
              <span>{{$allOrders->address->first_name ?? 'N/A'}} {{$allOrders->address->last_name ?? 'N/A'}}</span>
              <span>({{$allOrders->address->mobile_number ?? 'N/A'}})</span>

            </a>
          </td>


          <td>


            @if($allOrders->delivery_type == 'take_away')
            <span class="badge badge-success p-2">Take Away</span>
            @else
            <span class="badge badge-success p-2">Delivery</span>
            @endif
          </td>


          <td>



            <select
            @foreach ($allOrders->orderLogs as $user)
            {{$user->status == 'rejected'  || $user->status == 'cancelled' || $user->status == 'delivered'? 'disabled':'' }}
            @endforeach  class="form-control changestatus" name="status" data-id="{{$allOrders->id}}"   @can('edit_order') @else disabled  @endcan>

            @foreach($order_summary_logs as $order_summary)

            @if(isset($allOrders->orderLogs[0]))
            <option  @foreach ($allOrders->orderLogs as $user)
              {{$user->status == $order_summary->value ? 'disabled':'' }}
              @endforeach  value="{{ $order_summary->value }}" {{ $order_summary->value == $allOrders->orderLogs[0]->status ? 'selected':'' }} > {{ $order_summary->name }}</option>
              @endif
              @endforeach



            </select>




          </td>

          <td>{{ date('d/m/Y h:i A',strtotime($allOrders->created_at))}}  </td>
          @if(Gate::check('view_order'))

          <td>
            <a class="btn info_btn" data-toggle="tooltip" data-placement="right" title="Quick View">
             <i class="fa fa-question-circle quick_view" data-id="{{ $allOrders->id }}" order-placed-on="{{ date('d/m/Y h:i A',strtotime($allOrders->created_at))}}"></i>
           </a>

           <a class="action-button" title="View" href="{{route('orders.view',['id'=>$allOrders->id])}}"><i class="text-info fa fa-eye"></i></a>
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


<!-- Modal -->
<div id="myModal" class="modal  fade  " role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <div >
            Order Placed At  :  <span class="placed_date"> </span>
          </div>

        </h4>
      </div>
      <div class="modal-body">

       <!--start container -->
       <div class="model-back container-fluid" id="quick_view_container">



       </div>

       <!--end container -->

     </div>

   </div>

 </div>
</div>

<!--end modal -->

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
   //  $('body').on('click', '.delete-button', function(e) {
     $(document).ready(function(){


       // $('.quick_view').each(function(){
       //    $(this).click(function(){

       //        var data_id = $(this).attr('data-id');
       //        var order_placed_date = $(this).attr('order-placed-on');
       //         $.ajax({
       //            type:"post",
       //            url:"{{route('orders.show')}}",
       //            data:{
       //               "_token": "{{ csrf_token() }}",
       //               "id": data_id
       //            },
       //            dataType: "JSON",
       //            success:function(response){
       //              //console.log(response);
       //             // alert(response.status);
       //             $('.placed_date').html(order_placed_date);
       //              if(response.status) {
       //                 $('#quick_view_container').html(response.html);
       //                $('#myModal').modal({
       //                  'show':true,
       //                   backdrop: 'static',
       //                   keyboard: false
       //                });

       //              }
       //            }

       //        });


       //    });
       // });



       // $('#myModal').modal({
       //      'show':true,
       //      backdrop: 'static',
       //      keyboard: false
       //    });


       $('body').on('click', '.quick_view', function(e) {

         $('#myModal').modal({
            'show':true,
            backdrop: 'static',
            keyboard: false
          });

        var data_id = $(this).attr('data-id');
        var order_placed_date = $(this).attr('order-placed-on');

        var obj = $(this);

        $.ajax({
         type:"post",
         url:"{{route('orders.show')}}",
         data:{
           "_token": "{{ csrf_token() }}",
           "id": data_id
         },
         dataType: "JSON",
         success:function(response){
          $('.placed_date').html(order_placed_date);
          if(response.status) {
           $('#quick_view_container').html(response.html);
           $('#myModal').modal({
            'show':true,
            backdrop: 'static',
            keyboard: false
          });

         }
       }

     });

      });





     });

   </script>




   <script>
    $(document).ready(function() {




     $('#order-online-users-list').DataTable( {

      dom: 'Bfrtip',
      buttons: [
      {
        extend:    'copyHtml5',
        text:      '<i class="fa fa-copy mr-1"></i> Copy',
        titleAttr: 'Copy',
        exportOptions: {
          columns: [ 0, 1, 2,3]
        },
      },
      {
        extend:    'excelHtml5',
        text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
        titleAttr: 'Excel',
        exportOptions: {
          columns: [ 0, 1, 2,3]
        },
      },
      {
        extend:    'csvHtml5',
        text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
        titleAttr: 'CSV',
        exportOptions: {
          columns: [ 0, 1, 2,3]
        },
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
        titleAttr: 'PDF',
        exportOptions: {
          columns: [ 0, 1, 2,3]
        },
      }
      ],
      select: {
        style: 'multi'
      }
    });


     $('body').on('click', '.delete-button', function(e) {

      var id = $(this).attr('data-id');
      var obj = $(this);

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to  user   ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_user') }}",
            type: 'post',
            data: {
              id: id
            },
            success: function(response) {

              if (response.trim() == 'success') {

                $("#flash-message").css("display", "block");
                $("#flash-message").removeClass("d-none");
                $("#flash-message").addClass("alert-danger");
                $('#flash-message').html('User Deleted Successfully');
                obj.parent().parent().remove();
                setTimeout(() => {
                  $("#flash-message").addClass("d-none");
                }, 5000);

              } else {
                console.log("FALSE");
                setTimeout(() => {
                  alert("Something went wrong! Please try again.");
                }, 500);

              }

            }
          });
        }
      });
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
       url: "{{ route('filter_orders') }}",
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

            dom: 'Bfrtip',
            buttons: [
            {
              extend:    'copyHtml5',
              text:      '<i class="fa fa-copy mr-1"></i> Copy',
              titleAttr: 'Copy',
              exportOptions: {
                columns: [ 0, 1, 2]
              },
            },
            {
              extend:    'excelHtml5',
              text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
              titleAttr: 'Excel',
              exportOptions: {
                columns: [ 0, 1, 2]
              },
            },
            {
              extend:    'csvHtml5',
              text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
              titleAttr: 'CSV',
              exportOptions: {
                columns: [ 0, 1, 2]
              },
            },
            {
              extend:    'pdfHtml5',
              text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
              titleAttr: 'PDF',
              exportOptions: {
                columns: [ 0, 1, 2]
              },
            }
            ],
            select: {
              style: 'multi'
            }
          });


            //Change Status

            $(document).on('change','.changestatus',function(){

             var id = $(this).attr('data-id');

             var status=$(this).find(':selected').val();
    //alert(id+status);
    $.ajax({
      url:"{{route('order.status.update')}}",
      method:"POST",
      data:{
        'status':status,
        'order_id':id,

      },
      dataType:"JSON",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success:function(response){

       if(response.status=='true')
       {
          // swal("Status!", "Status Successfully Updated. ", "success");
        }

      }
    });

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
         url:"{{route('orders_reset')}}",
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
             $('#').DataTable().clear().destroy();
             $('#orders_list').html(response.html);
             $('#order-online-users-list').DataTable( {
              dom: 'Bfrtip',
              buttons: [
              {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-copy mr-1"></i> Copy',
                titleAttr: 'Copy',
                exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
                }
              },
              {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                titleAttr: 'Excel',
                exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
                },
              },
              {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                titleAttr: 'CSV',
                exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
                },
              },
              {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                titleAttr: 'PDF',
                exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
                },
              }
              ],
              select: {
                style: 'multi'
              }
            });

           }
         }
       });
        // update table data

      })
    // filter




  </script>


  <script>

  //Change Status

  $(document).on('change','.changestatus',function(){

   var id = $(this).attr('data-id');

   var status=$(this).find(':selected').val();
    //alert(id+status);
    $.ajax({
      url:"{{route('order.status.update')}}",
      method:"POST",
      data:{
        'status':status,
        'order_id':id,

      },
      dataType:"JSON",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success:function(response){
       location.reload(true);
     }
   });

  });

</script>
@stop
