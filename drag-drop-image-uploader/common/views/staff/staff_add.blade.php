@extends('adminlte::page')

@section('title', 'Super Admin | Add Staff')

@section('content_header')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Add Staff</h3>
                            <a class="btn btn-sm btn-success"
                                href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body table p-0 mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form id="addStaffForm" method="post" action="{{ route('save_staff') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                            <div class="form-group">
                                                <label for="staff_code">Staff Code<span class="text-danger">
                                                        *</span></label>
                                                <input type="text" name="staff_code" class="form-control" id="staff_code"
                                                    value="" maxlength="100">
                                                @if ($errors->has('staff_code'))
                                                    <div class="error">{{ $errors->first('staff_code') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                            <div class="form-group">
                                                <label for="staff_name">Staff Name<span class="text-danger">
                                                        *</span></label>
                                                <input type="text" name="staff_name" class="form-control" id="staff_name"
                                                    value="" maxlength="100">
                                                @if ($errors->has('staff_name'))
                                                    <div class="error">{{ $errors->first('staff_name') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                            <div class="form-group ">
                                                <label for="designation">Designation<span class="text-danger">
                                                        *</span></label>
                                                <select name="designation" class="form-control" placeholder=" "
                                                    id="designation">
                                                    <option value="" disabled>Select Designation</option>
                                                    @foreach ($designation_list as $key => $role)
                                                        <option value="{{ $role->id }}">{{ $role->designation }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                            <div class="form-group">
                                                <label for="points">Points</label>
                                                <input type="number" name="points" class="form-control" id="points"
                                                    value="" maxlength="100">
                                                @if ($errors->has('points'))
                                                    <div class="error">{{ $errors->first('points') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                         <div class="col-md-6 col-lg-6 col-xl-6 col-12   mb-3">
                                            <div class="form-group">
                                                <label for="points">Residency / Civil ID No.</label>
                                                <input type="text" name="civil_id" class="form-control" id="points"
                                                    value="" maxlength="100">
                                                @if ($errors->has('points'))
                                                    <div class="error">{{ $errors->first('points') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                            <div class="form-group  ">
                                                <label for="status">Status</label>
                                                <select class="form-select" name="status">
                                                    @foreach ($status as $status_data)
                                                        <option value="{{ $status_data->value }}">{{ $status_data->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" id="submit_btn"
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
@stop

@section('js')
    <script>

        $(document).ready(function() {

            $('#addStaffForm').validate({
                ignore: [],
                debug: false,
                rules: {
                    staff_name: {
                        required: true
                    },
                    staff_code: {
                        required: true,
                        remote: {
                            url: "{{ route('staff.staff_code_check') }}",
                            type: "post",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'staff_code': function() {
                                    return $('#staff_code').val()
                                },
                            },

                            dataFilter: function(data) {
                                var json = JSON.parse(data);
                                if (json.msg == "true") {
                                    return "\"" + "Staff Code already exists" +
                                        "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
                    },
                    designation: {
                        required: true
                    },
                },

                messages: {
                    staff_name: {
                        required: "Staff Name is required"
                    },
                    staff_code: {
                        required: "Staff Code is required"
                    },
                    designation: {
                        required: "Designation is required",
                    },
                }
            });




        });
    </script>
@stop
