@extends('adminlte::page')
@section('title', 'Super Admin | Edit Petty Cash Report')
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
                                    <h3 class="mb-0">Daily Petty Expense Reports</h3>
                                    <div class="search_wrap position-relative">
                                        <a class="btn btn-sm btn_clr btn-success"
                                            href="{{ url()->previous() }}">Back</a>
                                    </div>
                                </div>
                                <div class="tabs_header">
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane toptab active" id="dailyTabs-1" role="tabpanel">
                                        <!-- start section one -->
                                        <form name="daily_petty_expense" id="daily_petty_expense" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="userid" name="userid">
                                            <div class="card-body main_body form p-3 mb-4">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                        <div class="form-group mb-0">
                                                            <label for="category">Date </label>
                                                            <input type="text" name="report_date" id="report_date" class="form-control" autocomplete="off">
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
                                                                <option value="0" disabled selected>Category</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group mb-0">
                                                            <label for="sub_category">Sub Category <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="sub_category" class="sub_category form-control"
                                                                id="sub_category">
                                                                <option value="" disabled selected>Sub Category</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group mb-0">
                                                            <label for="doc_ref_no">Document Reference Number <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="doc_ref_no" id="doc_ref_no"
                                                                class="form-control" value=""readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group mb-0">
                                                            <label for="voucher_number">Voucher Number <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="voucher_number" id="voucher_number"
                                                                class="form-control" placeholder="Voucher Number">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel vehicle_repair">
                                                        <div class="form-group mb-0">
                                                            <label for="vehicle_number">Vehicle number <span
                                                                class="text-danger">*</span></label>
                                                            
                                                            <select name="vehicle_number" id="vehicle_number" class="form-control">
                                                                
                                                            </select>    
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="fuel_flag" id="fuel_flag" value="0">
                                                    <input type="hidden" name="repair_flag" id="repair_flag" value="0">
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel vehicle_repair">
                                                        <div class="form-group mb-0">
                                                            <label for="driver_id">Driver <span
                                                                class="text-danger">*</span></label>
                                                            <select name="driver_id" id="driver_id" class="form-control">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                        <div class="form-group mb-0">
                                                            <label for="driven_km">Driven (KM) <span
                                                                class="text-danger">*</span></label>
                                                            <input type="number" name="driven_km" id="driven_km"
                                                                class="form-control" placeholder="Driven (KM)">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                        <div class="form-group mb-0">
                                                            <label for="fuel">Fuel (litre) <span
                                                                class="text-danger">*</span></label>
                                                            <input type="text" name="fuel" id="fuel"
                                                                class="form-control" placeholder="Fuel">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group mb-0">
                                                            <label for="amount">Amount <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" name="amount"
                                                                class="amount form-control" placeholder="Amount" id="amount"
                                                                maxlength="100" aria-invalid="false">
                                                        </div>
                                                    </div>
                                                    {{-- <input type="file" id="doc_upload" name="doc_upload"> --}}

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group mb-0">
                                                            <label for="remarks">Remarks</label>
                                                            <input type="text" class="form-control" id="remarks"
                                                                name="remarks" placeholder="Remarks">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                        <div class="form-group my-0">
                                                            <label>Doc Image <span class="text-danger">*</span></label>
                                                            <div id="dropzoneDragArea"
                                                                class="dz-default dz-message dropzoneDragArea mb-0">
                                                                <span class="customsvg">Upload Doc Images</span>
                                                            </div>
                                                            <div class="dropzone-previews"></div>
                                                            <small class="image_notice"
                                                                style="color:#FF0A00;font-size:12px;"></small>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer submit_btn" style="margin:0 auto;border:none;">
                                                        <button class="button btn_bg_color common_btn text-white">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- end section two -->
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

