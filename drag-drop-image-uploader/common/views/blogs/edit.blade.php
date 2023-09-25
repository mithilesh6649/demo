@extends('adminlte::page')

@section('title', 'Super Admin | Edit Blog')

@section('content_header')
    <style type="text/css">
        .text-dangers {
            color: red !important;
        }

        #content_en-error {
            display: block;
            font-weight: 400px !important;
        }

        #content_ar-error {
            display: block;
            font-weight: 400px !important;
        }
    </style>
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-sm btn-success back-button"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        <h3>Edit Blog</h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="editBlogsForm" method="post" action="{{ route('blogs.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label for="page_title">Title{{ labelEnglish() }}<span class="text-danger">
                                                    *</span></label>
                                            <input type="text" name="title_en" class="form-control" id="title_en"
                                                maxlength="100" value="{{ $blog->title_en ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label for="page_title">Title{{ labelArabic() }}<span class="text-danger">
                                                    *</span></label>
                                            <input type="text" name="title_ar" class="form-control" id="title_ar"
                                                maxlength="100" value="{{ $blog->title_ar ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="section">Content{{ labelEnglish() }}<span class="text-danger">
                                            *</span></label>
                                    <textarea id="content_en" name="content_en">{{ $blog->content_en }}</textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="section">Content{{ labelArabic() }}<span class="text-danger">
                                            *</span></label>
                                    @if ($errors->has('section'))
                                        <div class="error">{{ $errors->first('section') }}</div>
                                    @endif
                                    <textarea id="content_ar" name="content_ar">{{ $blog->content_ar }}</textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        @foreach ($status as $status_data)
                                            <option value="{{ $status_data->value }}"
                                                @if ($status_data->value == $blog->status) selected @endif>
                                                {{ $status_data->name }}</option>
                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            {{-- Add Image Here --}}

                            <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-2 pt-4">
                                <div class="form-group mt-3">
                                    <label><strong>Blog Image (320X320)</strong></label>
                                </div>
                                <div class="row row_justify justify-content-center">
                                    <div class="card-body main_body form p-0">
                                        <div class="upload_img row row_justify justify-content-center">

                                            <div class="exsist_image img_upload_one"
                                                style="display: {{ $blog->thumbnail != null ? 'block' : 'none' }}">
                                                <img style="object-fit:contain;"
                                                    src="{{ asset('blog_images/' . $blog->thumbnail) }}">
                                                <label>Upload Blog Image (320X320)</label>
                                                <i class="remove_image fa fa-times" aria-hidden="true"
                                                    id="{{ $blog->id }}"></i>
                                            </div>

                                            <div class="new_image img_upload_one"
                                                style="display: {{ $blog->thumbnail != null ? 'none' : 'block' }}"
                                                style="display:none;">
                                                <img id="image_pre" src="{{ asset('images/add-image.png') }}"
                                                    alt="">
                                                <label>Upload Blog Image (320X320)</label>
                                                <i class="remove_temp_image remove_image_new fa fa-times" aria-hidden="true"
                                                    style="display: none;"></i>
                                                <input type="file" name="Media_image" id="product_image"
                                                    accept=".png, .jpg, .jpeg">
                                            </div>
                                            <input type="hidden" name="error_msg" id="error_msg" value="">
                                            <input type="hidden" name="image_status" id="image_status"
                                                value="{{ $blog->thumbnail ? 1 : 0 }}">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            {{--  ------------- --}}

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <style>
        i.remove_temp_image.remove_image_new.fa.fa-times {
            right: 50px !important;
        }

        i.remove_image.fa.fa-times {
            right: 50px !important;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script>
        $(document).ready(function() {
            // content
            // content
            initSample();

            CKEDITOR.replace('content_en', {
                customConfig: 'config.js',
                toolbar: 'simple',
                //language: 'hi',
                //uiColor: '#FF0000',
                extraPlugins: 'lineheight',
                removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor',
                colorButton_colors: 'CF5D4E,454545,FFF,DDD,CCEAEE,66AB16',
                colorButton_enableAutomatic: 'false',
                allowedContent: true
            });

            CKEDITOR.replace('content_ar', {
                customConfig: 'config.js',
                toolbar: 'simple',
                allowedContent: true,
                extraPlugins: 'lineheight',
            });


            $('#editBlogsForm').validate({
                ignore: [],

                rules: {
                    title_en: {
                        required: true
                    },
                    title_ar: {
                        required: true
                    },
                    content_en: {

                        required: function() {
                            CKEDITOR.instances.content_en.updateElement();
                        },
                        minlength: 10

                    },
                    content_ar: {
                        required: function() {
                            CKEDITOR.instances.content_ar.updateElement();
                        },
                        minlength: 10
                    },
                },
                messages: {
                    title_en: {
                        required: "Title(en) is required"
                    },
                    title_ar: {
                        required: "Title(ar) is required"
                    },
                    content_en: {
                        required: "Content(en) is required"
                    },
                    content_ar: {
                        required: "Content(ar) is required"
                    },
                }
            });

            // $('#editBlogsForm').submit(function(e){
            //    $(".text-dangers").hide();

            //    var title_en = $('#title_en').val().length;
            //    var title_ar = $('#title_ar').val().length;



            //    if(!title_en){

            //       $("<span class='text-dangers title_en'></span>").insertAfter($("#title_en"));
            //          $(".title_en").text('Title(en) is required');
            //          e.preventDefault();
            //    }

            //    if(!title_ar){
            //           $("<span class='text-dangers title_ar'></span>").insertAfter($("#title_ar"));
            //          $(".title_ar").text('Title(ar) is required');
            //          e.preventDefault();
            //    }

            //    var content_english = CKEDITOR.instances['content_en'].getData().replace(/<[^>]*>/gi, '').length;
            //      if(!content_english){
            //          $("<span class='text-dangers content_en'></span>").insertAfter($("#content_en"));
            //          $(".content_en").text('Content(en) is required');
            //          e.preventDefault();
            //      }

            //   var content_arabic = CKEDITOR.instances['content_ar'].getData().replace(/<[^>]*>/gi, '').length;
            //      if(!content_arabic){
            //          $("<span class='text-dangers content_ar'></span>").insertAfter($("#content_ar"));
            //          $(".content_ar").text('Content(ar) is required');
            //          e.preventDefault();
            //      }

            // });

        });
    </script>


    <!-- show image on change -->
    <script type="text/javascript">
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#thumbnail_preview_1').css('display', 'block');
                    $('#thumbnail_preview_1').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#thumbnail_preview_2').css('display', 'block');
                    $('#thumbnail_preview_2').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <!-- show image on change -->

    <script>
        $("#product_image").change(function(evt) {

            const [file] = product_image.files
            if (file) {

                if (file.type == "image/png" || file.type == "image/jpeg" || file.type == "image/jpg") {
                    if (file.size > 10546513) {

                        toastr.error("File size should be less then 8 MB");
                    } else {

                        image_pre.src = URL.createObjectURL(file);
                        image_pre.onload = function() {
                            width = image_pre.naturalWidth;
                            height = image_pre.naturalHeight;
                            console.log(width);
                            console.log(height);

                            if (width == 320 && height == 320) {
                                $('#product_image').css('display', 'none');
                                $('#image_pre').css('display', 'block');
                                $('.remove_temp_image').css('display', 'block');
                                $('#error_msg').val('');
                            } else {

                                $('#product_image').val('');

                                toastr.error(
                                    'Please upload an image with 320 x 320 pixels dimension'
                                );
                                $('#product_image').css('display', 'block');
                                $('#error_msg').val(1);
                            }
                        }

                    }
                } else {

                    alert("Invalid File type !");
                }
            }
        });

        $(document).on('click', '.remove_image', function() {
            let blog_id = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $('#image_status').val(0);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('delete.blog_image_delete') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            blog_id: blog_id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            $(".exsist_image").css('display', 'none');
                            $(".new_image").css('display', 'block');
                        }
                    });
                }
            });

        });

        $(document).on('click', '.remove_temp_image', function(evt) {
            $('#image_status').val(0);
            $("#product_image").val('');
            $('#image_pre').attr('src', "{{ asset('images/add-image.png') }}");
            $('#product_image').css('display', 'block');
            $('.remove_temp_image').css('display', 'none');
        });
    </script>

@stop
