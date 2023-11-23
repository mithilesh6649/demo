@extends('adminlte::page')

@section('title', 'Contact Us Details')

@section('content_header')
@stop

@section('content')
<div class="container-fluid p-0">
  <div class="col-lg-12">
    <div class="card order_outer rounded_circle">
      <div class="card-body rounded_circle table p-0 mb-0">
        <div class="order_details">
          <div class="card-main pt-3">
            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
              <h3 class="mb-0">Contact Us Details</h3>
              <a class="btn btn-sm btn-success add-advance-options" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <?php 
                if($contactUsMessage->user_id != null) {
                  $user = \App\Models\User::find($contactUsMessage->user_id);
                  $username = $user->first_name ? $user->first_name.' '.$user->last_name : $user->email;
                  $userType = 'User';
                }
                
                else { 
                  $username = "";
                  $userType = 'Guest';
                }

                $url = config('adminlte.website_url', '').'contactUsFiles/';
                $destinationPath = config('adminlte.admin_url').'images/';
                $filePath = $contactUsMessage->file ? $url.$contactUsMessage->file : '';
                if($contactUsMessage->file != null) {
                  $extension = explode('.', $contactUsMessage->file)[1];
                }
                else {
                  $extension = '';
                }
                ?>
              <form class="form_wrap">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>First Name</label>
                      <input class="form-control" placeholder="{{ucfirst( $contactUsMessage->first_name) }}" readonly>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input class="form-control" placeholder="{{ $contactUsMessage->email }}" readonly>
                    </div>
                  </div>

                </div>


                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Message</label>
                      <div style="background-color: #efefef; padding: 15px; border-radius: 5px;">{!! $contactUsMessage->message !!}</div>
                    </div>
                  </div>
                </div>
                

                <div class="row">

                  <div class="col-6">
                    <div class="form-group">
                      <label>Created Date</label>
                      <input class="form-control" placeholder="{{date('m/d/Y',strtotime($contactUsMessage->created_at))}}" readonly>
                    </div>
                  </div>

                  {{-- <div class="col-6">
                    <div class="form-group">
                      <label>Last Updated At</label>
                      <input class="form-control" placeholder="{{date('d/m/Y',strtotime($contactUsMessage->updated_at))}}" readonly>
                    </div>
                  </div> --}}

                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection