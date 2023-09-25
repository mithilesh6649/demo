@extends('adminlte::page')

@section('title', 'Super Admin | Checkout Offer Details  ')

@section('content_header')
 

@section('content')

<div class="container">
  <div class="row justify-content-center">
     <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              <h3>  Coupon Code Details</h3>
            </div>
            <div class="card-body table form mb-0">
              @if (session('status'))
              <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
              @endif
              <div class="modal-body p-0">
                <div class="portlet-body">
                  <div class="row">
                      <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group"> <label> Coupon  Name </label>
                              <input type="text" name="coupon_name" class="form-control" id="coupon_name" maxlength="100"  value="{{ $offer->coupon_name ?? ''}}" readonly> 
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group"> <label> Description </label>
                              <input type="text" name="coupon_name" class="form-control" id="coupon_name"    value="{{ $offer->description ?? ''}}" readonly> 
                           </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group mt-3">
                              <label for="discount_type">Coupon type </label> 
                              <select class="form-control" name="coupon_type" disabled>
                                 <option value="">Select Type</option>
                                 <option value="0" {{ $offer->coupon_type == "0" ? 'selected':'' }}>External</option>
                                 <option value="1" {{ $offer->coupon_type == "1" ? 'selected':'' }}>Internal</option>
                                 
                              </select>
                           </div>
                        </div>


                               <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group mt-3">
                  <label>Minimum order amount </label>
                  <input type="number" class="form-control" name="minimum_order_amount" maxlength="100" value="{{ $offer->minimum_order_amount ?? '' }}" readonly>
              
                </div>
              </div>



                           <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group mt-3">
                              <label for="discount_type">Discount type </label> 
                              <select class="form-control" disabled name="discount_type" id="discount_type_api">
                                 <option value="">Select Discount</option>
                                 <option value="1" {{ $offer->discount_type == "1" ? 'selected':'' }}>Amount</option>
                                 <option value="0" {{ $offer->discount_type == "0" ? 'selected':'' }}>Percentage</option>
                                 <option value="2" {{ $offer->discount_type == "2" ? 'selected':'' }}>Item</option>
                              </select>
                           </div>
                         </div>


                                 <div class="col-md-6 col-lg-6 col-xl-6 col-12  {{ $offer->discount_type == "2" ? 'd-none':'' }} " id="discount_amount_percent">
                           <div class="form-group mt-3"> <label for="title_en">Percentage/Amount  </label> <input type="number" name="discount_amount" class="form-control" id="discount_amount" maxlength="100" value="{{ $offer->discount_amount ?? '' }}" readonly> </div>
                             <label  class="percent_amount_select_error text-danger d-none" style="font-size:14px;font-weight: normal;">Percentage/Amount is required</label>
                        </div>

                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6   {{ $offer->discount_type == "2" ? '':'d-none' }}" id="discount_item">
                      <div class="form-group branches mt-3">
                       <label for="password">Select Item </label>
                         <select class="advance_category_search catselect" name="city_id"    style="width:200px;" disabled>
                              <option value="select_item">  Item</option>
                             
                             @forelse ($menuItem as $items)
                                  <option value="{{$items->id}}"   {{ $offer->menu_item_id == $items->id ? 'selected':' ' }} >{{ $items->item_name_en }}</option>
                              @empty
                                   <option class="disabled">Item</option>
                              @endforelse

                            </select>  
                          <label  class="cat_select_error text-danger d-none" style="font-size:14px;font-weight: normal;"> Item  is required</label>
                      </div>
                    </div>



                 
                   

                          <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group mt-3"> <label for="start_date">Start Date/Time </label> 
                              <input type="text" name="start_date" class="form-control dicount_date" id="start_date" maxlength="100" value="{{date('d/m/Y h:00 A',strtotime($offer->start_date))}}" readonly> 
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group mt-3"> <label for="end_date">End Date/Time </label> <input type="text" name="end_date" class="form-control dicount_date" id="end_date" maxlength="100" value="{{date('d/m/Y h:00 A',strtotime($offer->end_date))}}" readonly> </div>
                        </div>
                     
                  <!--     <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Item</h6>
                          <p class="mb-0"> 
                           @if($offer->discount_type == 2)
                               {{ $offer->menuItem->item_name_en }}
                             @else
                                 --
                             @endif 
                          </p>
                        </div>
                      </div> -->
 
                       <div class="col-md-12">
                        <div class="list mt-4 mb-3">
                          <h6 >Image </h6>
                          <div class="list-img mt-3"> 
                            <img src="{{asset('offers/coupon_code/'.$offer->thumbnail)}}"  class="offer_image_box "  current_image='pic_one' style="height:130px;"> 
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                         <div class="form-group">
                          <label for="start_date">Status</label>
                          <select name="discount_status" class="valid" aria-invalid="false" disabled>
                             <option value="1" {{$offer->discount_status==1 ? 'selected' : ''}}>Active</option>
                             <option value="0" {{$offer->discount_status==0 ? 'selected' : ''}}>Inactive</option>
                          </select>
                         </div>
                         <label class="mb-3 mt-3">Coupon  applied on
                            <a class="btn info_btn" data-toggle="tooltip" data-placement="right"
                                title=" Branch and Category/ Menu Item">
                                <i class="fa fa-question-circle"></i>
                            </a>
                        </label>
                      </div>

                   </div>
                   <div class="btn-group d-flex flex-wrap justify-content-between w-100">
                    <div class="left_tab">
                      <button type="button" class="btn btn-info mb-3 w-100" data-toggle="collapse">Selected  Branch</button>
                      <div id="branch" class="border">
                       <ul class="mb-0">
                         @foreach ($offer->CouponCodeBranch as $checkoutOffers)              
                            <li ><strong class="list-text">{{optional($checkoutOffers->branch)->title_en}}</strong></li>
                          @endforeach   
                        </ul>
                      </div>
                    </div>
                    <div class="right_tab">
                    <button type="button" class="btn btn-info mb-3 w-100">Selected  Category/ Menu Item</button>
                      <div id="category" class="border">
                        <div class="container-fluid  category_all_inputs_container " id="quick_view_container">
                           <div class="accordion" id="selectaccordionExample">
                              @forelse ($selected_menuItem as $key=>$selectitem)
                                 <div class="main_container">
                                 <div class="card categories">
                                    <div class="position-relative">
                                      <div class="card-header collapsed" data-toggle="collapse" data-target="#categories{{$key}}" aria-expanded="true">
                                         <span class="title">
                                           @php $flg1=\App\Models\CheckoutOfferItem::getcatName($key); 
                                            
                                            echo $flg1;
                                           @endphp
                                         </span>
                                         <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                      </div>
                                    </div>
                                    <div id="categories{{$key}}" class="collapse" data-parent="#selectaccordionExample" >
                                       <div class="card-body ">
                                          <div class="items-container">
                                            @foreach($selectitem as $value)
                                             <ul class="mb-0">

                                               @php  
                                               $flg2=\App\Models\CheckoutOfferItem::getMenuItem($value->menu_item_id); 
                                            
                                               
                                               @endphp
                                               <li><strong class="list-text">@php  echo $flg2; @endphp</strong></li>
                                                   </ul>
                                             @endforeach
                                           
                                          </div>
                                       </div>
                                       
                                    </div>
                                 </div>
                              </div>
                              
                              @empty
                              @endforelse
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
     </div>
  </div>
