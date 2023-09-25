@extends('adminlte::page')

@section('title', 'Super Admin | Edit Page Content')

@section('content_header')
 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-main">
                <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0"> 
                  <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                  <h3>View Management Details</h3>
                </div>
                <div class="card-body table form mb-0"> @if (session('status')) <div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif <form id="editContentManagementForm" method="post" action="" enctype="multipart/form-data"> @csrf <div class="card-body"> <input type="hidden" name="id" class="form-control" value="">
                          <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group"> 
                                <label>Name(en)</label>
                                <input type="text" name="name" class="form-control" id="name" maxlength="100" value="{{ $managementedit->name_en}}" readonly>
                              </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group"> 
                                <label>Name(ar)</label>
                                <input type="text" name="name" class="form-control" id="name" maxlength="100" value="{{ $managementedit->name_ar}}" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="row mt-3">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group">
                                <label>Organization(en)</label>
                                <input type="text" name="organization" class="form-control" id="Organization" readonly maxlength="100" value="{{$managementedit->organization_en}}">
                              </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group">
                                <label>Organization(ar)</label>
                                <input type="text" name="organization" class="form-control" id="Organization" readonly maxlength="100" value="{{$managementedit->organization_ar}}">
                              </div>
                            </div>
                            </div>
                            <div class="row mt-3">
                            
                              <div class="col-md-12">
                                 <div class="form-group">
                                  <label for="password_confirmation">Image </label>
                                   
                                  <div class="upload-img {{$managementedit->image_name != null ? '':'d-none'}}" style="position:relative;width: 250px;">                                            
                                    <label class="d-block"></label>
                                    <input type="hidden" name="old_image_name" value="{{$managementedit->image_name}}">
                                    <img src="{{asset('management/'.$managementedit->image_name)}}" id="thumbnail_preview" style="width: 250px;display: block;" class=" ">
                                  </div>
                               </div>
                              </div>
                            </div>
                         
                            <div class="form-group mt-3"> 
                              <label>Content(en)</label>
                              <div class="about-content">{!! $managementedit->content_en !!}</div>
                           
                            </div>
                            <div class="form-group mt-3"> 
                              <label>Content(ar)</label>
                              <div class="about-content">{!! $managementedit->content_ar !!}</div>
                           
                            </div>
                            
                           <div class="row mt-3">
                             <div class="col-md-6">
                                <div class="form-group">
                                  <label>Designation</label>
                                  <select class="form-control" disabled name="designation">
                                    @foreach($role as $role_del)
                                      <option value="{{$role_del->id}}" {{$role_del->id==$managementedit->management_role_id?'selected':''}}> {{$role_del->name_en}}({{$role_del->name_ar}})</option>
                                    @endforeach
                                  </select>
                                </div>
                             </div>
                             <div class="col-md-6">
                               <div class="form-group">
                                  <label>Status</label>
                                  <select class="form-control" disabled name="status">
                                    @foreach($status as $status_data)
                                     <option value="{{$status_data->value}}" @if($status_data->value==$managementedit->status) selected @endif>{{$status_data->name}}</option>
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

@endsection 

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
@stop

@section('js')

<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

<script src="{{asset('assets/ckeditor/samples/js/sample.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('assets/ckeditor/adapters/jquery.js') }}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <script> 
    $(document).ready(function() {
     // content
  initSample();

       CKEDITOR.replace( 'content_en', {
        customConfig : 'config.js',
        toolbar : 'simple',
         //language: 'hi',
        //uiColor: '#FF0000',
         removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor',
        colorButton_colors : 'CF5D4E,454545,FFF,DDD,CCEAEE,66AB16',
        colorButton_enableAutomatic :'false',
        allowedContent: true
      });

       CKEDITOR.replace('content_ar',{
        customConfig:'config.js',
        toolbar:'simple',
        allowedContent:true
       });

  </script>
@stop
