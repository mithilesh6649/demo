@extends('adminlte::page')

@section('title', 'Super Admin | Add Customer')

@section('content_header')

@section('content')

<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center">
                    <h3>Edit  Customer</h3>
                    <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                </div>
                <div class="card-body table p-0 mb-0">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form id="editUserForm" method="post" action="{{ route('update_user') }}">
                        @csrf
                        <div class="card-body form">
                            <input type="hidden" name="role_id" value="0">
                             <input type="hidden" name="id" class="form-control" id="id" value="{{ $user->id }}">
                            <div class="row">
                               


                                  <div class="col-6">
                                    <div class="form-group">
                                        <label for="password">Contact Number<span class="text-danger"> *</span></label>
                                        <br>
                                        <input type="tel"  name="phone_number" class="form-control"  id="txtPhone" value="{{ $user->phone_number ?? '' }}" />
                                        <input type="hidden"  name="country_code" class="form-control"  id="country_code"  value="{{ $user->country_code ?? '' }}"/>  
                                    </div>
                                </div>
                             
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12  mb-3">
                                <div class="form-group">
                                    <label for="email">{{ __('adminlte::adminlte.email') }} </label>
                                     <input type="text" name="email" class="form-control" id="email" value="{{$user->email }}"   maxlength="100">
                                    @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

 


                                         <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                    <div class="form-group  ">
                      <label for="email">Password  </label>
                      <div style="position:relative;"> 
                       <input id="password" type="password" name="password" class="form-control" placeholder=" " id="password" value="">
                        <div style="position:absolute;top:18px;right:15px;">
                         <i class="fas fa-eye view_pass" style="cursor:pointer;"></i>
                      </div>
                     </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                    <div class="form-group  ">
                      <label for="email">Confirm Password  </label>
                      <div style="position:relative;"> 
                       <input id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder=" " id="confirm_password" value="">
                        <div style="position:absolute;top:18px;right:15px;">
                         <i class="fas fa-eye view_con_pass" style="cursor:pointer;"></i>
                      </div>
                     </div>
                    </div>
                  </div>


                            <div class="col-md-6 col-lg-6 col-xl-6 col-12  mb-3">



                                <div class="form-group">
                                    <label for="first_name">First Name<span class="text-danger"> *</span></label>
                                     <input type="text" name="first_name" class="form-control" id="first_name" value="{{$user->first_name ?? ' ' }}" maxlength="100">
                                    @if($errors->has('first_name'))
                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12  mb-3">
                                <div class="form-group">
                                    <label for="last_name">Last Name  </label>
                                     <input type="text" name="last_name" class="form-control" id="last_name" value="{{$user->last_name ?? ' ' }}" maxlength="100">
                                    @if($errors->has('last_name'))
                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                            </div>

                     

                             <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                      <div class="form-group  ">
                        <label for="email">Status </label>
                        <div class="form-group radio">
                          <select class="form-control" name="status">
                            @foreach($status as $status_data)
                             <option value="{{$status_data->value}}" @if($status_data->value==$user->status) selected @endif>{{$status_data->name}}</option>
                            @endforeach
                          
                          </select>
                        </div>
                      </div>
                    </div>

                     <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                      <div class="form-group  ">
                        <label for="email">Block </label>
                        <select class="form-control" name="is_user_locked">
                          <option value="1" {{ $user->is_user_locked== 1 ? 'selected':'' }}>Block</option>
                          <option  value="0" {{ $user->is_user_locked== 0 ? 'selected':'' }}>Unblock</option>
                        </select>
                      </div>
                    </div>

            





            </div>
        </div>
        <!-- /.card-body -->
        <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.update') }}</button>
                </div>
    </form>
</div>
</div>
</div>
</div>
</div>


@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .editable_field {
      position: relative;
      top: -25px;
      right: 10px;
      float: right;
  }
  .non_editable_field {
      position: relative;
      top: -25px;
      right: 10px;
      float: right;
  }

  #job_alerts_modal label.error {
    position: absolute;
    bottom: -12px;
    left: 17px;
}
</style>
<style type="text/css">
    .ui-autocomplete {
      position: absolute;
      top: 100%;
      left: 0;
      z-index: 9999;
      display: none;
      float: left;
      min-width: 160px;
      padding: 5px 0;
      margin: 2px 0 0;
      list-style: none;
      font-size: 14px;
      text-align: left;
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border: 1px solid rgba(0, 0, 0, 0.15);
      border-radius: 4px;
      -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
      background-clip: padding-box;
  }

  .ui-autocomplete > li > div {
      display: block;
      padding: 3px 20px;
      clear: both;
      font-weight: normal;
      line-height: 1.42857143;
      color: #333333;
      white-space: nowrap;
  }

  .ui-state-hover,
  .ui-state-active,
  .ui-state-focus {
      text-decoration: none;
      color: #262626;
      background-color: #f5f5f5;
      cursor: pointer;
  }

  .ui-helper-hidden-accessible {
      border: 0;
      clip: rect(0 0 0 0);
      height: 1px;
      margin: -1px;
      overflow: hidden;
      padding: 0;
      position: absolute;
      width: 1px;
  }

  .select2-container{
    z-index: 9999;
}

