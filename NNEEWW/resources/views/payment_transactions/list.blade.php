@extends('adminlte::page')

@section('title', 'Payment Transaction ')

@section('content_header')
@stop

@section('content')

<div class="container">
 <div class="alert d-none" role="alert" id="flash-message">        
 </div>

 <div class="row justify-content-center">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header alert d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">           
          <h3>Payment Transactions</h3>
        </div>          
        <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options add-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> 
      </div>


      <div class="text-right mb-3 collapse  " id="advanceOptions">
       <select class="form-control filterType">
        <option value="dateRange">Date Range</option>
        <option value="MonthlyRange">Monthly</option>
        <option value="YearlyRange">Yearly</option>
      </select>

      <div class="dateRange">
        <div class="advance-options" style="">
         <div class="title">
           <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
         </div>                      
         <div class="left_option">
           <div class="left_inner">
             <h6>Select Date Range</h6>
             <div class="button_input_wrap">
              <div class="date_range_wrapper">
               <i class="fas fa-calendar-alt mr-2"></i>
               <input type="text" name="date_range"  autocomplete="off"  />
             </div>
             <div class="apply_reset_btn">
               <button class="btn btn-primary apply apply-filter mr-1 "><i class="fas fa-paper-plane mr-2"></i>Apply</button>
               <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
             </div>                              
           </div>                                                    
         </div>

       </div>
     </div>
   </div>

   <div class="MonthlyRange d-none">
    <div class="advance-options" style="">
     <div class="title">
       <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
     </div>                      
     <div class="left_option">
       <div class="left_inner">
         <h6>Select Month and Year</h6>
         <div class="button_input_wrap">
           <div class="button_input_wrap">
            <i class="fas fa-calendar-alt ml-2 mr-2 months"></i>
            <select class="form-control month" id="select_month" >
              <option value="">Select Month</option>
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">June</option>
              <option value="07">July</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
          </div>
          <div class="button_input_wrap">
            <i class="fas fa-calendar-alt ml-2 mr-2 "></i>
            <select class="form-control months" id="select_yearm">
              <option value="">Select Year</option>
              @php $year=date('Y');@endphp

              <option>{{$year}}</option>

            </select>

          </div>
          <div class="apply_reset_btn">
           <button class="btn btn-primary apply apply-filter-month mr-1 "><i class="fas fa-paper-plane mr-2"></i>Apply</button>
           <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
         </div>                              
       </div>                                                    
     </div>

   </div>
 </div>
    </div>  

<div class="YearlyRange d-none">
  <div class="advance-options" style="">
   <div class="title">
     <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
   </div>                      
   <div class="left_option">
     <div class="left_inner">
      <h6>Select Year</h6>
      <div class="button_input_wrap">
        <div class="button_input_wrap">
          <i class="fas fa-calendar-alt ml-2 mr-2 "></i>
          <select class="form-control months" id="select_year_wise">
            <option value="">Select Year</option>
            @php $year=date('Y');@endphp

            <option>{{$year}}</option>

          </select>

        </div>
        <div class="apply_reset_btn">
         <button class="btn btn-primary apply apply-filter-year mr-1 "><i class="fas fa-paper-plane mr-2"></i>Apply</button>
         <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
       </div>                              
     </div>                                                    
   </div>

 </div>
</div>
</div>  

</div>





<div class="card-body">
 @if (session('status'))
 <div class="alert alert-success" role="alert">
  {{ session('status') }}
</div>
@endif

<table style="width:100%" id="transaction-list" class="table table-bordered table-hover yajra-datatable">
  <thead>
    <tr>
      <th>User ID</th>
      <th>Transaction ID</th>
      <th>Payment For</th>
      <!-- <th>Time Period</th> -->
      <th>Total Amount</th>
      <th>Status</th>
      <th>Paid At</th>

      <th>Actions</th>



    </tr>
  </thead>
  <tbody class="filter_date_show" id="payments_list">
    @foreach($transactionList as $key => $data)
    <tr>
     <td>GHX -{{$data->user_id}}</td>
     <td>{{ $data->razorpay_order_id  ?? '--'}}</td>
     <!-- <td>{{ $data->payment_for  ?? ''}}</td> -->
     <td>
      
      @forelse($data->paymentTransactionItem as $allDiets)
      
      <span class="badge badge-pill badge-primary">{{$allDiets->type}}</span>
      @empty
        --
      @endforelse

     </td>
    <!-- <td>Monthly</td> -->
    <th> {!!rupeeSymbol()!!}  {{ $data->amount  ?? ''}}</th>
    <td>
      @if($data->transaction_status=='success'||$data->transaction_status=='captured')
      <span class="badge active_text_success p-1">Success</span>
      @elseif($data->transaction_status=='created')
        <span class="badge badge-warning p-1">Pending</span>
      @else
      <span class="badge inactive_text_warning p-1">
       {{ $data->transaction_status ?? 'N/A'}}
      </span> 
      @endif
    </td>
      <td> {!! date('m/d/Y ', strtotime($data->created_at)) !!} </td>


      <td>


        <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a>
        
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

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript"src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>">
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src='https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js'></script>

