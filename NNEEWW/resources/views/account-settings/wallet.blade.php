@extends('adminlte::page')

@section('title', 'KYC Verification')

@section('content_header')
@stop

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Wallet</h3>
            <!-- <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> -->
          </div>

          @if($is_wallet_added==1)
            @if($wallet_status==1)
              <div class="card-body">          
                <p>Wallet Balance</p> 
                <p>${{$wallet_balance}}</p>  
              </div>
            @else
              <div class="card-body">          
                <p>{{$message}}</p> 
                <p>Status : {{$status}}</p>  
              </div>
            @endif
          @else
            <div class="card-body">                
              <p>{{$message}}</p>   
            </div>
          @endif

        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
@stop

@section('js')
  
@stop
