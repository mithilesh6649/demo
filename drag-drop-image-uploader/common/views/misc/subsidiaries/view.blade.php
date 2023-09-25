@extends('adminlte::page')
@section('title', 'Super Admin | Subsidiaries  details')
@section('content_header')
 
@section('content')
 
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
             <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
             <h3>Subsidiaries Details</h3>
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
                        <label>Title(en)</label>
                        <input class="form-control" placeholder="{{ $Subsidiaries->title_en ?? '' }}" readonly>
                      </div>
                   </div>

                   <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group mt-3">
                         <label>Title(ar)</label>
                         <input class="form-control" placeholder="{{ $Subsidiaries->title_ar ?? '' }}" readonly>
                      </div>
                   </div>
                </div>

                <div class="row">
                   <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group mt-3">
                         <label>Description(en)</label>
                         <div class="about-content">{!! $Subsidiaries->description_ar !!}</div>
                      </div>
                   </div>
                </div> 

                <div class="row">
                   <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group mt-3">
                         <label>Description(ar)</label>
                         <div class="about-content">{!! $Subsidiaries->description_ar !!}</div>
                      </div>
                   </div>
                </div> 

                       <div class="form-group mt-3">
                                <label>Status</label>
                                <select class="form-control" name="status" disabled>
                                  @foreach($status as $status_data)
                                   <option value="{{$status_data->value}}" @if($status_data->value==$Subsidiaries->status) selected @endif>{{$status_data->name}}</option>
                                  @endforeach
                                
                                </select>

                            </div>
 
    
             </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection