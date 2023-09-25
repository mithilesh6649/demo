@extends('adminlte::page')

@section('title', 'Add Maintenance Sub Category')

@section('content_header')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3> Add Maintenance Sub Category</h3>
                            <a class="btn btn-sm btn-success"
                                href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body table p-0 mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form id="add_sub_category" method="post"
                                action="{{ route('save_maintenance_sub_category') }}">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cat_id">Maintenance Category Name<span
                                                            class="text-danger"> *</span></label>
                                                    <select class="advance_category_search catselect form-control"
                                                        name="cat_id" id="cat_id">
                                                        <option value="">Select Maintenance Category</option>

                                                        @forelse ($MaintenanceCategoryList as $allCateogry)
                                                            <option value="{{ $allCateogry->id }}">
                                                                {{ $allCateogry->cat_name }}</option>
                                                        @empty
                                                        @endforelse

                                                    </select>

                                                </div>

                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sub_cat_name">Maintenance Sub Category Name<span
                                                            class="text-danger"> *</span></label>
                                                    <input type="text" name="sub_cat_name" class="form-control"
                                                        id="sub_cat_name" maxlength="100">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="text"
                                        class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.save') }}</button>
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
        label#cat_id-error {
            position: relative;
            top: 92px;
            left: -196px;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#add_sub_category').validate({
                ignore: [],
                debug: false,
                rules: {
                    sub_cat_name: {
                        required: true,
                        remote: {
                            type: "POST",
                            url: "{{ route('check_maintenance_sub_category') }}",
                            data: {
                                "sub_cat_name": function() {
                                    return $("#sub_cat_name").val();
                                },
                                "_token": "{{ csrf_token() }}",
                                "cat_id": function() {
                                    return $("#cat_id").val();
                                },

                            },
                            dataFilter: function(result) {
                                var json = JSON.parse(result);
                                if (json.msg == 1) {
                                    return "\"" + "Sub Category Name already exist" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
                    },
                    cat_id: {
                        required: true,
                    }

                },
                messages: {
                    sub_cat_name: {
                        required: "Maintenance Sub Category Name is required"
                    },
                    cat_id: {
                        required: "Maintenance Category Name is required"
                    },
                }
            });
        });
    </script>


    <script type="text/javascript">
        // $(".catselect").select2();

        $(".catselect").select2({
            placeholder: "Select Maintenance Category",
        });
    </script>
@stop
