@extends('adminlte::page')
@section('title', 'Disease Details')
@section('content_header')
@section('content')


    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0">Disease Details</h3>
                                <a class="btn btn-sm btn-success add-advance-options"
                                    href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                            </div>
                            <div class="card-body main_body form p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form id="addCurrentOfferForm" method="post" action="{{ route('save_genetic_test') }}"
                                    enctype="multipart/form-data" style="pointer-events: none;">
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
                                        <div class="information_fields mb-0">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group"> <label>Name </label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name" maxlength="100" value="{{ $data->name ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="description">Description </label>
                                                        <input type="text" name="description" class="form-control"
                                                            id="description" maxlength="100"
                                                            value="{{ $data->description ?? '' }}">
                                                    </div>
                                                </div>



                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 ">
                                                    <div class="form-group ">
                                                        <label for="status">Status </label>
                                                        <select class="form-control" id="select" name="status">


                                                            @foreach ($status as $statu)
                                                                <option {{ $statu->value == $data->status ? 'selected' : '' }}
                                                                    value="{{ $statu->value }}">{{ $statu->name }}</option>
                                                            @endforeach


                                                        </select>
                                                    </div>
                                                </div>

                                                {{--  
                           <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                              <div class="list mt-4 mb-3">
                                 <label>Image (500 x 300) </label>

                              <div class="list-img mt-3"> 
                                 <img src="{{$data->image}}"  class="offer_image_box "  current_image='pic_one' style="height:130px;"> 
                                 </div>


                              </div>
                           </div>   --}}



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


    <!-- <style type="text/css">
       .card-header .title {
        font-size: 15px;
        color: #000;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 52vw;
        font-weight: 600;
    }
    .card-header .accicon {
        font-size: 20px;
        display: flex;
        justify-content: end;
    }
    .card-header{
      cursor: pointer;
    }
    .card{
      border: 1px solid #ddd;
    }
    .card-header:not(.collapsed) .rotate-icon {
      transform: rotate(180deg);
    }
    .form-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
    }
    .content-wrapper .card-body .form-group label {
      order: 1;
    }
    .emojionearea.form-control.emojionearea-inline, .content-wrapper .card-body .form-group select,
    .content-wrapper .card-body .form-group input.form-control {
      order: 2;
    }
    .content-wrapper .card-body .form-group label.error {
        order: 3;
        padding: 5px 0 0;

    </style> -->
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

    <script>
        // $(document).ready(function() {
        //        $('#addCurrentOfferForm').validate({
        //           ignore: [],

        //      rules: {
        //        offer_name: {
        //          required: true
        //        },
        //         start_date: {
        //          required: true
        //        },
        //         end_date: {
        //          required: true
        //        },
        //        description: { 
        //          required: true
        //        },
        //        offer_amount: { 
        //          required: true 
        //        },
        //       //  "associated_item_id[]":{
        //       //    required:true,

        //       // },
        //       offer_type:{
        //          required:true,
        //       },
        //       thumbnail:{
        //          required:true,
        //       },
        //       thumbnail_popup:{
        //          required:true,
        //       }

        //      }, 
        //      messages: {
        //        offer_name: {
        //          required: "Offer Name is required"
        //        },

        //         start_date: {
        //          required: "Start Date/ Time  is required"
        //        },
        //         end_date: {
        //          required: "End Date/ Time  is required"
        //        },

        //        description:{
        //          required: "Description is required"
        //        },
        //         terms_and_conditions:{
        //          required: "Terms and conditions is required"
        //        },
        //         offer_amount:{
        //          required: "Amount is required"
        //        },
        //    "associated_item_id[]":{
        //    required:"Items is required",
        //    },
        //      thumbnail_popup:{
        //          required:"Popup image is required"
        //       },
        //         thumbnail:{
        //          required:"Image is required"
        //       },
        //    offer_type:{
        //       required:"Current offer type is required"
        //    }  
        //      },


        //    });

        // });




        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",

        })


        //  $("#description").emojioneArea({
        //    pickerPosition: "bottom",
        //    filtersPosition: "bottom",
        //    tonesStyle: "square",
        //    shortnames: true,
        //    tones:false,
        //    search:false,
        // });


        // $("#offer_name").emojioneArea({
        //    pickerPosition: "right",
        // });


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
