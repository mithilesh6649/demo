@extends('adminlte::page')

@section('title', 'Super Admin | Customer Info')

@section('content_header')

@section('content')

<div class="container ">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>Customer Info</h3>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body table p-0 mb-0"> @if (session('status')) <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div> @endif <form id="editUserForm" method="post" action=""> @csrf <div class="card-body form">
             
              <div class="row">

                <div class="col-12">
                  <div class="form-group">
            
                    <div>
                        {!! $customer->customer_info !!}
                    </div>
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

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .editable_field {
      position: relative;
      top: -25px;
      right: 10px;
      float: right;
  }
  .non_editable_field {
      position: relative;
      top: -25px;
      right: 10px;
      float: right;
  }

  #job_alerts_modal label.error {
    position: absolute;
    bottom: -12px;
    left: 17px;
}
</style>
<style type="text/css">
    .ui-autocomplete {
      position: absolute;
      top: 100%;
      left: 0;
      z-index: 9999;
      display: none;
      float: left;
      min-width: 160px;
      padding: 5px 0;
      margin: 2px 0 0;
      list-style: none;
      font-size: 14px;
      text-align: left;
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border: 1px solid rgba(0, 0, 0, 0.15);
      border-radius: 4px;
      -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
      background-clip: padding-box;
  }

  .ui-autocomplete > li > div {
      display: block;
      padding: 3px 20px;
      clear: both;
      font-weight: normal;
      line-height: 1.42857143;
      color: #333333;
      white-space: nowrap;
  }

  .ui-state-hover,
  .ui-state-active,
  .ui-state-focus {
      text-decoration: none;
      color: #262626;
      background-color: #f5f5f5;
      cursor: pointer;
  }

  .ui-helper-hidden-accessible {
      border: 0;
      clip: rect(0 0 0 0);
      height: 1px;
      margin: -1px;
      overflow: hidden;
      padding: 0;
      position: absolute;
      width: 1px;
  }

  .select2-container{
    z-index: 9999;
}


.iti {
  position: relative;
  display: inline-block;
  min-width: 100%;
}
.chosen-container .chosen-choices {
  width: 100% !important;
  height: 50px !important;
  border-radius: 4px ;
}

</style>
@stop

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@stop
