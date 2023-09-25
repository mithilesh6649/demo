@extends('adminlte::page')
@section('title', 'Super Admin | View Maintenance Report')
@section('content_header')
@section('content')

    <div class="rightside_content">
        <div class="container-fluid p-0">
            <div class="alert d-none" role="alert" id="flash-message"></div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card order_outer rounded_circle">
                        <div class="card-body rounded_circle table p-0 mb-0">
                            <div class="order_details">
                                <div class="card-main pt-3">
                                    <div
                                        class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                                        <h3 class="mb-0">Maintenance Report</h3>
                                        <div class="search_wrap position-relative">
                                            <a class="btn btn-sm btn_clr btn-success"
                                                href="{{ url()->previous() }}">Back</a>
                                        </div>
                                    </div>
                                    <input type="hidden" id="userid" name="userid">
                                    <div class="card-body main_body form p-3 mb-4">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                <div class="form-group mb-0">
                                                    <label for="category">Date </label>
                                                    <input type="text" name="report_date" id="report_date"
                                                        class="form-control" autocomplete="off"
                                                        value="{{ date('d/m/Y', strtotime($maintenance_data->report_date)) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body main_body form p-3">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                <div class="form-group mb-0">
                                                    <label for="category">Category
                                                    </label>
                                                    <input type="text" class="category form-control" name="category"
                                                        id="category" value="{{ $maintenance_data->category->cat_name }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                <div class="form-group mb-0">
                                                    <label for="sub_category">Sub Category
                                                    </label>
                                                    <input type="text" class="sub_category form-control"
                                                        name="sub_category" id="sub_category"
                                                        value="{{ $maintenance_data->sub_category->sub_cat_name }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                <div class="form-group mb-0">
                                                    <label for="doc_ref_no"> Voucher Number<!-- Document Reference Number  -->
                                                    </label>
                                                    <input type="text" name="doc_ref_no" id="doc_ref_no"
                                                        class="form-control" value="{{ $maintenance_data->doc_ref_no }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                <div class="form-group mb-0">
                                                    <label for="doc_ref_no">Person Name / Company name </label>
                                                    <input type="text" name="person_or_company_name"
                                                        id="person_or_company_name" class="form-control"
                                                        value="{{ $maintenance_data->person_or_company_name }}" readonly>
                                                </div>
                                            </div>

                                            @if ($maintenance_data->voucher_number)
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel_hide">
                                                    <div class="form-group mb-0">
                                                        <label>Invoice Number
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $maintenance_data->voucher_number }}" readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($maintenance_data->car_id)
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label>Vehicle Number
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $maintenance_data->car->no_plate }}" readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($maintenance_data->driver_id)
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label>Driver
                                                        <input type="text" class="form-control"
                                                            value="{{ $maintenance_data->driver->drivers_name }}" readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($maintenance_data->driven_km)
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label>Driven (KM)
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $maintenance_data->driven_km }}" readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                <div class="form-group mb-0">
                                                    <label for="amount">Amount
                                                    </label>
                                                    <input type="number" name="amount" class="amount form-control"
                                                        placeholder="Amount" id="amount" maxlength="100"
                                                        value="{{ number_format($maintenance_data->amount, 3, '.', '') }}"
                                                        aria-invalid="false" readonly>
                                                </div>
                                            </div>
                                            {{-- <input type="file" id="doc_upload" name="doc_upload"> --}}
                                            @if ($maintenance_data->remarks != null)
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="remarks">Remarks</label>
                                                        <input type="text" class="form-control" id="remarks"
                                                            name="remarks" value="{{ $maintenance_data->remarks }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($maintenance_data->description != null)
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="remarks">Description</label>
                                                        <input type="text" class="form-control" id="description"
                                                            name="description"
                                                            value="{{ $maintenance_data->description }}" readonly>
                                                    </div>
                                                </div>
                                            @endif


                                            @if (@$maintenance_data['receiver_signature'] == null || @$maintenance_data['receiver_signature'] == '')
                                            @else
                                                <div class="col-md-12">
                                                    <div class="form-group mb-0">
                                                        <label>Receiver's Signature</label>
                                                        <div class="wrapper-content">
                                                            <img src="{{ @$maintenance_data['receiver_signature'] }}"
                                                                class="signature_image" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (@$maintenance_data['verified_by'] == null || @$maintenance_data['verified_by'] == '')
                                            @else
                                                <div class="col-md-12">
                                                    <div class="form-group mb-0">
                                                        <label>Verified by</label>
                                                        <div class="wrapper-content">
                                                            <img src="{{ @$maintenance_data['verified_by'] }}"
                                                                class="signature_image" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (@$maintenance_data['approved_by'] == null || @$maintenance_data['approved_by'] == '')
                                            @else
                                                <div class="col-md-12">
                                                    <div class="form-group mb-0">
                                                        <label>Approved by</label>
                                                        <div class="wrapper-content">
                                                            <img src="{{ @$maintenance_data['approved_by'] }}"
                                                                class="signature_image" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- signature --}}

                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                            <div class="form-group mt-3">
                                                <label for="address">Doc Image</label>
                                                <div class="row">
                                                    @forelse($maintenance_doc as $key=>$images)
                                                        <div class="col-md-4 col-lg-64 col-xl-4 col-12 branch_image_box mb-3"
                                                            image_id='{{ $key }}'>
                                                            <div class="border">
                                                                <img src="{{ env('BRANCH_MAINTENANCE_DOC_PATH') . $images['doc'] }}"
                                                                    alt="{{ $images['doc'] }}">
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-md-4 border text-center font-weight-bold">
                                                            <p class='p-2'> Document Not Available</p>
                                                        </div>
                                                    @endforelse
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
        </div>
    </div>


    <!-- /.card-body -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Doc Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body" class="image_preview">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" style=" width:auto; height:400px !important; margin:0px auto;">

                            @foreach ($maintenance_doc as $key => $images)
                                <div class="carousel-item show_image_id" show_image_id='{{ $key }}'>
                                    <a href='{{ env('BRANCH_MAINTENANCE_DOC_PATH') . $images['doc'] }}' target='_blank'>
                                        <img class="d-block "
                                            style="width: auto; height: 400px; margin:0px auto; min-width: auto;"
                                            src="{{ env('BRANCH_MAINTENANCE_DOC_PATH') . $images['doc'] }}"
                                            alt="{{ $images['doc'] }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---fsdfdsfd---->

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" type="text/css" />

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    {{-- signature --}}
    <style>
        .mySlides {
            display: none;
        }

        .carousel-inner {
            cursor: pointer;
        }

        .dropzone {
            box-shadow: 0px 2px 20px 0px #f2f2f2;
            border-radius: 10px;
        }

        .dz-image img {
            width: 85%;
            border-radius: 14px;
            margin-bottom: 5px;
            margin-top: 15px;
        }

        body .dz-preview {
            text-align: left !important;
        }

        /*my code*/
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #1f5c7a;
        }

        /*my code*/

        #profileImage {
            height: 150px;
            width: 200px;
            border-radius: 10px;
            object-fit: contain;
            background-color: #fbfbfb;
            border: 1px solid #343d49;
            padding: 10px;
        }

        .messageArea {
            margin-left: 0;
            padding-left: 0;
        }

        .my-message {
            margin-right: 10px;
            background: #ebebeb;
            color: #333333;
            border-radius: 10px;
            padding: 10px;
            max-width: 50vw;
            display: inline-block;
            position: relative;
            margin-bottom: 22px;
        }

        .my-name {
            font-weight: bolder;
            margin-right: 0px;
        }

        .my-content {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .my-message:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-top: 15px solid #ebebeb;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            top: 0;
            right: -15px;
        }

        .my-message:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-top: 17px solid #ebebeb;
            border-left: 16px solid transparent;
            border-right: 16px solid transparent;
            top: 0px;
            right: -16px;
        }

        .butDel {
            width: 10px;
            height: 25px;
        }

        .butDelText {
            position: relative;
            right: 3.5px;
            top: -1px;
        }

        .another-message {
            margin-left: 10px;
            background: #263238;
            color: #ffffff;
            border-radius: 10px;
            padding: 10px;
            max-width: 50vw;
            display: inline-block;
            position: relative;
            margin-bottom: 22px;
        }

        .another-message:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-top: 15px solid #263238;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            top: 0;
            left: -15px;
        }

        .another-message:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-top: 17px solid #263238;
            border-left: 16px solid transparent;
            border-right: 16px solid transparent;
            top: 0px;
            left: -16px;
        }

        .another-name {
            font-weight: bolder;
            margin-right: 0px;
        }

        .another-content {
            margin-top: 0px;
            margin-bottom: 0px;
            line-height: 22px;
        }

        .iti {
            position: relative;
            display: inline-block;
            min-width: 100%;
        }

        .chosen-container .chosen-choices {
            width: 100% !important;
            height: 50px !important;
            border-radius: 4px;
        }

        .dz-image-preview {
            width: 15% !important;
            float: left;
            text-align: center !important;
            text-transform: capitalize;
        }

        .select-status {
            height: 30px !important;
            width: 120px !important;
            border-radius: 0px !important;
            position: relative;
            bottom: 3px;
        }

        .btn-danger {
            height: 26px;
            width: 85%;
            margin: 0px auto;
            line-height: 15px;
            position: relative;
            top: 3px;
            background-color: #f43127;
            border-color: #f43127;
        }

        .dz-success-mark,
        .dz-error-mark {
            display: none;
        }

        .dz-preview {
            margin-top: 20px;
        }

        .vehicle_fuel,
        .cylinder {
            display: none;
        }

        .vehicle_fuel_hide {
            display: block;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #F43127;
            border-color: #F43127;
        }

        .vehicle_repair {
            display: none;
        }

        .error_message_slip {
            font-size: 12px !important;
            font-weight: 400 !important;
            color: red !important;

        }

        .disabled_button {
            opacity: .6;
        }

        input[type='time']::-webkit-calendar-picker-indicator {
            opacity: 0;
            position: absolute;
            width: 10%;
            left: 35%;
        }
    </style>
    <style>
        .signature_image {
            /*border: 1px solid silver; */
            */
            /* margin: 10px auto; */
            border-radius: 5px;
            min-width: 100%;
            max-height: 100px;
            margin: 0 auto;
        }
    </style>

    <style type="text/css">
        .wrapper-content {
            position: relative;
            width: 100%;
            /* height: 200px; */
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin-bottom: 20px;
        }

        .signature-pad {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 200px;
            background-color: white;
        }
    </style>
    {{-- signature --}}
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.branch_image_box').each(function() {
                $(this).click(function() {

                    $('.show_image_id').each(function() {
                        $(this).removeClass('active');
                    });

                    var image_id = $(this).attr('image_id');
                    $('#exampleModal').modal('show');

                    $('.show_image_id').each(function() {

                        if ($(this).attr('show_image_id') == image_id) {
                            $(this).addClass('active');
                        }

                    });


                });
            });
        });



        $(document).ready(function() {

            $('.carousel').carousel({
                interval: false,
            });

        });
    </script>
@stop
