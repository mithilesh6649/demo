@extends('adminlte::page')

@section('title', 'User Details')

@section('content_header')

@section('content')

<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0"> User Details</h3>
                            <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body form pt-3 pb-0">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="container p-0">
                                <span class="badge badge-danger   p-2 my-2"> USER ID : GHX-{{ @$User->id ?? '--' }}
                                </span>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist active d-flex align-items-center"
                                        data-toggle="tab" href="#profile"><img
                                        src="{{ asset('assets/images/profile.svg') }}" class="mr-1"
                                        style="width: 15px; height: 15px;" alt="">Profile</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist   d-flex align-items-center"
                                        data-toggle="tab" href="#appSettings"><img
                                        src="{{ asset('assets/images/profile.svg') }}" class="mr-1"
                                        style="width: 15px; height: 15px;" alt=""> App Settings</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist   d-flex align-items-center"
                                        data-toggle="tab" href="#dailyRecommendedNutrients"><img
                                        src="{{ asset('assets/images/profile.svg') }}" class="mr-1"
                                        style="width: 15px; height: 15px;" alt=""> Daily
                                    Recommended/Intake Nutrients</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab"
                                    href="#Transaction"><img src="{{ asset('assets/images/transaction.svg') }}"
                                    class="mr-1" style="width: 15px; height: 15px;"
                                    alt="">Subscription</a>
                                </li>

                                 <li class="nav-item">
                                    <a class="nav-link nav_nutritionist   d-flex align-items-center"
                                    data-toggle="tab" href="#information"><img
                                    src="{{ asset('assets/images/profile.svg') }}" class="mr-1"
                                    style="width: 15px; height: 15px;" alt="">Information</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link nav_nutritionist   d-flex align-items-center"
                                    data-toggle="tab" href="#goalsWeb"><img
                                    src="{{ asset('assets/images/profile.svg') }}" class="mr-1"
                                    style="width: 15px; height: 15px;" alt="">Goals</a>
                                </li>

                                  <li class="nav-item">
                                <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab"
                                href="#diet">
                                <img src="{{ asset('assets/images/diet.svg') }}"
                                style="width: 15px; height: 15px;" class="mr-1"
                                alt="">Diet</a>
                            </li>

                                <li class="nav-item">
                                    <a class="nav-link nav_nutritionist   d-flex align-items-center"
                                    data-toggle="tab" href="#progress"><img
                                    src="{{ asset('assets/images/profile.svg') }}" class="mr-1"
                                    style="width: 15px; height: 15px;" alt="">Progress</a>
                                </li>

                               


                                <li class="nav-item">
                                    <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab"
                                    href="#goals">
                                    <img src="{{ asset('assets/images/tracker.svg') }}"
                                    style="width: 15px; height: 15px;" class="mr-1"
                                    alt="">Tracker</a>
                                </li>

                               

                                <li class="nav-item">
                                    <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab"
                                    href="#reports">
                                    <img src="{{ asset('assets/images/reports.svg') }}"
                                    style="width: 15px; height: 15px;" class="mr-1" alt="">Test
                                Reports</a>
                            </li>

                          

                            <li class="nav-item">
                                <a class="nav-link nav_nutritionist d-flex align-items-center"
                                data-toggle="tab" href="#Appoinments"><img
                                src="{{ asset('assets/images/appointment.svg') }}" class="mr-1"
                                style="width: 15px; height: 15px;" alt="">Appointments</a>
                            </li>





                            <li class="nav-item">
                                    <a class="nav-link nav_nutritionist   d-flex align-items-center"
                                    data-toggle="tab" href="#healthGuide"><img
                                    src="{{ asset('assets/images/profile.svg') }}" class="mr-1"
                                    style="width: 15px; height: 15px;" alt="">Help & Support</a>
                                </li>


                            <li class="nav-item">
                                <a class="nav-link nav_nutritionist d-flex align-items-center"
                                data-toggle="tab" href="#Reviews">
                                <img src="{{ asset('assets/images/rating.svg') }}"
                                style="width: 15px; height: 15px;" class="mr-1"
                                alt="">Reviews</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="profile" class="container tab-pane active"><br>
                                @include('users.partials.user_profile_partials')
                            </div>

                            <div id="appSettings" class="container tab-pane fade"><br>
                                @include('users.partials.app_settings')
                            </div>

                            <div id="dailyRecommendedNutrients" class="container tab-pane fade"><br>
                                @include('users.partials.daily_recommended_nutrients')
                            </div>

                            <div id="progress" class="container tab-pane fade"><br>
                                @include('users.partials.progress')
                            </div>

                            <div id="healthGuide" class="container tab-pane fade"><br>
                                @include('users.partials.health_guide')
                            </div>

                            <div id="information" class="container tab-pane fade"><br>
                                @include('users.partials.user_information')
                            </div>

                            <div id="goalsWeb" class="container tab-pane fade"><br>
                                @include('users.partials.goals_clinical_and_nutritional')
                            </div>

                            <div id="goals" class="container tab-pane fade"><br>
                                @include('users.partials.user_goals')

                            </div>

                            <div id="reports" class="container tab-pane fade "><br>
                                @include('users.partials.user_reports')

                            </div>
                            <div id="diet" class="container tab-pane fade "><br>
                                @include('users.partials.diet')
                            </div>

                            <div id="Appoinments" class="container tab-pane fade "><br>
                                @include('users.partials.user_appoinments')
                            </div>

                            <div id="Transaction" class="container tab-pane fade "><br>
                                @include('users.partials.user_subscription')
                            </div>

                            <div id="Reviews" class="container tab-pane fade "><br>
                                @include('users.partials.user_reviews')

                            </div>



                        </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
