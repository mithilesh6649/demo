@extends('adminlte::page')

@section('title', 'Super Admin | Edit Gift Cards')

@section('content_header')
 

@section('content')

 
 
<div class="container">
<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
         <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
               <h3> Gift Cards Details</h3>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body p-0">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif 
               <form id="addGiftCard" method="post" action="{{ route('gift.card.save') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body table form mb-0">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                           <div class="form-group">
                              <label for="title">Title {{ labelEnglish() }} </label>
                              <input type="text" name="title" class="form-control" id="tilte"   maxlength="100" value="{{$GiftCard->title ?? 'N/A'}}" readonly> 
                           </div>
                        </div>

                         <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                           <div class="form-group">
                              <label for="title_ar">Title {{ labelArabic() }} </label>
                              <input type="text" name="title_ar" class="form-control" id="title_ar"   maxlength="100" value="{{$GiftCard->title_ar ?? 'N/A'}}" readonly>
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group">
                              <label for="description">Description {{ labelEnglish() }} </label>
                              <textarea name="description" style="height:60px;" maxlength="500"  readonly >{{$GiftCard->description ?? 'N/A'}}</textarea>
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group">
                              <label for="description_ar">Description {{ labelArabic() }} </label>
                              <textarea name="description_ar" style="height:60px;" maxlength="500"  readonly>{{$GiftCard->description_ar ?? 'N/A'}}</textarea>
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group ">
                              <label for="card_type">Card type </label> 
                              <select class="form-control" name="gift_cards_type_id" id="gift_cards_type_id" disabled>
                                 <option value="">Select  Card Type</option>
                                 @foreach($gift_card_type as $card_type)
                                 <option {{$card_type->id == $GiftCard->gift_cards_type_id ? 'selected':''}}  value="{{$card_type->id}}">{{$card_type->name}} KD</option>
                                 @endforeach
                              </select>
                           </div> 
                        </div> 
                  
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group  "> <label for="start_number">Card number  </label> <input type="number" name="start_number" class="form-control" id="start_number" min="0" maxlength="100" value="{{$GiftCard->card_number}}" readonly> </div>
                        </div>
                        

                             <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group ">
                              <label for="status">Is Gift Card Used </label> 
                               <input type="text" name="title_ar" class="form-control" id="title_ar"   maxlength="100" value="{{$GiftCard->is_gift_card_used == 1 ? 'Yes':'No'}}" readonly>
                           </div>
                        </div>
 
 
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group ">
                              <label for="status">Status </label> 
                               <input type="text" name="title_ar" class="form-control" id="title_ar"   maxlength="100" value="{{$GiftCard->status == 1 ? 'Active':'Inactive'}}" readonly>
                           </div>
                        </div>
 
                     </div>
                    
               </form>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>


@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
 
@stop

@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>


<script>
    $(document).ready(function() {  
    
      $( ".checkoutoffers_date" ).datetimepicker({
            timepicker:true,
            formatTime: 'g:i A',
            format : 'd/m/Y g:i A',
            validateOnBlur: false,
            minDate : 0
         });



      $('#addGiftCard').validate({
        ignore: [],
        debug: false,
        rules: {
          title: {
            required: true,
           
          },
            
           description: {
            required: true,
          },
           start_date: {
            required: true,
          },
           end_date: {
            required: true, 
            
          },
           price: {
            required: true,
          },
          //  thumbnail: {
          //   required: true,
          // },
           card_type: {
            required: true,
          },

          
        },
        messages: {
          title: {
            required: "Title is required",
          },
          description: {
            required: "Description  is required",
          },
            start_date: {
            required: "Start Date/ Time  is required",
          },
           end_date: {
            required: "Start Date/ Time  is required",
          },
           price: {
            required: "Price  is required",
          },
           thumbnail: {
            required: "Thumbnail  is required",
          },
           card_type: {
            required: "Card Type  is required",
          },

    
           
          
        }
      });
    
    
        $.validator.addMethod("noSpace", function(value, element) { 
            return $.trim(value).length!=0; 
        }, "No space please and don't leave it empty");
    
        
    
    });
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
        };
    
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
<!-- show image on change -->
<script>
    // CKEDITOR.replace( 'description_en' ,{
        
    // });
    
    // CKEDITOR.replace( 'description_ar' ,{
        
    // });




$(".remove-pro-img").click(function(evt){      
   
                  $(".remove-pro-img").addClass("d-none");
                  $("#thumbnail_preview").css('display', 'none');
                   
                  $(".thumbnail_pic").val(null);  
    
 
  });
</script>

@stop
