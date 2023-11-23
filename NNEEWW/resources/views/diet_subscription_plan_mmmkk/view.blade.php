@extends('adminlte::page')
@section('title', 'Diet Subscription Plan Details')
@section('content_header')
@section('content')

 
    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0">Diet Subscription Plan Details</h3>
                                <a class="btn btn-sm btn-success add-advance-options"
                                    href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                            </div>
                            <div class="card-body main_body form p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form id="EditSpecializationForm" method="post"
                                    action="{{ route('diet.subscription.plan.update') }}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="diet_subscription_plan_id" value="{{ $data->id }}">

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


                                                <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
                                                    <div class="form-group"> <label>Title 
                                                        </label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name" maxlength="100" value="{{ $data->name ?? '' }}" readonly>
                                                    </div>
                                                </div> 
  
                                
                                                     

                                          <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="monthly_amount"> {{ $data->id == 4 ? '2 Months Price':'Monthly Price' }}</label>
                                                <input type="text" name="monthly_amount" class="form-control"
                                                    id="monthly_amount" value="{{ $data->monthly_amount ?? '' }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 {{ $data->id == 4 ? 'd-none':'' }}">
                                            <div class="form-group">
                                                <label for="quaterly_amount">Quaterly Price( Per Months)</label>
                                                <input type="text" name="quaterly_amount" class="form-control"
                                                    id="quaterly_amount" value="{{ $data->quaterly_amount ?? '' }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 {{ $data->id == 4 ? 'd-none':'' }}">
                                            <div class="form-group">
                                                <label for="yearly_amount">Yearly Price (Per Months)</label>
                                                <input type="text" name="yearly_amount" class="form-control"
                                                    id="yearly_amount" value="{{ $data->yearly_amount ?? '' }}" readonly>
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripiton">Description </label>
                                                <textarea readonly name="description" rows="1" style="width: 100%;border:1px solid #ced4da;">{{ $data->description ?? '' }}</textarea>
                                            </div>
                                        </div>


                                         <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12" style="pointer-events:none;">
                                                <div class="form-group">
                                                    <label>Diet Subscription Feature</label>
                                                    <select data-placeholder="Select Test" multiple
                                                        class="chosen-select form-control" name="tests_id[]"
                                                        id="managers">
                                                        <option value="" disabled>Select Diet Subscription Feature</option>
                                                        @forelse ($allPlanFeatures as $featuress)
                                                          <option value="{{$featuress->id}}" @foreach ($data->DietSubscriptionFeatureMap as $mm)
@if ($mm['feature_id'] == $featuress->id)
selected
@endif @endforeach>{{$featuress->name?? '--'}}</option> 
                                                        @empty
                                                            <option disabled>Diet Subscription Feature Not Found
                                                            </option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>



                                       

 

                                                      <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                                    <div class="list mb-3">
                                                        <label>Image (500 x 300) </label>

                                                        <div class="list-img">
                                                            @if (!empty($data->image))
                                                                <img src="{{ $data->image }}"
                                                                    class="offer_image_box show-modal "
                                                                    current_image='pic_one' style="height:130px;">
                                                            @else
                                                                Image not available
                                                            @endif
                                                        </div>


                                                    </div>
                                                </div>


                                                   <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                                            <div class="form-group ">
                                                <label for="status">Status </label>
                                                <select disabled class="form-control" id="select" name="status">


                                                    @foreach ($status as $statu)
                                                    <option {{$data->status == $statu->value ? 'selected':''}} value="{{ $statu->value }}">{{ $statu->name }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>


                                 

                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 {{ $data->id == 4 ? 'd-none':'' }}" style="pointer-events:none;">
                                                 
                                                {{-- start discount input  --}}

                                                <div class="d-flex align-items-center">
                                                     
                                                    <label class="mb-0">Is Paid</label><input type="checkbox"
                                                        class="w-auto ml-2" name="is_paid" id="is_paid" {{$data->is_free != 1? 'checked':''}}>
                                                </div>


                                                 <div id="discountInput" class="{{$data->is_free != 1 ? '':'d-none'}}" 
                                            >
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="first_name">Discount(%) </label>
                                                        <input type="number"  name="discount" max="100"
                                                            class="form-control" id="discount"
                                                            value="{{$data->discount}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                               </div>
                                               
                                            
                                           






                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    
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
                },
                messages: {
                    name: {
                        required: "Name is required"
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

@stop
