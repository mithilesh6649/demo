@extends('adminlte::page')

@section('title', 'Website Content')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ @$type }} Details</h3>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back</a>
        </div>        
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form class="form_wrap">
            <div class="row">

              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                <div class="form-group">
                  <label>Title</label>
                  <input class="form-control" placeholder="{{@$content->title}}" readonly>
                </div>
              </div>
             
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                <div class="form-group website_content">
                  <label>Content</label>
                  <div class="content_view">{!!@$content->content!!}</div>
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

@section('css')
@stop

@section('js')
@stop
