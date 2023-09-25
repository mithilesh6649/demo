@extends('adminlte::page')
@section('title', 'Super Admin | Offer Edit  ')
@section('content_header')
@section('content')
<div class="container">
<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Offer Edit</h3>
         </div>
         <div class="card-body">
            <form id="editOfferForm" method="post" action="{{route('offers.update')}}" enctype="multipart/form-data">
               @csrf 
               <input type="hidden" name="offer_id" value="{{ $offer->id }}">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group"> 
                        <label>Offer Name<span class="text-danger"> *</span></label>
                           <input type="text" name="offer_name" class="form-control" id="offer_name" maxlength="100" value="{{ $offer->offer_name }}">
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                         <label for="promocode">Promocode<span class="text-danger"> *</span></label> 
                           <input type="text" name="promocode" class="form-control" id="promocode" maxlength="100" value="{{ $offer->promocode }}">
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group mt-4"> 
                        <label for="start_date">Start Date<span class="text-danger"> *</span></label>
                           <input type="date" name="start_date" class="form-control" id="start_date" maxlength="100" value="{{ $offer->start_date }}">
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group mt-4"> 
                        <label for="end_date">End Date<span class="text-danger"> *</span></label>
                           <input type="date" name="end_date" class="form-control" id="end_date" maxlength="100" value="{{ $offer->end_date }}"> 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                        <div class="form-group mt-4"> 
                         <label for="picture_one">Picture one  (300X500)</label>
                           <input type="file" accept=".png, .jpg, .jpeg" name="picture_one" id="picture_one" onchange="readURL1(this);" class="form-control"> 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                        <div class="form-group mt-4"> 
                        <label for="picture_two">Picture two (448X448) </label>
                           <input type="file" accept=".png, .jpg, .jpeg" name="picture_two" id="picture_two" onchange="readURL2(this);" class="form-control"> 
                        </div>
                     </div>
                  </div>
                  <!-- show thumbnail -->
                  <div class="row">
                     <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                        <div class="list-img mt-3"> 
                           <img src="{{asset('offers/image_one/'.$offer->picture_one)}}" id="thumbnail_preview_1" style="height:130px;">
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                        <div class="list-img mt-3">
                           <img src="{{asset('offers/image_two/'.$offer->picture_two)}}" id="thumbnail_preview_2" style="height:130px;"> 
                        </div>
                     </div>
                  </div>
                  <!-- show thumbnail -->
                  <div class="form-group mt-4">
                   <label for="description">Description<span class="text-danger"> *</span></label>
                     <textarea id="description" name="description" class="form-control">{{$offer->description}}</textarea>
                  </div>
                  <div class="form-group mt-4">
                  <label for="terms_and_conditions">Terms and conditions <span class="text-danger"> *</span></label> 
                     <textarea id="terms_and_conditions" name="terms_and_conditions" class="form-control">{{$offer->terms_and_conditions}}</textarea>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                     <div class="form-group mt-4">
                     <label for="discount_type">Discount type<span class="text-danger"> *</span></label> 
                        <select class="form-control" name="discount_type">
                           <option value="">Select Discount  </option>
                           <option {{ $offer->discount_type == '1' ? 'selected' : ' ' }} value="1">Amount</option> 
                           <option {{ $offer->discount_type == '0' ? 'selected' : ' ' }} value="0">Percentage</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                     <div class="form-group mt-4"> 
                     <label for="title_en">Percentage/Amount <span class="text-danger"> *</span></label>
                        <input type="number" name="discount_amount" class="form-control" id="discount_amount" maxlength="100" value="{{ $offer->discount_amount }}"> 
                     </div>
                  </div>
               </div>
             
               <label class="mb-3 mt-3">Offer applied on 
               <a class="btn info_btn" data-toggle="tooltip" data-placement="right" title="Select at least one " >
               <i class="fa fa-question-circle"></i>
               </a>
               </label> 
               <div class="row mb-3">
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                     <div >
                        <label for="title_en">Min Order</label><br>
                        <div class="border min_order_box"  data-toggle="collapse" data-target="#demo" style="width:fit-content;">
                           <input  class="min_order remove_warning" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Yes" data-off="No" name="minimum_order" {{ $offer->minimum_order== 'on' ? 'checked':'' }} >
                        </div>
                     </div>
                     <div id="demo" class="collapse mt-3">
                        <input type="number"   class="form-control" id="minimum_order_amount" maxlength="100"  value="{{ $offer-> minimum_order_amount}}"   >
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                     <div>
                        <label for="title_en">Order Above Of</label><br>
                        <div  class="border max_order_box remove_warning" data-toggle="collapse" data-target="#demo2" style="width:fit-content;"> 
                           <input   class="max_order" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Yes" data-off="No" name="maximum_order" {{ $offer->maximum_order== 'on' ? 'checked':'' }} >
                        </div>
                     </div>
                     <div id="demo2" class="collapse mt-3">
                        <input type="number"   class="form-control" id="maximum_order_amount" maxlength="100" value="{{ $offer-> maximum_order_amount}}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                     <div  >
                        <label for="title_en">Every Order</label><br>
                        <div class="remove_warning" style="width:fit-content;">
                           <input   class="every_order" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Yes" data-off="No" name="every_order" {{ $offer->every_order== 'on' ? 'checked':'' }}>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                     <div  >
                        <label for="title_en">First Order</label><br>
                        <div class="remove_warning" style="width:fit-content;">
                           <input   class="first_order" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Yes" data-off="No" name="first_order" {{ $offer->first_order== 'on' ? 'checked':'' }}>
                        </div>
                     </div>
                  </div>
                  <div class=" mt-3">
                     <span class="text-danger d-none select_notice"> Select at least one </span>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                     <div class="form-group">
                        <label for="email">Status</label>
                        <div class="form-group radio">
                           <select class="form-control" name="status">
                           <option value="1" {{ $offer->status== 1 ? 'selected':'' }}>Active</option>
                           <option  value="0" {{ $offer->status== 0 ? 'selected':'' }}>Inactive</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer"><button type="submit" class="button btn_bg_color common_btn text-white">Update</button> </div>
            </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection 
