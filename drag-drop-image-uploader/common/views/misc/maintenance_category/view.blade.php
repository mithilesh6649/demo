@extends('adminlte::page')

@section('title', 'Maintenance Category Details')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Maintenance  Category Details</h3>
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
                      <label>Maintenance  Category Name</label>
                      <input class="form-control" placeholder="{{ $MaintenanceCategory->cat_name }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" disabled>
                          <option value="1" {{ $MaintenanceCategory->status == 1 ? 'selected':''  }}  >Active</option>
                          <option  value="0" {{ $MaintenanceCategory->status == 0 ? 'selected':''  }}  >Inactive</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Created At</label>
                      <input class="form-control" placeholder="{{ $MaintenanceCategory->created_at ? date('d/m/Y', strtotime($MaintenanceCategory->created_at)) : '' }}" readonly>
                    </div>
                  </div>
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Updated At</label>
                      <input class="form-control" placeholder="{{ $MaintenanceCategory->updated_at ? date('d/m/Y', strtotime($MaintenanceCategory->updated_at)) : '' }}" readonly>
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