@extends('adminlte::page')

@section('title', 'Super Admin | Add Gift Cards')

@section('content_header')
 

@section('content')

<div class="container">
<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
         <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
               <h3>Add Gift Cards</h3>
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
                              <label for="title">Title {{ labelEnglish() }}<span class="text-danger"> *</span></label>
                              <input type="text" name="title" class="form-control" id="tilte"   maxlength="100">
                           </div>
                        </div>

                         <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                           <div class="form-group">
                              <label for="title_ar">Title {{ labelArabic() }}<span class="text-danger"> *</span></label>
                              <input type="text" name="title_ar" class="form-control" id="title_ar"   maxlength="100">
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group">
                              <label for="description">Description {{ labelEnglish() }} </label>
                              <textarea name="description" style="height:60px;" maxlength="500" ></textarea>
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group">
                              <label for="description_ar">Description {{ labelArabic() }} </label>
                              <textarea name="description_ar" style="height:60px;" maxlength="500" ></textarea>
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group ">
                              <label for="card_type">Card type<span class="text-danger"> *</span></label> 
                              <select class="form-control" name="gift_cards_type_id" id="gift_cards_type_id">
                                 <option value="">Select  Card Type</option>
                                 @foreach($gift_card_type as $card_type)
                                 <option value="{{$card_type->id}}">{{$card_type->name}} KD</option>
                                 @endforeach
                              </select>
                           </div> 
                        </div> 
                  
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group  "> <label for="start_number">Card number Start <span class="text-danger"> *</span></label> <input type="number" name="start_number" class="form-control" id="start_number" min="0" maxlength="100"> </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group  "> <label for="end_number">Card number End </label> <input type="number" name="end_number" class="form-control" id="end_number" min="0" maxlength="100"> </div>
                        </div>
 
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                           <div class="form-group ">
                              <label for="status">Status </label> 
                              <select class="form-control" name="status" id="status">
                                 @foreach($status as $status_data)
                                 <option value="{{$status_data->value}}">{{$status_data->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>

                       
                         <label class="warning-error-notice text-danger d-none" style="font-size:14px;font-weight: normal;"> Start number should not be greater than end number</label>
 
                     </div>
                     <div class="card-footer">
                        <button type="submit" class="button btn_bg_color common_btn text-white">Save</button>
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
    
      
      $('#addGiftCard').validate({
        ignore: [],
        debug: false,
        rules: {
          title: {
            required: true,
           
          },

          title_ar: {
            required: true,
           
          },
            
          //  description: {
          //   required: true,
          // },
          // description_ar: {
          //   required: true,
          // },
           start_number: {
            required: true,
          },
          //  end_number: {
          //   required: true, 

          // },
           
           gift_cards_type_id: {
            required: true,
          },

          
        },
        messages: {
          title: {
            required: "Title (en) is required",
          },

           title_ar: {
            required: "Title (ar) is required",
          },
          description: {
            required: "Description (en)  is required",
          },

           description_ar: {
            required: "Description (ar)  is required",
          },

            start_number: {
            required: "Start number is required",
          },
           end_number: {
            required: "End number  is required",
          },
           price: {
            required: "Price  is required",
          },
           thumbnail: {
            required: "Thumbnail  is required",
          },
           gift_cards_type_id: {
            required: "Card Type  is required",
          },    
        },
        submitHandler: function(form) { 
             
             var start_number = $('#start_number').val();
             var end_number = $('#end_number').val();

             if(end_number != ""){ 
             if(start_number < end_number){
             // alert('success');
                return true;  
             } else{
               return true;
               //  $('.warning-error-notice').removeClass('d-none');
             
               //     setTimeout(function(){
               //       $('.warning-error-notice').addClass('d-none');
               //    },1000);

               // return false;
             } 

             } 

               return true;

             
               
              
   }
      });
    
     
    
        
    
    });
</script>
 
 

@stop