@endsection 

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
<style>
    .vehicle_fuel{
        display: none;
    }
    .vehicle_repair{
        display: none;
    }
    .dz-details{
        display:none;
    }
    .dz-preview.dz-image-preview a.dz-remove{
        color: #f43127 !important;
        font-weight: 600 !important;
    }
    .dz-preview.dz-image-preview a.dz-remove:hover{
        text-decoration: underline !important;
        color: #f43127 !important;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">
    var fuel = false;
    var repair = false;
    
    $(document).on('change', '#category', function() {

        var str1 = $(this).find('option:selected').text().toLowerCase();
        var str2 = 'vehicle';

        if(str1.indexOf(str2) != -1){
            fuel = true;
            repair = true;
            $('#fuel_flag').val(1);
            $('#repair_flag').val(1);
            $('.vehicle_fuel').css('display','block');
        }else{
            fuel = false;
            repair = false;
            $('#fuel_flag').val(0);
            $('#repair_flag').val(0);
            $('.vehicle_fuel').css('display','none');
        }

        $.ajax({
            type: "POST",
            url: "",
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
                }
            }
        });
    });

    // check if sub category is vehicle fule/maintenance
    $(document).on('click','#sub_category',function(){
        var str1 = $(this).find('option:selected').text().toLowerCase();
        var str2 = 'vehicle';
        var str3 = 'fuel';

        if(str1.indexOf(str2) != -1){
            if(str1.indexOf(str3) != -1){
                fuel = true;
                repair = true;
                $('#fuel_flag').val(1);
                $('#repair_flag').val(1);
                $('.vehicle_fuel').css('display','block');
            }else{
                fuel = false;
                repair = true;
                $('#fuel_flag').val(0);
                $('#repair_flag').val(1);
                $('.vehicle_fuel').css('display','none');
                $('.vehicle_repair').css('display','block');
            }
        }else{
            fuel = false;
            repair = false;
            $('#fuel_flag').val(0);
            $('#repair_flag').val(0);
            $('.vehicle_fuel').css('display','none');
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
                required: true
            },
            amount: {
                required: true
            },
            vehicle_number:{
                required : function(){
                    return repair;
                }
            },
            driver_id:{
                required : function(){
                    return repair;
                }
            },
            driven_km:{
                required : function(){
                    return fuel;
                }
            },
            fuel:{
                required : function(){
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
            voucher_number: {
                required: 'Voucher Number is required'
            },
            amount: {
                required: 'Amount is required'
            },
            vehicle_number:{
                required : 'Vehicle Number is required'
            },
            driver_id:{
                required : "Driver is required"
            },
            driven_km:{
                required : "Driven KM is required"
            },
            fuel:{
                required : "Fuel is required"
            },
        }
    });

    Dropzone.autoDiscover = false;
    let token = $('meta[name="csrf-token"]').attr('content');

    var dropzone = new Dropzone("div#dropzoneDragArea", {
        paramName: "file",
        url: "",
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
        init: function() {
            var myDropzone = this;

            this.on("uploadprogress", function(file, progress) {
                console.log("File progress", progress);
            });
            $("form[name='daily_petty_expense']").submit(function(event) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if ($(this).valid()) {
                    if ($('.dropzone-previews').html() != "") {

                    } else {
                        $('.image_notice').html('Please Upload at least one Doc Image');
                        setTimeout(function() {
                            $('.image_notice').html('');
                        }, 1500);
                        return false;
                    }
                } else {
                    return false;
                }
                event.preventDefault();

                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {

                        if (data.status == "success") {
                            myDropzone.processQueue();
                            $('.image_notice').html('');
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            this.on('sending', function(file, xhr, formData) {
                let userid = document.getElementById('userid').value;
                formData.append('userid', userid);
            });

            this.on("success", function(file, response) {
                console.log(response);

                swal({
                        title: "Daily Petty Expense",
                        text: "Daily Petty Expense Added Successfully",
                        type: "success",
                    },
                    function() {
                        window.location.href = ""
                    }
                );
                $('#demoform')[0].reset();
                $('.dropzone-previews').empty();

            });
            this.on("error", function(file, message) {
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

</script>

<script>
    $(document).on('focusout','#amount',function(){
        var val = $(this).val();
        $(this).val(parseFloat(val).toFixed(3));
    })

    $(document).on('keyup','#amount',function(){
        var val = $(this).val();
        if(val.split('.').length>1){
            if(val.split('.')[1].length > 3){
                var new_val = parseFloat(val).toFixed(3);
                $(this).val(new_val);
            }
        }
    })

    // ----------Report Date---------//
    var date = new Date();
    date.setDate(date.getDate());
    $("#report_date").datepicker({
        altField: "#report_date",
        dateFormat: "dd/mm/yy",
        defaultDate: date,
        onSelect: function () {
            $(this).trigger('change');
            selectedDate = $.datepicker.formatDate("dd/mm/yy", $(this).datepicker('getDate'));
        },
    });
    $("#report_date").datepicker("setDate", date);
</script>
@stop
