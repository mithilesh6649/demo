@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif


@section('auth_body')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <div class="background_login">
        <div class="login_wrap">
            <div class="right">
            <div class="login-logo-inner">
                <!-- <a class="admin_logo" href="#"><img src="{{ asset('assets/images/logo.svg') }}" alt=""></a> -->
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logIn_heading">
                        <h3 class="card-title float-none mb-0">Log In</h3>
                        <p class="mt-2">Please sign in to continue.</p>
                    </div>
                    <div class="card-header-heading">
                        <img src="{{asset('assets/images/logo-brand.svg')}}" alt="">
                        <!-- <p class="mb-3">Welcome! please login below</p> -->
                    </div>
                </div>
                <form action="{{ $login_url }}" method="post" id="loginForm" class="login_form">
                    {{ csrf_field() }}

                    {{-- Email field --}}
                    <div class="input-group">
                        <div class="form-group email mb-4">
                            <div class="pb-2 d-flex align-items-center">
                                <img src="{{asset('assets/images/email.svg')}}" alt="">
                            </div>
                            <input type="email" id="login_email" class="email_form form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"  value="{{ old('email') }}" placeholder="Email" autofocus placeholder="Ex: emaple@centralmotors.com" >
                        </div>

                        @if($errors->has('email'))
                            <div class="error-msg">
                                <p class="mb-0">{{ $errors->first('email') }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Password field --}}
                    <div class="input-group">
                        <div class="form-group password mt-4">
                            <div class="pb-2 d-flex align-items-center">
                                <img src="{{asset('assets/images/password-lock.svg')}}" alt="">
                            </div>
                            <input type="password" class="password_form form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Password" id="password">
                            <span class="btn-show-pass"><i class="fa fa-eye" id="togglePassword" style="color: #111111;"></i></span>
                        </div>

                        @if($errors->has('password'))
                            <div class="error-msg">
                                <p>{{ $errors->first('password') }}</p>
                            </div>
                        @endif
                    </div>
                    {{-- <div class="form-group">
                        <div class="forgot_pass text-right mb-2">
                            <a href="">Forgot password?</a>
                        </div>
                    </div> --}}
                    {{-- Login field --}}
                    <div class="row">

                        <div class="col-12">
                            <div class="btn-wrapper mb-2">
                                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}" style="background-color: #ECCF5A;
                                    border: none;
                                    border-bottom:3px solid #ECCF5A;
                                    font-weight: 600;
                                    font-size: 16px;
                                    color: #ffffff;    height: 52px;">
                                    {{ __('adminlte::adminlte.log_in') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
<style type="text/css">
    .login-page .login-box .login_wrap .input-group label.error{
        top: unset !important;
    }
    .error-msg {
        color: #ff0000 !important;
        font-size: 12px;
        font-weight: 400;
        margin-top: -12px;
    }
</style>
@stop

@section('js')
<script type="text/javascript">
    $("#login_email").keyup(function(){
        $(".error-msg").hide()
    });
</script>
<script type="text/javascript">
    const togglePassword = document.querySelector('#togglePassword');
</script>

<script type="text/javascript">
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        if($(this).hasClass('fa-eye-slash')){
            $(this).addClass('fa-eye-slash');
            $(this).removeClass('fa-eye-slash');
        }else{
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye-slash');
        }
    });
</script>
@stop