@extends('adminlte::page')

@section('title', 'Super Admin | Payment Transactions')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Payment Transactions</h3>
              <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              <!-- <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> -->
            </div>           
            <div class="card-body table form mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <div class="text-right mb-3">
                <div class="advance-options payment_advance_options" style="display: none;">
                   <div class="title">
                     <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                   </div>                      
                   <div class="left_option">
                     <div class="left_inner">
                       <h6>Select Date Range</h6>
                       <div class="button_input_wrap">
                         <div class="input_wrap position-relative">
                           <i class="fas fa-calendar-alt mr-2"></i>
                           <input type="text" name="date_range" class="form-control" autocomplete="off">
                         </div>
                         <div class="apply_reset_btn">
                           <button  class="btn btn-primary apply apply-filter mr-1"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                           <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
                         </div>                              
                       </div>                                                    
                     </div>
                    <div class="advance_options_btn" style="display: none;">
                     <button class="btn btn-primary export-as-csv"><i class="fas fa-share mr-2"></i>Export as CSV</button>
                     <button  class="btn btn-primary export-bulk-invoices"><i class="fas fa-download mr-2"></i>Download bulk invoices</button>                                            
                   </div>                         
                   </div>
                </div>
              </div>
              <table style="width:100%" id="paymentTransactionsList" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th style="display:none">#</th>
                    <th>{{ __('adminlte::adminlte.transaction_id') }}</th>
                    <th>{{ __('adminlte::adminlte.amount') }}</th>
                    <th>Type</th>
                    <th>{{ __('adminlte::adminlte.status') }}</th>
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                    <td style="display:none">1</td>
                    <td>ch_3JPRcnH65aypuFHu0VYz15IV</td>
                    <td>KWD 299</td>
                    <td>Online Order</td>
                    <td>succeeded</td>
                    
                    <td>
                      <a class="action-button" title="View" href="{{route('payments.view')}}"><i class="text-info fa fa-eye"></i></a>
                    </td>
                  </tr>

                  <tr>
                    <td style="display:none">1</td>
                    <td>ch_3JSI8hH65aypuFHu1QdWtQrd</td>
                    <td>KWD 396</td>
                    <td>Dine-in</td>
                    <td>succeeded</td>
                    
                    <td>
                      <a class="action-button" title="View" href="{{route('payments.view')}}"><i class="text-info fa fa-eye"></i></a>
                    </td>
                  </tr>
                  
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
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script type="text/javascript">
    $('#paymentTransactionsList').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });


    $(document).ready(function() {

      $('input[name="date_range"]').daterangepicker({
        "startDate": moment().subtract('days', 29),
        "endDate": moment(),
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

    $('body').on('click','.apply-filter',function(){
      $('#paymentTransactionsList').DataTable().destroy();
      build_datatable($('input[name="date_range"]').val());
    });

  </script>

@stop
