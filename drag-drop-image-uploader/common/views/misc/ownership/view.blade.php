@extends('adminlte::page')

@section('title', 'Ownership Details')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Ownership Details</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>            
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form class="form_wrap">
                <div class="row">
                   <div class="col-6 mb-3">
                    <div class="form-group">
                      <label>Ownership Name</label>
                      <input class="form-control" placeholder="{{ $owner->ownership_name }}" readonly>
                    </div>
                  </div>
                  <div class="col-6 mb-3">
                    <div class="form-group">
                      <label>Status</label>
                      <input class="form-control" placeholder="{{ $owner->status==1?'Active':'Inactive' }}" readonly>
                    </div>
                  </div>
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Created At</label>
                      <input class="form-control" placeholder="{{ $owner->created_at ? date('d/m/Y', strtotime($owner->created_at)) : '' }}" readonly>
                    </div>
                  </div>
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Updated At</label>
                      <input class="form-control" placeholder="{{ $owner->updated_at ? date('d/m/Y', strtotime($owner->updated_at)) : '' }}" readonly>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection