@extends('adminlte::page')

@section('title', 'Block Details')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Block Details</h3>
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
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label>Block</label>
                      <input class="form-control" placeholder="{{ $block->block }}" readonly>
                    </div>
                  </div>



                     <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                        <div class="form-group ">
                           <label for="status">Status </label> 
                           <select class="form-control" name="status" id="status" disabled>
                           @foreach($status as $status_data)
                           <option value="{{$status_data->value}}" {{ $status_data->value == $block->status ? 'selected':'' }} >{{$status_data->name}}</option>
                           @endforeach
                           </select>
                        </div>
                     </div>
 
                      
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Created At</label>
                      <input class="form-control" placeholder="{{ $block->created_at ? date('d/m/Y', strtotime($block->created_at)) : '' }}" readonly>
                    </div>
                  </div>
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Updated At</label>
                      <input class="form-control" placeholder="{{ $block->updated_at ? date('d/m/Y', strtotime($block->updated_at)) : '' }}" readonly>
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