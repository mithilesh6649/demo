@extends('adminlte::page')
@section('title', 'Diet Subscription Sub Plan')
@section('content_header')
@section('content')
 
 
<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Diet Subscription Sub Plan  </h3>
                            <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body main_body form p-3">


                            <div class="container">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs d-none" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist d-none active" data-toggle="tab"
                                        href="#home">Diet Subscription Plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist d-none  " data-toggle="tab"
                                        href="#documents">Diet Subscription Sub Plan</a>
                                    </li>
                                    
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="home" class="container tab-pane active ">                     
                                        <span class="badge badge-pill badge-primary mb-3"> Step 1 :- Create Sub Plan</span>
                                        @include('diet_subscription_sub_plan.partial.diet_subscription_plans')
                                    </div>

                                    <div id="documents" class="container tab-pane  fade"><br>

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
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
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
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
<script>
    $(document).ready(function() {

       $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!",
       });

       $('#EditSpecializationForm').validate({
        ignore: [],

        rules: {
            name: {
                required: true
            },
            amount:{
                required:true
            },
            "features_id[]":{
                required:true
            },
            "plan_amount[0][]":{
                required:true
            },
            "plan_amount[1][]":{
                required:true
            },
            "plan_amount[2][]":{
                required:true
            },
            "plan_amount[3][]":{
                required:true
            },
            "plan_amount[4][]":{
                required:true
            },
            "plan_amount[5][]":{
                required:true
            },
            "plan_amount[6][]":{
                required:true
            },
            "plan_amount[7][]":{
                required:true
            },
            "plan_amount[8][]":{
                required:true
            },
            "plan_amount[9][]":{
                required:true
            },
            "plan_amount[10][]":{
                required:true
            },
            "plan_duration[0][]":{
                required:true
            },
             "plan_duration[1][]":{
                required:true
            },
             "plan_duration[2][]":{
                required:true
            },
             "plan_duration[3][]":{
                required:true
            },
             "plan_duration[4][]":{
                required:true
            },
             "plan_duration[5][]":{
                required:true
            },
             "plan_duration[6][]":{
                required:true
            },
             "plan_duration[7][]":{
                required:true
            },
             "plan_duration[8][]":{
                required:true
            },
             "plan_duration[9][]":{
                required:true
            },
             "plan_duration[10][]":{
                required:true
            },  
        },
        messages: {
            name: {
                required: "Name is required"
            },
            amount: {
                required: "Amount is required"
            },
            "features_id[]":{
                required:"Diet Subscription Sub Feature is required"
            },
             "plan_amount[0][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[1][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[2][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[3][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[4][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[5][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[6][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[7][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[8][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[9][]":{
                 required: "Plan amount is required"
            },
            "plan_amount[10][]":{
                 required: "Plan amount is required"
            },
                 "plan_duration[0][]":{
                 required: "Plan Duration is required"
            },
             "plan_duration[1][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[2][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[3][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[4][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[5][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[6][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[7][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[8][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[9][]":{
               required: "Plan Duration is required"
            },
             "plan_duration[10][]":{
               required: "Plan Duration is required"
            },

        },


    });

   });
