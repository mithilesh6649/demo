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
<div class="login_wrap">
    <div class="form-box">
        <h2 class="mb-2">Admin Panel Login</h2>
        <label class="text-center d-block mb-0">Welcome! please login below</label>
        <form action="" method="post" id="loginForm" class="position-relative mt-4" novalidate="novalidate">
            <input type="hidden" name="_token" value="1N3Kgh6Jx7wrBgl9kIvYEzfcdAULlFuwjHzNIiEQ">
            <div class="input-group mb-4 position-relative">
                <input type="email" name="email" placeholder="Email" class="form-control valid" value="" autofocus="" aria-invalid="false">
             </div>
            <div class="input-group mb-4 position-relative">
                <input type="password" name="password" id="password" placeholder="Password" class="" aria-invalid="false">
                <img src="images/eye.png" alt="">
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <div class="d-flex align-items-center">
                <div class="check_box_wrap">
                  <input value="1" type="checkbox">
                  <label></label>
                </div>
                <span class="ms-1">Remember me</span>
              </div>
              <a href="forgot-password.html">Forgot Password</a>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <button type="submit" class="button btn_bg_color common_btn text-white">
                        LOGIN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('js')
    <script>
        function showPassword() {
            var pass = document.getElementById("password");
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }
    </script>
@stop