<script>

 $('#transaction-list').DataTable( {

  dom: 'Bfrtip',
   "ordering": false,
  buttons: [
  {
    extend:    'copyHtml5',
    text:      '<i class="fa fa-copy mr-1"></i> Copy',
    titleAttr: 'Copy',
    exportOptions: {
      columns: [ 0, 1, 2, 3, 4]
    },
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
      columns: [ 0, 1, 2, 3, 4,5,6]
    },
   //  customize: function(doc) {
   //   doc.content[1].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
   // },
 }
 ],
  select: {
    style: 'multi'
  },

});


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


  console.log('date range');
  console.log(date_range);
      // return false;

  if(date_range.length==1)
    return false;
  $.ajax({
   url: '{{ route('filter_transactions') }}',
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
      $("#transaction-list").DataTable().clear().destroy();
      $('#payments_list').html(response.html);
    }
  }
});
});

 $('body').on('click','.reset-button',function(){
   $('input[name="date_range"]').val('');
   $('#select_month').val('');
   $('#select_yearm').val('');
   $('#select_year_wise').val('');


   $('.advance_options_btn').hide();


        // update table data
   $.ajax({
     url: '{{ route('payment_transactions_reset') }}',
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
         $('#transaction-list').DataTable().clear().destroy();
         $('#payments_list').html(response.html);
                  // $('#transaction-list').DataTable( {
                  //     dom: 'Bfrtip',
                  //       buttons: [
                  //           {
                  //               extend:    'copyHtml5',
                  //               text:      '<i class="fa fa-copy mr-1"></i> Copy',
                  //               titleAttr: 'Copy',
                  //               exportOptions: {
                  //                   columns: [ 0, 1, 2, 3, 4]
                  //               },
                  //           },
                  //           {
                  //               extend:    'excelHtml5',
                  //               text:      '<i class="fa fa-file-excel mr-1"></i>Excel',
                  //               titleAttr: 'Excel',
                  //               exportOptions: {
                  //                     columns: [ 0, 1, 2, 3, 4]
                  //               },
                  //           },
                  //           {
                  //               extend:    'csvHtml5',
                  //               text:      '<i class="fa fa-file-csv mr-1"></i>CSV',
                  //               titleAttr: 'CSV',
                  //               exportOptions: {
                  //                   columns: [ 0, 1, 2, 3, 4]
                  //               },
                  //           },
                  //           {
                  //               extend:    'pdfHtml5',
                  //               text:      '<i class="fa fa-file-pdf mr-1"></i>PDF',
                  //               titleAttr: 'PDF',
                  //               exportOptions: {
                  //                   columns: [ 0, 1, 2, 3, 4]
                  //               },
                  //           }
                  //       ],
                  //       select: {
                  //           style: 'multi'
                  //       }
                  //   });

       }
     }
   });
        // update table data

 })
    // filter



</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.filterType').on('change',function(){
      $('.dateRange,.MonthlyRange,.YearlyRange').addClass('d-none');
      $('.'+$(this).val()).removeClass('d-none');
   });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
     $('.apply-filter-month').click(function(){
         var selectedMonth = $('#select_month').val();
         var selectedYear = $('#select_yearm').val();
         if(selectedMonth != '' && selectedYear != ''){
           $.ajax({
             url: '{{ route('filter_transactions_month_year') }}',
             method: 'post',
             data: {
                month:selectedMonth,
                year:selectedYear,
                filterType:'monthYear',
             },
             dataType: "JSON",
             headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function (response) {
               console.log('response');
               console.log(response);

               if(response.status) {
                $("#transaction-list").DataTable().clear().destroy();
                $('#payments_list').html(response.html);
              }
            }
          });      
         } 
     });


    
    //Year Wise filter
      
        $('.apply-filter-year').click(function(){
         var selectedYear = $('#select_year_wise').val();
         if(selectedYear != ''){
           $.ajax({
             url: '{{ route('filter_transactions_month_year') }}',
             method: 'post',
             data: {
                year:selectedYear,
                filterType:'Year',
             },
             dataType: "JSON",
             headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function (response) {
               console.log('response');
               console.log(response);

               if(response.status) {
                $("#transaction-list").DataTable().clear().destroy();
                $('#payments_list').html(response.html);
              }
            }
          });      
         } 
     });

  });
</script>
@stop
