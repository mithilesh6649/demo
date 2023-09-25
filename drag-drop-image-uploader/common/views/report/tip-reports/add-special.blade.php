@extends('layouts.main')

@section('title', 'Branch | Special Tip Distribution')

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
                                <div class="card-main">
                                    <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                        <h3 class="mb-0">Add Special Tip Distribution</h3>
                                        <div class="search_wrap position-relative">
                                            <a class="btn btn-sm btn_clr btn-success" href="{{ url()->previous() }}">Back</a>
                                        </div>
                                    </div>
                                    <div class="tabs_header">
                                        <div class="tab-content">
                                            <div class="tab-pane toptab active" id="dailyTabs-1" role="tabpanel">
                                                <!-- start section one -->
                                                <form name="tip_report" id="tip_report" method="POST"
                                                    enctype="multipart/form-data" action="{{ route('tip-distribution.save') }}">
                                                    @csrf
                                                    <input type="hidden" id="userid" name="userid">

                                                    <div class="card-body main_body form p-0" style="padding: 0 !important;">
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                                                <div class="form-group mb-0">
                                                                    <label for="category">Date </label>
                                                                    <input type="text" name="report_date"
                                                                        id="report_date" value="{{ date('d/m/Y') }}"
                                                                        class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="staff_name">Staff Name <span
                                                                            class="text-danger">*</span></label>
                                                                    <select name="staff_name" id="staff_name" class="form-control">
                                                                        <option value="">Select staff</option>
                                                                      @foreach($allstaff as $staff)
                                                                       <option value="{{$staff->id}}">{{$staff->staff_name}}</option>
                                                                      @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>

                                                             <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="amount">Amount <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number" name="amount"
                                                                        class="amount form-control" placeholder="Amount"
                                                                        id="amount" maxlength="100" aria-invalid="false">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                                {{-- <div class="form-group my-0">
                                                                    <label>Document</label>
                                                                    <div id="dropzoneDragArea"
                                                                        class="dz-default dz-message dropzoneDragArea mb-0">
                                                                        <span class="customsvg">Upload Document</span>
                                                                    </div>
                                                                    <div class="dropzone-previews"></div>
                                                                    <small class="image_notice"
                                                                        style="color:#FF0A00;font-size:12px;"></small>
                                                                </div> --}}
                                                            </div>


                                                            <div class="card-footer submit_btn"
                                                                style="margin:0 auto;border:none;">
                                                                <button
                                                                    class="button btn_bg_color common_btn text-white">Submit</button>
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

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <style>
        .vehicle_fuel {
            display: none;
        }

        .vehicle_repair {
            display: none;
        }

        .vehicle_fuel_hide {
            display: block;
        }

        .dz-details {
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
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript">
        var date = new Date();

        $("#report_date").datepicker({
            altField: "#report_date",
            dateFormat: "dd/mm/yy",
            defaultDate: date,
            maxDate: date,
            onSelect: function() {
                $(this).trigger('change');
                selectedDate = $.datepicker.formatDate("dd/mm/yy", $(this).datepicker('getDate'));
            },
            //  onClose: function () {
            //     $("#report_date").validate().element("#report_date");
            // }
        });

        $('#tip_report').validate({
            rules: {
                amount: {
                    required: true,
                    valuecheck: true,
                },
                staff_name:{
                    required:true
                }
            },
            messages: {
                amount: {
                    required: 'Amount is required'
                },
                staff_name:{
                    required:"Staff Name is required"
                }
            }
        });

        jQuery.validator.addMethod("valuecheck", function(value, element) {
            return (parseFloat(value) > 0);
        }, "Amount must be greater than zero");

        $(document).on('focusout', '#amount', function() {
            var val = $(this).val();
            $(this).val(parseFloat(val).toFixed(3));
        });

        $(document).on('keyup', '#amount', function() {
            var val = $(this).val();
            if (val.split('.').length > 1) {
                if (val.split('.')[1].length > 3) {
                    var new_val = parseFloat(val).toFixed(3);
                    $(this).val(new_val);
                }
            }
        });
    </script>
@endpush
