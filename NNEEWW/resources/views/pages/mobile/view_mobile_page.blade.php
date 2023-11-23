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
                    <label class="pb-2"><i class="fas fa-user-circle"></i>Title</label>
                    <input class="form-control" placeholder="{{ $pageContent->title }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="pb-2"><i class="fas fa-eye"></i>View</label>
                    <input class="form-control" placeholder="{{ ucfirst($pageContent->device_type) }}" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label class="pb-2"> <i class="fas fa-clipboard-list"></i>Content</label>
                    <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px;">{!! $pageContent->content !!}<div>
                  </div>
                </div>
              </div>
              <div class="row">
                @if($pageContent->updated_at != null)
                <div class="col-6">
                  <div class="form-group">
                    <label class="pb-2"><i class="fas fa-calendar-day"></i>Last Updated</label>
                    <input class="form-control" placeholder="{{date('m/d/Y',strtotime($pageContent->updated_at))}}" readonly>
                  </div>
                </div>
                @endif
                <div class="col-6">
                  <div class="form-group">
                    <label class="pb-2"><i class="fas fa-calendar-day"></i>Created Date</label>
                    <input class="form-control" placeholder="{{date('m/d/Y',strtotime($pageContent->created_at))}}" readonly>
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