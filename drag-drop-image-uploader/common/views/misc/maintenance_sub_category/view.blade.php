@extends('adminlte::page')

@section('title', 'Maintenance Sub Category Details')

@section('content_header')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Maintenance Category Details</h3>
                            <a class="btn btn-sm btn-success"
                                href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body table p-0 mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form id="maintenance_sub_category_form">
                                @csrf
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-warning">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="information_fields mb-0">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="city">Maintenance Category Name</label>
                                                    <input type="text" value="{{ @$MaintenanceSubCategory->category->cat_name }}" readonly>
                                                </div>

                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="city">Petty Expense Sub Category Name </label>
                                                    <input type="text" name="sub_cat_name" class="form-control"
                                                        id="city" maxlength="100"
                                                        placeholder="{{ $MaintenanceSubCategory->sub_cat_name }}" readonly>
                                                </div>
                                            </div>


                                            <div class="col-6 mb-3">
                                                <div class="form-group">
                                                    <label>Created At</label>
                                                    <input class="form-control"
                                                        placeholder="{{ $MaintenanceSubCategory->created_at ? date('d/m/Y', strtotime($MaintenanceSubCategory->created_at)) : '' }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <div class="form-group">
                                                    <label>Updated At</label>
                                                    <input class="form-control"
                                                        placeholder="{{ $MaintenanceSubCategory->updated_at ? date('d/m/Y', strtotime($MaintenanceSubCategory->updated_at)) : '' }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input type="text" value="{{ $MaintenanceSubCategory->status == 1 ? 'Active' : 'Inactive' }}" readonly>
                                                </div>
                                            </div>


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

@section('css')
    <style>
        label#category_id-error {
            position: relative;
            top: 92px;
            left: -196px;
        }
    </style>
@stop

