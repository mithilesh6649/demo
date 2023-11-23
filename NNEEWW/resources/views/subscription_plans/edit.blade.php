@extends('adminlte::page')

@section('title', 'Edit Plan')

@section('content_header')


@section('content')

    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon_main">

                                    </div>
                                    <h3 class="mb-0">Subscription Plan Edit</h3>
                                </div>
                                <a class="btn btn-sm btn-success add-advance-options"
                                    href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                            </div>
                            <div class="card-body main_body form p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form id="addPlan" method="post" action="{{ route('subscription-plan.update_plans') }}"
                                    onload="resetForm()" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="plan_id" value="{{ $editPlan->id }}">
                                    <div class="row mx-0">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="first_name"> Title<span class="text-danger"> *</span></label>
                                                <input type="text" name="plan_name" class="form-control" id="plan_name"
                                                    value="{{ $editPlan->title ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control"
                                                    id="description" value="{{ $editPlan->description ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="monthly_amount">Monthly Price</label>
                                                <input type="text" name="monthly_amount" class="form-control"
                                                    id="monthly_amount" value="{{ $editPlan->monthly_amount ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="quarterly_amount">Quarterly Price</label>
                                                <input type="text" name="quarterly_amount" class="form-control"
                                                    id="quarterly_amount" value="{{ $editPlan->quarterly_amount ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="annual_amount">Yearly Price</label>
                                                <input type="text" name="annual_amount" class="form-control"
                                                    id="annual_amount" value="{{ $editPlan->annual_amount ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="last_name">Status</label>
                                                <select class="form-select form-control" aria-label="Default select example"
                                                    name="status" id="plan_duration">

                                                    @forelse ($status as $status_data)
                                                        <option value="{{ $status_data->value }}">{{ $status_data->name }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="card-footer border_none text-left">
                                        <button type="text"
                                            class="btn btn-primary common_btn addagent_btn">{{ __('adminlte::adminlte.save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />

    <style>
        .profile-image-show {
            position: relative;
        }

        #profile_picture {
            border: 1px solid red;
            width: 100% !important;
            height: 100% !important;
            border-radius: 20%;
            position: absolute;
            opacity: 0;

        }
    </style>

@stop

@section('js')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>




    <script>
        $(document).ready(function() {

            $("input").attr("autocomplete", "new-password");



            //Validator
            $('#addPlan').validate({
                ignore: [],
                debug: false,
                rules: {
                    plan_name: {
                        required: true,
                    },


                },
                messages: {
                    plan_name: {
                        required: "  Title is required"
                    },

                }
            });


            jQuery.validator.addMethod("phone_valid", function(value, element) {
                return this.optional(element) ||
                    /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value)
                // just ascii letters
            }, "Please enter vaild numer");
            jQuery.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]*$/.test(value)
                // just ascii letters
            }, "Please use alphabets only");


        });
    </script>


@stop
