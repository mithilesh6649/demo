@extends('adminlte::page')

@section('title', 'Mobile Page Content')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Mobile Page Content</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form class="form_wrap">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Title</label>
<<<<<<< HEAD
                    <input class="form-control px-0" placeholder="{{ $pageContent->title }}" readonly>
=======
                    <input class="form-control" value="{{ $pageContent->title }}" readonly>
>>>>>>> e9cf68d3d9876a4396db15331a6e625bd26042a2
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>View</label>
<<<<<<< HEAD
                    <input class="form-control px-0" placeholder="{{ ucfirst($pageContent->device_type) }}" readonly>
=======
                    <input class="form-control" value="{{ ucfirst($pageContent->device_type) }}" readonly>
>>>>>>> e9cf68d3d9876a4396db15331a6e625bd26042a2
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Added By</label>
<<<<<<< HEAD
                    <input class="form-control px-0" placeholder="{{ $addedBy->first_name.' '.$addedBy->last_name }}" readonly>
=======
                    <input class="form-control" value="{{ $addedBy->first_name.' '.$addedBy->last_name }}" readonly>
>>>>>>> e9cf68d3d9876a4396db15331a6e625bd26042a2
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Updated By</label>
<<<<<<< HEAD
                    <input class="form-control px-0" placeholder="{{ $updatedBy->first_name.' '.$updatedBy->last_name }}" readonly>
=======
                    <input class="form-control" value="{{ $updatedBy->first_name.' '.$updatedBy->last_name }}" readonly>
>>>>>>> e9cf68d3d9876a4396db15331a6e625bd26042a2
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Last Updated</label>
<<<<<<< HEAD
                    <input class="form-control px-0" placeholder="{{ date('d/m/y', strtotime($pageContent->last_updated_at)) }}" readonly>
=======
                    <input class="form-control" value="{{ date('d/m/y', strtotime($pageContent->last_updated_at)) }}" readonly>
>>>>>>> e9cf68d3d9876a4396db15331a6e625bd26042a2
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Created Date</label>
<<<<<<< HEAD
                    <input class="form-control px-0" placeholder="{{ date('d/m/y', strtotime($pageContent->created_at)) }}" readonly>
=======
                    <input class="form-control" value="{{ date('d/m/y', strtotime($pageContent->created_at)) }}" readonly>
>>>>>>> e9cf68d3d9876a4396db15331a6e625bd26042a2
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Updated Date</label>
<<<<<<< HEAD
                    <input class="form-control px-0" placeholder="{{ date('d/m/y', strtotime($pageContent->updated_at)) }}" readonly>
=======
                    <input class="form-control" value="{{ date('d/m/y', strtotime($pageContent->updated_at)) }}" readonly>
>>>>>>> e9cf68d3d9876a4396db15331a6e625bd26042a2
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Content</label>
<<<<<<< HEAD
                    <div class="about-content">{!! $pageContent->content !!}<div>
=======
                    <div style="background-color: #87ceeb; padding: 15px; border-radius: 5px; color: #ffffff;">{!! $pageContent->content !!}<div>
>>>>>>> e9cf68d3d9876a4396db15331a6e625bd26042a2
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