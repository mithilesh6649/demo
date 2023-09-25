@extends('adminlte::page')
@section('title', 'Super Admin | Sales & Petty Reporting')
@section('content_header')
@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Petty Cash Report Details</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>        
          <div class="card-body table p-0 mb-0">
             <form id="daily_petty_expense" method="POST" action="{{route('update-petty-voucher')}}"
                                        enctype="multipart/form-data" class="dropzone p-0">
                                        @csrf
                                        <input type="hidden" id="id" name="id" value="{{$petty_expense->id}}">

                                        <div class="card-body main_body form p-3 mb-4">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group my-0" style="pointer-events:none;">
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
                                                        <label for="category">Category </label>
                                                        <input type="text" class="category form-control" name="category" id="category" value="{{ $petty_expense->category['cat_name'] }}" data-slug="{{ $petty_expense->category['slug'] }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="sub_category">Sub Category  </label>
                                                       <input type="text" class="sub_category form-control" name="sub_category" id="sub_category" value="{{ $petty_expense->sub_category['sub_cat_name'] }}" data-slug="{{ $petty_expense->sub_category['slug'] }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="doc_ref_no">Document Reference Number  </label>
                                                        <input type="text" name="doc_ref_no" id="doc_ref_no"
                                                            class="form-control" value="{{ $petty_expense->doc_ref_no }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                    <div class="form-group mb-0">
                                                        <label for="voucher_number">Time <span
                                                                class="text-danger">*</span></label>
                                                        <input type="time" type="time" name="vehicle_fuel_time"
                                                            value="{{ $petty_expense->fuel_time }}" autocomplete="off"
                                                            step="5" id="vehicle_fuel_time" class="form-control"
                                                            placeholder="">
                                                    </div>
                                                </div>

                                                 <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                    <label for="doc_ref_no">Invoice Number </label>
                                                    <input type="text" name="invoice_number" id="invoice_number"
                                                        class="form-control"
                                                        value="{{ $petty_expense->voucher_number }}" readonly>
                                                    </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel vehicle_repair">
                                                        <div class="form-group mb-0">
                                                            <label for="vehicle_number">Vehicle number <span
                                                                    class="text-danger">*</span></label>

                                                            <input type="text" name="invoice_number" id="invoice_number" class="form-control"
                                                                    value="{{ @$petty_expense['car']['no_plate'] }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel vehicle_repair">
                                                        <div class="form-group mb-0">
                                                            <label for="driver_id">Driver <span
                                                                    class="text-danger">*</span></label>

                                                            <input type="text" name="invoice_number" id="invoice_number" class="form-control"
                                                                    value="{{ @$petty_expense['driver']['drivers_name'] }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                        <div class="form-group mb-0">
                                                            <label for="driven_km">Driven (KM) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="driven_km" id="driven_km"
                                                                class="form-control"
                                                                value="{{ $petty_expense->driven_km }}"
                                                                placeholder="Driven (KM)">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                        <div class="form-group mb-0">
                                                            <label for="fuel">Fuel (litre) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="fuel" id="fuel"
                                                                class="form-control" value="{{ $petty_expense->fuel }}"
                                                                placeholder="Fuel">
                                                        </div>
                                                    </div>


                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 main_amount">
                                                    <div class="form-group mb-0">
                                                        <label for="amount">Amount  </label>
                                                        <input type="number" name="amount" id="amount" class="amount form-control"
                                                            value="{{ number_format($petty_expense->amount, 3, '.', '') }}"
                                                            id="amount" maxlength="100" aria-invalid="false" readonly>
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="remarks">Remarks</label>
                                                        <input type="text" class="form-control" id="remarks"
                                                            name="remarks" value="{{ $petty_expense->remarks }}" readonly>
                                                    </div>
                                                </div> -->

                                                <input type="hidden" name="cylinder_flag" id="cylinder_flag" value="0">

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 cylinder ">
                                                    <div class="form-group mb-0">
                                                        <label for="number_cylinder">Number of Cylinder </label>
                                                        <input type="number" name="number_cylinder" id="number_cylinder"
                                                            class="form-control" placeholder="Number of Cylinder" value="{{ $petty_expense->number_cylinder }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 cylinder">
                                                    <div class="form-group mb-0">
                                                        <label for="cylinder_amount">Cylinder Amount </label>
                                                        <input type="number" name="cylinder_amount" id="cylinder_amount"
                                                            class="form-control camount amountcal amountcal_input" placeholder="Cylinder Amount" value="{{number_format($petty_expense->cylinder_amount,3,'.','') }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 cylinder">
                                                    <div class="form-group mb-0">
                                                        <label for="cylinder_commission">Cylinder Commission</label>
                                                        <input type="number" name="cylinder_commission" id="cylinder_commission"
                                                            class="form-control camount amountcal amountcal_input" placeholder="Cylinder Commission" value="{{number_format($petty_expense->cylinder_commission,3,'.','') }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 cylinder">
                                                    <div class="form-group mb-0">
                                                        <label for="total_amount">Total Amount </label>
                                                        <input type="number" name="total amount" id="total_amount"
                                                            class="form-control camount" readonly placeholder="Total Amount" value="{{number_format($petty_expense->totol_amount,3,'.','') }}"  readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                    <div class="form-group mb-0">
                                                        <label for="vehicle_fuel_pump">Petrol Pump</label>
                                                        
                                                        <input type="text" name="invoice_number" id="invoice_number" class="form-control"
                                                                    value="{{ @$petty_expense['petrolpump']['name'] }}" readonly>
                                                    </div>
                                                  </div>

                                                  @if ($petty_expense->petrol_slip_date != null)
                                                      <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 vehicle_fuel">
                                                          <div class="form-group mb-0">
                                                              <label for="vehicle_petrtol_slip">Petrol Slip Date<span
                                                                      class="text-danger">*</span></label>
                                                              <input type="text" name="vehicle_petrtol_slip"
                                                                  id="vehicle_petrtol_slip" class="form-control"
                                                                  value="{{ date('d/m/Y', strtotime($petty_expense->petrol_slip_date)) }}" readonly>
                                                              <p class="error_message_slip"></p>
                                                          </div>
                                                      </div>
                                                  @endif
                                                  

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3 person_name">
                                                    <div class="form-group mb-0">
                                                        <label for="person_name">Person Name </label>
                                                        <input type="text" class="form-control" id="person_name"
                                                            name="person_name" value="{{ $petty_expense->person_name }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="description">Description </label>
                                                        <input type="text" class="form-control" id="description"
                                                            name="description" value="{{ $petty_expense->description }}" readonly>
                                                    </div>
                                                </div>

                                                @if($petty_expense['receiver_signature'])
                                                <div class="col-md-12">
                                                  <div class="form-group verified_by mb-3">
                                                      <label class="headings">Receiver's Signature</label>
                                                      <div class="wrapper" style="border: 1px solid #dee2e6;
                                                      border-radius: 5px;">
                                                          <img src="{{@$petty_expense['receiver_signature']}}" class="signature_image" style="width: auto;border:none" alt="">
                                                      </div>
                                                  </div>
                                                </div> 
                                              @endif

                                              @if($petty_expense['verified_by'])
                                                <div class="col-md-12">
                                                  <div class="form-group verified_by mb-3">
                                                      <label class="headings">Verified by</label>
                                                      <div class="wrapper" style="border: 1px solid #dee2e6;
                                                      border-radius: 5px;">
                                                          <img src="{{@$petty_expense['verified_by']}}" class="signature_image" style="width: auto;border:none" alt="">
                                                      </div>
                                                  </div>
                                                </div>
                                              @endif

                                              @if($petty_expense['approved_by'])
                                                <div class="col-md-12">
                                                  <div class="form-group verified_by mb-0">
                                                      <label class="headings">Approved by</label>
                                                      <div class="wrapper" style="border: 1px solid #dee2e6;
                                                      border-radius: 5px;">
                                                          <img src="{{@$petty_expense['approved_by']}}" class="signature_image" style="width: auto;border:none" alt="">
                                                      </div>
                                                  </div>
                                                </div>
                                              @endif

                                                
                                            </div>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.csss" type="text/css" />

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

        .vehicle_fuel {
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

        .cylinder{
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
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript">

        
        var fuel = false;
        var repair = false;
        var cylinder=false;
        var cat_name = $.trim($('#category').data('slug').toLowerCase());
        var sub_cat_name = $.trim($('#sub_category').data('slug').toLowerCase());
        console.log(cat_name);

       console.log(sub_cat_name);

        var sub_str_1 = 'vehicle';
        var sub_str_2 = 'vehicle_fuel';
        var sub_str_3 = 'gas_cylinder';

        if (cat_name.indexOf(sub_str_1) != -1) {
            if (sub_cat_name.indexOf(sub_str_2) != -1) {

                console.log('first--'); 

                fuel = true;
                repair = true;
                cylinder = false;
                $('#fuel_flag').val(1);
                $('#repair_flag').val(1);
                $('#cylinder_flag').val(0);
                $('.vehicle_fuel').css('display', 'block');
                $('.vehicle_fuel_hide').css('display', 'none');
                $('.cylinder').css('display', 'none');
                $('.main_amount').show();

                $('.person_name').css('display','none');
            } else {

                console.log('second--');

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
                $('.main_amount').show();

                $('.person_name').css('display','none');
            }
        } else if (cat_name.indexOf(sub_str_3) != -1) {

            console.log('third--');

            fuel = false; 
            repair = false;
            cylinder = true;
            $('#fuel_flag').val(0);
            $('#repair_flag').val(0);
            $('#cylinder_flag').val(1);
            $('.vehicle_fuel').css('display', 'none');
            $('.vehicle_fuel_hide').css('display', 'block');
            $('.cylinder').css('display', 'block');
            $('.main_amount').hide();

            $('.person_name').css('display','block');
        } else {

            console.log('fourth--');

            fuel = false;
            repair = false;
            cylinder = false;
            $('#fuel_flag').val(0);
            $('#repair_flag').val(0);
            $('#cylinder_flag').val(0);
            $('.vehicle_fuel').css('display', 'none');
            $('.vehicle_fuel_hide').css('display', 'block');
            $('.cylinder').css('display', 'none');
            $('.main_amount').show();

            $('.person_name').css('display','block');
        }
        
        console.log(cylinder)


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

        $(document).on('focusout','#amount',function(){
            var val = $(this).val();
            $(this).val(parseFloat(val).toFixed(3));
        })

        $(document).on('keyup','.amountcal',function(){
            var sum=0;
            $("input[class *= 'amountcal_input']").each(function() {
                if ($(this).val() != '') {
                    sum=sum+parseFloat($(this).val());
                }           
            });
            $('#total_amount').val(Number(sum).toFixed(3));
            $('#amount').val(Number(sum).toFixed(3))
        });

        $(document).on('keyup','#amount,#cylinder_amount,#cylinder_commission',function(){
            var val = $(this).val();
            if(val.split('.').length>1){
                if(val.split('.')[1].length > 3){
                    var new_val = parseFloat(val).toFixed(3);
                    $(this).val(new_val);
                }
            }
        })
    </script>
@stop