</div>






         
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"> Image</h5>
                              <button type="button" class="close"
                                  data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">
                                      ×
                                  </span>
                              </button>
                            </div>
                            <div class="modal-body" class="image_preview">
                              <div class="carousel-inner" style=" width:100%; height:400px !important;">
                                <div class="carousel-item  active"  >
                                  <img class="d-block " style="width: 100%; height: 400px;"     src="{{asset('offers/coupon_code/'.$offer->thumbnail)}}" alt="First slide">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

  

@endsection 

@section('css')
<style>
.main_container .card.categories {
  border: 1px solid #ddd;
}
.main_container .card-body {
    padding: 10px;
}
.items-container {
    margin-left: 25px;
}
.content-wrapper .content .card .card-header span.title {
    font-size: 15px;
    color: #000;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 52vw;
}
.card-header:not(.collapsed) .rotate-icon {
    transform: rotate(180deg);
}
.content-wrapper .content .card .card-header {
    height: 55px;
    cursor: pointer;
}
div#branch, div#category {
    overflow-y: scroll;
    height: 400px;
    padding: 20px;
    margin: 0 8px;
}
div#branch::-webkit-scrollbar,
div#category::-webkit-scrollbar {
  width: 3px;
  border-radius: 10px;
}
/* Track */
div#branch::-webkit-scrollbar-track,
div#category::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}
/* Handle */
div#branch::-webkit-scrollbar-thumb,
div#category::-webkit-scrollbar-thumb {
  background: #888888;
  border-radius: 10px;
}
/* Handle on hover */
div#branch::-webkit-scrollbar-thumb:hover,
div#category::-webkit-scrollbar-thumb:hov {
  background: #888888;
}
.btn-group .right_tab button:active,  .btn-info:not(:disabled):not(.disabled):active {
    border-color: #ffca33;
    background-color: #ffca33;
    color: #000000;
}
.btn-group .left_tab .btn-info:not(:disabled):not(.disabled):active {
    border-color: #000000;
    background-color: #000000;
    color: #ffffff;
}
</style>
@stop
 
