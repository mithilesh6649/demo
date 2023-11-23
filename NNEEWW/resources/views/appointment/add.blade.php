@extends('adminlte::page')
@section('title', 'Add Appointments')
@section('content_header')
@section('content')
    <?php
    $CLIENT_ID = 'V8BIrV0vSEyBiMK8YuwZfA';
    $REDIRECT_URI = 'https://feea-111-93-38-130.ngrok.io/zoom-authentication'; //url('zoom-authentication');
    $url = 'https://zoom.us/oauth/authorize?response_type=code&client_id=' . $CLIENT_ID . '&redirect_uri=' . $REDIRECT_URI;
    ?>



    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card order_outer rounded_circle">
                    <div class="card-body rounded_circle table p-0 mb-0">
                        <div class="order_details">
                            <div class="card-main pt-3">
                                <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">Add Appointment</h3>

                                    <!-- <a href="<?php echo $url; ?>">Login with Zoom</a> -->

                                    <a class="btn btn-sm btn-success add-advance-options"
                                        href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                                </div>
                                <div class="card-body main_body form p-3">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form id="addAppoinmentForm" enctype="multipart/form-data">
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

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group"> <label for="reason_for_appointment">
                                                                Appoinment Title<span class="text-danger"> *</span></label>
                                                            <input type="text" name="reason_for_appointment"
                                                                class="form-control reason_for_appointment"
                                                                id="reason_for_appointment" maxlength="100"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label>Select User<span class="text-danger">*</span></label>
                                                            <select class="form-control UserSelect" id="select"
                                                                name="user_id">

                                                            </select>
                                                            <label id="user_cutom_error"></label>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label>Select Nutritionists<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control NutritionistSelect" id="select2"
                                                                name="nutritionist_id">
                                                                <option value="">Select Nutritionist</option>


                                                                @forelse ($NutritionistList as $Nutritionist)
                                                                    <option value="{{ $Nutritionist->id }}">
                                                                        {{ $Nutritionist->name }}
                                                                        ({{ $Nutritionist->email ?? '--' }})
                                                                    </option>
                                                                @empty
                                                                    <option disabled>No results found </option>
                                                                @endforelse

                                                            </select>
                                                            <label id="nutritionist_cutom_error"></label>
                                                        </div>
                                                    </div>




                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group"> <label for="appoinment_date">Appointment
                                                                Date<span class="text-danger"> *</span></label> <input
                                                                type="text" name="appoinment_date"
                                                                class="form-control appoinment_date" id="appoinment_date"
                                                                maxlength="100" autocomplete="off"> </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group"> <label for="appoinment_start_time">
                                                                Appointment Start Time<span class="text-danger">
                                                                    *</span></label> <input type="text"
                                                                name="appoinment_start_time"
                                                                class="form-control appoinment_start_time"
                                                                id="appoinment_start_time" maxlength="100"
                                                                autocomplete="off"> </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group"> <label
                                                                for="appoinment_end_time">Appointment End Time<span
                                                                    class="text-danger"> *</span></label> <input
                                                                type="text" name="appoinment_end_time"
                                                                class="form-control appoinment_end_time"
                                                                id="appoinment_end_time" maxlength="100" autocomplete="off">
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="error-msg-app">

                                                </div>




                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="text"
                                                class="button btn_bg_color common_btn text-white submit-btn">{{ __('adminlte::adminlte.save') }}</button>
                                        </div>
                                    </form>
                                    {{-- <div class="d-none" id="appoinment_container">
                                                <p>
                                                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                                                    data-target="#collapseExample" aria-expanded="false"
                                                    aria-controls="collapseExample" id="appoinment_text">

                                                </button>
                                            </p>
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body" id="quick_view_container">

                                                </div>
                                            </div>
                                        </div> --}}

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
    <link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop
