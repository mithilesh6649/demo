@extends('adminlte::page')

@section('title', ' Super Admin | Edit Media')

@section('content_header')
@section('content')


<?php
 error_reporting(0);
?> 

    <div class="container-fluid p-0">
            <div class="col-md-12">
                <div class="card order_outer rounded_circle">
                    <div class="card-body rounded_circle table p-0 mb-0">
                        <div class="order_details">
                            <div class="card-main pt-3">
                                <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">Edit Key</h3>
                                    <a class="btn btn-sm btn-success add-advance-options"
                                        href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> 
                                </div>
                                <div class="card-body main_body form p-3">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form id="addRoleForm" method="post", action="{{ route('save_role') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                <label for="role_name">{{$data->key_slug}}<span class="text-danger">*</span></label>
                                                <input type="text" name="{{$data->key_slug}}" class="form-control" id="{{$data->key_slug}}" value="{{$data->value}}" autocomplete="off">
                                                
                                                </div>
                                            </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     
@stop

@section('js')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>




        


@stop
