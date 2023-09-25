@extends('adminlte::page')

@section('title', 'Super Admin | Add New Sub Category')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Add New Sub Category</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="editUserForm" method="post", action="">
              @csrf
              <div class="card-body form">
               
                <div class="row">
                 
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="first_name">Name<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" value="" maxlength="100">
                     
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="first_name">Category<span class="text-danger"> *</span></label>
                      
                      <select class="form-control" name="category">
                        <option value="">Select Category</option>
                        <option value="1">Menu Category</option>
                      </select>
                     
                      @if($errors->has('category'))
                        <div class="error">{{ $errors->first('category') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="password_confirmation">Thumbnail<span class="text-danger"> *</span></label>
                      
                      <input type="file" name="thumbnail" onchange="readURL(this);" class="form-control">
                     
                      @if($errors->has('thumbnail'))
                        <div class="error">{{ $errors->first('thumbnail') }}</div>
                      @endif
                    </div>
                  </div>

                </div>

                <!-- show thumbnail -->
                <div class="row">
                  <img src="" id="thumbnail_preview" style="width:300;height:130px;display:none;">
                </div>
                <!-- show thumbnail -->

                <!-- toggle -->
                <div class="row">
                  <!-- testing cml toggle -->
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12 mt-4">
                    <div class="form-group radio">
                      <div class="job_alerts">
                        <label class="pr-2 mb-0 d-block">Enable/Disable<span class="text-danger"> *</span></label>
                        <label class="switch">
                            <input name="status" type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                                      
                      </div>
                    </div>
                  </div>
                  <!-- testing cml toggle -->
                </div>
                <!-- toggle -->

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>


@endsection

@section('css')
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
  <script>
    $("select.multiple").select2();
    $(document).ready(function() {
      
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      $('#editUserForm').validate({
        ignore: [],
        debug: false,
        rules: {
          user_name: {
            required: true,
            noSpace:true
          },
          full_name: {
            required: true,
            noSpace:true
          },

          city: {
            required: true,
            noSpace:true
          },

          island: {
            required: true,
            noSpace:true
          },
          
          email: {
            required: true,
            email: true,
          },
          phone_number: {
            regex: /^[\d ()+-]+$/,
            minlength: 7,
            maxlength: 15
          },
          password:{
            required:true,
            pass_check:true
          },
          password_confirmation: {
            required: true,
            equalTo: "#password"
          }
        },
        messages: {
          user_name: {
            required: "The Username field is required.",
          },
          full_name: {
            required: "The Full Name field is required.",
          },

          city: {
            required: "The City field is required.",
          },

          island: {
            required: "The Island field is required.",
          },
          
          email: {
            required: "The Email field is required.",
            email: "Please enter a valid email"
          },

          password: {
            required: "The Password field is required."
          },
          password_confirmation: {
            required: "The Confirm Password field is required.",
            equalTo : "The Confirm Password should match to Password."
          },
        }
      });


        $.validator.addMethod("noSpace", function(value, element) { 
            return $.trim(value).length!=0; 
        }, "No space please and don't leave it empty");

        $.validator.addMethod("pass_check", function(value, element) {
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/; 
            return value.match(regex); 
        }, "Password must be 8 characters long containing atleast one upper case, one lower case and one number.");

    });
  </script>


  <!-- show image on change -->
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#thumbnail_preview').css('display', 'block');
          $('#thumbnail_preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <!-- show image on change -->

@stop
