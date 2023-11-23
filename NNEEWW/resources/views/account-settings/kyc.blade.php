@extends('adminlte::page')

@section('title', 'KYC')

@section('content_header')
@stop

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>KYC</h3>
        </div>

        @if(@$kyc->status == 'submitted')
        <div class="card-body">                


          <p>{{$person->firstName}} {{$person->lastName}}</p> 
          <p>{{$person->email}}</p> 
          <p>{{$person->phone}}</p> 
          <p>Status : {{$kyc_message->idv}}</p>  


        </div>
        @else
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form id="addAdminForm" method="post", action="{{ route('submit-kyc') }}">
            @csrf
            <div class="card-body">                
              <div class="row">

                <div class="col-6">
                  <div class="form-group">
                    <label for="first_name">First Name<span class="text-danger"> *</span></label>
                    <input type="text" name="first_name" class="form-control" id="first_name" maxlength="100" placeholder="First Name">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="last_name">Last Name<span class="text-danger"> *</span></label>
                    <input type="text" name="last_name" class="form-control" id="last_name" maxlength="100" placeholder="Last Name">
                  </div>
                </div>

                <input type="hidden" name="phone_ext" id="phone_ext">

                <div class="col-6">
                  <div class="form-group">
                    <label for="phone">Phone Number<span class="text-danger"> *</span></label>
                    <input type="text" name="phone" class="form-control phone_field" id="phone" maxlength="100" placeholder="Phone Number">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="email">Email<span class="text-danger"> *</span></label>
                    <input type="text" name="email" class="form-control" id="email" maxlength="100" placeholder="Email">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="birthday">Birth date<span class="text-danger"> *</span></label>
                    <input type="date" name="birthday" class="form-control" id="birthday" maxlength="100" autocomplete="nope">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="street_address_1">Id Type<span class="text-danger"> *</span></label>
                    <select name="idtype" class="form-control" id="idtype">
                      <option value="" hidden>Id Type</option>
                      <option value="ssn">ssn</option>
                      <option value="passport">passport</option>
                    </select>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="idnumber">Id Number<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="idnumber" id="idnumber" placeholder="Id Number">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="address_type">Address Type<span class="text-danger"> *</span></label>
                    <select name="address_type" class="form-control" id="address_type">
                      <option value="">Address Type</option>
                      <option value="mailing">mailing</option>
                      <option value="billing">billing</option>
                      <option value="shipping">shipping</option>
                    </select>
                  </div>
                </div> 

                <div class="col-6">
                  <div class="form-group">
                    <label for="line1">Address 1<span class="text-danger"> *</span></label>
                    <input type="text" name="line1" class="form-control" id="line1" maxlength="100" placeholder="Address 1">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="country">Country<span class="text-danger"> *</span></label>
                    <input type="text" name="country" class="form-control" id="country" maxlength="100" placeholder="Country">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="state">State<span class="text-danger"> *</span></label>
                    <input type="text" name="state" class="form-control" id="state" maxlength="100" placeholder="State">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="city">City<span class="text-danger"> *</span></label>
                    <input type="text" name="city" class="form-control" id="city" maxlength="100" placeholder="City">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="postal_code">Postal Code<span class="text-danger"> *</span></label>
                    <input type="number" name="postal_code" class="form-control" id="postal_code" min="0" placeholder="Postal Code">
                  </div>
                </div>

              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" id="submit_btn" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
            </div>
          </form>
          @endif

        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
  <style type="text/css">
  

  input[id="phone"]::placeholder{
    padding-left: 30px;
  }

</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js"></script>
<script>

  var input = document.querySelector("#phone");
  intlTelInput(input, {
    initialCountry: "us",
    geoIpLookup: function (success, failure) {
      $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
        var countryCode = (resp && resp.country) ? resp.country : "us";
        success(countryCode);
      });
    },
  });

  $( "#phone" ).focus(function() {
    $('#phone_ext').val($('.iti__country-list .iti__active').data('dial-code'));
  });

  $('#addAdminForm').validate({
    ignore: [],
    debug: false,
    rules: {
      first_name: {
        required: true,
        noSpace : true
      },
      last_name: {
        required: true,
        noSpace : true
      },
      phone: {
        required: true,
        noSpace : true,
        checkPhone : true
      },
      email: {
        required: true,
        email: true,
        noSpace : true
      },
      birthday: {
        required: true
      },
      idtype: {
        required: true
      },
      idnumber: {
        required: true,
        checkSSN: function(){
          if($('option:selected', '#idtype').val() == 'ssn'){
            return true;
          }
        },
        checkPassport: function(){
          if($('option:selected', '#idtype').val() == 'passport'){
            return true;
          }
        },
      },
      address_type: {
        required: true,
        noSpace : true
      },
      line1: {
        required: true
      },
      country: {
        required: true,
        noSpace : true,
        checkCountryCode: true,
      },
      city: {
        required: true,
        noSpace : true,
      },
      state: {
        required: true,
        noSpace : true,
        checkStateCode : true,
      },
      postal_code: {
        required: true,
        noSpace : true,
        checkPostalCode : true
      },
    },
    messages: {
      first_name: {
        required: "The First Name is required."
      },
      last_name: {
        required: "The Last Name is required."
      },
      phone: {
        required: "The Phone Number is required.",
      },
      email: {
        required: "The Email is required.",
        email: "Please enter a valid Email"
      },
      birthday: {
        required: "The Birth date is required."
      },
      idtype: {
        required: "The Id Type is required."
      },
      idnumber: {
        required: "The Id Number is required.",
      },
      address_type: {
        required: "The Address Type is required."
      },
      line1: {
        required: "The Address 1 is required."
      },
      country: {
        required: "The Country is required.",
        maxlength: "Please enter correct Country code."
      }, 
      city: {
        required: "The City is required."
      },
      state: {
        required: "The State is required.",
        maxlength: "Please enter correct State code."
      },
      postal_code: {
        required: "The Postal Code is required."
      },
    }
  });

  $.validator.addMethod("noSpace", function(value, element) { 
    return $.trim(value).length!=0; 
  }, "Please don't leave it empty.");

  $.validator.addMethod("checkPassport", function(value, element) {
    var re = new RegExp('^(?!^0+$)[a-zA-Z0-9]{6,9}$');
    return this.optional(element) || re.test(value);
  }, "The Passport number is not valid.");

  $.validator.addMethod("checkPhone", function(value, element) {
    var re = new RegExp("^([+]?[\s0-9]+)?(\d{3}|[(]?[0-9]+[)])?([-]?[\s]?[0-9])+$");
    return this.optional(element) || re.test(value);
  }, "The Phone number is not valid.");

  $.validator.addMethod("checkPostalCode", function(value, element) {
    var re = new RegExp("^[0-9]{4,6}$");
    return this.optional(element) || re.test(value);
  }, "The Postal code is not valid."); 

  $.validator.addMethod("checkCountryCode", function(value, element) {
    var re = new RegExp("^[a-zA-Z]{2,2}$");
    return this.optional(element) || re.test(value);
  }, "Please Enter valid Country");

  $.validator.addMethod("checkStateCode", function(value, element) {
    var re = new RegExp("^[a-zA-Z]{2,2}$");
    return this.optional(element) || re.test(value);
  }, "Please Enter valid State");

  $.validator.addMethod("email",
   function(value, element) {
     return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
   });

  $.validator.addMethod("checkSSN",
   function(value, element) {
     return /^\d{3}-?\d{2}-?\d{4}$/.test(value);
   }, "The SSN number is not valid.");

 </script>
 @stop