@section('js')
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript">
      $(".catselect").select2();
</script>   
  <script> 
    $(document).ready(function() {
      // content
      //  CKEDITOR.replace( 'content_en', {
      //   customConfig : 'config.js',
      //   toolbar : 'simple',
      //   allowedContent: true
      // });

      //  CKEDITOR.replace('content_ar',{
      //   customConfig:'config.js',
      //   toolbar:'simple',
      //   allowedContent:true
      //  });

       $('#pages-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data ;
        }
      }]
    });


       $('#pages-list-branch').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data;
        }
      }]
    });


      $('#addContentManagementForm').validate({
             ignore: [],
            
        rules: {
          offer_name: {
            required: true
          },
          promocode: {
            required: true,
                     remote:{
                  type:"get",
                  url:"{{route('offers.promocode.check')}}",
                  data: {
                        "promocode": function() { return $("#promocode").val(); },
                        "_token": "{{ csrf_token() }}",
                       
                      },
                      dataFilter: function (result) {
                       var json = JSON.parse(result);
                                    if (json.msg == 1) {
                                        return "\"" + "Promocode already  exist" + "\"";
                                    } else {
                                        return 'true';
                                    }
                      }    
                }
          },
           start_date: {
            required: true
          },
           picture_one: { 
            required: true
          },
           picture_two: { 
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
          title_en: {
            required: "Title(en) is required"
          },
          title_ar: {
            required: "Title(ar) is required"
          },
           thumbnail: {
            required: "Thumbnail  is required"
          },
           banner: {
            required: "Icon is required"
          },
          content_en:{
            required: "Content(en) is required"
          },
          content_ar:{
            required: "Content(ar) is required"
          },
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


       
       });
    
  </script>



  <script>
 

  $(document).ready(function(){
   $('.offer_image_box').each(function(){
     $(this).click(function(){
         
          $('.remove_active').each(function(){
            $(this).removeClass('active');
          });
        

        $('#exampleModal').modal('show');
            var image_name = $(this).attr('current_image');

            if(image_name =='pic_one'){
             $('.pic_show_one').addClass('active');
            }else{
              $('.pic_show_two').addClass('active');
            }

          

        

        
     });
   });
  });



   $(document).ready(function(){
 
  $('.carousel').carousel({
  interval: false,
});
 });



</script>

@stop
