@extends('adminlte::page')
@section('title', 'Current Offer Details')
@section('content_header')
@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Current Offer Details</h3>
                  <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
               </div>
               <div class="card-body table p-0 mb-0">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                  </div>
                  @endif
                  <form id="addCurrentOfferForm" method="post" action="{{ route('current.offers.homepage.save') }}" enctype="multipart/form-data">
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
                              <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3" style="pointer-events:none;">
                                 <div class="form-group"> <label>Offer Name </label>
                                    <input type="text" name="offer_name" value="{{$HomePageOffer->offer_name}}" class="form-control" id="offer_name" maxlength="100"  > 
                                 </div>
                              </div>
                              <div class="col-md-6 mb-3" style="pointer-events:none;">
                                 <div class="form-group">
                                    <label for="description">Description</label> 
                                    <input type="text" name="description" value="{{$HomePageOffer->description}}"  class="form-control" id="description" maxlength="100"  > 
                                 </div>
                              </div>

                                        <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                                 <div class="form-group ">
                                    <label for="discount_type"> Current Offer Type </label> 
                                    <select disabled class="form-control" id="select" name="offer_type">
                                       <option value="">Select Current Offer Type</option>

                                        @foreach ($current_offer_types as $current_offer_type)
                                          <option  {{$HomePageOffer->offer_type == $current_offer_type->value ? 'selected':'' }}  value="{{$current_offer_type->value}}">{{$current_offer_type->name}}</option>
                                        @endforeach
                                      
                                      <!--  <option   value="1">Offer</option> 
                                       <option   value="1">Add</option>  -->
                                    </select>
                                 </div>
                              </div>

                                  <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
                           <div class="form-group"> <label for="title_en">Amount </label> <input type="number" name="offer_amount" class="form-control" id="discount_amount" maxlength="100" value="{{$HomePageOffer->offer_amount ?? 'N/A'}}" readonly> </div>
                           </div>
                     
                              <!-- show thumbnail -->  
                              <div class="col-md-6 col-lg-6 col-xl-6 col-12" style="pointer-events:none;">
                                 <div class="form-group "> <label for="start_date">Start Date/ Time </label> <input type="text" name="start_date" class="form-control checkoutoffers_date" id="start_date" maxlength="100" autocomplete="off" value="{{date('d/m/Y h:00 A',strtotime($HomePageOffer->start_date))}}"  > </div>
                              </div>
                              <div class="col-md-6 col-lg-6 col-xl-6 col-12" style="pointer-events:none;">
                                 <div class="form-group "> <label for="end_date">End Date/ Time </label> <input type="text" name="end_date" class="form-control checkoutoffers_date" id="end_date" maxlength="100" autocomplete="off" value="{{date('d/m/Y h:00 A',strtotime($HomePageOffer->end_date))}}" > </div>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12 d-none">
                                 <div class="form-group mt-3" style="pointer-events: none;">
                                    <label>Select Items</label> 
                                    <select data-placeholder="Select Items" multiple class="chosen-select form-control" name="associated_item_id[]" id="managers">
                                       <option value="" disabled>Select Items <span class="text-danger"> *</span></option>
                                       @forelse ($MenuItems as $MenuItem)
                                       <option 

                                                                        @foreach ($HomePageOfferAssociation as $mm)
                  @if ($mm['associated_item_id'] == $MenuItem->id)
                  selected
                  @endif @endforeach

                                        value="{{ $MenuItem->id }}">{{ $MenuItem->item_name_en  ?? ' '}} ({{ $MenuItem->item_name_ar  ?? ' '}} )  </option>
                                       @empty
                                       <option disabled >Menu Item Not Found !</option>
                                       @endforelse
                                    </select>
                                 </div>
                              </div>
                              



 
                              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12 d-none">
                                 <div class="form-group mt-3">
                                    <label>Select Free Item   </label> 
                                    <select disabled class="advance_category_search catselect" name="offer_item_id">
                                       <option value="">Items</option>
                                       @forelse ($MenuItems as $MenuItem)
                                       <option {{ $MenuItem->id==$HomePageOffer->offer_item_id ? 'selected':''}}  value="{{ $MenuItem->id }}">{{ $MenuItem->item_name_en  ?? ' '}} ({{ $MenuItem->item_name_ar  ?? ' '}} )  </option>
                                       @empty
                                       <option disabled >Menu Item Not Found !</option>
                                       @endforelse  
                                    </select> 
                                 </div>
                              </div>
                     

                     <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                        <div class="list mt-4 mb-3">
                            <label>Image (500 x 300) </label>
                          <div class="list-img mt-3"> 
                            <img src="{{asset('offers/current_offer/'.$HomePageOffer->regular_image)}}"  class="offer_image_box "  current_image='pic_one' style="height:130px;"> 
                          </div>
                        </div>
                      </div>  
                     
                     <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                        <div class="list mt-4 mb-3">
                           <label> Popup Image (448 * 448 )</label>
                          <div class="list-img mt-3"> 
                            <img src="{{asset('offers/current_offer_popup/'.$HomePageOffer->pop_up_image)}}"  class="offer_image_box "  current_image='pic_one' style="height:130px;"> 
                          </div>
                        </div>
                      </div>  




                              <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                 <div class="form-group mt-3">
                                    <label for="start_date">Status</label>
                                    <select disabled name="offer_status" class="valid" aria-invalid="false">
                                       <option {{ $HomePageOffer->status=="1"? 'selected':''}} value="1">Active</option>
                                       <option {{ $HomePageOffer->status=="0"? 'selected':''}} value="0">Inactive</option>
                                    </select>
                                 </div>
                              </div>

                                  <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                 <div class="form-group mt-3">
                                    <label for="start_date">Popup Image Status</label>
                                    <select disabled name="popup_image_status" class="valid" aria-invalid="false">
                                       <option {{ $HomePageOffer->pop_up_image_status=="1"? 'selected':''}} value="1">Active</option>
                                       <option {{ $HomePageOffer->pop_up_image_status=="0"? 'selected':''}}  value="0">Inactive</option>
                                    </select>
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
@endsection
@section('css')
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop
@section('js')
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script>
   $(document).ready(function() {
          $('#addCurrentOfferForm').validate({
             ignore: [],
            
        rules: {
          offer_name: {
            required: true
          },
           start_date: {
            required: true
          },
           end_date: {
            required: true
          },
          description: { 
            required: true
          },
          offer_type: { 
            required: true
          },
          "associated_item_id[]":{
            required:true,

         },
         offer_item_id:{
            required:true,
         }
           
        },
        messages: {
          offer_name: {
            required: "Offer Name is required"
          },
         
           start_date: {
            required: "Start Date/ Time  is required"
          },
           end_date: {
            required: "End Date/ Time  is required"
          },
         
          description:{
            required: "Description is required"
          },
           terms_and_conditions:{
            required: "Terms and conditions is required"
          },
           offer_type:{
            required: "Offer Type is required"
          },
            "associated_item_id[]":{
        required:"Items is required",
      },
      offer_item_id:{
         required:"Free Item is required"
      }  
        },
 

      });

   });
   
   
   
   
   $(".chosen-select").chosen({
    no_results_text: "Oops, nothing found!",

 }) 
   
   
   $("#description").emojioneArea({
     pickerPosition: "bottom",
     filtersPosition: "bottom",
     tonesStyle: "square",
     shortnames: true,
     tones:false,
     search:false,
  });
   
   
   $("#offer_name").emojioneArea({
      pickerPosition: "right",
   });
   
   
   $( ".checkoutoffers_date" ).datetimepicker({
    timepicker:true,
    formatTime: 'g:i A',
    format : 'd/m/Y g:i A',
    validateOnBlur: false,
    minDate : 0
 });

   $(".catselect").select2();
   
