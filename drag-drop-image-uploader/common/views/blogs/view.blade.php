@extends('adminlte::page')

@section('title', 'Super Admin | Blog details')

@section('content_header')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-sm btn-success back-button"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        <h3>Blog Details</h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form_wrap">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Title {{ labelEnglish() }} </label>
                                        <input class="form-control" placeholder="{{ $blog->title_en }}" readonly>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Title{{ labelArabic() }} </label>
                                        <input class="form-control" placeholder="{{ $blog->title_ar }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-3">
                                        <label>Content{{ labelEnglish() }} </label>
                                        <div class="about-content">{!! $blog->content_en !!}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-3">
                                        <label>Content{{ labelArabic() }}</label>
                                        <div class="about-content">{!! $blog->content_ar !!}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Status</label>

                                <?php

                                $blog_status = '';

                                foreach ($status as $status_data) {
                                    if ($status_data->value == $blog->status) {
                                        $blog_status = $status_data->name;
                                    }
                                }

                                ?>

                                <input class="form-control" placeholder="{{ $blog_status }}" readonly>
                            </div>

                            {{-- Add Image Here --}}

                            @if ($blog->thumbnail != null)
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
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{--  ------------- --}}


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.open_grepper_editor').hide();
        });
    </script>
@endsection
