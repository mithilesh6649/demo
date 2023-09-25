@extends('adminlte::page')
@section('title', 'Super Admin | Sales & Petty Reporting')
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
                              <!--       <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                        <h3 class="mb-0">Edit Petty Cash Report</h3>
                                        <div class="search_wrap position-relative">
                                            <a class="btn btn-sm btn_clr btn-success"
                                                href="{{ url()->previous() }}">Back</a>
                                        </div>
                                    </div> -->

                                          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Edit Petty Cash Report</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>  

                                    <form name="daily_petty_expense" id="daily_petty_expense" method="POST"
                                        enctype="multipart/form-data" class="dropzone p-0" style="border:none !important;">
                                        @csrf
                                        <input type="hidden" id="id" name="id"
                                            value="{{ $petty_expense->id }}">
                                        <input type="hidden" id="old_images_name" name="old_images_name">

                                        <div class="card-body main_body form p-3 mb-4">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group my-0">
                                                        <label for="category">Date </label>
                                                        <input type="text" name="report_date" id="report_date"
                                                            class="form-control" autocomplete="off"
                                                            value="{{ date('d/m/Y', strtotime($petty_expense->report_date)) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body main_body form p-3">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="category">Category <span
                                                                class="text-danger">*</span></label>
                                                        <select name="category" class="category form-control"
                                                            id="category">

                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    @if ($petty_expense->category_id == $cat->id) selected @endif>
                                                                    {{ $cat->cat_name }}</option>
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
                                                            @foreach ($petty_expense['category']['subcategories'] as $sub_category)
                                                                <option value="{{ $sub_category->id }}"
                                                                    @if ($sub_category->id == $petty_expense->sub_category_id) selected @endif>
                                                                    {{ $sub_category->sub_cat_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="doc_ref_no">Document Reference Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="doc_ref_no" id="doc_ref_no"
                                                            class="form-control" value="{{ $petty_expense->doc_ref_no }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel_hide">
                                                    <div class="form-group mb-0">
                                                        <label for="voucher_number">Invoice Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="voucher_number" id="voucher_number"
                                                            class="form-control"
                                                            value="{{ $petty_expense->voucher_number }}" >
                                                             <input type="hidden"  id="voucher_error_r">
                                                    </div>
                                                </div>

                                                {{-- optional fields --}}
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                    <div class="form-group mb-0">
                                                        <label for="vehicle_fuel_time">Time <span
                                                                class="text-danger">*</span></label>
                                                        <input type="time" type="time" name="vehicle_fuel_time"
                                                            step="5" id="vehicle_fuel_time" class="form-control"
                                                            value="{{ $petty_expense->fuel_time }}">
                                                              <input type="hidden"  id="time_r">
                                                    </div>
                                                </div>


                                                <div
                                                    class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel vehicle_repair">
                                                    <div class="form-group mb-0">
                                                        <label for="vehicle_number">Vehicle number <span
                                                                class="text-danger">*</span></label>

                                                        <select name="vehicle_number" id="vehicle_number"
                                                            class="form-control">
                                                            @foreach ($branch_cars as $branch_car)
                                                                <option value="{{ $branch_car['car']['id'] }}"
                                                                @if ($branch_car['car']['id'] == $petty_expense->car_id) selected @endif>
                                                                    {{ $branch_car['car']['no_plate'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="fuel_flag" id="fuel_flag" value="0">
                                                <input type="hidden" name="repair_flag" id="repair_flag" value="0">
                                                <input type="hidden" name="cylinder_flag" id="cylinder_flag"
                                                    value="0">

                                                
                                                <div
                                                    class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel vehicle_repair">
                                                    <div class="form-group mb-0">
                                                        <label for="driver_id">Driver <span
                                                                class="text-danger">*</span></label>
                                                        <select name="driver_id" id="driver_id" class="form-control">
                                                            @foreach ($drivers as $driver)
                                                                <option value="{{ $driver->driver['id'] }}" @if ($driver->driver['id'] == $petty_expense->driver_id) selected @endif>
                                                                    {{ $driver->driver['drivers_name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                    <div class="form-group mb-0">
                                                        <label for="driven_km">Driven (KM) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="driven_km" id="driven_km"
                                                            class="form-control" value="{{ $petty_expense->driven_km }}">
                                                            <input type="hidden"  id="driven_error_r">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                    <div class="form-group mb-0">
                                                        <label for="fuel">Fuel (litre) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="fuel" id="fuel"
                                                            class="form-control" value="{{ $petty_expense->fuel }}">
                                                    </div>
                                                </div>
                                                {{-- optional fields --}}

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 main_amount">
                                                    <div class="form-group mb-0">
                                                        <label for="amount">Amount <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="amount" id="amount"
                                                            class="amount form-control"
                                                            value="{{ number_format($petty_expense->amount, 3, '.', '') }}"
                                                            id="amount" maxlength="100" aria-invalid="false">
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="remarks">Remarks</label>
                                                        <input type="text" class="form-control" id="remarks"
                                                            name="remarks" value="{{ $petty_expense->remarks }}">
                                                    </div>
                                                </div> -->

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="description">Description</label>
                                                        <input type="text" class="form-control" id="description"
                                                            name="description"
                                                            value="{{ $petty_expense->description ?? 'N/A' }}">
                                                    </div>
                                                </div>

                                                {{-- later added --}}
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 cylinder ">
                                                    <div class="form-group mb-0">
                                                        <label for="number_cylinder">Number of Cylinder<span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="number_cylinder" id="number_cylinder"
                                                            class="form-control" placeholder="Number of Cylinder"
                                                            value="{{ $petty_expense->number_cylinder }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 cylinder">
                                                    <div class="form-group mb-0">
                                                        <label for="cylinder_amount">Cylinder Amount </label>
                                                        <input type="number" name="cylinder_amount" id="cylinder_amount"
                                                            class="form-control camount amountcal amountcal_input"
                                                            placeholder="Cylinder Amount"
                                                            value="{{ number_format($petty_expense->cylinder_amount, 3, '.', '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 cylinder">
                                                    <div class="form-group mb-0">
                                                        <label for="cylinder_commission">Cylinder Commission </label>
                                                        <input type="number" name="cylinder_commission"
                                                            id="cylinder_commission"
                                                            class="form-control camount amountcal amountcal_input"
                                                            placeholder="Cylinder Commission"
                                                            value="{{ number_format($petty_expense->cylinder_commission, 3, '.', '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 cylinder">
                                                    <div class="form-group mb-0">
                                                        <label for="total_amount">Total Amount<span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="total_amount" id="total_amount"
                                                            class="form-control camount" placeholder="Total Amount"
                                                            value="{{ number_format($petty_expense->totol_amount, 3, '.', '') }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                    <div class="form-group mb-0">
                                                        <label for="vehicle_fuel_pump">Petrol Pump<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select form-control" name="vehicle_fuel_pump"
                                                            id="vehicle_fuel_pump">
                                                            @forelse($petrolpumps as $pump)
                                                                <option value="{{ $pump->id }}"
                                                                    {{ $petty_expense->petrol_pump_id == $pump->id ? 'selected' : '' }}>
                                                                    {{ $pump->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>

                                                @if ($petty_expense->petrol_slip_date != null)
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                        <div class="form-group mb-0">
                                                            <label for="vehicle_petrtol_slip">Petrol Slip Date<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="vehicle_petrtol_slip"
                                                                id="vehicle_petrtol_slip" class="form-control"
                                                                value="{{ date('d/m/Y', strtotime($petty_expense->petrol_slip_date)) }}">
                                                            <p class="error_message_slip"></p>
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- later added --}}

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group my-0">
                                                        <label>Doc Image </label>
                                                        <div id="dropzoneDragArea"
                                                            class="dz-default dz-message dropzoneDragArea mb-0">
                                                            <span class="customsvg">Upload Doc Images</span>
                                                        </div>
                                                        <div class="dropzone-previews"></div>
                                                        <small class="image_notice"
                                                            style="color:#FF0A00;font-size:12px;"></small>
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <button
                                                        class="button btn_bg_color common_btn text-white">Submit</button>
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
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
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
            margin-top: 5px;
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
            width: 100%;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        // -- Select2 Option -- //

        $(document).ready(function() {
            $('#driver_id').select2();
        });

        // ----------------- //
    </script>

    <script>
        var old_images_name = [];
        Dropzone.autoDiscover = false;
        let token = $('meta[name="csrf-token"]').attr('content');

        $(function() {

            const dropzone = new Dropzone("div#dropzoneDragArea", {

                paramName: "file",
                url: "{{ route('update-petty-docs') }}",
                previewsContainer: 'div.dropzone-previews',
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 20,
                maxFilesize: 500,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                addRemoveLinks: true,

                acceptedFiles: ".jpeg,.jpg,.png",
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;

                    var js_lang = {!! json_encode($petty_docs) !!};
                    js_lang.forEach(obj => {
                        console.log('image name');
                        console.log(obj);

                        Object.entries(obj).forEach(([key, value]) => {
                            if (`${key}` === `doc`) {
                                //console.log('--');
                                //console.log(value);
                                //console.log("{{ env('PETTY_DOCS_PATH') }}"+`${value}`);
                                let key = {
                                    name: `${value}`,
                                    size: 12345
                                };
                                myDropzone.displayExistingFile(key,
                                    "{{ env('PETTY_DOCS_PATH') }}" + `${value}`);
                            }
                        });
                    });

                    //form submission code goes here
                    $("form[name='daily_petty_expense']").submit(function(event) {

                        if ($('#cylinder_flag').val() == 1) {
                            if (($.trim($('#voucher_number').val()) == '') || ($.trim($(
                                    '#number_cylinder').val()) == '') || ($.trim($(
                                    '#cylinder_amount').val()) == '') || ($.trim($(
                                    '#cylinder_commission').val()) == '') || ($.trim($(
                                    '#total_amount').val()) == '')) {
                                return false;
                            }
                        } else {
                            if ($('#fuel_flag').val() == 1) {
                                if (($.trim($('#vehicle_number').val()) == '') || ($.trim($(
                                        '#amount').val()) == '') || ($.trim($('#driven_km')
                                        .val()) == '') || ($.trim($('#vehicle_fuel_time')
                                        .val()) == '') ||
                                    ($.trim($('#fuel').val()) == '')) {
                                    return false;
                                }
                            } else {
                                if (($.trim($('#voucher_number').val()) == '') || ($.trim($(
                                        '#amount').val()) == '')) {
                                    return false;
                                }
                            }
                        }

                        // Geting all Uploaded images data.......
                        var old_images_name = " ";
                        // $('.dz-complete').each(function() {
                        //     var c_one = this.children[0];

                        //     $(c_one).each(function() {
                        //         old_images_name += this.children[0].alt + "--";
                        //     });
                        // });

                        // $("#old_images_name").val(old_images_name);

                        $('.dz-complete').each(function() {
                            var c_one = this.children[1];
                            var get_img = c_one.getElementsByTagName('DIV')[1].children[
                                0].innerHTML;
                            old_images_name += get_img + "--";
                        });

                        $("#old_images_name").val(old_images_name);





                       
                         

                        // if ($('.time_r').() = "") {
                        //     return false;
                        // }

                        if($('#time_r').val()==1){
                            return false;
                        }

                        if($('#driven_error_r').val()==1){
                            return false;
                        }  

                         if($('#voucher_error_r').val()==1){
                            return false;
                        }        

                       
                        //Make sure that the form isn't actully being sent.

                        event.preventDefault();
                        var formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('sales_and_petty.update') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                if (data == "success") {
                                    if (myDropzone.files.length) {
                                        myDropzone.processQueue();
                                    } else {
                                        setTimeout(function() {
                                            localStorage.setItem(
                                                'success_data',
                                                'Branch has been Updated successfully!'
                                            );

                                        }, 900);
                                    }

                                    $('.image_notice').html('');
                                    $(".custom_message").removeClass('d-none');
                                    scroll(0, 0);
                                    window.location.href =
                                        "{{ route('sales-and-petty') }}";
                                }
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });

                    });

                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData) {

                    });

                    this.on("success", function(file, response) {
                        console.log(response);
                        $(".custom_message").removeClass('d-none');
                        scroll(0, 0);
                        $('#demoform')[0].reset();
                        $('.dropzone-previews').empty();
                        window.location.href = "{{ route('sales-and-petty') }}";

                    });

                    this.on("error", function(file) {
                        myDropzone.removeFile(file);
                        swal({
                            title: "Error",
                            text: "The file is too large.  ",
                            type: "warning",
                            showCancelButton: true,
                        });

                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        var fuel = false;
        var repair = false;
        var cylinder = false;
        var cat_name = $.trim($('#category').find('option:selected').text().toLowerCase());
        var sub_cat_name = $.trim($('#sub_category').find('option:selected').text().toLowerCase());
        var sub_str_1 = 'vehicle';
        var sub_str_2 = 'fuel';
        var sub_str_3 = 'gas cylinder refilling';

        if (cat_name.indexOf(sub_str_1) != -1) {
            if (sub_cat_name.indexOf(sub_str_2) != -1) {
                fuel = true;
                repair = true;
                cylinder = false;
                $('#fuel_flag').val(1);
                $('#repair_flag').val(1);
                $('#cylinder_flag').val(0);
                $('.vehicle_fuel').css('display', 'block');
                $('.vehicle_fuel_hide').css('display', 'none');
                $('.cylinder').css('display', 'none');
                $('.main_amount').css('display', 'block');
            } else {
                fuel = false;
                repair = true;
                cylinder = false;
                $('#fuel_flag').val(0);
                $('#repair_flag').val(1);
                $('#cylinder_flag').val(0);
                $('.vehicle_fuel').css('display', 'none');
                $('.vehicle_repair').css('display', 'block');
                $('.vehicle_fuel_hide').css('display', 'block');
                $('.cylinder').css('display', 'none');
                $('.main_amount').css('display', 'block');
            }
        } else if (cat_name.indexOf(sub_str_3) != -1) {
            fuel = false;
            repair = false;
            cylinder = true;
            $('#fuel_flag').val(0);
            $('#repair_flag').val(0);
            $('#cylinder_flag').val(1);
            $('.vehicle_fuel').css('display', 'none');
            $('.vehicle_fuel_hide').css('display', 'block');
            $('.cylinder').css('display', 'block');
            $('.main_amount').css('display', 'none');
        } else {
            fuel = false;
            repair = false;
            cylinder = false;
            $('#fuel_flag').val(0);
            $('#repair_flag').val(0);
            $('#cylinder_flag').val(0);
            $('.vehicle_fuel').css('display', 'none');
            $('.vehicle_fuel_hide').css('display', 'block');
            $('.cylinder').css('display', 'none');
            $('.main_amount').css('display', 'block');
        }

        $(document).on('change', '#category', function() {

            var str1 = $(this).find('option:selected').text().toLowerCase();
            var str2 = 'vehicle';
            var str3 = 'gas cylinder refilling';

            if (str1.indexOf(str2) != -1) {
                fuel = true;
                repair = true;
                cylinder = false;
                $('#fuel_flag').val(1);
                $('#repair_flag').val(1);
                $('#cylinder_flag').val(0);
                $('.vehicle_fuel').css('display', 'block');
                $('.vehicle_fuel_hide').css('display', 'none');
                $('.cylinder').css('display', 'none');
                $('.main_amount').css('display', 'block');
            } else if (str1.indexOf(str3) != -1) {

                fuel = false;
                repair = false;
                cylinder = true;
                $('#fuel_flag').val(0);
                $('#repair_flag').val(0);
                $('#cylinder_flag').val(1);
                $('.vehicle_fuel').css('display', 'none');
                $('.vehicle_fuel_hide').css('display', 'block');
                $('.cylinder').css('display', 'block');
                $('.main_amount').css('display', 'none');
            } else {
                fuel = false;
                repair = false;
                cylinder = false;
                $('#fuel_flag').val(0);
                $('#repair_flag').val(0);
                $('#cylinder_flag').val(0);
                $('.vehicle_fuel').css('display', 'none');
                $('.vehicle_fuel_hide').css('display', 'block');
                $('.cylinder').css('display', 'none');
                $('.main_amount').css('display', 'block');
            }

            $.ajax({
                type: "POST",
                url: "{{ route('petty-expense.sub-category') }}",
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

                        $('#sub_category').html(html);
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '#sub_category', function() {
            var str1 = $(this).find('option:selected').text().toLowerCase();
            var str2 = 'vehicle';
            var str3 = 'fuel';

            if (str1.indexOf(str2) != -1) {
                if (str1.indexOf(str3) != -1) {
                    fuel = true;
                    repair = true;
                    $('#fuel_flag').val(1);
                    $('#repair_flag').val(1);
                    $('.vehicle_fuel').css('display', 'block');
                    $('.vehicle_fuel_hide').css('display', 'none');
                } else {
                    fuel = false;
                    repair = true;
                    $('#fuel_flag').val(0);
                    $('#repair_flag').val(1);
                    $('.vehicle_fuel').css('display', 'none');
                    $('.vehicle_repair').css('display', 'block');
                    $('.vehicle_fuel_hide').css('display', 'block');
                }
            } else {
                fuel = false;
                repair = false;
                $('#fuel_flag').val(0);
                $('#repair_flag').val(0);
                $('.vehicle_fuel').css('display', 'none');
                $('.vehicle_fuel_hide').css('display', 'block');
            }
        })

        $('#daily_petty_expense').validate({
            rules: {
                category: {
                    required: true,
                },
                sub_category: {
                    required: true
                },
                voucher_number: {
                    required: true,
                    remote:{
                    type:"post",
                    url:"{{route('check-duplicate-voucher')}}",
                    data: {
                    "id":function(){return $('#id').val();},
                    "voucher_number": function() { return $("#voucher_number").val(); },
                    "_token": "{{ csrf_token() }}",

                    },
                    dataFilter: function (result) {
                    var json = JSON.parse(result);
                    if (json.status == "true") {
                         $('#voucher_error_r').val(1);
                    return "\"" + "Voucher Number already exists" + "\"";
                    } else {
                         $('#voucher_error_r').val(0);
                    return 'true';
                    }
                    }    
                    } 
     
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
                    },
                    remote: {
                        url: "{{ route('edit-check.km') }}",
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': function() {
                                return "{{ @$petty_expense->id }}";
                            },
                            'vehicle_number': function() {
                                return $('#vehicle_number').val();
                            },

                        },

                        dataFilter: function(data) {
                            var json = JSON.parse(data);
                            if (json.status == "true") {
                                  $('#driven_error_r').val(1);
                                return "\"" + json.msg + "\"";
                            } else {
                                 $('#driven_error_r').val(0);
                                return 'true';
                            }
                        }
                    }
                },
                vehicle_fuel_time: {
                    required: true,
                    step: false,
                    remote: {
                        url: "{{ route('daily_petty_expense.checkfueltime') }}",
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'report_date': function() {
                                return $('#report_date').val()
                            },
                            "vehicle_fuel_time": function() {
                                return $('#vehicle_fuel_time').val()
                            },
                            'petty_expense_id': function() {
                                return "{{ @$petty_expense->id }}"
                            }
                        },

                        dataFilter: function(data) {
                            var json = JSON.parse(data);
                            if (json.msg == "true") {
                                $('#time_r').val(1);
                                return "\"" + "Time already exists" + "\"";
                                
                            } else {
                                $('#time_r').val(0);
                                return 'true';
                            }
                        }
                    }
                },
                vehicle_petrtol_slip: {
                    required: true
                },
                fuel: {
                    required: function() {
                        return fuel;
                    }
                },

                number_cylinder: {
                    required: function() {
                        return cylinder;
                    }
                },
                cylinder_amount: {
                    required: function() {
                        return cylinder;
                    }
                },
                cylinder_commission: {
                    required: function() {
                        return cylinder;
                    }
                },
                total_amount: {
                    required: function() {
                        return cylinder;
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
                voucher_number: {
                    required: 'Voucher Number is required',
                   // reemote: 'Voucher Number already exists',
                },
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
                fuel: {
                    required: "Fuel is required"
                },
                vehicle_fuel_time: {
                    required: "Time is required"
                },
                vehicle_petrtol_slip: {
                    required: "Petrol Slip Date is required"
                }
            }
        });

        // ----------Report Date---------//
        var date = new Date();
        date.setDate(date.getDate());
        $("#report_date").datepicker({
            altField: "#report_date",
            dateFormat: "dd/mm/yy",
            defaultDate: date,
            onSelect: function() {
                $(this).trigger('change');
                selectedDate = $.datepicker.formatDate("dd/mm/yy", $(this).datepicker('getDate'));
            },
        });

        $('#vehicle_petrtol_slip').datepicker({
            altField: "#vehicle_petrtol_slip",
            dateFormat: "dd/mm/yy",

        });

        $(document).on('change', '#vehicle_petrtol_slip', function(e) {

            var report_date = $('#report_date').val();
            var petrol_slip = $(this).val();

            report_date = report_date.split("/");
            petrol_slip = petrol_slip.split("/");

            var edate = new Date(report_date[2], report_date[1], report_date[0]);
            var sdate = new Date(petrol_slip[2], petrol_slip[1], petrol_slip[0]);

            days = (edate - sdate) / (1000 * 60 * 60 * 24);
            days = days + 1;
            console.log(days);

            if (days > 3 || days <= 0) {
                $('.error_message_slip').text('');
                $('.error_message_slip').text('Petrol Slip Date not valid');

                $('.common_btn').attr('disabled', 'disabled');
                $('.common_btn').addClass('disabled_button');
            } else {
                $('.error_message_slip').text('');
                $('.common_btn').removeAttr('disabled', 'disabled');
                $('.common_btn').removeClass('disabled_button');
            }
        })

        $(document).on('focusout', '#amount,.camount', function() {
            var val = $(this).val();
            $(this).val(parseFloat(val).toFixed(3));
        })

        $(document).on('keyup', '.amountcal', function() {
            var sum = 0;
            $("input[class *= 'amountcal_input']").each(function() {
                if ($(this).val() != '') {
                    sum = sum + parseFloat($(this).val());
                    //total_amount  amount
                }
            });

            $('#total_amount').val(Number(sum).toFixed(3));
            $('#amount').val(Number(sum).toFixed(3))
        });

        $(document).on('keyup', '#amount,#cylinder_amount,#cylinder_commission', function() {
            var val = $(this).val();
            if (val.split('.').length > 1) {
                if (val.split('.')[1].length > 3) {
                    var new_val = parseFloat(val).toFixed(3);
                    $(this).val(new_val);
                }
            }
        })
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            var all_images_url = [];
            var js_lang = {!! json_encode($petty_docs) !!};
            //  console.log(js_lang);
            $(js_lang).each(function(data, value) {
                all_images_url.push("{{ env('PETTY_DOCS_PATH') }}" + value.doc);
                // getBase64FromUrl("{{ env('PETTY_DOCS_PATH') }}"+value.doc).then(console.log)
            });


            var img_tag = [];
            $('.dz-complete').each(function(index) {
                var c_one = this.children[0];
                var img = c_one.getElementsByTagName('IMG')[0];
                console.log($(img).remove());
                $(c_one).append(`<img   alt="" src="` + all_images_url[index] +
                    `" width="100" height="100">`);
                //  console.log(img.getAttributeNames());

            });



            // console.log(all_images_url);


        });
    </script>


@stop
