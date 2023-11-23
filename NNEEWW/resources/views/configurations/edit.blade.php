@extends('adminlte::page')

@section('title', 'Transaction Limit')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Transaction Limit</h3>
            <a class="btn btn-sm btn-success" href="{{ route('configuration') }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="updateLimit" method="post" action="{{route('configuration.update')}}">
              @csrf
              <input type="hidden" name="id" value="{{ $transaction_limit->id }}">
              <div class="card-body form">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="name">Amount($)<span class="text-danger"> *</span></label>
                      <input type="text" name="amount" class="form-control" id="amount" value="{{$transaction_limit->amount}}" maxlength="100" autocomplete="nope">
                      @if($errors->has('amount'))
                        <div class="error">{{ $errors->first('amount') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="days">Day(s)<span class="text-danger"> *</span></label>
                      <!-- <input type="text" name="days" class="form-control" id="days" value="{{ $transaction_limit->days }}" maxlength="100"> -->

                      <select name="days" class="form-control" id="days">
                        <option value="" selected disabled>Select Day(s)</option>
                        <option value="1" @if($transaction_limit->days==1) selected @endif>1</option>
                        <option value="2" @if($transaction_limit->days==2) selected @endif>2</option>
                        <option value="3" @if($transaction_limit->days==3) selected @endif>3</option>
                        <option value="4" @if($transaction_limit->days==4) selected @endif>4</option>
                        <option value="5" @if($transaction_limit->days==5) selected @endif>5</option>
                        <option value="6" @if($transaction_limit->days==6) selected @endif>6</option>
                        <option value="7" @if($transaction_limit->days==7) selected @endif>7</option>
                        <option value="8" @if($transaction_limit->days==8) selected @endif>8</option>
                        <option value="9" @if($transaction_limit->days==9) selected @endif>9</option>
                        <option value="10" @if($transaction_limit->days==10) selected @endif>10</option>
                      </select>

                      @if($errors->has('days'))
                        <div class="error">{{ $errors->last('days') }}</div>
                      @endif
                    </div>
                  </div>
                  
               </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary">{{ __('adminlte::adminlte.update') }}</button>
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
  <script>
    $(document).ready(function() {

      $('#amount').keypress(function(eve) {
        if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
          eve.preventDefault();
        }

        $('#amount').keyup(function(eve) {
          if ($(this).val().indexOf('.') == 0) {
            $(this).val($(this).val().substring(1));
          }
        });
      });


      $('#updateLimit').validate({
        ignore: [],
        debug: false,
        rules: {
          amount: {
            required: true,
            noSpace : true
          },
          days: {
            required: true
          },
        },
        messages: {
          amount: {
            required: "The Amount is required."
          },
          days: {
            required: "The Day(s) is required."
          }
        }
      });


      $.validator.addMethod("noSpace", function(value, element) { 
        return $.trim(value).length!=0; 
      }, "Please don't leave it empty.");

    });
  </script>
@stop
