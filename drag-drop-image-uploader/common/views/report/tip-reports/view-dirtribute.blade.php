@extends('adminlte::page')

@section('title', 'Branch | Branch Tip Reports')

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
                                <div class="card-main">
                                    <div
                                        class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                                        <h3 class="mb-0">View Distribute Tip</h3>
                                        <div class="search_wrap position-relative">
                                            <a class="btn btn-sm btn_clr btn-success"
                                                href="{{ url()->previous() }}">Back</a>
                                        </div>
                                    </div>
                                    <div class="tabs_header">
                                        <div class="tab-content">
                                            <div class="tab-pane toptab active" id="dailyTabs-1" role="tabpanel">
                                                <!-- start section one -->
                                                <input type="hidden" id="userid" name="userid">

                                                <div class="card-body main_body form p-0" style="padding: 0 !important;">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                            <div class="form-group mb-0">
                                                                <label id="closing_balance"
                                                                    style="font-size:20px !important;"> Tip to be
                                                                    distributed :
                                                                    {{ number_format($branchtipsum->tip_amount, 3, '.', '') }}</label>
                                                                <input type="hidden" name="report_date" id="report_date"
                                                                    value="{{ date('d/m/Y') }}" class="form-control"
                                                                    autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row mt-3">
                                                                <div class="col-3">
                                                                    <div class="form-group">
                                                                        <label>Staff Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-group">
                                                                        <label>Point</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-group">
                                                                        <label>Available</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-group">
                                                                        <label>Amount</label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            @forelse($branchtip as $staff)
                                                                <div class="row ">
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <input type="text" readonly
                                                                                name="staff_name[]"
                                                                                value="{{ \App\Models\BranchTipDistributions::getName($staff->staff_id) }}"
                                                                                class="form-control">
                                                                            <input type="hidden" name="staff_id[]"
                                                                                value="{{ $staff->id }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <input type="number" readonly name="point[]"
                                                                                class="form-control"
                                                                                value="{{ $staff->points }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <input type="text" readonly
                                                                                name="Available_time[]"
                                                                                value="{{ $staff->available }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <input type="number" readonly name="amount[]"
                                                                                class="form-control"
                                                                                value="{{ $staff->amount }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                            @endforelse


                                                        </div>

                                                    </div>


                                                    <!-- <div class="card-footer submit_btn"
                                                                            style="margin:0 auto;border:none;">
                                                                        <button class="button btn_bg_color common_btn text-white mt-5">Submit</button>

                                                                     </div> -->
                                                </div>
                                            </div>
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
@stop

@section('js')
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
                staff_name: {
                    required: true
                }
            },
            messages: {
                amount: {
                    required: 'Amount is required'
                },
                staff_name: {
                    required: "Staff Name is required"
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
@stop
