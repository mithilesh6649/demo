@extends('adminlte::page')
@section('title', 'Sign View')
@section('content_header')
@stop
@section('content')
<div class="container">
<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Sign Details</h3>
         </div>
         <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
               {{ session('status') }}
            </div>
            @endif
            <form class="form_wrap">
               <div class="row">
                  <div class="col-12">
                     <div class="form-group">
                        <label>Name</label>
                        <input class="form-control px-0" placeholder="{{ $sign->name }}" readonly>
                     </div>
                  </div>
                
               </div>
                 <div class="row">
                     <div class="col-6">
                        <div class="form-group">
                           <label>Last Updated:</label>
                           <input class="form-control px-0" placeholder="{{ date('m/d/Y', strtotime($sign->updated_at)) }}" readonly>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="form-group">
                           <label>Created Date:</label>
                           <input class="form-control px-0" placeholder="{{ date('m/d/Y', strtotime($sign->created_at)) }}" readonly>
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