<link href="{{ asset('tagify/dist/tagify.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


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

<style>
    /* start mk profile upload coding */
    .profile-image-show {
        height: 161px;
        width: 161px;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #wh;
        border: 7px solid #dcf7d5;
        position: relative;
        margin: 0 0 20px;
        cursor: pointer;
    }

    .upload_image_wrapper {
        padding: 16px 25px 16px 25px;
        background-color: #ffffff !important;
        border: 1px solid #F0EFEF;
        height: 60px;
        box-shadow: none;
        outline-style: none;
        font-size: 13px;
        line-height: normal;
        color: #1c1c1c;
        border-radius: 10px;
        position: relative;
    }

    .upload_image_wrapper input#news_source_website_image_1 {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        z-index: 1;
        cursor: pointer;
    }

    input[type=file],
    /* FF, IE7+, chrome (except button) */
    input[type=file]::-webkit-file-upload-button {
        /* chromes and blink button */
        cursor: pointer;
    }

    .upload_image_wrapper i.far.fa-image {
        font-size: 28px;
    }


    .profile-image-show {
        background-color: #f6f7fb;
        border-radius: 20px;
        border: 1px dashed #878D8E !important;
        width: 200px;
        height: 200px;
        margin: 0px 0 20px;
        /*overflow: hidden;*/
        padding: 10px;
    }

    .remove-pro-img {
        position: absolute;
        top: -10px;
        right: -10px;
        z-index: 9;
    }

    .profile-image-show img#profileImage {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .thumb_nails {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .thumb_nails h4 {
        font-size: 14px;
        width: 100%;
        text-align: center;
        margin: 10px 0 0;
        font-weight: 600;
    }

    #profile_picture {
        border: 1px solid red;
        width: 100% !important;
        height: 100% !important;
        border-radius: 20%;
        position: absolute;
        opacity: 0;
    }


    /* end mk profile upload coding */


    .editable_field {
        position: relative;
        top: -25px;
        right: 10px;
        float: right;
    }

    .non_editable_field {
        position: relative;
        top: -25px;
        right: 10px;
        float: right;
    }

    #job_alerts_modal label.error {
        position: absolute;
        bottom: -12px;
        left: 17px;
    }
</style>

