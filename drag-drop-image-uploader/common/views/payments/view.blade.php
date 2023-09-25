@extends('adminlte::page')

@section('title', 'Payment Transaction Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>{{ __('adminlte::adminlte.payment_transaction_information') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>        
          <div class="card-body table form mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form class="form_wrap">
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" placeholder="KWD 299" readonly>
                  </div>
                </div>
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" placeholder="ch_3JPRcnH65aypuFHu0VYz15IV" readonly>
                  </div>
                </div>
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group mt-3">
                    <label>Name</label>
                    <input class="form-control" placeholder="succeeded" readonly>
                  </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group mt-3">
                    <label>Name</label>
                    <input class="form-control" placeholder="Online Order" readonly>
                  </div>
                </div>
                
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                  <div class="form-group mt-3">
                    <label>Name</label>
                    <input class="form-control" placeholder="{{ date('d/m/y')}}" readonly>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
@stop

@section('js')
@stop
