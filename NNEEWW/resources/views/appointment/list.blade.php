@extends('adminlte::page')

@section('title', 'Super Admin | Appointments')

@section('content_header')

@section('content')

@php
$appointment_requested = \App\Models\Appointment::appointment_requested;
$appointment_scheduled = \App\Models\Appointment::appointment_scheduled;
$appointment_end = \App\Models\Appointment::appointment_end;

@endphp

<div class="container-fluid p-0">
<div class="alert d-none" role="alert" id="flash-message">
</div>
<div class="col-md-12">
    <div class="card order_outer rounded_circle">
        <div class="card-body rounded_circle table p-0 mb-0">
            <div class="order_details">
                <div class="card-main pt-3">
                    @can('add_appointments')
                    <div class="order_heading alert d-flex  align-items-center justify-content-between mb-4">
                        <h3 class="mb-0"> Appointments</h3>

                        @if ($ConfidentialApiKey->value != '')
                        <a class="btn btn-sm btn-success add-advance-options"
                        href="{{ route('add_appointment') }}">Add Appointment</a>
                        @else
                        <a class="btn btn-sm btn-success add_appointment add-advance-options">Add
                        Appointment</a>
                        @endif
                    </div>
                    @endcan
                    <div class="">
                            <!--  <div>
                                       <label>Select appointment type</label>
                                       <select class="form-control" style="width:fit-content;" id="appoinment-type-select">
                                           <option value="">Select Appointment type</option>
                                           <option value="0">All Appointments</option>
                                           <option value="2">Scheduled</option>
                                           <option value="1">Requested</option>
                                           <option value="3">Appointment End</option>
                                       </select>
                                   </div> -->
                                   <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="display-none"></th>
                                            <th>User</th>
                                            <th>Nutritionst</th>
                                            <th>Date</th>
                                            <th>Start</th>
                                            <th>End Time</th>
                                            <th>Duration</th>
                                            <th>Zoom Meeting</th>
                                            <th>Status</th>
                                            @if (Gate::check('view_appointments') || Gate::check('edit_appointments') || Gate::check('delete_appointments'))
                                            <th>Action</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody id="appointments_list">
                                        @foreach ($AppointmentList as $data)
                                        <tr>

                                            <td class="display-none"></td>
                                            <td>{{ @$data->appointment->User->name }}</td>




                                            <td>{{ @$data->appointment->Nutritionist->name }}</td>



                                            <td>{{ date('d/m/Y', strtotime(@$data->appointment_time)) }}</td>

                                            <td>{{ @$data->start_time == null ? '--' : date('g:i A', strtotime(@$data->start_time)) }}
                                            </td>

                                            <td>{{ @$data->end_time == null ? '--' : date('g:i A', strtotime(@$data->end_time)) }}
                                            </td>

                                            <td>
                                                @if (!empty(@$data->start_time) && !empty(@$data->end_time))
                                                {{ @$data->calculated_duration }} Min
                                                @else
                                                --
                                                @endif
                                            </td>

                                            <td>
                                                @if ($data->status != $appointment_requested && $data->appointment_join_url != '')
                                                <span class="badge badge-pill badge-dark mb-1 copy_btn"
                                                style="font-size:12px;"
                                                data-link="{{ @$data->appointment_join_url }}"
                                                title="{{ @$data->appointment_join_url }}">Copy </span>
                                                @else
                                                --
                                                @endif

                                            </td>


                                            <td>{{ @$data->AppointmentStatus->name }}</td>




                                            @if (Gate::check('view_appointments') || Gate::check('edit_appointments') || Gate::check('delete_appointments'))

                                            @if ($data->status != $appointment_requested && $data->appointment_join_url != '')
                                            <td>
                                                
                                                @can('edit_appointments')
                                                <i title="Notify both by sending mail" class="fa fa-bell notify_btn"
                                                aria-hidden="true" data-id="{{ @$data->id }}"></i>
                                                @endcan

                                                @can('view_appointments')
                                                <a class="action-button" title="View"
                                                href="{{ route('view_appointment', ['id' => $data->id]) }}"><i
                                                class="text-success fa fa-eye"></i></a>
                                                @endcan


                                               @can('edit_appointments')
                                                <a href="{{ route('edit_appointment', ['id' => @$data->id]) }}"
                                                    title="Edit"><i class="text-warning fa fa-edit"></i></a>




                                                    <a class="action-button cancel-button"
                                                    title="Cancel this appointment" href="javascript:void(0)"
                                                    data-id="{{ $data->id }}"
                                                    meeting-id="{{ @$data->meeting_id }}"><i
                                                    class="text-danger fa fa-times"></i></a>
                                                      @endcan
                                                    @can('delete_appointments')
                                                    <a class="action-button delete-button" title="Delete"
                                                    href="javascript:void(0)" data-id="{{ $data->id }}"
                                                    meeting-id="{{ @$data->meeting_id }}"><i
                                                    class="text-danger fa fa-trash-alt"></i></a>
                                                    @endcan

                                                </td>
                                                @else
                                                <td>
                                                   @can('edit_appointments')
                                                   <a class="action-button scheduled-appoinment-button"
                                                   title="Schedule Appointment" href="javascript:void(0)"
                                                   data-id="{{ $data->id }}"
                                                   meeting-id="{{ @$data->meeting_id }}">
                                                   <i class="text-dark fa fa-calendar"
                                                   style="font-size:16px;"></i></a>
                                                   @endcan

                                                   @can('delete_appointments')
                                                   <a class="action-button delete-button" title="Delete"
                                                   href="javascript:void(0)" data-id="{{ $data->id }}"
                                                   meeting-id="{{ @$data->meeting_id }}"><i
                                                   class="text-danger fa fa-trash-alt"></i></a>
                                                   @endcan

                                                </td>
                                                @endif
                                                @endif


                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div id="myModal" class="modal  fade  " role="dialog">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            <div>
                                Schedule Appoinment : <span class="placed_date"> </span>
                            </div>

                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--start container -->
                        <div class="model-back container-fluid" id="quick_view_container">



                        </div>

                        <!--end container -->

                    </div>

                </div>

            </div>
        </div>

        <!--end modal -->

        @endsection

        @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
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
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $('#pages-list').DataTable({
        // "order": [[ 3, "desc" ]],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }]
        });




    // delete
    //$('.delete-button').click(function(e) {
        $(document).on("click", ".delete-button", function() {
            var id = $(this).attr('data-id');
            var meeting_id = $(this).attr('meeting-id');
            var obj = $(this);

        // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to  delete this Appointment ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_appointment') }}",
                        type: 'post',
                        data: {
                            id: id,
                            meeting_id: meeting_id
                        },
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log("Response", response);
                            if (response.success == 1) {
                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html(
                                    ' Appointment  Deleted Successfully');
                                obj.parent().parent().remove();
                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);
                            } else {
                                console.log("FALSE");
                                setTimeout(() => {
                                    swal('Error',
                                        response.message,
                                        'error');
                                }, 500);
                            // swal("Error!", "Something went wrong! Please try again.", "error");
                            // swal("Something went wrong! Please try again.");
                            }
                        }
                    });
                }
            });
        });
    // delete
    </script>
    <script type="text/javascript">
    //Active and incactive choices

        $(document).ready(function() {
            $(document).on('change', '.change_status_of_status', function() {
                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "post",
                    url: " ",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                    //toastr.success(response.message);
                        console.log(response);
                    }
                });
            })

        //        $('.change_status_of_group').change(function(){

        // });



        });
    </script>
    <script type="text/javascript">
    //Active and incactive choices

        $(document).ready(function() {
            $(document).on('change', '.change_status_of_popup', function() {
                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                    //toastr.success(response.message);
                        console.log(response);
                    }
                });
            })

        //        $('.change_status_of_group').change(function(){

        // });



        });

    //Copy link

    // $('#copy_btn').click(function(){
    //     var getLink = $(this).attr('data-link');
    //     alert(getLink);
    // });

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

        $(document).on('click', '.notify_btn', function() {
            var btn = this;
            var getId = $(this).attr('data-id');
          var url = "{{ route('send-mail', ['id' => 'getId']) }}";
         // alert(url);
            swal({
                title: "Are You Sure ?",
                text: "Do you want to Notify Both By Mail",
                type: "warning",
                confirmButtonText: "Send Mail",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {


                    $.ajax({
                        type: "POST",
                        url: "{{--route('send-mail', ['id' =>getId])--}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {


                            Swal.fire(
                                'Success',
                                'Mail Send Successfully !',
                                'success'
                                )
                        }
                    });

                }
            });

        });

        $(document).on('click', '.add_appointment', function() {

            swal({
                title: "Please Generate Token",
                text: "Before creating appointments you have to Generate Token .",
                type: "warning",
                confirmButtonText: "Generate Now",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $(location).attr('href', "{{ route('edit_apiKey', ['slug' => 'zoom']) }}");
                }
            });

        });
    </script>


    <script>
    //  $('body').on('click', '.delete-button', function(e) {
        $(document).ready(function() {



            $('body').on('click', '.scheduled-appoinment-button', function(e) {

                $('#myModal').modal({
                    'show': true,
                    backdrop: 'static',
                    keyboard: false
                });

                var data_id = $(this).attr('data-id');
                var order_placed_date = $(this).attr('order-placed-on');

                var obj = $(this);

                $.ajax({
                    type: "post",
                    url: "{{ route('scheduled_appointment') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": data_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('.placed_date').html(order_placed_date);
                        if (response.status) {
                            $('#quick_view_container').html(response.html);
                            $('#myModal').modal({
                                'show': true,
                                backdrop: 'static',
                                keyboard: false
                            });

                            additionalDataLinks();

                        }
                    }

                });

            });





        });





        function additionalDataLinks() {


            $(".appoinment_date").datetimepicker({
            // timepicker:true,
            // formatTime: 'g:i A',
            // format : 'd/m/Y g:i A',
            // validateOnBlur: false,
            // minDate : 0,
            // step: 15,
                minDate: new Date(),
                timepicker: false,
                format: 'd/m/Y',
                scrollMonth: false,
                scrollInput: false
            });

            $(".appoinment_start_time").datetimepicker({
                datepicker: false,
                formatTime: 'g:i A',
                format: 'g:i A',
                validateOnBlur: false,
                step: 60,
            });


            $(".appoinment_end_time").datetimepicker({
                datepicker: false,
                formatTime: 'g:i A',
                format: 'g:i A',
                step: 60,
                validateOnBlur: false,
            });


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




            $(document).ready(function() {
                $('#addAppointmentForm').validate({
                    ignore: [],

                    rules: {
                        user_id: {
                            required: true
                        },
                        nutritionist_id: {
                            required: true
                        },
                        appoinment_date: {
                            required: true
                        },
                        appoinment_start_time: {
                            required: true
                        },
                        appoinment_end_time: {
                            required: true
                        },
                        reason_for_appointment: {
                            required: true
                        }

                    },
                    errorPlacement: function(error, element) {
                        if (element.attr("name") == "nutritionist_id") {
                            error.appendTo($('#nutritionist_cutom_error'));
                        } else if (element.attr("name") == "user_id") {
                            error.appendTo($('#user_cutom_error'));
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    messages: {
                        user_id: {
                            required: "User  is required"
                        },

                        nutritionist_id: {
                            required: "Nutritionist  is required"
                        },
                        appoinment_date: {
                            required: "Appoinment date  is required"
                        },

                        appoinment_start_time: {
                            required: "Appoinment start time is required"
                        },
                        appoinment_end_time: {
                            required: "Appoinment end time is required"
                        },
                        reason_for_appointment: {
                            required: "Appoinment title is required"
                        }

                    },
                    submitHandler: function(form) {

                     //Make AJax Request....................

                     //Make AJax Request....................

                    var appoinmentStartTime = $("#appoinment_start_time").val();
                    var appoinmentEndTime = $("#appoinment_end_time").val();

                    // Convert time strings to 24-hour format for easier comparison
                    var startDateTime = new Date("2000-01-01 " + appoinmentStartTime);
                    var endDateTime = new Date("2000-01-01 " + appoinmentEndTime);

                    var timeDiff = endDateTime - startDateTime; // Difference in milliseconds
                    var hoursDiff = timeDiff / (1000 * 60 * 60); // Convert milliseconds to hours

                    if (hoursDiff === 1) {
                        console.log("Valid: Time difference is one hour.");
                    } else {
                        toastr.error('The time difference should be exactly one hour.');
                        console.log("Invalid: Time difference is not one hour.");
                        return false;
                    }

                        $.ajax({
                            type: "POST",
                            url: "{{ route('scheduled_appointment_save') }}",
                            data: new FormData(form),
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if (response.status == 'failed') {
                                    toastr.error(response.message);
                                }

                                if (response.status == 'success') {
                                    toastr.success(response.message);
                                    $('#myModal').modal('hide');

                                }
                            }
                        });
                        return false;
                //End AjAX rEQUEST...

                    }


                });

            });



        //    $(document).ready(function() {
        //       $('#addAppointmentForm').validate({
        //        ignore: [],

        //        rules: {
        //           user_id: {
        //               required: true
        //           },
        //           nutritionist_id: {
        //               required: true
        //           },
        //           appoinment_date:{
        //               required:true
        //           },
        //           appoinment_start_time:{
        //               required:true
        //           },
        //           appoinment_end_time:{
        //               required:true
        //           }

        //       },
        // //                 errorPlacement:
        // // function(error, element){
        // //   var id=element[0]['id'];
        // //   $( element ).before( "<label for='"+id+"' class='error'>"+error.text()+"</label>" );
        // // },
        //       messages: {
        //           user_id: {
        //               required: "User  is required"
        //           },

        //           nutritionist_id: {
        //               required: "Nutritionist  is required"
        //           },
        //           appoinment_date: {
        //               required: "Appoinment date  is required"
        //           },

        //           appoinment_start_time: {
        //               required: "Appoinment start time is required"
        //           },
        //           appoinment_end_time: {
        //               required: "Appoinment end time is required"
        //           },

        //       },
        //   });

        //   });

        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#appoinment-type-select').on('change', function() {
                var currentObj = this;
                var appointmentStatus = this.value;

            // update table data
                $.ajax({
                    url: "{{ route('filter.appointments') }}",
                    method: 'post',
                    data: {
                        status_value: appointmentStatus
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('response');
                        console.log(response);
                        if (response.status) {
                            $('#appointments_list').html(response.html);
                        }
                    }
                });
            });
        });
    </script>


    <script>
        $(document).on('click', '.cancel-button', function() {
            var id = $(this).attr('data-id');

            var obj = $(this);

            swal({
                title: "Are You Sure ?",
                text: "Do you want to  Cancle this appointment",
                type: "warning",
                confirmButtonText: "Yes , Cancle it",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {


                    $.ajax({
                        type: "POST",
                        url: "{{ route('cancel.appointment') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(response) {


                            Swal.fire(
                                'Success',
                                'Appointment cancelled successfully !',
                                'success'
                                )
                        }
                    });

                }
            });

        });
    </script>


    @stop
