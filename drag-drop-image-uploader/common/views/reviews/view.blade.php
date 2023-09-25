@extends('adminlte::page')

@section('title', 'Super Admin | Review details')

@section('content_header')
 

@section('content')

  
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <h3> Review Details</h3>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
               <form class="form_wrap">
                  <div class="row">
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Customer Name</label>
                           <input class="form-control px-0" placeholder="{{ $review->name ?? '' }}" readonly>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                        <div class="form-group ">
                           <label for="status">Status </label> 
                           <select class="form-control" name="status" id="status" disabled>
                           @foreach($status as $status_data)
                           <option value="{{$status_data->value}}" {{ $status_data->value == $review->status ? 'selected':'' }} >{{$status_data->name}}</option>
                           @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                        <div class="form-group mt-4">
                           <label for="message">Message</label>
                           <textarea class="form-control" id="message" readonly>{{$review->message}}</textarea>
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