<style type="text/css">
    .select2-container {
        min-width: 400px;
    }

    .select2-results__option {
        padding-right: 20px;
        vertical-align: middle;
    }

    .select2-results__option:before {
        content: "";
        display: inline-block;
        position: relative;
        height: 20px;
        width: 20px;
        border: 2px solid #e9e9e9;
        border-radius: 4px;
        background-color: #fff;
        margin-right: 20px;
        vertical-align: middle;
    }

    .select2-results__option[aria-selected=true]:before {
        font-family: fontAwesome;
        content: "\f00c";
        color: #fff;
        background-color: #f77750;
        border: 0;
        display: inline-block;
        padding-left: 3px;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #fff;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #eaeaeb;
        color: #272727;
    }

    .select2-container--default .select2-selection--multiple {
        margin-bottom: 10px;
    }

    .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
        border-radius: 4px;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #f77750;
        border-width: 2px;
    }

    .select2-container--default .select2-selection--multiple {
        border-width: 2px;
    }

    .select2-container--open .select2-dropdown--below {
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .select2-selection .select2-selection--multiple:after {
        content: 'hhghgh';
    }

    /* select with icons badges single*/
    .select-icon .select2-selection__placeholder .badge {
        display: none;
    }

    .select-icon .placeholder {
        display: none;
    }

    .select-icon .select2-results__option:before,
    .select-icon .select2-results__option[aria-selected=true]:before {
        display: none !important;
        /* content: "" !important; */
    }

    .select-icon .select2-search--dropdown {
        display: none;
    }
</style>


@stop

@section('js')
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('tagify/dist/jQuery.tagify.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    $('#appoinment-list').DataTable({});

    $('#weight-tracker-list , #water-tracker-list , #report-list,#reviews-list,#report-list-hs,#support-list-hs,#consultation-list-hs,#dna-list-hs,#chronic-list-hs,#WeightLossSupport-list-hs,#DietPlanSupport-list-hs,#TalkToGenahealthx-list,#diet-plan-list').DataTable({
        'ordering': false
    });
</script>

<script>
    $(document).on('click', '.copy_btn', function() {
        var btn = this;
        var getLink = $(this).attr('data-link');

        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(getLink).select();
        document.execCommand("copy");
        $temp.remove();

        $(btn).html('Copied !');

        setTimeout(function() {
            $(btn).html('Copy');
        }, 800);

    });

    $(function() {
        var code = "+" +
                "{{ $User->country_code ?? 49 }}{{ $User->phone_number }}"; // Assigning value from model.
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


<script type="text/javascript">
    $('[name=dietary_type_of_diet]').tagify({
        duplicates: false
    });

    $('[name=dietary_favorite_food]').tagify({
        duplicates: false
    });

    $('[name=dietary_disliked_food]').tagify({
        duplicates: false
    });

    $(".js-select2").select2({
        closeOnSelect: false,
        placeholder: "Placeholder",
        allowHtml: true,
        allowClear: true,
            tags: true // создает новые опции на лету
        });

        // $('.icons_select2').select2({
        //     width: "100%",
        //     templateSelection: iformat,
        //     templateResult: iformat,
        //     allowHtml: true,
        //     placeholder: "Placeholder",
        //     dropdownParent: $('.select-icon'), //обавили класс
        //     allowClear: true,
        //     multiple: false
        // });
    </script>


    <script type="text/javascript">
        var chartTitle = "Body Weight Summary";
        var chart;
          renderChart({!! json_encode($userWeightGraph) !!}) 
        $(document).on('click', '.log_graph', function () {
           
            chartTitle = $(this).text();

            getGraphData($(this).attr('data-log-type'));
        });



        function getGraphData(logType) {

            if (logType.length) {

                $.ajax({
                    url: "{{ route('get.graph.data') }}",
                    type: "GET",
                    data: { log_type: logType, user_id:"{{@$User->id}}" },
                    success: function (response) {

                        if (response.status === 200 && !response.error) {

                            reRenderChart(response);

                        } else {

                            toastr.error('Something went wrong!');
                        }
                    },
                    error: function (err) {


                    }
                })
            }
        }

        function renderChart(data) {

            var date = [];
            var value = [];

            $.each(data, function (index, val) {

                date.push(val.date);
                value.push(val.value);
            });

            let options = {
                chart: {
                    type: 'area',
                    animations: {
                        speed: 1500,
                        easing: 'linear',
                        dynamicAnimation: {
                            enabled: true,
                            speed: 1000
                        }
                    }
                },
                series: [{
                    name: 'Body Weight ( Kg )',
                    data: value
                }],
                xaxis: {
                    type: 'category',
                    categories: date,
                    labels: {
                        show: true,
                    }
                },
                yaxis: [{
                    title: 'Test'
                }],
                stroke: {
                    curve: 'smooth',
                },
                title: {
                    text: chartTitle
                },
                colors: ['#379911']
            };

            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }

        function reRenderChart(response) {
            var date = [];
            var value = [];

            $.each(response.data, function (ind, val) {

                date.push(val.date);
                value.push(val.value);
            });

            chart.updateSeries([
            {
                name: chartTitle,
                data: value,
            },
            ], true);

            chart.updateOptions({
                xaxis: {
                    categories: date
                },
                title: {
                    text: chartTitle + 'Summary'
                },
            })
        }
    </script>


    <script type="text/javascript">
    $(document).ready(function(){
        $('#diet-type-select').on('change',function(){
         var currentObj = this;
         var dietPlanId = this.value; 
                // update table data 
         $.ajax({
             url:"{{route('filter.diet_plan')}}",
             method: 'post',
             data: {
               dietPlanId: dietPlanId,
               user_id:"{{@$User->id}}"
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               if(response.status) {
                  $('#diet-plan-list').DataTable().clear().destroy();
                  $('#diet_plan_list').html(response.html);
                    $('#diet-plan-list').DataTable({});
             }
         }
     });
     });
    });
</script>

    @stop
 