@extends('adminlte::page')

@section('title', 'Contact Us Details')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Contact Us Details</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
           
            <form class="form_wrap">
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->name }}" readonly>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->email }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->contact_number }}" readonly>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>Subject</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->subject }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-12 ">
                  <div class="form-group">
                    <label>Message</label>
                    <div style="background-color: #efefef; padding: 15px; border-radius: 5px;">{!! $contactUsMessage->message !!}<div>
                  </div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Created At</label>
                    <input class="form-control" placeholder="{{ date('d/m/Y', strtotime($contactUsMessage->created_at)) }}" readonly>
                  </div>
                </div>
              
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Status  </label>
                           <select class="form-control changestatus" name="status" data-id="{{ $contactUsMessage->id}}"  disabled>
                      @foreach ($contact_us_status as $contact_status)

                     <option value="{{ $contact_status->value }}" {{ $contact_status->value == $contactUsMessage->status ? 'selected':'' }} > {{ $contact_status->name }}</option>


                        @endforeach
 
                      </select>
                  </div>
                </div>
              </div>

      

            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection