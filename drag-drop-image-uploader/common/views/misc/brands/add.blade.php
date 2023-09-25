@extends('adminlte::page')

@section('title', 'Super Admin |Add Brand')

@section('content_header')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Add Brand</h3>
                            <a class="btn btn-sm btn-success"
                                href="{{ route('brands.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body table p-0 mb-0">
                            <form class="form_wrap" id="addBrandForm" method="post"
                                action="{{ route('save.brand') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label>Title {{ labelEnglish() }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title_en" maxlength="100" />
                                        </div>
                                    </div>

                                      <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label>Title {{ labelArabic() }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title_ar" maxlength="100" />
                                        </div>
                                    </div>

                                     

                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-2">
                                        <div class="form-group ">
                                            <label for="status">Status </label>
                                            <select class="form-control" name="status" id="status">
                                                @foreach ($status as $status_data)
                                                    <option value="{{ $status_data->value }}">{{ $status_data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Add Image Here --}}

                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-2 pt-4">
                                        <div class="row row_justify justify-content-center">


                                            <div class="card-body main_body form p-0">
                                                <div class="upload_img row row_justify justify-content-center">
                                                    <div class="new_image img_upload_one" style="display: block "
                                                        style="display:none;">
                                                        <img id="image_pre" src="{{ asset('images/add-image.png') }}"
                                                            alt="">
                                                        <label>Upload Image</label>

                                                        <i class="remove_temp_image remove_image_new fa fa-times"
                                                            aria-hidden="true" style="display: none;"></i>
                                                        <input type="file" name="Media_image" id="product_image"
                                                            accept=".png, .jpg, .jpeg">
                                                    </div>
                                                    <input type="hidden" name="error_msg" id="error_msg" value="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {{--  ------------- --}}


                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="button btn_bg_color common_btn text-white">Save</button>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <style>
        #profileImage {
            height: 150px;
            width: 200px;
            border-radius: 10px;
            object-fit: contain;
            background-color: #fbfbfb;
            border: 1px solid #343d49;
            padding: 10px;
        }

        .messageArea {
            margin-left: 0;
            padding-left: 0;
        }

        .my-message {
            margin-right: 10px;
            background: #ebebeb;
            color: #333333;
            border-radius: 10px;
            padding: 10px;
            max-width: 50vw;
            display: inline-block;
            position: relative;
            margin-bottom: 22px;
        }

        .my-name {
            font-weight: bolder;
            margin-right: 0px;
        }

        .my-content {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .my-message:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-top: 15px solid #ebebeb;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            top: 0;
            right: -15px;
        }

        .my-message:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-top: 17px solid #ebebeb;
            border-left: 16px solid transparent;
            border-right: 16px solid transparent;
            top: 0px;
            right: -16px;
        }

        .butDel {
            width: 10px;
            height: 25px;
        }

        .butDelText {
            position: relative;
            right: 3.5px;
            top: -1px;
        }

        .another-message {
            margin-left: 10px;
            background: #263238;
            color: #ffffff;
            border-radius: 10px;
            padding: 10px;
            max-width: 50vw;
            display: inline-block;
            position: relative;
            margin-bottom: 22px;
        }
    </style>
@stop

@section('js')

    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script>
        $(document).ready(function() {

            $('#addBrandForm').validate({
                ignore: [],

                rules: {
                    title_ar: {
                        required: true
                    },
                    title_en: {
                        required: true,
                      
                    },
                    Media_image: {
                        required: true,
                    },


                },
                messages: {
                    title_ar: {
                        required: "Title (ar) is required",
                    },
                    title_en: {
                        required: "Title (en) is required",
                    },
                    Media_image: {
                        required: "Image is required",
                    },
                }
            });

        });


        $(document).on('change', '#product_image', function(evt) {

            const [file] = product_image.files
            if (file) {

                if (file.type == "image/png" || file.type == "image/jpeg" || file.type == "image/jpg") {
                    if (file.size > 10546513) {

                        toastr.error("File size should be less then 8 MB");
                    } else {
                        $('#product_image').css('display', 'none');
                        $('#image_pre').css('display', 'block');
                        $('.remove_temp_image').css('display', 'block');
                        $('#error_msg').val('');

                        image_pre.src = URL.createObjectURL(file);
                        image_pre.onload = function() {
                            width = image_pre.naturalWidth;
                            height = image_pre.naturalHeight;
                        }

                    }
                } else {

                    alert("Invalid File type !");
                }
            }
        });

        $(document).on('click', '.remove_temp_image', function(evt) {
            $("#product_image").val('');
            $('#image_pre').attr('src', "{{ asset('images/add-image.png') }}");
            $('#product_image').css('display', 'block');
            //  $('#image_pre').css('display','none');
            $('.remove_temp_image').css('display', 'none');
        });
    </script>


@stop
