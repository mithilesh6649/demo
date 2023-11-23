@extends('adminlte::page')

@section('title', 'Payment Transaction Details')

@section('content_header')
@stop 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>Payment Transaction Details</h3>
          <a class="btn btn-sm btn-success add-advance-options" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form class="form_wrap">



            <div class="row">

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>User Name</label>
                  <input class="form-control" placeholder="{{ @$transactionView->user->name ?? '--' }}" readonly>
                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Transaction ID</label>
                  <input class="form-control" placeholder="{{ $transactionView->razorpay_order_id ?? '--' }}" readonly>
                </div>
              </div>

              <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Payment For</label>
                  <input class="form-control" placeholder="@if($transactionView->payment_for=='diet_plans')Diet Plan @else Test @endif" readonly>
                </div>
              </div> -->


                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Product</label>
                  <input class="form-control" placeholder="{{ @$transactionView->dietPlanSubscription->name ?? '--' }}" readonly>
                </div>
              </div>

              <!--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Time  Period</label>
                  <input class="form-control" placeholder="Monthly" readonly>
                </div>
              </div> -->

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label> Total Amount</label>
                  <input class="form-control" placeholder=" {!!rupeeSymbol()!!}  {{ $transactionView->amount ?? '--' }}" readonly>
                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Status</label>
                  <input class="form-control" placeholder="@switch($transactionView->transaction_status)
                  @case('captured')
                  Success
                  @break
                  @case('created')
                  Pending
                  @break
                  @default
                  {{$transactionView->transaction_status}}
                  @endswitch
" readonly>
                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Paid At</label>
                  <input class="form-control" placeholder="{!! date('m/d/Y ', strtotime($transactionView->created_at)) !!}" readonly>
                </div>
              </div>

              <div class="form-group">
                <label>Payment For</label>

                <ul>

                 @forelse($transactionView->paymentTransactionItem as $allDiets)

                 <li> {{ucfirst($allDiets->type)}}   ||    {!!rupeeSymbol()!!} {{$allDiets->amount}}  </li>
                 @empty
                 --
                 @endforelse


               </ul>

             </div>



              
            </div>
          </form>
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
