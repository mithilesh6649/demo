@extends('adminlte::page')

@section('title', 'Super Admin | Add Banner Image')

@section('content_header')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>View Banner</h3>
                            <a class="btn btn-sm btn-success"
                                href="{{ route('banners.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body table form mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="tab_wrapper">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <form id="addbanner" method="post" autocomplete="off" enctype="multipart/form-data"
                                            name="demoform" style="border:none;">
                                            @csrf
                                            <div class="card-body form">
                                                <div class="row">
                                                    <input type="hidden" id="userid" name="userid">
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label>Image Type</label>
                                                            <select disabled name="image_type" id="image_type"
                                                                class="form-control">
                                                                <option value="">Image Type</option>
                                                                <option value="0"
                                                                    @if ($banner[0]->type == 0) selected @endif>Single
                                                                    Image</option>
                                                                <option value="1"
                                                                    @if ($banner[0]->type == 1) selected @endif>
                                                                    Multiple Image</option>
                                                            </select>
                                                            @if ($errors->has('image_type'))
                                                                <div class="error">{{ $errors->first('image_type') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label>Page Name</label>
                                                            <select name="page_name" disabled id="page_name"
                                                                class="form-control">

                                                                <!-- 	 <option value="">Page Name</option>
                                     <option @if ($banner[0]->page_name == 'home_page') selected @endif>Home Page</option> -->

                                                                @forelse ($pages_name as $page_name)
                                                                    <option
                                                                        {{ $page_name->value == $banner[0]->page_name ? 'selected' : '' }}>
                                                                        {{ $page_name->name }}</option>
                                                                @empty
                                                                    <option disabled>Pages not found</option>
                                                                @endforelse


                                                                <!-- <option @if ($banner[0]->page_name == 'mm_cares') selected @endif>MM Cares</option>
                                   <option @if ($banner[0]->page_name == 'menu') selected @endif>Menu</option>
                                   <option @if ($banner[0]->page_name == 'blog') selected @endif >Blog</option>
                                   <option @if ($banner[0]->page_name == 'catering') selected @endif>Catering</option>
                                   <option @if ($banner[0]->page_name == 'dine-in') selected @endif >Dine-in</option>
                                   <option @if ($banner[0]->page_name == 'outlets') selected @endif>Outlets</option>
                                   <option @if ($banner[0]->page_name == 'loyality_point') selected @endif >Loyality Point</option>
                                   <option @if ($banner[0]->page_name == 'about_us') selected @endif >About Us</option>
                                   <option @if ($banner[0]->page_name == 'contact_us') selected @endif >Contact Us</option>
                                   <option @if ($banner[0]->page_name == 'order_online') selected @endif >Order Online</option>
                                      -->
                                                            </select>

                                                            @if ($errors->has('page_name'))
                                                                <div class="error">{{ $errors->first('page_name') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12 ">
                                                        <div class="form-group mt-3">
                                                            <label>Banner Image</label>
                                                            <div class="dropzone-previews">
                                                                @foreach ($banner as $image)
                                                                    <div>
                                                                        <div class="list-img">
                                                                            <img src="{{ asset('CMS/banner/' . $image->banner) }}"
                                                                                alt="banner image" class="img"
                                                                                style="width: 250px;height: 130px;">
                                                                        </div>
                                                                        @if ($image->status == 1)
                                                                            <span
                                                                                class="badge badge-pill badge-success p-0 mt-2">Active</span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-pill badge-danger p-0 mt-2">Deactive</span>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <small class="image_notice"
                                                                style="color:#FF0A00;font-size:12px;"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <!--                     <div class="card-footer">
                          <button type="submit" class="button btn_bg_color common_btn text-white d-none">Save</button>
                        </div> -->
                                        </form>
                                    </div>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Banner Image</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">
                                                            ×
                                                        </span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" class="image_preview">
                                                    <div class="w3-content w3-display-container">
                                                        <button class="w3-button w3-black w3-display-left"
                                                            onclick="plusDivs(-1)">&#10094;</button>
                                                        <button class="w3-button w3-black w3-display-right"
                                                            onclick="plusDivs(1)">&#10095;</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        .mySlides {
            display: none;
        }

        .dropzoneDragArea {
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
            border-radius: 6px;
            padding: 60px;
            text-align: center;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .dropzone {
            box-shadow: 0px 2px 20px 0px #f2f2f2;
            border-radius: 10px;
        }

        /*my code*/
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #1f5c7a;
        }

        /*my code*/

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

        .another-message:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-top: 15px solid #263238;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            top: 0;
            left: -15px;
        }

        .another-message:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-top: 17px solid #263238;
            border-left: 16px solid transparent;
            border-right: 16px solid transparent;
            top: 0px;
            left: -16px;
        }

        .another-name {
            font-weight: bolder;
            margin-right: 0px;
        }

        .another-content {
            margin-top: 0px;
            margin-bottom: 0px;
            line-height: 22px;
        }

        .iti {
            position: relative;
            display: inline-block;
            min-width: 100%;
        }

        .chosen-container .chosen-choices {
            width: 100% !important;
            height: 50px !important;
            border-radius: 4px;
        }

        .dz-preview {
            margin-top: 20px;
        }
    </style>
@stop

@section('js')
    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "block";
        }

        function imagetotal() {
            var page = $('#page_name').find(':selected').val();
            $.ajax({
                url: "{{ route('banners.update.datasta') }}",
                method: "GET",
                data: {
                    'page': page
                },
                dataType: "JSON",
                success: function(response) {
                    imageslide(response.data);

                }

            });
        }

        function imageslide(imagesld) {
            var src = "{{ asset('CMS/banner/') }}";
            var html = "";
            console.log(imagesld);

            $.each(imagesld, function(key, val) {

                $.each(imagesld[key], function(key, val) {
                    if (key == 'banner') {

                        html += "<img class='mySlides' src='" + src + "/" + val +
                            "' style='width:100%;height:400px;' />";


                    }
                });


            });
            var button =
                '<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button><button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>';
            $('.w3-display-container').empty();
            $('.w3-display-container').append(button);
            $('.w3-display-container').append(html);

        }
        $(document).on('click', '.nav-item', function() {
            $('.nav_link').each(function() {
                if ($(this).hasClass('active')) {
                    var target = $(this).attr('href');
                    $('.tab-pane').removeClass('show');
                    $('.tab-pane').removeClass('active');
                    $(target).addClass('show');
                    $(target).addClass('active');
                }
            })
        })
    </script>


    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script type="text/javascript">
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",

        })

        $(document).ready(function() {
            imagetotal();

            $('.img').on('click', function() {

                $(this).attr('src');
                var src = $(this).attr('src');

                $(".w3-display-container img").each(function() {
                    if ($(this).attr('src') == src) {
                        $(this).css('display', 'block');
                    } else {
                        $(this).css('display', 'none');
                    }
                });


                $('#exampleModal').modal('show');

            });

        });
    </script>




@stop
