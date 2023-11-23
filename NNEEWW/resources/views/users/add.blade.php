@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0">Add User</h3>
                                <a class="btn btn-sm btn-success add-advance-options"
                                    href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                            </div>
                            <div class="card-body main_body form p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <!--
                                        <form id="addUserForm" method="post" action="{{ route('save_user') }}">
                                            @csrf
                                            <div class="">

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="name">Name<span class="text-danger"> *</span></label>
                                                            <input type="text" name="name" class="form-control" id="name"
                                                                maxlength="100">
                                                            @if ($errors->has('name'))
    <div class="error">{{ $errors->first('name') }}</div>
    @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="email">Email<span class="text-danger"> *</span></label>
                                                            <input type="text" name="email" class="form-control" id="email"
                                                                maxlength="100">
                                                            <div id="email_error" class="error"></div>
                                                            @if ($errors->has('email'))
    <div class="error">{{ $errors->first('email') }}</div>
    @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                        <label for="password">Phone Number<span class="text-danger"> *</span></label>
                                                        
                                                        <input type="tel"  name="phone_number" class="form-control"  id="txtPhone"/>
                                                        <input type="hidden"  name="country_code" class="form-control"  id="country_code" />
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="gender">Gender<span class="text-danger"> *</span></label>

                                                            <select name="gender" class="form-control" id="gender">
                                                                <option value="">Select Gender</option>
                                                                @foreach ($genders as $gender)
    <option value="{{ $gender->value }}">{{ $gender->name }}</option>
    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="password">{{ __('adminlte::adminlte.password') }}<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="password" name="password" class="form-control" id="password"
                                                                maxlength="100">
                                                            @if ($errors->has('password'))
    <div class="error">{{ $errors->last('password') }}</div>
    @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="password" name="confirm_password" class="form-control"
                                                                id="confirm_password" maxlength="100">
                                                            @if ($errors->has('confirm_password'))
    <div class="error">{{ $errors->last('confirm_password') }}</div>
    @endif
                                                        </div>
                                                    </div>

                                


                                            


                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="status">Status<span class="text-danger"> *</span></label>
                                                            <select name="status" class="form-control" id="status">
                                                                @foreach ($status as $status)
    <option value="{{ $status->id }}">{{ $status->name }}</option>
    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>

                                            <div class="card-footer">
                                                <button id="submitButton"
                                                    class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                                            </div>

                                        </form> -->


                                <!-- Graph Coding Start -->
                                <div>
                                    <h5>New Users</h5>
                                    <hr>

                                    <div id="chart">
                                    </div>
                                </div>
                                <!-- Graph Coding End -->



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
        .information_fields {
            margin-bottom: 30px;
        }

        .address_fields {
            margin-top: 30px;
        }

        input#txtPhone {
            padding-left: 95px !important;
        }

        .iti--allow-dropdown .iti__flag-container .iti__selected-flag {
            width: 90px;
        }
    </style>
@stop

@section('js')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript">
        $(function() {
            var code = "+91 "; // Assigning value from model.
            $('#txtPhone').val(code);
            $('#txtPhone').intlTelInput({
                autoHideDialCode: true,
                autoPlaceholder: "ON",
                dropdownContainer: document.body,
                formatOnDisplay: true,

                initialCountry: "auto",
                nationalMode: true,
                placeholderNumberType: "MOBILE",
                preferredCountries: ['US'],
                separateDialCode: true
            });

        });

        $("#txtPhone").on('focusout', function() {
            var code = $("#txtPhone").intlTelInput("getSelectedCountryData").dialCode;
            $('#country_code').val(code);
        });
    </script>

    <script>
        function myFunction() {
            document.getElementById("email").val('');
        }

        $("input").attr("autocomplete", "new-password");

        $('#addUserForm').validate({
            ignore: [],
            debug: false,
            rules: {
                name: {
                    required: true,

                },
                email: {
                    required: true,
                    remote: {
                        type: "get",
                        url: "{{ route('check_user_email') }}",
                        data: {
                            "email": function() {
                                return $("#email").val();
                            },
                            "_token": "{{ csrf_token() }}",

                        },
                        dataFilter: function(result) {
                            var json = JSON.parse(result);
                            if (json.msg == 1) {
                                return "\"" + "Email ID already  exist" + "\"";
                            } else {
                                return 'true';
                            }
                        }
                    }

                },
                gender: {
                    required: true,
                },
                phone_number: {
                    required: true,
                },
                password: {
                    required: true,

                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: "Name  is required",
                },

                email: {
                    required: "Email is required",
                    email: "Please enter a valid email"
                },
                gender: {
                    required: "Gender is required",
                },
                phone_number: {
                    required: "Phone number is required",
                },

                password: {
                    required: "Password is required"
                },
                confirm_password: {
                    required: "Confirm Password is required",
                    equalTo: "Confirm Password should match to Password"
                },
            }
        });


        //Appex charts


        var options = {
            series: [{
                name: 'Users',
                data: [
                    <?php foreach ($month_val_data as $key => $value): ?>
                    {{ $value }},
                    <?php endforeach ?>
                ]
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + "";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "";
                    }
                }

            },
            title: {
                text: 'Monthly Users in Gena HealthX , 2023',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

@stop
