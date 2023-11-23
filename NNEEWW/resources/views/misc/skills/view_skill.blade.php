@extends('adminlte::page')

@section('title', 'Skill Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.skill_information') }}</h3>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>        
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form class="form_wrap">

            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.name') }}</label>
                  <input class="form-control" placeholder="{{ $skill[0]->name }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.slug') }}</label>
                  <input class="form-control" placeholder="{{ $skill[0]->slug }}" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.status') }}</label>
                  <input class="form-control" placeholder="{{ $skill[0]->status ? 'Active' : 'Inactive' }}" readonly>
                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.deleted_date') }}</label>
                  <input class="form-control" placeholder="{{ $skill[0]->deleted_at ? date('d/m/y', strtotime($skill[0]->deleted_at)) : '' }}" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_date') }}</label>
                  <input class="form-control" placeholder="{{ $skill[0]->created_at ? date('d/m/y', strtotime($skill[0]->created_at)) : '' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                  <input class="form-control" placeholder="{{ $skill[0]->updated_at ? date('d/m/y', strtotime($skill[0]->updated_at)) : '' }}" readonly>
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
  <style>
    .skill-description { font-size: 13px; }
  </style>
@stop

@section('js')
@stop
