@extends('adminlte::page')

@section('title', 'Add News')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Update Sign</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
              <form id="signform" method="post" enctype="multipart/form-data" action="{{route('update_sign')}}">
              @csrf
              <div class="card-body form">
                <div class="row"> 
                  <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label for="name">Name<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" value="{{$sign->name}}" maxlength="100">
                     
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>

                    <!-- <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                    <label for="content">Page Content</label>
                <textarea id="content" name="content"></textarea>
                     
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                   
                      <div class="form-group">
                      <label for="name">News Publish Date:<span class="text-danger"> *</span></label>
                      <input type="date"name="date" class="form-control" id="date" value="">
                     
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>  
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label for="time">News Publish time<span class="text-danger"> *</span></label>
                      <input type="time"name="news_time" class="form-control" id="time" value="">
                     
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                      </div>

                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                    <label for="image">News Image<span class="text-danger"> *</span></label>
                    <input type="file" name="file" class="form-control" id="file" value="" accept="image/*"/>
                     
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                     </div>
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                    <label for="doc">DOC<span class="text-danger"> *</span></label>
                    <input type="file" name="doc" class="form-control" id="doc" value=""data-file_types="pdf|doc|docx|rtf"accept="docx/pdf*">
                     
        <p color="red"id="output"></p>
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                     </div>     -->
                  <!-- <div class="col-md-6 col-lg-6 col-xl-6 col-6 mt-6">
                    <div class="form-group radio">
                      <div class="job_alerts">
                        <label>Send Notification to users</label>
                        <label class="switch">
                            <input name="notify_users" type="checkbox">
                            <span class="slider round"></span>
                        </label>
                                      
                      </div>
                    </div>
                  </div> -->
                  <!-- testing cml toggle -->
    
                </div>
              </div>
                  
                  <!-- testing cml toggle -->

                  
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" id="update" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
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
</style>
@stop

@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script> -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
 <script>
    $("select.multiple").select2();
    $(document).ready(function() {
      
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      $('#signform').validate({
       
        ignore: [],
        debug: false,
        rules: {
            name: {
            required: true,
            noSpace:true
          },
         
          
        },
        messages: {
         name: {
            required: "The Name is required",
          },
         
        news_time:{
         
            required:"This field is required",
            
          }
          
        
          
        },
        submitHandler: function () {
          form.submit();
    }
      });
        $.validator.addMethod("noSpace", function(value, element) { 
            return $.trim(value).length!=0; 
        }, "No space please and don't leave it empty");

       $.validator.addMethod("timey", function(value, element) {
    var hour = parseInt(value.substring(0,2));
    return hour > 7 && hour < 23;
}, "Invalid time");
    
    });
  
  </script>
  

     
    


@stop
