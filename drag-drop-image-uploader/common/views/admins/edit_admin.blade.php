@extends('adminlte::page')

@section('title', '  Edit Admin')

@section('content_header')
 
  
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>{{ __('adminlte::adminlte.edit_admin') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <form id="updateAdminForm" method="post" action="{{ route('update_admin') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $admin->id }}">
                <div class="card-body form">
                  <div class="row">
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label for="last_name">First Name<span class="text-danger"> *</span></label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{$admin->first_name ?? ' ' }}" maxlength="100">
                        @if($errors->has('first_name'))
                          <div class="error">{{ $errors->first('first_name') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label for="last_name">Last Name<span class="text-danger"> *</span></label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{$admin->last_name ?? ' ' }}" maxlength="100">
                        @if($errors->has('last_name'))
                          <div class="error">{{ $errors->first('last_name') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="email" class="form-control" placeholder=" " id="email" value="{{ $admin->email ?? '' }}" readonly maxlength="100">
                        @if($errors->has('email'))
                          <div class="error">{{ $errors->last('email') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">               
                      <div class="form-group  ">
                       <label for="role_id">{{ __('adminlte::adminlte.role') }}<span class="text-danger"> *</span></label>
                        <select name="role_id" class="form-control" placeholder=" " id="role_id">
                          @foreach($roles as $key=>$role)
                          <option value="{{ $role->id }}" {{ $role->id==$admin->role_id ? 'selected':''}}>{{ $role->name ?? '' }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('role_id'))
                          <div class="error">{{ $errors->last('role_id') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 ">
                      <div class="form-group  ">
                        <label for="email"> Password  </label>
                        <div style="position:relative;"> 
                         <input id="password" type="password" name="password" class="form-control" placeholder=" " >
                          <div style="position:absolute;top:18px;right:15px;">
                           <i class="fas fa-eye view_pass" style="cursor:pointer;"></i>
                        </div>
                       </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group ">
                        <label for="email">Confirm Password  </label>
                        <div style="position:relative;"> 
                         <input id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder=" " >
                          <div style="position:absolute;top:18px;right:15px;">
                           <i class="fas fa-eye view_con_pass" style="cursor:pointer;"></i>
                        </div>
                       </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group ">
                        <label for="email">Status </label>
                        <select class="form-control" placeholder="Status" name="is_user_locked">
                          @foreach($status as $status_data)
                           <option value="{{$status_data->value}}" @if($admin->status==$status_data->value) selected @endif >{{$status_data->name ?? ''}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
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
</div>

@endsection

@section('css')
@stop

@section('js')
  <script>
    function isPasswordPresent() {
            return $('#password').val().length > 0;
        }
    $(document).ready(function() {

       
      $('#updateAdminForm').validate({
        ignore: [],
        debug: false,
        rules: {
          first_name: {
            required: true
          },
          last_name: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          role: {
            required: true 
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
            required: " First name is required"
          },
          last_name: {
            required: " Last name is required"
          },
          email: {
            required: "Email is required",
            email: "Please enter a valid Email"
          },
          role: {
            required: "Role is required"
          },
          
          confirm_password: {
              
              equalTo: 'Confirm Password must match Password'
          },
        }
      });

      $.validator.addMethod("pwcheck",
                function(value, element) {
                    return /^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/.test(value);
            });
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
