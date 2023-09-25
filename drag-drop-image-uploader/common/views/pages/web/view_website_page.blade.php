@extends('adminlte::page')
@section('title', 'Super Admin | Page Content details')
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
                            <h3>Page Content</h3>
                        </div>
                        <div class="card-body table form mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="form_wrap">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                        <div class="form-group">
                                            <label>Title(en)</label>
                                            <input class="form-control" placeholder="{{ $pageContent->title_en ?? '' }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                        <div class="form-group mt-3">
                                            <label>Title(ar)</label>
                                            <input class="form-control" placeholder="{{ $pageContent->title_ar ?? '' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                @if ($pageContent->section != 'outlets_content' &&
                                    $pageContent->section != 'loyalty_title' &&
                                    $pageContent->section != 'our_management' &&
                                    $pageContent->section != 'our_brands' &&
                                    $pageContent->section != 'subsidiaries')
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                            <div class="form-group mt-3">
                                                <label>Content(en)</label>
                                                <div class="about-content">{!! $pageContent->content_en !!}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                            <div class="form-group mt-3">
                                                <label>Content(ar)</label>
                                                <div class="about-content">{!! $pageContent->content_ar !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- <div class="row">
                           <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group mt-3">
                                 <label>Name</label>
                                 <input class="form-control px-0" placeholder="{{ $addedBy->first_name . ' ' . $addedBy->last_name }}" readonly>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group mt-3">
                                <label>Name</label>
                                <input class="form-control px-0" placeholder="{{ $updatedBy->first_name . ' ' . $updatedBy->last_name }}" readonly>
                              </div>
                           </div>
                        </div> -->

                                @if ($pageContent->section == 'contact_us')
                                    <div class="form-group mt-3">
                                        <label>Guest Support</label>
                                        <input type="text" class="form-control" name="support"
                                            value="{{ $pageContent->support_number }}" readonly />
                                    </div>
                                @endif

                                @if ($pageContent->section == 'contact_us')
                                    <div class="form-group mt-3">
                                        <label>WhatsApp Number</label>
                                        <input type="text" class="form-control" name="whats_app_number"
                                            value="{{ $pageContent->whats_app_number }}" readonly />
                                    </div>
                                @endif

                                @if ($pageContent->section == 'contact_us')
                                    <div class="form-group mt-3">
                                        <label>Address 1</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $pageContent->address }}" readonly />
                                    </div>
                                @endif
                                @if ($pageContent->section == 'contact_us')
                                    <div class="form-group mt-3">
                                        <label>Address 2</label>
                                        <input type="text" class="form-control" name="address_two"
                                            value="{{ $pageContent->address_two }}" readonly />
                                    </div>
                                @endif

                                @if ($pageContent->section == 'contact_us')
                                    <div class="form-group mt-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $pageContent->email }}" readonly />
                                    </div>
                                @endif
                                <div class="form-group mt-3">
                                    <label>Status</label>
                                    <select class="form-control" disabled name="status">
                                        @foreach ($status as $status_data)
                                            <option value="{{ $status_data->value }}"
                                                @if ($status_data->value == $pageContent->status) selected @endif>{{ $status_data->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group mt-3">
                                            <label>Updated At</label>
                                            <input class="form-control"
                                                placeholder="{{ date('Y/m/d', strtotime($pageContent->last_updated_at)) }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group mt-3">
                                            <label>Created At</label>
                                            <input class="form-control"
                                                placeholder="{{ date('Y/m/d', strtotime($pageContent->created_at)) }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
