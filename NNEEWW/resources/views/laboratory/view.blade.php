@extends('adminlte::page')

@section('title', 'Laboratory Details')

@section('content_header')

@section('content')

    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">Laboratory Details</h3>
                                </div>
                                <a class="btn btn-sm btn-success add-advance-options"
                                    href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                            </div>
                            <div class="card-body main_body form p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form id="addLaboratoryForm" autocomplete="off" method="post",
                                    action="{{ route('update_laboratory') }}" onload="myFunction()"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="lab_id" class="form-control"
                                        value="{{ $LaboratoryData->id }}">

                                    <div class="card-body">
                                        <div class="row">


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lab_name">First Name</label>
                                                    <input type="text" name="first_name" class="form-control"
                                                        id="first_name" maxlength="100"
                                                        value="{{ $LaboratoryData->first_name ?? '' }}" readonly>
                                                </div>
                                            </div>

                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name </label>
                                                        <input type="text" name="last_name" class="form-control"
                                                            id="last_name" maxlength="100"  value="{{ $LaboratoryData->last_name ?? '' }}" readonly>
                                                    </div>

                                                    
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email </label>
                                                        <input type="text" name="email" class="form-control"
                                                            id="email" maxlength="100"  value="{{ @$LaboratoryData->LaboratoryMetadata->email ?? '' }}" readonly>
                                                    </div>

                                                    
                                                   </div>



                                    <div class="col-6">
                                    <div class="form-group">
                                    <label for="password">Phone Number </label>

                                    <input type="tel" name="phone_number" class="form-control" id="txtPhone"
                                    value="{{@$LaboratoryData->LaboratoryMetadata->phone_number ?? '' }}"  readonly >
                                    <input type="hidden" name="country_code" class="form-control" id="country_code"
                                    value="{{ @$LaboratoryData->LaboratoryMetadata->country_code ?? '' }}" readonly   />
                                    </div>
                                    </div>

                                          
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lab_name">Opening time</label>
                                                    <input type="text"
                                                        class="form-control date_controls timepickercustom"
                                                        name="opening_time" autocomplete="off"
                                                        value="{{ @$LaboratoryData->LaboratoryMetadata->open_time ?? '' }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lab_name">Closing time</label>
                                                    <input type="text"
                                                        class="form-control date_controls timepickercustom"
                                                        name="ending_time" autocomplete="off"
                                                        value="{{ @$LaboratoryData->LaboratoryMetadata->close_time ?? '' }}"
                                                        readonly>
                                                </div>
                                            </div>

                                              <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="charges">Charges</label>
                                                    <input type="number" name="charges" class="form-control" id="charges"
                                                        value="{{ @$LaboratoryData->LaboratoryMetadata->charges ?? '' }}"
                                                        readonly>
                                                </div>
                                            </div>
                                             
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="descripiton">Description</label>
                                                    <textarea name="descripiton" rows="1" style="width: 100%;border:1px solid #ced4da;    background-color: #f5f5f5;"
                                                        readonly>{{ @$LaboratoryData->description ?? '' }}</textarea>
                                                </div>
                                            </div>


                                            <div class="col-md-6" style="pointer-events: none;">
                                                <div class="form-group">
                                                    <label for="name">Address</label>
                                                    <input autocomplete="off" type="text" name="address"
                                                        class="form-control" id="name" maxlength="500"
                                                        value="{{ @$LaboratoryData->LaboratoryMetadata->address ?? '' }}"
                                                        readonly>
                                                </div>
                                            </div>

                                           

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">City</label>
                                                    <input type="text" name="txtCity" class="form-control" id="txtCity"
                                                        maxlength="100" readonly
                                                        value="{{ @$LaboratoryData->LaboratoryMetadata->city ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">State</label>
                                                    <input type="text" name="state" class="form-control" id="txtState"
                                                        maxlength="100" readonly
                                                        value="{{ @$LaboratoryData->LaboratoryMetadata->state ?? '' }}">
                                                </div>
                                            </div>

                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Country</label>
                                                    <input type="text" name="state" class="form-control" id="txtState"
                                                        maxlength="100" readonly
                                                        value="{{ @$LaboratoryData->LaboratoryMetadata->country ?? '' }}">
                                                </div>
                                            </div>

                                            <div style="pointer-events: none;"
                                                class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                <div class="form-group ">
                                                    <label>Test</label>
                                                    <select data-placeholder="Select Test" multiple
                                                        class="chosen-select form-control" name="tests_id[]"
                                                        id="managers">
                                                        <option value="" disabled>Select Test</option>
                                                        @forelse ($AllActiveGeneticTest as $test)
                                                            <option value="{{ $test->id }}"
                                                                @foreach ($LaboratoryTests as $mm)
                                                                        @if ($mm['test_id'] == $test->id)
                                                                        selected
                                                                        @endif @endforeach>
                                                                {{ $test->name ?? ' ' }}

                                                                @foreach ($genetic_test_types as $genetic_test_type)
                                                                    @if ($genetic_test_type->value == $test->type)
                                                                        ({{ $genetic_test_type->name }})
                                                                    @endif
                                                                @endforeach

                                                            </option>
                                                        @empty
                                                            <option disabled>Test Not Found
                                                            </option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>








                                            <input type="hidden" name="zipcode" class="form-control" id="txtZip"
                                                maxlength="100">

                                            <!--                          <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="name">Latitude</label> -->
                                            <input type="hidden" name="lat" class="form-control" id="lat"
                                                readonly
                                                value="{{ @$LaboratoryData->LaboratoryMetadata->latitude ?? '' }}">
                                            <!-- </div>
                                                                            </div> -->
                                            <!--   <div class="col-md-6">
                                                                            <div class="form-group"> -->
                                            <!--     <label for="name">Longitude</label> -->
                                            <input type="hidden" name="lng" class="form-control" id="lng"
                                                readonly
                                                value="{{ @$LaboratoryData->LaboratoryMetadata->longitude ?? '' }}">
                                            <!-- </div>
                                                                            </div> -->


                                            <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                                <div class="form-group ">
                                                    <label>Image (500 x 300)</label>

                                                    <div class="upload-img" style="position:relative;">

                                                        <img src="{{ @$LaboratoryData->LaboratoryMetadata->image }}"
                                                            id="thumbnail_preview"
                                                            class="{{ @$LaboratoryData->LaboratoryMetadata->image != null ? '' : 'd-none' }} show-modal"
                                                            style="width:300;height:130px;">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                                                <div class="form-group ">
                                                    <label for="status">Status</label>
                                                    <select disabled class="form-control" id="select" name="status"
                                                        style="background-color: #f5f5f5;">


                                                        @foreach ($status as $status_data)
                                                            <option
                                                                {{ $LaboratoryData->status == $status_data->value ? 'selected' : '' }}
                                                                value="{{ $status_data->value }}">
                                                                {{ $status_data->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            {{-- start discount input  --}}
                                            {{-- 
                                                    <div class="d-flex align-items-center">
                                                    <label>Add Discount</label>
                                                    <input type="checkbox" class="w-auto ml-2" name="" id="addDiscount"> 
                                                    <label class="mb-0 ml-4">Is Partner</label>
                                                    <input type="checkbox" class="w-auto ml-2" name="is_partner">
                                                </div> --}}






                                            {{-- End discount input --}}

                                            {{-- start discount input  --}}


                                            <div class="d-flex align-items-center" style="pointer-events: none;">
                                                <label>Add Discount</label>
                                                <input type="checkbox" name="" id="addDiscount"
                                                    class="w-auto ml-2"
                                                    {{ @$LaboratoryData->LaboratoryMetadata->discount != null ? 'checked' : '' }}>

                                                <label class="mb-0 ml-4">Is Partner</label>
                                                <input class="w-auto ml-2"
                                                    {{ @$LaboratoryData->LaboratoryMetadata->is_partner != null ? 'checked' : '' }}
                                                    type="checkbox" name="is_partner">
                                            </div>




                                            {{-- End discount input --}}



                                        </div>

                                        {{-- <div id="discountInput" class="d-none">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="first_name">Discount(%)<span class="text-danger">
                                                                    *</span></label>
                                                            <input type="number" min="1" max="100" class="form-control"
                                                                id="discount">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        <div id="discountInput"
                                            class="{{ @$LaboratoryData->LaboratoryMetadata->discount != null ? '' : 'd-none' }}">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="first_name">Discount(%)<span class="text-danger">
                                                                *</span></label>
                                                        <input readonly type="number" min="1" max="100"
                                                            class="form-control" id="discount"
                                                            value="{{ @$LaboratoryData->LaboratoryMetadata->discount ?? '' }}"
                                                            {{ @$LaboratoryData->LaboratoryMetadata->discount != null ? 'name=discount' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Laboratory</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <img src="{{ @$LaboratoryData->LaboratoryMetadata->image }}" id="put_me"
                                        width="100%" height="100%">
                                </div>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>

            @endsection

            @section('css')
                <link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
            @stop

            @section('js')




                <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
                <link rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
                <script type="text/javascript"
                    src="https://maps.google.com/maps/api/js?key=AIzaSyBwum8vSJGI-HNtsPVSiK9THpmA2IbgDTg&libraries=places"></script>
                <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>



<script> 

         $(function() {
        var code = "+"+"{{ @$LaboratoryData->LaboratoryMetadata->country_code ?? 49 }}{{ @$LaboratoryData->LaboratoryMetadata->phone_number }}"; // Assigning value from model.
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

                <script>
                    $(".chosen-select").chosen({
                        no_results_text: "Oops, nothing found!",

                    });

                    google.maps.event.addDomListener(window, 'load', initialize);

                    function initialize() {
                        var input = document.getElementById('name');
                        var autocomplete = new google.maps.places.Autocomplete(input);
                        autocomplete.addListener('place_changed', function() {
                            var place = autocomplete.getPlace();
                            $('#lat').val(place.geometry['location'].lat());
                            $('#lng').val(place.geometry['location'].lng());
                            var address = place.formatted_address;
                            var latitude = place.geometry.location.lat();
                            var longitude = place.geometry.location.lng();
                            var latlng = new google.maps.LatLng(latitude, longitude);
                            var geocoder = geocoder = new google.maps.Geocoder();
                            geocoder.geocode({
                                'latLng': latlng
                            }, function(results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    if (results[0]) {
                                        console.log(results);
                                        var address = results[0].formatted_address;
                                        var pin = results[0].address_components[results[0].address_components.length -
                                            1].long_name;
                                        var country = results[0].address_components[results[0].address_components
                                            .length - 2].long_name;
                                        var state = results[0].address_components[results[0].address_components.length -
                                            3].long_name;
                                        var city = results[0].address_components[results[0].address_components.length -
                                            4].long_name;
                                        document.getElementById('txtState').value = state;
                                        //    document.getElementById('txtState').value = state;
                                        document.getElementById('txtCity').value = city;
                                        document.getElementById('txtZip').value = pin;
                                        //  $.ajax({
                                        //      url: "#",
                                        //      type: 'POST',
                                        //      data: {
                                        //          _token: "{{ csrf_token() }}",
                                        //          name: city,
                                        //          country_name: country
                                        //      },
                                        //      success: function(data) {
                                        //          if (data.msg == 1) {
                                        //              $("#name").after(
                                        //                  '<label for="name" generated="true" class="error">The Destination is already existed, Please try another one.</label>'
                                        //              );
                                        //              $(".common_btn").attr('disabled', 'disabled');
                                        //          } else {
                                        //              $(".invalid-dest").remove();
                                        //              $(".common_btn").removeAttr('disabled', 'disabled');
                                        //          }
                                        //      }
                                        //  });
                                    }
                                }
                            });
                        });
                    }
                </script>

                <script>
                    $(document).ready(function() {
                        $('#addLaboratoryForm').validate({
                            ignore: [],
                            debug: false,
                            rules: {
                                lab_name: {
                                    required: true,
                                },
                                charges: {
                                    required: true,
                                },
                                opening_time: {
                                    required: true,
                                },
                                ending_time: {
                                    required: true,
                                },
                                address: {
                                    required: true,
                                },
                                discription: {
                                    required: true,
                                },
                                txtCity: {
                                    required: true,
                                },
                                // thumbnail: {
                                //     required: true,
                                //     accept: "jpg,jpeg,png"
                                // },
                                discount: {
                                    required: true,
                                    digits: true,
                                },


                            },
                            messages: {
                                lab_name: {
                                    required: "Name is required",
                                },
                                charges: {
                                    required: "Charges is required",
                                },
                                opening_time: {
                                    required: "Opening time is required",
                                },
                                ending_time: {
                                    required: "Closing time is required",
                                },
                                address: {
                                    required: "Address is required",
                                },
                                discription: {
                                    required: "Discription is required",
                                },
                                txtCity: {
                                    required: "City is required",
                                },
                                thumbnail: {
                                    required: "Image is required",
                                },
                                discount: {
                                    required: "Discount is required",
                                }
                            }
                        });

                    });



                    $('.timepickercustom').timepicker({
                        'showDuration': true,
                        'timeFormat': 'h:i A'
                    });
                </script>






                <script type="text/javascript">
                    function readURL(input) {

                        if (input.files && input.files[0]) {

                            var files = input.files[0];
                            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                            if (!validImageTypes.includes(files.type)) {
                                swal({
                                    title: "Error",
                                    text: "Invalid image type. Please use only png and jpeg type.",
                                    type: "warning",
                                    showCancelButton: false,
                                });

                                $(".thumbnail_pic").val(null);
                            } else {
                                var reader = new FileReader();
                                reader.onload = function(e) {

                                    $('#thumbnail_preview').css('display', 'block');
                                    $(".remove-pro-img").removeClass("d-none");
                                    $('#thumbnail_preview').attr('src', e.target.result);

                                    // setTimeout(function() {
                                    //     let image_pre = document.getElementById('thumbnail_preview');
                                    //     var width = image_pre.naturalWidth;
                                    //     var height = image_pre.naturalHeight;

                                    //     console.log(width);
                                    //     console.log(height);

                                    //                if(width!=500 || height!=300){
                                    //                    swal({
                                    //       title: "To Large Image",
                                    //       text: "Please upload an image with 500 x 300   pixels dimension !",
                                    //       type: "warning",
                                    //      // showCancelButton: true,
                                    //       confirmButtonColor: "#DD6B55",
                                    //       confirmButtonText: "Change Image!",
                                    //      // closeOnConfirm: false 
                                    //       //  cancelButtonText: "Upload Any Way",   
                                    //     },
                                    //     function(){
                                    //         //swal("Deleted!", "'Please upload an image with 500 x 300   pixels dimension'", "success");  
                                    //          $(".remove-pro-img").addClass("d-none");
                                    //         // $("#thumbnail_preview").css('display', 'none');
                                    //         $("#thumbnail_preview").attr('src','{{ @$LaboratoryData->LaboratoryMetadata->image }}'); 
                                    //          $(".thumbnail_pic").val(null);   


                                    //     });

                                    //     }


                                    // });

                                };

                                reader.readAsDataURL(input.files[0]);
                                // alert(URL.createObjectURL(input.files[0]));


                            }
                        }
                    }



                    $(".remove-pro-img").click(function(evt) {
                        $(".remove-pro-img").addClass("d-none");
                        $("#thumbnail_preview").css('display', 'none');
                        $(".thumbnail_pic").val(null);
                    });
                </script>

                <script>
                    $(document).ready(function() {

                        $("#addDiscount").click(function() {
                            if ($(this).is(':checked')) {
                                //show oos
                                $("#discountInput").removeClass('d-none');
                                $('#discount').attr('name', 'discount');
                            } else {
                                //hide oos
                                $("#discountInput").addClass('d-none');
                                $('#discount').removeAttr('name');
                            }
                        });

                    });


                    $(document).on("click", ".show-modal", function() {
                        // $(".big1").click(function() {
                        // id = $(this).attr('id');
                        // src = $("." + 'view_full' + id).attr('src');
                        // $("#put_me").attr("src", src);
                        $("#exampleModal").modal('show');
                    });
                </script>



            @stop
