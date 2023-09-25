@extends('adminlte::page')
@section('title', 'Super Admin | Theme Content details')
@section('content_header')
 
@section('content')
 
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
             <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
             <h3>Theme Content</h3>
          </div>
          <div class="card-body table form mb-0">
             @if (session('status'))
             <div class="alert alert-success" role="alert">
                {{ session('status') }}
             </div>
             @endif
             <form class="form_wrap">
                <div class="row">
                   <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" placeholder="{{ $SingleTheme->name ?? '' }}" readonly>
                      </div>
                   </div>

                  
                <div class="row">
                   <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group mt-3">
                         <label>Theme</label>
                         <div class="about-content">{!! $SingleTheme->theme !!}</div>
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