</script>
<!-- show image on change -->
<script type="text/javascript">
    var img_src = $('#thumbnail_preview').attr('src');

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#thumbnail_preview').removeClass("d-none");
                $(".remove-pro-img").removeClass("d-none");
                $('#thumbnail_preview').attr('src', e.target.result);
                let image_pre = document.getElementById('thumbnail_preview');
                var width = image_pre.naturalWidth;
                var height = image_pre.naturalHeight;
                console.log(width);
                console.log(height);

                    //             setTimeout(function(){

                    //           let image_pre = document.getElementById('thumbnail_preview');
                    //                var  width = image_pre.naturalWidth;
                    //                var  height = image_pre.naturalHeight;

                    //                 console.log(width);
                    //                  console.log(height);

                    //            if(width!=500 || height!=300){
                    //                swal({
                    //   title: "To Large Image",
                    //   text: "Please upload an image with 500 x 300   pixels dimension !",
                    //   type: "warning",
                    //  // showCancelButton: true,
                    //   confirmButtonColor: "#DD6B55",
                    //   confirmButtonText: "Change Image!",
                    //  // closeOnConfirm: false 
                    //  //   cancelButtonText: "Upload Any Way",   
                    // },
                    // function(){
                    //     //swal("Deleted!", "'Please upload an image with 500 x 300   pixels dimension'", "success");  
                    //      $(".remove-pro-img").addClass("d-none");
                    //  //    $("#thumbnail_preview").css('display', 'none');
                    //       $('#thumbnail_preview').attr('src',img_src);
                    //      $(".thumbnail_pic").val(null);   


                    // });

                    // }


                    //       });





            };

            reader.readAsDataURL(input.files[0]);
                // alert(URL.createObjectURL(input.files[0]));


        }
    }



    $(".remove-pro-img").click(function(evt) {

        $(".remove-pro-img").addClass("d-none");
        $("#thumbnail_preview").addClass("d-none");

        $(".thumbnail_pic").val(null);


    });
</script>


<script>
    $(document).ready(function() {

        $("#is_paid").click(function() {
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
</script>

<!-- show image on change -->


<script>
    $(document).ready(function(){
       var count = 0;
       $('#add_plan_btn').click( () => {
         count++;
        var plan_desing = ` <div class="row choices_child border p-4 mb-3">
        <div class="col-md-4  col-lg-4  col-xl-4 col-12">
        <div class="form-group">
        <label for="duration[]">Select Plan Duration</label>
        <select name="plan_duration[`+count+`][]" id="plan_duration`+count+`" class="form-control">
          <option value="">Select Plan Duration</option>
        @foreach($MonthDurations as $MonthDuration)
        <option value="{{$MonthDuration->value}}">{{$MonthDuration->name}}</option>
        @endforeach
        </select>
        </div>
        </div>
        <div class="col-md-4  col-lg-4  col-xl-4 col-12">
        <div class="mainArabicChoiceContainer">
        <div class="form-group">
        <label for="amount">Amount<span
        class="text-danger"> *</span></label>
        <input type="number" name="plan_amount[`+count+`][]" class="form-control"
        value="" step="any">
        </div>
        </div>
        </div>
        <div class="col-md-3  col-lg-3  col-xl-3 col-12">
        <div class="form-group">
        <label for="discount">Discount  </label>
        <input type="number" name="plan_discount[`+count+`][]" class="form-control"
        value="" step="any">
        </div>
        </div>
        <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">
        <i class="text-danger fa fa-trash-alt delete-button-just-created" style="font-size:28px;cursor:pointer;"></i> <!-- <i
        class="text-success"
        style="font-size:14px; margin-top:20px;">Default</i> -->
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
        <div class="form-group">
        <label>Diet Subscription Sub Feature</label>
        <select data-placeholder="Select Diet Subscription Sub Feature" multiple
        class="chosen-select form-control" name="plan_feature_id[`+count+`][]"
        id="managers">
        <option value="" disabled>Select Diet Subscription Feature</option>
        @forelse ($allDietSubPlanDurationFeatures as $featuress)
        <option value="{{$featuress->id}}">{!!$featuress->name?? '--'!!}</option>
        @empty
        <option disabled>Diet Subscription Feature Not Found
        </option>
        @endforelse
        </select>
        </div>
        </div>

        </div>`;

        $('#plan_container').append(plan_desing); 
        
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",
        });


        // $('.delete-button-just-created').click(()=>{
        //    console.log($(this));
        //      //$(this).parent().remove();
        // });

        $(document).on("click", ".delete-button-just-created", function () {
           var element = $(this).parent().parent().remove();
          console.log(element);
        });

    });
   });
</script>

@stop
