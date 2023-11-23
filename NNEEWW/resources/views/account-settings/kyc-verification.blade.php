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
            <h3>KYC Verification</h3>
            <!-- <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> -->
          </div>

          @if($is_wallet_added==1)
            <div class="card-body">                
              <!-- <div class="row"> -->

                <p>{{$message}}</p> 
                <p>Status : {{ucfirst($status)}}</p>  

             <!-- </div> -->
            </div>
          @else
             <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addAdminForm" method="post", action="{{ route('kyc-verification') }}">
              @csrf
              <div class="card-body">                
                <div class="row">

                  <div class="col-12">
                    <div class="form-group">
                      <label for="user_name">Username<span class="text-danger"> *</span></label>
                      <input type="text" name="user_name" class="form-control" id="user_name" maxlength="100" autocomplete="nope" value="{{ old('user_name') }}">
                      <label class="error" style="display:none;" id="user_name_error"></label>
                      @if($errors->has('user_name'))
                        <div class="error">{{ $errors->first('user_name') }}</div>
                      @endif
                    </div>
                  </div>
                

                  <div class="col-6">
                    <div class="form-group">
                      <label for="first_name">First Name<span class="text-danger"> *</span></label>
                      <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" id="first_name" maxlength="100">
                      @if($errors->has('first_name'))
                        <div class="error">{{ $errors->first('first_name') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="last_name">Last Name<span class="text-danger"> *</span></label>
                      <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" id="last_name" maxlength="100">
                      @if($errors->has('last_name'))
                        <div class="error">{{ $errors->first('last_name') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="phone">Phone Number<span class="text-danger"> *</span></label>
                      <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" maxlength="100">
                      @if($errors->has('phone'))
                        <div class="error">{{ $errors->first('phone') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="email">Email<span class="text-danger"> *</span></label>
                      <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" maxlength="100">
                      @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="birthday">Birth date<span class="text-danger"> *</span></label>
                      <input type="date" name="birthday" value="{{ old('birthday') }}" class="form-control" id="birthday" maxlength="100" autocomplete="nope">
                      @if($errors->has('birthday'))
                        <div class="error">{{ $errors->first('birthday') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="street_address_1">Street Address One<span class="text-danger"> *</span></label>
                      <input type="text" name="street_address_1" value="{{ old('street_address_1') }}" class="form-control" id="street_address_1" maxlength="100">
                      @if($errors->has('street_address_1'))
                        <div class="error">{{ $errors->first('street_address_1') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="street_address_2">Street Address Two<span class="text-danger"> *</span></label>
                      <input type="text" name="street_address_2" value="{{ old('street_address_2') }}" class="form-control" id="street_address_2" maxlength="100">
                      @if($errors->has('street_address_2'))
                        <div class="error">{{ $errors->first('street_address_2') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="city">City<span class="text-danger"> *</span></label>
                      <input type="text" name="city" class="form-control" value="{{ old('city') }}" id="city" maxlength="100">
                      @if($errors->has('city'))
                        <div class="error">{{ $errors->first('city') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="state">State<span class="text-danger"> *</span></label>
                      <input type="text" name="state" class="form-control" value="{{ old('state') }}" id="state" maxlength="100">
                      @if($errors->has('state'))
                        <div class="error">{{ $errors->first('state') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="postal_code">Postal Code<span class="text-danger"> *</span></label>
                      <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}" id="postal_code" maxlength="100">
                      @if($errors->has('postal_code'))
                        <div class="error">{{ $errors->first('postal_code') }}</div>
                      @endif
                    </div>
                  </div>


                  <div class="col-6">
                    <div class="form-group">
                      <label for="ssn">SSN<span class="text-danger"> *</span></label>
                      <input type="text" name="ssn" class="form-control" value="{{ old('ssn') }}" id="ssn" maxlength="100">
                      @if($errors->has('ssn'))
                        <div class="error">{{ $errors->first('ssn') }}</div>
                      @endif
                    </div>
                  </div>

               </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" id="submit_btn" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
              </div>
            </form>
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
  <script>
    $(document).ready(function() {
      
      $('#addAdminForm').validate({
        ignore: [],
        debug: false,
        rules: {
          user_name: {
            required: true,
            noSpace : true
          },
          first_name: {
            required: true,
            noSpace : true
          },
          last_name: {
            required: true,
            noSpace : true
          },
          email: {
            required: true,
            email: true,
            noSpace : true
          },
          phone: {
            required: true,
            noSpace : true,
            checkPhone : true
          },
          birthday: {
            required: true
          },
          street_address_1: {
            required: true,
            noSpace : true
          },
          street_address_2: {
            required: true,
            noSpace : true
          },
          city: {
            required: true,
            noSpace : true
          },
          state: {
            required: true,
            noSpace : true,
            maxlength : 2,
          },
          postal_code: {
            required: true,
            noSpace : true,
            checkPostalCode : true
          },
          ssn: {
            required: true,
            noSpace : true,
            checkSSN : true
          },
        },
        messages: {
          user_name: {
            required: "The UserName is required."
          },
          email: {
            required: "The Email is required.",
            email: "Please enter a valid Email"
          },
          first_name: {
            required: "The First Name is required."
          },
          last_name: {
            required: "The Last Name is required."
          },
          phone: {
            required: "The Phone Number is required.",
          },
          birthday: {
            required: "The Birth date is required."
          },
          street_address_1: {
            required: "The Street Address One is required."
          },
          street_address_2: {
            required: "The Street Address Two is required."
          },
          city: {
            required: "The City is required."
          },
          state: {
            required: "The State is required."
          },
          postal_code: {
            required: "The Postal Code is required."
          },
          ssn: {
            required: "The SSN is required."
          },
        }
      });

      $.validator.addMethod("noSpace", function(value, element) { 
        return $.trim(value).length!=0; 
      }, "Please don't leave it empty.");

      $.validator.addMethod("checkSSN", function(value, element) {
        var re = new RegExp('^(?!666|000|9\\d{2})\\d{3}-(?!00)\\d{2}-(?!0{4})\\d{4}$');
        return this.optional(element) || re.test(value);
      }, "The SSN number is not valid.");

      $.validator.addMethod("checkPhone", function(value, element) {
        var re = new RegExp("^([+]?[\s0-9]+)?(\d{3}|[(]?[0-9]+[)])?([-]?[\s]?[0-9])+$");
        return this.optional(element) || re.test(value);
      }, "The Phone number is not valid.");

      $.validator.addMethod("checkPostalCode", function(value, element) {
        var re = new RegExp("^[0-9]{4,6}$");
        return this.optional(element) || re.test(value);
      }, "The Postal code is not valid.");


      // check handle
      $(document).on('keyup','#user_name',function(){  
        console.log('Length');
        if($.trim($(this).val()).length > 0){
          $.ajax({
            type:"POST",
            url:"{{ route('check-handle') }}",
            data: {
              user_name: $(this).val()
            },
            success: function(response) {
              console.log(response);
              if(response.statusCode==200){
                if(response.status=='SUCCESS'){
                  $('#user_name_error').css('display','none');
                  $('#user_name_error').text('');
                  $('#user_name').removeClass('error');
                }else{
                  // 
                  $('#user_name_error').css('display','block');
                  $('#user_name_error').text(response.message);
                  $('#user_name').addClass('error');
                }
              }else{
                $('#user_name_error').css('display','block');
                $('#user_name_error').text(response.message);
                $('#user_name').addClass('error');
              }
            }
          });
        }else{
          $('#user_name_error').css('display','none');
          $('#user_name_error').text('');
          $('#user_name').removeClass('error');
        }
      });
      // check handle

      // handle submit
      $(document).on('click','#submit_btn',function(){
        console.log('birth date');
        console.log($('#birthday').val());
        // return false;
        var flag = false;
        if($.trim($('#first_name').val()).length!=0 && $.trim($('#last_name').val()).length!=0 && $.trim($('#email').val()).length!=0 && $.trim($('#phone').val()).length!=0 && $.trim($('#street_address_1').val()).length!=0 && $.trim($('#street_address_2').val()).length!=0 && $.trim($('#city').val()).length!=0 && $.trim($('#state').val()).length!=0 && $.trim($('#postal_code').val()).length!=0 && $.trim($('#ssn').val()).length!=0 && $.trim($('#birthday').val()).length!=0){

          if($.trim($('#user_name').val()).length > 0){

            $.ajax({
              type:"POST",
              url:"{{ route('check-handle') }}",
              async: false,
              data: {
                user_name: $("#user_name").val()
              },
              success: function(response) {
                console.log(response);
                if(response.statusCode==200){
                  if(response.status=='SUCCESS'){
                    $('#user_name_error').css('display','none');
                    $('#user_name_error').text('');
                    $('#user_name').removeClass('error');
                    console.log('---1');
                    flag = true;
                  }else{
                    // 
                    $('#user_name_error').css('display','block');
                    $('#user_name_error').text(response.message);
                    $('#user_name').addClass('error');
                    console.log('---2');                    
                  }
                }else{
                  $('#user_name_error').css('display','block');
                  $('#user_name_error').text(response.message);
                  $('#user_name').addClass('error');
                  console.log('---3');
                }
              }
            });
          }else{
            $('#user_name_error').css('display','none');
            $('#user_name_error').text('');
            $('#user_name').removeClass('error');
          }

        }else{
          // do nothing
        }
        console.log('finally--');
        if($.trim($('#user_name').val()).length && !flag && $('#birthday').val()!='')
        return false;
      })
      // handle submit

    });
  </script>
@stop
