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
                            <a class="btn btn-sm btn-success back-button"
                                href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                            <h3>Edit Page Content</h3>
                        </div>
                        <div class="card-body table form mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                            @endif
                            <form id="editContentManagementForm" method="post" action="{{ route('pages.update') }}"
                                enctype="multipart/form-data"> @csrf <div class="card-body"> <input type="hidden"
                                        name="page_content_id" class="form-control" value="{{ $pageContent->id }}">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group">
                                                <label>Title(en)</label>
                                                <input type="text" name="title_en" class="form-control" id="title_en"
                                                    maxlength="100" value="{{ $pageContent->title_en }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group">
                                                <label>Title(ar)</label>
                                                <input type="text" name="title_ar" class="form-control" id="title_ar"
                                                    maxlength="100" value="{{ $pageContent->title_ar }}">
                                            </div>
                                        </div>
                                    </div> <!-- show thumbnail -->
                                    @if ($pageContent->section != 'outlets_content' &&
                                        $pageContent->section != 'loyalty_title' &&
                                        $pageContent->section != 'our_management' &&
                                        $pageContent->section != 'our_brands' &&
                                        $pageContent->section != 'subsidiaries')
                                        <div class="form-group mt-3">
                                            <label>Content(en)</label>
                                            <textarea id="content_en" name="content_en">{{ $pageContent->content_en }}</textarea>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Content(ar)</label>
                                            @if ($errors->has('section'))
                                                <div class="error">{{ $errors->first('section') }}</div>
                                            @endif
                                        </div>
                                        <textarea id="content_ar" name="content_ar">{{ $pageContent->content_ar }}</textarea>
                                    @endif

                                    @if ($pageContent->section == 'contact_us')
                                        <div class="form-group mt-3">
                                            <label>Guest Support</label>
                                            <input type="text" class="form-control" name="support"
                                                value="{{ $pageContent->support_number }}" />
                                        </div>
                                    @endif

                                    @if ($pageContent->section == 'contact_us')
                                        <div class="form-group mt-3">
                                            <label>WhatsApp Number</label>
                                            <input type="text" class="form-control" name="whats_app_number"
                                                value="{{ $pageContent->whats_app_number }}" />
                                        </div>
                                    @endif


                                    @if ($pageContent->section == 'contact_us')
                                        <div class="form-group mt-3">
                                            <label>Address 1</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $pageContent->address }}" />
                                        </div>
                                    @endif

                                    @if ($pageContent->section == 'contact_us')
                                        <div class="form-group mt-3">
                                            <label>Address 2</label>
                                            <input type="text" class="form-control" name="address_two"
                                                value="{{ $pageContent->address_two }}" />
                                        </div>
                                    @endif


                                    @if ($pageContent->section == 'contact_us')
                                        <div class="form-group mt-3">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ $pageContent->email }}" />
                                        </div>
                                    @endif

                                    <div class="form-group mt-3">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            @foreach ($status as $status_data)
                                                <option value="{{ $status_data->value }}"
                                                    @if ($status_data->value == $pageContent->status) selected @endif>
                                                    {{ $status_data->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>

                                </div> <!-- /.card-body -->
                                <div class="card-footer"> <button type="submit"
                                        class="button btn_bg_color common_btn text-white">Update</button> </div>



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

        <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>

        <script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
        <!-- <script type="text/javascript" src="{{ asset('assets/ckeditor/adapters/jquery.js') }}"></script> -->


        <script>
            $(document).ready(function() {
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











                //  $(function() {
                // $('#content_en').ckeditor({
                //     toolbar: 'Full',
                //     //enterMode : CKEDITOR.ENTER_BR,
                //     //shiftEnterMode: CKEDITOR.ENTER_P,


                // });
                //  $('#ckeditor2').ckeditor({
                //     toolbar: 'Full',
                //     enterMode : CKEDITOR.ENTER_BR,
                //     shiftEnterMode: CKEDITOR.ENTER_P
                // });


                // });


                $('#editContentManagementForm').validate({
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

    @stop