/*.iti {
  position: relative;
  display: inline-block;
  min-width: 100%;
}
.chosen-container .chosen-choices {
  width: 100% !important;
  height: 50px !important;
  border-radius: 4px ;
}*/

</style>
@stop

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

  $("input").attr("autocomplete", "new-password");

  $("select.multiple").select2();
  $(document).ready(function() {

      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "The Contact Number must be in numbers only.");
      $('#editUserForm  ').validate({
        ignore: [],
        debug: false,
        rules: {
          first_name: {
            required: true,
           
        },
        last_name: {
             
            
        },
        email: {
           
            email: true,
    //         remote:{
    //           type:"get",
    //           url:"{{route('check_user_email')}}",
    //           data: {
    //             "email": function() { return $("#email").val(); },
    //             "_token": "{{ csrf_token() }}",

    //         },
    //         dataFilter: function (result) {
    //            var json = JSON.parse(result);
    //            if (json.msg == 1) {
    //             return "\"" + "Email ID already  exist" + "\"";
    //         } else {
    //             return 'true';
    //         }
    //     }    
    // }
},
phone_number: {
     required:true,
     minlength: 8,
     maxlength: 15 
},
password:{
required:false,
minlength: 8
},
confirm_password:
{
equalTo:"#password"
}
},
messages: {
  first_name: {
    required: "First name  is required.",
},
last_name: {
    required: "The Last name field is required.",
},
email: {
    required: "The Email field is required.",
    email: "Please enter a valid email"
},
phone_number: {
    required: "Contact Numer  is required",
    minlength:"Please enter at least 8 digits",
    maxlength:"Please enter no more than 15 digits", 
},
password: {
    required: "Password is required"
},
password_confirmation: {
    required: "Confirm Password is required",
    equalTo : "Confirm Password should match to Password"
},
}
});

      jQuery.validator.addMethod("phone_valid", function(value, element) { 
          return this.optional(element) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value)
  // just ascii letters
      },"Please enter vaild numer");



      $.validator.addMethod("noSpace", function(value, element) { 
        return $.trim(value).length!=0; 
    }, "No space please and don't leave it empty");

      $.validator.addMethod("pass_check", function(value, element) {
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/; 
        return value.match(regex); 
    }, "Password must be 8 characters long containing atleast one upper case, one lower case and one number.");

  });











  $(function () {
      var code = "+"+"{{ $user->country_code}}{{ $user->phone_number}}"; // Assigning value from model.
      $('#txtPhone').val(code);
      $('#txtPhone').intlTelInput({
          autoHideDialCode: true,
          autoPlaceholder: "ON",
          dropdownContainer: document.body,
          formatOnDisplay: true,
           
          initialCountry: "auto",
          nationalMode: true,
          placeholderNumberType: "MOBILE",
          preferredCountries: ['US'],
          separateDialCode: true
      });
     


       
  });

  $("#txtPhone").on('focusout',function(){
    var code = $("#txtPhone").intlTelInput("getSelectedCountryData").dialCode;
     $('#country_code').val(code);
  });




</script>

  <script type="text/javascript">
    $(document).on('click','.view_pass',function(){
        console.log('view_pass');  
        $(this).removeAttr('class');
        if($('#password').attr('type')=='password'){
            $('#password').attr('type','text');
            $(this).addClass('fas fa-eye-slash view_pass');
        }else{
            $('#password').attr('type','password');
            $(this).addClass('fas fa-eye view_pass');
        }              
    })


     $(document).on('click','.view_con_pass',function(){
        console.log('view_pass');  
        $(this).removeAttr('class');
        if($('#confirm_password').attr('type')=='password'){
            $('#confirm_password').attr('type','text');
            $(this).addClass('fas fa-eye-slash view_con_pass');
        }else{
            $('#confirm_password').attr('type','password');
            $(this).addClass('fas fa-eye view_con_pass');
        }              
    })
</script>
@stop
