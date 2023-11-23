@extends('adminlte::page')
@section('title', 'Appointment Details')
@section('content_header')
@section('content')

    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0">Appointment Details</h3>

                                <a class="btn btn-sm btn-success add-advance-options"
                                    href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                            </div>
                            <div class="card-body main_body form p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form id="addCurrentOfferForm" method="post" action="{{ route('update_appointment') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
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
                                        <div class="form-group"> <label for="reason_for_appointment"> Appoinment Title</label> <input
                                                type="text" name="reason_for_appointment"
                                                class="form-control reason_for_appointment" id="reason_for_appointment"
                                                maxlength="100" autocomplete="off" readonly value={{@$data->reason_for_appointment}}></div>
                                    </div>
                                    

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Select User  </label>
                                                        <select disabled class="form-control UserSelect" id="select"
                                                            name="user_id">
                                                            <option value="{{ $data->Appointment->user_id }}" selected="selected">
                                                                {{ @$data->Appointment->User->name }}</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Select Nutritionists </label>
                                                        <select disabled class="form-control NutritionistSelect" id="select"
                                                            name="nutritionist_id">
                                                            <option value="">Select Nutritionist</option>


                                                            @forelse ($NutritionistList as $Nutritionist)
                                                                <option
                                                                    {{ $data->Appointment->invitee_id == $Nutritionist->id ? 'selected' : '' }}
                                                                    value="{{ $Nutritionist->id }}">
                                                                    {{ $Nutritionist->name }}</option>
                                                            @empty
                                                                <option disabled>No results found </option>
                                                            @endforelse

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group" style="pointer-events: none;"> <label for="appoinment_date">Appointment
                                                            Date </label><input
                                                            type="text" name="appoinment_date"
                                                            class="form-control appoinment_date" id="appoinment_date"
                                                            maxlength="100" autocomplete="off"
                                                            value="{{ date('d/m/Y', strtotime(@$data->appointment_time)) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group"> <label for="appoinment_start_time"> Appointment
                                                            Start Time </label> <input
                                                            type="time" name="appoinment_start_time"
                                                            class="form-control appoinment_start_time"
                                                            id="appoinment_start_time" maxlength="100" autocomplete="off"
                                                            value="{{ date('H:i', strtotime(@$data->start_time)) }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group"> <label for="appoinment_end_time">Appointment
                                                            End Time </label> <input
                                                            type="time" name="appoinment_end_time"
                                                            class="form-control appoinment_end_time"
                                                            id="appoinment_end_time" maxlength="100" autocomplete="off"
                                                            value="{{ date('H:i', strtotime(@$data->end_time)) }}" readonly>
                                                    </div>
                                                </div>



 









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
                            return {
                                id: item.id,
                                text: item.text + "(" + item.email + ")"
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

@stop
