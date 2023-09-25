
@extends('adminlte::page')

@section('title', 'Super Admin | Admin details')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>{{ __('adminlte::adminlte.admin_information') }}</h3>
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
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                  <div class="form-group mb-0">
                   <label>First Name </label>
                    <input class="form-control" placeholder="{{$admin->first_name ?? 'N/A' }}" readonly>
                  </div>
                </div>
   
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                  <div class="form-group mb-0">
                   <label>Last Name </label>
                    <input class="form-control" placeholder="{{$admin->last_name ?? 'N/A' }}" readonly>
                  </div>
                </div>
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                  <div class="form-group">
                   <label>{{ __('adminlte::adminlte.email') }}</label>
                    <input class="form-control" placeholder="{{ $admin->email }}" readonly>
                  </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                  <div class="form-group ">
                    <label>{{ __('adminlte::adminlte.role') }}</label>
                    
                    <input class="form-control" placeholder="{{ $admin->role->name}}" readonly>
                  </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                  <div class="form-group  ">
                      <label>Created At</label>
                    <input class="form-control" placeholder="{{date('d/m/Y H:i A',strtotime($admin->created_at)) }}" readonly>
                  </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                  <div class="form-group  ">
                  <label>Updated At</label>
                    <input class="form-control" placeholder="{{ date('d/m/Y H:i A',strtotime($admin->updated_at))}}" readonly>
                  </div>
                </div> 

                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                  <div class="form-group">
                   <label for="email">Status </label>
                    <div class="form-group radio">
                      <select class="form-control" placeholder="Status" name="status" disabled>
                        @foreach($status as $status_data)
                         <option value="{{$status_data->value}}" @if($admin->status==$status_data->value) selected @endif >{{$status_data->name}}</option>
                        @endforeach
                      </select>
                     </div>
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

@section('css')
@stop

@section('js')
@stop
