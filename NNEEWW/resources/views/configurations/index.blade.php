@extends('adminlte::page')
@section('title', 'Admins')
@section('content_header')
@stop
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Transaction Limit</h3> 
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
                  <th>Maximum Limit in Day(s)</th>
                  <!-- <th>Amount</th> -->
                  <!-- <th>Day(s)</th> -->
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </thead>
              <tbody id="tbody">
                  <tr>
                    <td class="display-none"></td>
                    <td>${{ $transaction_limit->amount }} <b>in</b> {{ $transaction_limit->days }} Day(s)</td>
                    <!-- <td>${{ $transaction_limit->amount }}</td> -->
                    <!-- <td>{{ $transaction_limit->days }}</td> -->
                    <td>
                      <a class="action-button" title="Edit" href="{{route('configuration.edit',$transaction_limit->id)}}"><i class="text-warning fa fa-edit"></i></a>
                    </td>
                  </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Limit/Day(s)</th>
                  <!-- <th>Amount</th> -->
                  <!-- <th>Day(s)</th> -->
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

 

@stop