@section('js')
    <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
    <!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(".appoinment_date").datetimepicker({
            // timepicker:true,
            // formatTime: 'g:i A',
            // format : 'd/m/Y g:i A',
            // validateOnBlur: false,
            // minDate : 0,
            // step: 15,
            minDate: new Date(),
            timepicker: false,
            format: 'd/m/Y',
            scrollMonth: false,
            scrollInput: false
        });


        $(".appoinment_start_time").datetimepicker({
            datepicker: false,
            formatTime: 'g:i A',
            format: 'g:i A',
            validateOnBlur: false,
            step: 60,
        });



        $(".appoinment_end_time").datetimepicker({
            datepicker: false,
            formatTime: 'g:i A',
            format: 'g:i A',
            step: 60,
            validateOnBlur: false,
        });



        $(document).ready(function() {

            // Add custom validation method
            $.validator.addMethod("notEqual", function(value, element, param) {
                return value != $(param).val();
            }, "Appointment Start & End time can't be equal");

            // Add custom validation method
            $.validator.addMethod("notGreater", function(value, element, param) {
                return value > $(param).val();
            }, "Appointment  End time not less than Start time");

            $('#addAppoinmentForm').validate({
                ignore: [],

                rules: {
                    user_id: {
                        required: true
                    },
                    nutritionist_id: {
                        required: true
                    },
                    appoinment_date: {
                        required: true
                    },
                    appoinment_start_time: {
                        required: true,
                        notEqual: "#appoinment_end_time",

                    },
                    appoinment_end_time: {
                        required: true,
                        //  notGreater: "#appoinment_start_time"
                    },
                    reason_for_appointment: {
                        required: true
                    }

                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "nutritionist_id") {
                        error.appendTo($('#nutritionist_cutom_error'));
                    } else if (element.attr("name") == "user_id") {
                        error.appendTo($('#user_cutom_error'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                messages: {
                    user_id: {
                        required: "User  is required"
                    },

                    nutritionist_id: {
                        required: "Nutritionist  is required"
                    },
                    appoinment_date: {
                        required: "Appoinment date  is required"
                    },

                    appoinment_start_time: {
                        required: "Appoinment start time is required"
                    },
                    appoinment_end_time: {
                        required: "Appoinment end time is required"
                    },
                    reason_for_appointment: {
                        required: "Appoinment title is required"
                    }

                },
                submitHandler: function(form) {

                    //Make AJax Request....................

                    var appoinmentStartTime = $("#appoinment_start_time").val();
                    var appoinmentEndTime = $("#appoinment_end_time").val();

                    // Convert time strings to 24-hour format for easier comparison
                    var startDateTime = new Date("2000-01-01 " + appoinmentStartTime);
                    var endDateTime = new Date("2000-01-01 " + appoinmentEndTime);

                    var timeDiff = endDateTime - startDateTime; // Difference in milliseconds
                    var hoursDiff = timeDiff / (1000 * 60 * 60); // Convert milliseconds to hours

                    if (hoursDiff === 1) {
                        console.log("Valid: Time difference is one hour.");
                    } else {
                        toastr.error('The time difference should be exactly one hour.');
                        console.log("Invalid: Time difference is not one hour.");
                        return false;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('save_appointment') }}",
                        data: new FormData(form),
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == 'failed') {
                                toastr.error(response.message);
                            }

                            if (response.status == 'success') {
                                toastr.success(response.message);
                                setTimeout(() => {
                                    window.location.href =
                                        "{{ route('appointments_list') }}";
                                }, 200);
                            }
                        }
                    });
                    return false;
                    //End AjAX rEQUEST...


                }


            });

        });



        // $(".UserSelect").select2();
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $(".NutritionistSelect").select2({});

            $(".UserSelect").select2({
                placeholder: 'Select User',
                width: '350px',
                delay: 250,
                allowClear: true,
                minimumInputLength: false,
                ajax: {
                    url: "{{ route('get_active_users') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page
                        }
                    },
                    processResults: function(data, params) {
                        //console.log(data);
                        params.page = params.page || 1;
                        console.log(params.page);
                        console.log(data);
                        var result = $.map(data, function(item) {
                            if (item.email == null) {
                                $n_email = '--';
                            } else {
                                $n_email = item.email;
                            }
                            return {
                                id: item.id,
                                text: item.text + "(" + $n_email + ")"
                            }
                        });
                        console.log(result);
                        return {
                            //results: result
                            results: result,
                            pagination: {
                                more: (params.page * 1) > data.total_count
                            },
                        };
                    },

                    cache: true
                }
            });
        });
    </script>



    <script>
        $(document).ready(function() {

            $('#appoinment_date ,.NutritionistSelect').on('change', function() {
                var current_obj = this.value;
                var nutritionist_id = $('.NutritionistSelect').val();
                var appoinment_date = $('#appoinment_date').val();
                //Ajax find appoinment...

                if (nutritionist_id != '' && appoinment_date != '') {
                    $.ajax({
                        type: "post",
                        url: "{{ route('today_appointment') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "date": appoinment_date,
                            "nutritionist_id": nutritionist_id,
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log(response);
                            //  $('.placed_date').html(order_placed_date);
                            if (response.status) {
                                $('#quick_view_container').html(response.html);
                                $('#appoinment_text').html(
                                    " See All Appoinments of selected Nutritionist :- " +
                                    appoinment_date);
                                $('#appoinment_container').removeClass("d-none");
                            }
                        }

                    });
                }


            });
        });
    </script>


    <!--    <script type="text/javascript">
        //$('#appoinment_start_time','#appoinment_end_time',)
        $(document).ready(function() {
            $('#appoinment_start_time,#appoinment_end_time,#appoinment_date,.NutritionistSelect').on('change',
                function() {
                    var start_time = $('#appoinment_start_time').val();
                    var end_time = $('#appoinment_end_time').val();
                    var nutritionist_id = $('.NutritionistSelect').val();
                    var appoinment_date = $('#appoinment_date').val();
                    if (start_time != '' && end_time != '' && nutritionist_id != '' && appoinment_date != '') {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('check_appointment_exist') }}",
                            data: {
                                "start_time": start_time,
                                "end_time": end_time,
                                "nutritionist_id": nutritionist_id,
                                "appoinment_date": appoinment_date
                            },
                            success: function(response) {
                                if (response.success == "true") {
                                    var design = `  <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Oops!</strong>   Appoinment already exist for this Date/Time.
                                    </div> `;
                                    $('.error-msg-app').html(design);
                                    $('.submit-btn').attr('disabled', true);

                                    setTimeout(function() {
                                        $('.error-msg-app').html('');
                                        $('#appoinment_start_time').val('');
                                        $('#appoinment_end_time').val('');
                                        $('.submit-btn').attr('disabled', false);
                                    }, 1000);

                                } else {

                                }
                            }
                        });
                    }
                });
        });
    </script> -->
@stop
