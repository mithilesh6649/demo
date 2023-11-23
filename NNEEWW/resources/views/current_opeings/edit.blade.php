@extends('adminlte::page')
@section('title', 'Edit Job')
@section('content_header')
@section('content')


<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Edit Job</h3>
                            <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body main_body form p-3">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form id="addCurrentOfferForm" method="post" action="{{ route('update_current_opening') }}"
                            enctype="multipart/form-data">
                            @csrf
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

                                <input type="hidden" name="job_id" value="{{$data->id ?? ''}}">
                                <div class="information_fields mb-0">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
                                            <div class="form-group"> <label> Job Title<span class="text-danger">
                                            *</span></label>
                                            <input type="text" name="job_title" class="form-control"
                                            id="job_title" maxlength="100" value="{{$data->job_title ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
                                        <div class="form-group"> <label> Department<span class="text-danger">
                                        *</span></label>
                                        <input type="text" name="department" class="form-control"
                                        id="department" maxlength="100" value="{{$data->department ?? ''}}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
                                    <div class="form-group"> <label>Location<span class="text-danger">
                                    *</span></label>
                                    <input type="text" name="location" class="form-control"
                                    id="location" maxlength="100" value="{{$data->location ?? ''}}">
                                </div>
                            </div>



                            <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                                <div class="form-group ">
                                    <label for="employee_type">Employee Type<span class="text-danger">
                                    *</span></label>
                                    <select class="form-control" id="select" name="employee_type">
                                       <option value="">Select Employee Type</option>
                                       <option {{$data->employee_type == 1 ? 'selected':''}} value="1">Full TIme</option>

                                       <option {{$data->employee_type == 0 ? 'selected':''}} value="0">Part TIme</option>

                                   </select>
                               </div>
                           </div>






                           <div class="col-md-12 mb-3">
                            <label for="description">Description<span class="text-danger">
                            *</span></label>
                            <textarea id="description" name="description">{{$data->description ?? ''}}</textarea>
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="description"
                                    class="custom-control-input">
                                    @if ($errors->has('description'))
                                    <div class="error">{{ $errors->first('description') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>









                        <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                            <div class="form-group ">
                                <label for="status">Status<span class="text-danger">
                                *</span></label>
                                <select class="form-control" id="select" name="status">


                                    @foreach ($status as $statu)
                                    <option value="{{ $statu->value }}">{{ $statu->name }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="text"
                class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.update') }}</button>
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
<script src="{{ asset('assets/ckeditor_2/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor_2/samples/js/sample.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#addCurrentOfferForm').validate({
            ignore: [],

            rules: {
                job_title: {
                    required: true
                },
                description: {
                    required: function() {
                        CKEDITOR.instances.description.updateElement();
                    },
                    minlength: 10
                },
                department: {
                    required: true,
                },
                location: {
                    required: true,
                },
                employee_type: {
                    required: true,
                },


            },
            messages: {
                job_title: {
                    required: "Job Title is required"
                },

                description: {
                    required: "Description  is required"
                },
                department: {
                    required: "Department  is required"
                },

                location: {
                    required: "Location is required"
                },

                employee_type: {
                    required: "Employee Type is required"
                },

            },


        });

    });




    $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!",

    })



    CKEDITOR.replace('description', {
            // customConfig: 'config.js',
            // toolbar: 'simple'
    })

    CKEDITOR.replace('additional_info', {
            // customConfig: 'config.js',
            // toolbar: 'simple'
    })

    $(".checkoutoffers_date").datetimepicker({
        timepicker: true,
        formatTime: 'g:i A',
        format: 'd/m/Y g:i A',
        validateOnBlur: false,
        minDate: 0
    });

    $(".catselect").select2();
</script>
<!-- show image on change -->
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#thumbnail_preview').css('display', 'block');
                $(".remove-pro-img").removeClass("d-none");
                $('#thumbnail_preview').attr('src', e.target.result);

                setTimeout(function() {

                    let image_pre = document.getElementById('thumbnail_preview');
                    var width = image_pre.naturalWidth;
                    var height = image_pre.naturalHeight;

                    console.log(width);
                    console.log(height);

                        //            if(width!=500 || height!=300){
                        //                swal({
                        //   title: "To Large Image",
                        //   text: "Please upload an image with 500 x 300   pixels dimension !",
                        //   type: "warning",
                        //  // showCancelButton: true,
                        //   confirmButtonColor: "#DD6B55",
                        //   confirmButtonText: "Change Image!",
                        //  // closeOnConfirm: false 
                        //   //  cancelButtonText: "Upload Any Way",   
                        // },
                        // function(){
                        //     //swal("Deleted!", "'Please upload an image with 500 x 300   pixels dimension'", "success");  
                        //      $(".remove-pro-img").addClass("d-none");
                        //      $("#thumbnail_preview").css('display', 'none');
                        //      $(".thumbnail_pic").val(null);   


                        // });

                        // }


                });




            };

            reader.readAsDataURL(input.files[0]);
                // alert(URL.createObjectURL(input.files[0]));


        }
    }



    $(".remove-pro-img").click(function(evt) {

        $(".remove-pro-img").addClass("d-none");
        $("#thumbnail_preview").css('display', 'none');

        $(".thumbnail_pic").val(null);


    });
</script>
<!-- show image on change -->
<!-- show image on change -->
<script type="text/javascript">
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#thumbnail_preview_two').css('display', 'block');
                $(".remove-pro-img-two").removeClass("d-none");
                $('#thumbnail_preview_two').attr('src', e.target.result);

                let image_pre = document.getElementById('thumbnail_preview_two');
                var width = image_pre.naturalWidth;
                var height = image_pre.naturalHeight;
                console.log(width);
                console.log(height);


                setTimeout(function() {

                    let image_pre = document.getElementById('thumbnail_preview_two');
                    var width = image_pre.naturalWidth;
                    var height = image_pre.naturalHeight;

                    console.log(width);
                    console.log(height);

                    if (width != 448 || height != 448) {
                        swal({
                            title: "To Large Image",
                            text: "Please upload an image with 448 x 448   pixels dimension !",
                            type: "warning",
                                    // showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Change Image!",
                                    // closeOnConfirm: false 
                                    //cancelButtonText: "Upload Any Way",   
                        },
                        function() {
                                    //swal("Deleted!", "'Please upload an image with 500 x 300   pixels dimension'", "success");  
                            $(".remove-pro-img-two").addClass("d-none");
                            $("#thumbnail_preview_two").css('display', 'none');
                            $(".thumbnail_pic_two").val(null);


                        });

                    }


                });



            };

            reader.readAsDataURL(input.files[0]);
        }
    }



    $(".remove-pro-img-two").click(function(evt) {

        $(".remove-pro-img-two").addClass("d-none");
        $("#thumbnail_preview_two").css('display', 'none');

        $(".thumbnail_pic_two").val(null);


    });
</script>
<!-- show image on change -->
@stop
