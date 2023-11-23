@extends('adminlte::page')

@section('title', 'Account')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3></h3>
            <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
          </div>
<!--           <div class="card-body">
           <div class="text-right">
              <div class="advance-options">
                 <div class="title">
                    <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                 </div>
                 <div class="left_option">
                    <div class="left_inner">
                       <h6>Select Date Range(Created)</h6>
                       <div class="date-picker-new">
                          <div class="apply_reset_btn">
                             <div class="button_input_wrap">
                                <i class="fas fa-calendar-alt mr-2"></i><input type="text" name="date_range" class="form-control" autocomplete="off">
                              </div>
                             <button class="btn btn-primary apply apply-filter mr-1"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                             <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
                          </div>
                       </div>
                    </div>
                    <div class="advance_options_btn" style="display: none;">  
                       <button class="btn btn-primary export-bulk-invoices"><i class="fas fa-download mr-2"></i>Download bulk invoices</button>
                    </div>
                 </div>
              </div>
           </div>
          </div> -->
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Accounts</h3>
              <a class="btn btn-sm btn-success" href="account">Add Account</a>
          </div> 

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Account Type</th>
                  <th>Account Name</th>
                  <th>Balance</th>

                  <th>Created at</th>
                  <th>Last updated at</th>

                  @can('view_admin')
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                  @endcan
                  
                </tr>
              </thead>
              <tbody id="tbody">
                <?php for ($i=0; $i < count((is_countable($account)?$account:[])); $i++) { 
                  ?>
                  <tr>
                    <td class="display-none"></td>
                    <td>{{ ucfirst(@$account[$i]->type) }}</td>
                    <td>{{ @$account[$i]->label }}</td>
                    <td>{{ @$account[$i]->currency }} {{ @$account[$i]->availableBalance  }}</td>
                    <td>{{date('d/m/Y',strtotime(@$account[$i]->createdAt))}}</td>
                    <td>{{date('d/m/Y',strtotime(@$account[$i]->modifiedAt))}}</td>
                    
                    <td>
                      
                        @can('view_admin')
                        <a class="action-button" title="View" href="view-account/{{$account[$i]->id}}"><i class="text-info fa fa-eye"></i></a>
                        @endcan

                    </td>
                    
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Account Type</th>
                  <th>Account Name</th>
                  <th>Balance</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <!-- date filter -->
  <script type="text/javascript">
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
     $('body').on('click','.show-advance-options',function(e){
       e.preventDefault();
       $('.advance-options').slideToggle();
     });
   
     
   });
  </script>
  <!-- date filter -->

  <script type="text/javascript">
    $('body').on('click','.apply-filter',function(){
      console.log('filter now');
      var date_range = $('input[name="date_range"]').val().split('-');   
      if(date_range.length==1)
        return false;
      $.ajax({
           url: '{{ route('admins.filter') }}',
           method: 'post',
           data: {
               date_range: date_range,
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               if(response.status) {
                 $('#tbody').html(response.html);    
               }
           }
       });
    });

    $('body').on('click','.reset-button',function(){
      console.log('filter now');

      $('input[name="date_range"]').val('');
      $('.advance_options_btn').hide();
      
      $.ajax({
           url: '{{ route('admins.filter') }}',
           method: 'post',
           data: {
               reset : true
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               if(response.status) {
                 $('#tbody').html(response.html);    
               }
           }
       });
    });
  </script>


@stop
