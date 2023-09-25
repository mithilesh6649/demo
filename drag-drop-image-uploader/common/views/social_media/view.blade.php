@extends('adminlte::page')

@section('title', 'Super Admin | Social Link Details')

@section('content_header')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Social Link Details</h3>
                            <a class="btn btn-sm btn-success"
                                href="{{ route('social-media.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body table p-0 mb-0">
                            <form class="form_wrap" id="addSocialMediaForm">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" maxlength="100"
                                                value="{{ $social_link->name }}" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label>Profile URL</label>
                                            <input type="text" class="form-control" name="profile_url" maxlength="100"
                                                value="{{ $social_link->profile_url }}" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-2">
                                        <div class="form-group ">
                                            <label for="status">Status </label>
                                            @foreach ($status as $status_data)
                                                @if ($status_data->value == $social_link->status)
                                                    <input type="text" class="form-control" name="status"
                                                        maxlength="100" value="{{ $status_data->name }}" readonly />
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Add Image Here --}}
                                    @if ($social_link->image != null)
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-2 pt-4">
                                            <div class="row row_justify justify-content-center">

                                                <div class="card-body main_body form p-0">
                                                    <div class="upload_img row row_justify justify-content-center">
                                                        <div class="exsist_image img_upload_one"
                                                            style="display: {{ $social_link->image ? 'block' : 'none' }}">
                                                            <img style="object-fit:contain;"
                                                                src="{{ asset('socialmedia_links/' . $social_link->image) }}">
                                                            <label>Uploaded Image</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                    {{--  ------------- --}}
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
@stop

@section('js')
@stop