</script>
<!-- show image on change -->
<script type="text/javascript">
   function readURL(input) {
    if (input.files && input.files[0]) {
     var reader = new FileReader();

     reader.onload = function (e) {
      $('#thumbnail_preview').css('display', 'block');
      $(".remove-pro-img").removeClass("d-none");
      $('#thumbnail_preview').attr('src', e.target.result);
         let image_pre = document.getElementById('thumbnail_preview');
               var  width = image_pre.naturalWidth;
               var  height = image_pre.naturalHeight;
                 console.log(width);
                 console.log(height);

//                swal({
//   title: "Are you sure?",
//   text: "You will not be able to recover this imaginary file!",
//   type: "warning",
//   showCancelButton: true,
//   confirmButtonColor: "#DD6B55",
//   confirmButtonText: "Yes, delete it!",
//   closeOnConfirm: false 
// },
// function(){
//   swal("Deleted!", "'Please upload an image with 500 x 300   pixels dimension'", "success");
// });
   




   };
   
   reader.readAsDataURL(input.files[0]);
   // alert(URL.createObjectURL(input.files[0]));
             

}
}



$(".remove-pro-img").click(function(evt){      

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

     reader.onload = function (e) {
      $('#thumbnail_preview_two').css('display', 'block');
      $(".remove-pro-img-two").removeClass("d-none");
      $('#thumbnail_preview_two').attr('src', e.target.result);

       let image_pre = document.getElementById('thumbnail_preview_two');
               var  width = image_pre.naturalWidth;
               var  height = image_pre.naturalHeight;
                 console.log(width);
                 console.log(height);

   };
   
   reader.readAsDataURL(input.files[0]);
} 
}



$(".remove-pro-img-two").click(function(evt){      

 $(".remove-pro-img-two").addClass("d-none");
 $("#thumbnail_preview_two").css('display', 'none');

 $(".thumbnail_pic_two").val(null);  


});
</script>
<!-- show image on change -->
@stop
