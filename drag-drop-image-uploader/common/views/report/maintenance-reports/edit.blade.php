@extends('adminlte::page')
@section('title', 'Super Admin | Edit Maintenance Report')
@section('content_header')
@section('content')

    <div class="rightside_content">
        <div class="container-fluid p-0">
            <div class="alert d-none" role="alert" id="flash-message">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card order_outer rounded_circle">
                        <div class="card-body rounded_circle table p-0 mb-0">
                            <div class="order_details">
                                <div class="card-main pt-3">
                                    <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                        <h3 class="mb-0">Maintenance Report</h3>
                                        <div class="search_wrap position-relative">
                                            <a class="btn btn-sm btn_clr btn-success"
                                                href="{{ url()->previous() }}">Back</a>
                                        </div>
                                    </div>
                                    <form name="maintenance_report" id="maintenance_report" method="POST"
                                        enctype="multipart/form-data"
                                        action="{{ route('report.maintenance.update_maintenance') }}">
                                        @csrf
                                        <input type="hidden" id="maintenance_id" name="maintenance_id"
                                            value="{{ $maintenance_data->id }}">
                                        <div class="card-body main_body form p-3 mb-4">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group my-0">
                                                        <label for="category">Date </label>
                                                        <input type="text" name="report_date" id="report_date"
                                                            class="form-control" autocomplete="off"
                                                            value="{{ date('d/m/Y', strtotime($maintenance_data->report_date)) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="fuel_flag" id="fuel_flag" value="0">
                                        <input type="hidden" name="repair_flag" id="repair_flag" value="0">
                                        <div class="card-body main_body form p-3">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="category">Category <span
                                                                class="text-danger">*</span></label>
                                                        <select name="category" class="category form-control"
                                                            id="category">
                                                            @foreach (@$categories as $cat)
                                                                <option value="{{ @$cat->id }}"
                                                                    @if (@$maintenance_data->category_id == @$cat->id) selected @endif>
                                                                    {{ @$cat->cat_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="sub_category">Sub Category <span
                                                                class="text-danger">*</span></label>
                                                        <select name="sub_category" class="sub_category form-control"
                                                            id="sub_category">
                                                            @foreach (@$maintenance_data->category->sub_categories as $sub_category)
                                                                <option value="{{ @$sub_category->id }}"
                                                                    @if (@$maintenance_data->sub_category->id == @$sub_category->id) selected @endif>
                                                                    {{ @$sub_category->sub_cat_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="doc_ref_no"> Voucher Number
                                                            <!-- Document Reference Number --><span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="doc_ref_no" id="doc_ref_no"
                                                            class="form-control" value="{{ $maintenance_data->doc_ref_no }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="doc_ref_no">Person Name / Company Name</label>
                                                        <input type="text" name="person_or_company_name"
                                                            id="person_or_company_name" class="form-control"
                                                            value="{{ $maintenance_data->person_or_company_name }}"
                                                            placeholder="Person Name / Company Name">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel_hide">
                                                    <div class="form-group mb-0">
                                                        <label for="voucher_number"> Invoice Number</label>
                                                        <input type="text" name="voucher_number" id="voucher_number"
                                                            class="form-control" placeholder="Invoice Number"
                                                            value="{{ $maintenance_data->voucher_number }}">
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel vehicle_repair">
                                                    <div class="form-group mb-0">
                                                        <label for="vehicle_number">Vehicle number <span
                                                                class="text-danger">*</span></label>

                                                        <select name="vehicle_number" id="vehicle_number"
                                                            class="form-control">
                                                            @foreach (@$branch_cars as $branch_car)
                                                                <option value="{{ @$branch_car['car']['id'] }}"
                                                                    @if (@$branch_car['car']['id'] == @$maintenance_data->car_id) selected @endif>
                                                                    {{ @$branch_car['car']['no_plate'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel vehicle_repair">
                                                    <div class="form-group mb-0">
                                                        <label for="driver_id">Driver <span
                                                                class="text-danger">*</span></label>
                                                        <select name="driver_id" id="driver_id" class="form-control">
                                                            @foreach (@$drivers as $driver)
                                                                <option value="{{ @$driver->driver['id'] }}"
                                                                    @if (@$maintenance_data->driver_id == @$driver->driver['id']) selected @endif>
                                                                    {{ @$driver->driver['drivers_name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                    <div class="form-group mb-0">
                                                        <label for="driven_km">Driven (KM) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="driven_km" id="driven_km"
                                                            class="form-control"
                                                            value="{{ $maintenance_data->driven_km }}"
                                                            placeholder="Driven (KM)">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="amount">Amount <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="amount" class="amount form-control"
                                                            placeholder="Amount" id="amount" maxlength="100"
                                                            aria-invalid="false"
                                                            value="{{ number_format($maintenance_data->amount, 3, '.', '') }}">
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel_hide">
                                                    <div class="form-group mb-0">
                                                        <label for="remarks">Remarks</label>
                                                        <input type="text" class="form-control" id="remarks"
                                                            name="remarks" placeholder="Remarks"
                                                            value="{{ $maintenance_data->remarks }}">
                                                    </div>
                                                </div> --}}

                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="description">Description </label>
                                                        <input type="text" name="description" id="description"
                                                            class="form-control" placeholder="Description"
                                                            value="{{ $maintenance_data->description }}" />
                                                    </div>
                                                </div>


                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                    <div class="form-group my-0">
                                                        <label>Document</label>
                                                        <div id="dropzoneDragArea"
                                                            class="dz-default dz-message dropzoneDragArea mb-0">
                                                            <span class="customsvg">Upload Document</span>
                                                        </div>
                                                        <div class="dropzone-previews"></div>
                                                        <small class="image_notice"
                                                            style="color:#FF0A00;font-size:12px;"></small>
                                                    </div>
                                                </div>


                                                {{-- signature --}}
                                                @if (@$maintenance_data['receiver_signature'] == null || @$maintenance_data['receiver_signature'] == '')
                                                @else
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>Receiver's Signature</label>
                                                            <div class="wrapper_section">
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
                                                            <div class="wrapper_section">
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
                                                            <div class="wrapper_section">
                                                                <img src="{{ @$maintenance_data['approved_by'] }}"
                                                                    class="signature_image" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- signature --}}

                                                {{--
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group my-0">
                                                        <label>Document</label>
                                                        <div id="dropzoneDragArea"
                                                            class="dz-default dz-message dropzoneDragArea mb-0">
                                                            <span class="customsvg">Upload Document</span>
                                                        </div>
                                                        <div class="dropzone-previews"></div>
                                                        <small class="image_notice"
                                                            style="color:#FF0A00;font-size:12px;"></small>
                                                    </div>
                                                </div>  --}}


                                                <div class="card-footer submit_btn" style="margin:0 auto;border:none">
                                                    <button
                                                        class="button btn_bg_color common_btn text-white">Update</button>
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
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" type="text/css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .mySlides {
            display: none;
        }

        .dropzoneDragArea {
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
            border-radius: 6px;
            padding: 60px;
            text-align: center;
            margin-bottom: 10px;
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



        .btn-danger:hover {
            color: #fff;
            background-color: #F43127;
            border-color: #F43127;
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

        .dz-size {
            display: none;
        }

        .dz-filename {
            display: none;
        }

        .dz-preview.dz-image-preview a.dz-remove {
            color: #f43127 !important;
            font-weight: 600 !important;
        }

        .dz-preview.dz-image-preview a.dz-remove:hover {
            text-decoration: underline !important;
            color: #f43127 !important;
        }
    </style>

    <style>
        .dropzone .dz-message {
            text-align: center;
            margin: 0;
        }

        .tab_wrapper ul li.nav-item {
            width: calc(14.28571428571429% - 5px);
        }

        .tab_wrapper ul.nav.nav-pills {
            width: 100%;
        }

        .dropzoneDragArea {
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
            border-radius: 6px;
            padding: 60px;
            text-align: center;
            cursor: pointer;
        }

        .dropzone .dz-preview {
            position: relative;
            display: inline-block;
            vertical-align: top;
            margin: 20px 20px 0 0px;
            min-height: 100px;
        }

        .dropzone .dz-preview .dz-remove {
            color: #f43127;
            font-weight: 600;
        }

        div#managers_chosen {
            padding: 16px 22px !important;
            font-size: 14px !important;
            border-radius: 14px !important;
            border: 1px solid #cccccc;
            height: 120px;
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
    </style>

    {{-- signature --}}
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
        .wrapper_section {
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
    {{-- Select2 Style --}}
    <style>
        #select2-driver_id-container {
            padding: 0px 6px;
            margin-top: 10px;
            font-size: 14px;
            font-weight: 400;
            color: #000000 !important;
        }
    </style>
    {{-- --------------- --}}
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- signature --}}

    <script>
        // -- Select2 Option -- //

        $(document).ready(function() {
            $('#driver_id').select2();
        });

        // ----------------- //
    </script>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script type="text/javascript">
        if ("{{ @$maintenance_data['receiver_signature'] }}" == null ||
            "{{ @$maintenance_data['receiver_signature'] }}" == "") {
            var canvas = document.getElementById('signature-pad');
        }
        if ("{{ @$maintenance_data['verified_by'] }}" == null || "{{ @$maintenance_data['verified_by'] }}" == "") {
            var canvas_2 = document.getElementById('signature-pad_2');
        }
        if ("{{ @$maintenance_data['approved_by'] }}" == null || "{{ @$maintenance_data['approved_by'] }}" == "") {
            var canvas_3 = document.getElementById('signature-pad_3');
        }

        function resizeCanvas() {
            var ratio = Math.max(window.devicePixelRatio || 1, 1);

            if ("{{ @$maintenance_data['receiver_signature'] }}" == null ||
                "{{ @$maintenance_data['receiver_signature'] }}" == "") {
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            }

            if ("{{ @$maintenance_data['verified_by'] }}" == null || "{{ @$maintenance_data['verified_by'] }}" ==
                "") {
                canvas_2.width = canvas_2.offsetWidth * ratio;
                canvas_2.height = canvas_2.offsetHeight * ratio;
                canvas_2.getContext("2d").scale(ratio, ratio);
            }

            if ("{{ @$maintenance_data['approved_by'] }}" == null || "{{ @$maintenance_data['approved_by'] }}" ==
                "") {
                canvas_3.width = canvas_3.offsetWidth * ratio;
                canvas_3.height = canvas_3.offsetHeight * ratio;
                canvas_3.getContext("2d").scale(ratio, ratio);
            }
        }

        // window.onresize = resizeCanvas;
        resizeCanvas();

        if ("{{ @$maintenance_data['receiver_signature'] }}" == null ||
            "{{ @$maintenance_data['receiver_signature'] }}" == "") {
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
            });
        }

        if ("{{ @$maintenance_data['verified_by'] }}" == null || "{{ @$maintenance_data['verified_by'] }}" == "") {
            var signaturePad_2 = new SignaturePad(canvas_2, {
                backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
            });
        }

        if ("{{ @$maintenance_data['approved_by'] }}" == null || "{{ @$maintenance_data['approved_by'] }}" == "") {
            var signaturePad_3 = new SignaturePad(canvas_3, {
                backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
            });
        }

        if ("{{ @$maintenance_data['receiver_signature'] }}" == null ||
            "{{ @$maintenance_data['receiver_signature'] }}" == "") {
            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });
        }

        if ("{{ @$maintenance_data['verified_by'] }}" == null || "{{ @$maintenance_data['verified_by'] }}" == "") {
            document.getElementById('clear_2').addEventListener('click', function() {
                signaturePad_2.clear();
            });
        }

        if ("{{ @$maintenance_data['approved_by'] }}" == null || "{{ @$maintenance_data['approved_by'] }}" == "") {
            document.getElementById('clear_3').addEventListener('click', function() {
                signaturePad_3.clear();
            });
        }

        if ("{{ @$maintenance_data['receiver_signature'] }}" == null ||
            "{{ @$maintenance_data['receiver_signature'] }}" == "") {
            document.getElementById('undo').addEventListener('click', function() {
                var data = signaturePad.toData();
                if (data) {
                    data.pop(); // remove the last dot or line
                    signaturePad.fromData(data);
                }
            });
        }

        if ("{{ @$maintenance_data['verified_by'] }}" == null || "{{ @$maintenance_data['verified_by'] }}" == "") {
            document.getElementById('undo_2').addEventListener('click', function() {
                var data = signaturePad_2.toData();
                if (data) {
                    data.pop(); // remove the last dot or line
                    signaturePad_2.fromData(data);
                }
            });
        }

        if ("{{ @$maintenance_data['approved_by'] }}" == null || "{{ @$maintenance_data['approved_by'] }}" == "") {
            document.getElementById('undo_3').addEventListener('click', function() {
                var data = signaturePad_3.toData();
                if (data) {
                    data.pop(); // remove the last dot or line
                    signaturePad_3.fromData(data);
                }
            });
        }

        $(document).on('click', '.submit_btn', function() {
            if ("{{ @$maintenance_data['receiver_signature'] }}" == null ||
                "{{ @$maintenance_data['receiver_signature'] }}" == "") {
                $('#signature_1').val(signaturePad.toData().length != 0 ? signaturePad.toDataURL('image/png') :
                    null);
            }
            if ("{{ @$maintenance_data['verified_by'] }}" == null ||
                "{{ @$maintenance_data['verified_by'] }}" == "") {
                $('#signature_2').val(signaturePad_2.toData().length != 0 ? signaturePad_2.toDataURL('image/png') :
                    null);
            }
            if ("{{ @$maintenance_data['approved_by'] }}" == null ||
                "{{ @$maintenance_data['approved_by'] }}" == "") {
                $('#signature_3').val(signaturePad_3.toData().length != 0 ? signaturePad_3.toDataURL('image/png') :
                    null);
            }
        })
    </script>

    <script>
        var fuel = false;
        var repair = false;
        var cat_name = $.trim($('#category').find('option:selected').text().toLowerCase());
        var sub_cat_name = $.trim($('#sub_category').find('option:selected').text().toLowerCase());
        var sub_str_1 = 'vehicle';

        if (cat_name.indexOf(sub_str_1) != -1) {
            fuel = true;
            repair = true;
            $('#fuel_flag').val(1);
            $('#repair_flag').val(1);
            $('.vehicle_fuel').css('display', 'block');
        } else {
            fuel = false;
            repair = false;
            $('#fuel_flag').val(0);
            $('#repair_flag').val(0);
            $('.vehicle_fuel').css('display', 'none');
            $('.vehicle_repair').css('display', 'none');
        }

        $(document).on('change', '#category', function() {

            var str1 = $(this).find('option:selected').text().toLowerCase();
            var str2 = 'vehicle';

            check_vehicle = '';

            if (str1.indexOf(str2) != -1) {
                check_vehicle = 'true';
                fuel = true;
                repair = true;
                $('#fuel_flag').val(1);
                $('#repair_flag').val(1);
                $('.vehicle_fuel').css('display', 'block');
            } else {
                check_vehicle = 'false';
                fuel = false;
                repair = false;
                $('#fuel_flag').val(0);
                $('#repair_flag').val(0);
                $('.vehicle_fuel').css('display', 'none');

            }

            $.ajax({
                type: "POST",
                url: "{{ route('report.maintenance_sub_category') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    cat_id: $(this).val()
                },
                success: function(response) {

                    var html = '';
                    if (response.sub_categories) {

                        $.each(response.sub_categories, function(ind, val) {
                            html = html + '<option value="' + val.id + '">' + val.sub_cat_name +
                                '</option>';
                        });

                        // html += '<option value="0" disabled>Sub Category</option>';
                        $('#sub_category').html(html);

                    } else {

                    }
                }
            });
        });

        // check if sub category is vehicle fule/maintenance
        $(document).on('click', '#sub_category', function() {
            var str1 = $(this).find('option:selected').text().toLowerCase();

            if (check_vehicle == 'true') {
                fuel = true;
                repair = true;
                $('#fuel_flag').val(1);
                $('#repair_flag').val(1);
                $('.vehicle_fuel').css('display', 'block');
            } else {
                fuel = false;
                repair = false;
                $('#fuel_flag').val(0);
                $('#repair_flag').val(0);
                $('.vehicle_fuel').css('display', 'none');
                $('.vehicle_repair').css('display', 'none');
            }
        })

        $('#maintenance_report').validate({
            rules: {
                category: {
                    required: true,
                },
                sub_category: {
                    required: true
                },
                amount: {
                    required: true
                },
                vehicle_number: {
                    required: function() {
                        return repair;
                    }
                },
                driver_id: {
                    required: function() {
                        return repair;
                    }
                },
                driven_km: {
                    required: function() {
                        return fuel;
                    }
                },
            },
            messages: {
                category: {
                    required: 'Please Select Category'
                },
                sub_category: {
                    required: 'Please Select Sub Category'
                },
                // voucher_number: {
                //     required: 'Voucher Invoice Number is required',
                //     remote: 'Voucher Invoice Number already exists'
                // },
                amount: {
                    required: 'Amount is required'
                },
                vehicle_number: {
                    required: 'Vehicle Number is required'
                },
                driver_id: {
                    required: "Driver is required"
                },
                driven_km: {
                    required: "Driven KM is required"
                },
            }
        });
    </script>

    <script>
        $(document).on('focusout', '#amount', function() {
            var val = $(this).val();
            $(this).val(parseFloat(val).toFixed(3));
        })

        $(document).on('keyup', '#amount', function() {
            var val = $(this).val();
            if (val.split('.').length > 1) {
                if (val.split('.')[1].length > 3) {
                    var new_val = parseFloat(val).toFixed(3);
                    $(this).val(new_val);
                }
            }
        })
    </script>

    <script>
        function elementr(id) {
            var document_image_id = $('.removei' + id).data('deltype');
            var maintenance_id = '{{ $maintenance_data->id }}';
            var maxFile = 20;

            // if ($('.dz-complete').length == 1) {
            //     swal({
            //         title: "Doc Image",
            //         text: "One Doc Image is required",
            //         type: "info",
            //     });
            //     return false;
            // } else {

            swal({
                    title: "Are you sure?",
                    text: "This Document Will be Permanently Deleted!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm) {

                    if (isConfirm) {

                        $.ajax({
                            url: "{{ route('management_document_image.delete') }}",
                            method: "POST",
                            data: {
                                document_image_id: document_image_id,
                                maintenance_id: maintenance_id
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "JSON",

                            success: function(response) {

                                if (response.status == 'success') {

                                    previewImageDisplay(response.data, maxFile);
                                    imageslide(response.data);

                                }
                            }

                        });

                    } else {
                        swal("Cancelled", "Your Document is safe :)", "error");
                        e.preventDefault();
                    }
                });

            // }

        }


        // Dropzone has been added as a global variable.
        Dropzone.autoDiscover = false;
        let token = $('meta[name="csrf-token"]').attr('content');

        function previewImageDisplay(asllimage, maxFile) {
            $('.dropzone-previews').empty();

            if (Dropzone.instances.length > 0)
                Dropzone.instances.forEach(dz => dz.destroy())


            var dropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('maintenance_document.doc_image_save') }}",
                previewsContainer: 'div.dropzone-previews',
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 20,
                maxFilesize: 20,
                maxFiles: maxFile,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },

                // addRemoveLinks: true,
                acceptedFiles: ".jpeg,.jpg,.png",
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;
                    //form submission code goes here
                    this.on("uploadprogress", function(file, progress) {
                        console.log("File progress", progress);
                    });

                    var id = '';
                    var maintenance_id = '';
                    var js_lang = asllimage;

                    js_lang.forEach(obj => {

                        Object.entries(obj).forEach(([key, value]) => {

                            if (`${key}` === `doc`) {
                                let key = {
                                    name: `${value}`,
                                    size: 12345
                                };
                                myDropzone.displayExistingFile(key,
                                    "{{ env('BRANCH_MAINTENANCE_DOC_PATH') }}" + `${value}`
                                );


                                var del = "<button type='button' data-delid='" + id +
                                    "' onclick='elementr(" + id +
                                    ")' class='btn btn-danger removei" + id +
                                    "' data-deltype='" + id + "' >Delete</button>"
                                $('.dz-remove').last().attr('remove-id', id);

                                $('.dz-remove').last().addClass('remove-image');
                                $('.dz-remove').empty();
                                $('.dz-details').last().append(del);
                            }

                            if (`${key}` === `id`) {
                                id = value;
                            }

                            if (`${key}` === `maintenance_id`) {
                                maintenance_id = value;

                            }


                            $('.dz-remove').last().attr('remove-id', id);

                            $('.dz-remove').last().addClass('remove-image');


                        });

                        $(".dz-preview").last().slideToggle().slideToggle(); //fadeIn("slow");
                    });


                    $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();


                    $("form[name='maintenance_report']").submit(function(event) {
                        //Make sure that the form isn't actully being sent.
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });


                        //Checking image upload or not

                        if ($(this).valid()) {

                            // if ($('.dropzone-previews').html() != "") {

                            // } else {
                            //     $('.image_notice').html('Please Upload at least one image');
                            //     setTimeout(function() {
                            //         $('.image_notice').html('');
                            //     }, 1500);
                            //     return false;
                            // }
                        } else {
                            return false;
                        }


                        event.preventDefault();

                        var formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('report.maintenance.update_maintenance') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                if (data.status == "success") {


                                    $('.common_btn').addClass('disabled_button');

                                    $('.common_btn').prop("disabled", true);

                                    if (myDropzone.files.length == 0) {
                                        swal({
                                                title: "Maintenance Expense",
                                                text: "Maintenance Updated Successfully",
                                                type: "success",
                                            },
                                            function() {
                                                window.location.href =
                                                    "{{ route('maintenance.report.list') }}"
                                            });
                                    }

                                    myDropzone.processQueue();
                                    $('.image_notice').html('');

                                    // window.location.href =
                                    //     "{{ route('maintenance.report.list') }}";

                                }
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });

                    });

                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData) {
                        //fetch the user id from hidden input field and send that userid with our image
                        let maintenance_id = document.getElementById('maintenance_id')
                            .value;
                        formData.append('maintenance_id', maintenance_id);
                    });

                    this.on("success", function(file, response) {

                        swal({
                                title: "Maintenance Expense",
                                text: "Maintenance Updated Successfully",
                                type: "success",
                            },
                            function() {
                                window.location.href = "{{ route('maintenance.report.list') }}"
                            }
                        )

                        $('#maintenance_report')[0].reset();

                        $('.dropzone-previews').empty();
                        localStorage.setItem('success_data', 'Document has been added successfully!');

                    });


                    this.on("error", function(file, message) {
                        //alert(message);
                        console.log(file);

                        var messages = myDropzone.removeFile(file);

                        if (message != "Upload canceled.")
                            swal({
                                title: "Error",
                                text: message,
                                type: "warning",
                                showCancelButton: true,
                            });

                    });
                }
            });
        }

        $(function() {
            $('.dropzone-previews').empty();

            var dropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('maintenance_document.doc_image_save') }}",
                previewsContainer: 'div.dropzone-previews',
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 20,
                maxFilesize: 20,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },

                // addRemoveLinks: true,
                acceptedFiles: ".jpeg,.jpg,.png",
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;
                    //form submission code goes here
                    this.on("uploadprogress", function(file, progress) {
                        console.log("File progress", progress);
                    });

                    var id = '';
                    var maintenance_id = '';
                    var js_lang = {!! json_encode($maintenance_images) !!};

                    js_lang.forEach(obj => {

                        Object.entries(obj).forEach(([key, value]) => {

                            if (`${key}` === `doc`) {
                                let key = {
                                    name: `${value}`,
                                    size: 12345
                                };
                                myDropzone.displayExistingFile(key,
                                    "{{ env('BRANCH_MAINTENANCE_DOC_PATH') }}" +
                                    `${value}`);

                                var del = "<button type='button' data-delid='" + id +
                                    "' onclick='elementr(" + id +
                                    ")' class='btn btn-danger removei" + id +
                                    "' data-deltype='" + id + "' >Delete</button>"
                                $('.dz-remove').last().attr('remove-id', id);

                                $('.dz-remove').last().addClass('remove-image');
                                $('.dz-remove').empty();
                                $('.dz-details').last().append(del);
                            }

                            if (`${key}` === `id`) {
                                id = value;
                            }

                            if (`${key}` === `maintenance_id`) {
                                maintenance_id = value;

                            }


                            $('.dz-remove').last().attr('remove-id', id);

                            $('.dz-remove').last().addClass('remove-image');


                        });

                        $(".dz-preview").last().slideToggle().slideToggle(); //fadeIn("slow");
                    });


                    $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();


                    $("form[name='maintenance_report']").submit(function(event) {
                        //Make sure that the form isn't actully being sent.
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            }
                        });


                        //Checking image upload or not

                        if ($(this).valid()) {

                            // if ($('.dropzone-previews').html() != "") {

                            // } else {
                            //     $('.image_notice').html('Please Upload at least one image');
                            //     setTimeout(function() {
                            //         $('.image_notice').html('');
                            //     }, 1500);
                            //     return false;
                            // }
                        } else {
                            return false;
                        }


                        event.preventDefault();

                        var formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('report.maintenance.update_maintenance') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                if (data.status == "success") {

                                    $('.common_btn').addClass('disabled_button');

                                    $('.common_btn').prop("disabled", true);

                                    if (myDropzone.files.length == 0) {
                                        swal({
                                                title: "Maintenance Expense",
                                                text: "Maintenance Updated Successfully",
                                                type: "success",
                                            },
                                            function() {
                                                window.location.href =
                                                    "{{ route('maintenance.report.list') }}"
                                            });
                                    }

                                    myDropzone.processQueue();
                                    $('.image_notice').html('');

                                    // window.location.href = "{{ route('maintenance.report.list') }}";

                                }
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });

                    });

                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData) {
                        //fetch the user id from hidden input field and send that userid with our image
                        let maintenance_id = document.getElementById(
                            'maintenance_id').value;
                        formData.append('maintenance_id', maintenance_id);
                    });

                    this.on("success", function(file, response) {

                        swal({
                                title: "Maintenance Expense",
                                text: "Maintenance Updated Successfully",
                                type: "success",
                            },
                            function() {
                                window.location.href =
                                    "{{ route('maintenance.report.list') }}"
                            }
                        )

                        $('#maintenance_report')[0].reset();

                        $('.dropzone-previews').empty();
                        localStorage.setItem('success_data',
                            'Document has been added successfully!');

                    });


                    this.on("error", function(file, message) {
                        //alert(message);
                        console.log(file);

                        var messages = myDropzone.removeFile(file);

                        if (message != "Upload canceled.")
                            swal({
                                title: "Error",
                                text: message,
                                type: "warning",
                                showCancelButton: true,
                            });

                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var all_images_url = [];
            var js_lang = {!! json_encode($maintenance_images) !!};
            //  console.log(js_lang);
            $(js_lang).each(function(data, value) {
                all_images_url.push("{{ env('BRANCH_MAINTENANCE_DOC_PATH') }}" + value.doc);
                // getBase64FromUrl("{{ env('PETTY_DOCS_PATH') }}"+value.doc).then(console.log)
            });


            var img_tag = [];
            $('.dz-complete').each(function(index) {
                var c_one = this.children[0];
                var img = c_one.getElementsByTagName('IMG')[0];
                console.log($(img).remove());
                $(c_one).append( < img alt = ""
                    src = "+all_images_url[index]+"
                    width = "100"
                    height = "100" > );
                //  console.log(img.getAttributeNames());

            });



            // console.log(all_images_url);


        });
    </script>
@stop