@section('css')
@stop
@section('js')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script> 
   $(document).ready(function() {
     
   
   
     $('#editOfferForm').validate({
            ignore: [],
           
       rules: {
         offer_name: {
           required: true
         },
         promocode: {
           required: true,
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
          terms_and_conditions: { 
           required: true
         },
          discount_type: { 
           required: true
         },
          discount_amount: { 
           required: true
         },
          minimum_order_amount: { 
           required: true
         },
          maximum_order_amount: { 
           required: true
         },
       },
       messages: {
         offer_name: {
           required: "Offer name is required"
         },
         promocode: {
           required: "Promocode is required"
         },
          start_date: {
           required: "Start date  is required"
         },
          end_date: {
           required: "End date  is required"
         },
          
         description:{
           required: "Description is required"
         },
          terms_and_conditions:{
           required: "Terms and conditions is required"
         },
          discount_type:{
           required: "Discount type is required"
         },
          discount_amount:{
           required: " Percentage/Amount is required"
         },
          minimum_order_amount:{
           required: " Minimum order amount is required"
         },
          maximum_order_amount:{
           required: " Maximum order amount is required"
         },
          
       },
   submitHandler: function(form) { 
            
              
             if($('.min_order').is(':checked') || $('.max_order').is(':checked') || $('.every_order').is(':checked') || $('.first_order').is(':checked')){
                 return true;
             }else{
                 $('.select_notice').removeClass('d-none');
                 return false;
             } 
   
              
             
   }
     });
   
   
   
   });
</script>
<!-- show image on change -->
<script type="text/javascript">
   function readURL1(input) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
   
       reader.onload = function (e) {
         $('#thumbnail_preview_1').css('display', 'block');
         $('#thumbnail_preview_1').attr('src', e.target.result);
       };
   
       reader.readAsDataURL(input.files[0]);
     }
   }
   
   function readURL2(input) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
   
       reader.onload = function (e) {
         $('#thumbnail_preview_2').css('display', 'block');
         $('#thumbnail_preview_2').attr('src', e.target.result);
       };
   
       reader.readAsDataURL(input.files[0]);
     }
   }
</script>
<!-- show image on change -->
<script>
   $(document).ready(function(){
     
   
        $('#demo').on('shown.bs.collapse', function () {
           $('#minimum_order_amount').attr('name', 'minimum_order_amount');
       });
   
       $("#demo").on("hide.bs.collapse",function(){
         $('#minimum_order_amount').removeAttr('name', 'minimum_order_amount');
       }); 
        
        $('#demo2').on('shown.bs.collapse', function () {
             $('#maximum_order_amount').attr('name', 'maximum_order_amount');
       });
   
       $("#demo2").on("hide.bs.collapse",function(){
         $('#maximum_order_amount').removeAttr('name', 'maximum_order_amount');
       }); 
    
       if('{{$offer->minimum_order}}' == 'on'){
          $('.min_order_box').trigger('click');
       }
   
       
        if('{{$offer->maximum_order}}' == 'on'){
          $('.max_order_box').trigger('click');
       }
   
   
       
          $(".remove_warning").each(function(){
            $(this).click(function(){
              $('.select_notice').addClass('d-none');
            });
       });
   
      
      });
   
</script>
@stop
