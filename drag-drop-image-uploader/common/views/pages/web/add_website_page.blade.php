@extends('adminlte::page')

@section('title', 'Super Admin | Add Page Content')

@section('content_header')
 

@section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                    <h3>Add Page Content</h3>
                </div>
                <div class="card-body"> @if (session('status')) <div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif <form id="addContentManagementForm" method="post" action="{{ route('pages.save')}}" enctype="multipart/form-data"> @csrf <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                    <div class="form-group"> <label for="title_en">Title{{ labelEnglish() }}<span class="text-danger"> *</span></label> <input type="text" name="title_en" class="form-control" id="title_en" maxlength="100"> </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                    <div class="form-group"> <label for="title_ar">Title{{ labelArabic() }}<span class="text-danger"> *</span></label> <input type="text" name="title_ar" class="form-control" id="title_ar" maxlength="100"> </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-12 col-12">
                                    <div class="form-group"> <label for="banner">Banner<span class="text-danger"> *</span></label> <input type="file" accept=".png, .jpg, .jpeg" name="banner" id="banner" onchange="readURL2(this);" class="form-control"> </div>
                                </div>
                            </div> <!-- show thumbnail -->
                            <div class="row">
                                <div class="col-md-6 col-lg-12 col-xl-12 col-12"> <img src="{{asset('background_images/back1.jpg')}}" id="thumbnail_preview_1" style="height:130px;display:none;"> </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-12"> <img src="{{asset('background_images/back2.jpg')}}" id="thumbnail_preview_2" style="height:130px;display:none;"> </div>
                            </div> <!-- show thumbnail --> <br>
                            <div class="form-group"> <label for="content_en">Content{{labelEnglish()}}<span class="text-danger"> *</span></label> </div> <textarea id="content_en" name="content_en"></textarea> <br>
                            <div class="form-group"> <label for="section">Content{{labelArabic()}}<span class="text-danger"> *</span></label> @if($errors->has('section')) <div class="error">{{ $errors->first('section') }}</div> @endif </div> <textarea id="content_ar" name="content_ar"></textarea>
                        </div> <!-- /.card-body -->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary">Save</button> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

@section('css')
@stop

@section('js')
  <script> 
    $(document).ready(function() {
      // content
       CKEDITOR.replace( 'content_en', {
        customConfig : 'config.js',
        toolbar : 'simple',
        allowedContent: true
        
      });

       CKEDITOR.replace('content_ar',{
        customConfig:'config.js',
        toolbar:'simple',
        allowedContent:true
       });


      $('#addContentManagementForm').validate({
             ignore: [],
            
        rules: {
          title_en: {
            required: true
          },
          title_ar: {
            required: true
          },
           thumbnail: {
            required: true
          },
           banner: { 
            required: true
          },
          content_en:{

             required: function() {
              CKEDITOR.instances.content_en.updateElement();
            },
            minlength:10

          },
          content_ar:{
             required: function() {
              CKEDITOR.instances.content_ar.updateElement();
            },
            minlength:10
          },
        },
        messages: {
          title_en: {
            required: "Title(en) is required"
          },
          title_ar: {
            required: "Title(ar) is required"
          },
           thumbnail: {
            required: "Thumbnail  is required"
          },
           banner: {
            required: "Banner is required"
          },
          content_en:{
            required: "Content(en) is required"
          },
          content_ar:{
            required: "Content(ar) is required"
          },
        }
      });



    });
  </script>


  <!-- show image on change -->
  <script type="text/javascript">
    function readURL1(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#thumbnail_preview_1').css('display', 'block');
          $('#thumbnail_preview_1').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function readURL2(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#thumbnail_preview_2').css('display', 'block');
          $('#thumbnail_preview_2').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <!-- show image on change -->

@stop
