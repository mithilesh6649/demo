@extends('adminlte::page')

@section('title', 'Super Admin | Offer Details  ')

@section('content_header')
 

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                  <h3>Offer Details</h3>
                </div>
                <div class="card-body">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                  @endif
                <div class="modal-body p-0">
                  <div class="portlet-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="list">
                          <h6 class="text-uppercase">Offer Name</h6>
                          <p class="mb-0"> {{ $offer->offer_name }}</p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list">
                          <h6 class="text-uppercase">promocode</h6>
                          <label class="badge badge-warning p-0 mb-0"> {{ $offer->promocode }}</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4"> 
                          <h6>Start Date </h6>
                          <p class="mb-0">{!! date('Y/m/d', strtotime($offer->start_date)) !!}</p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6>End Date</h6>
                          <p class="mb-0">{!! date('Y/m/d', strtotime($offer->end_date)) !!}</p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Amount</h6>
                          <p class="mb-0">
                             @if($offer->discount_type == 1)
                               KD {{ $offer->discount_amount }}
                             @else
                                 --
                             @endif 
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Percent</h6>
                          <p class="mb-0"> 
                           @if($offer->discount_type == 0)
                               {{ $offer->discount_amount }} %
                             @else
                                 --
                             @endif 
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Min Order</h6>
                          <p class="mb-0">
                             @if($offer->minimum_order == 'on')
                               KD {{ $offer->minimum_order_amount }}
                             @else
                                 --
                             @endif 
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Order Above Of</h6>
                          <p class="mb-0"> 
                            @if($offer->maximum_order == 'on')
                              KD {{ $offer->maximum_order_amount }}
                             @else
                                 --
                             @endif 
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Every Order</h6>
                          <p class="mb-0">
                             @if($offer->every_order == 'on')
                              <label class="badge badge-success p-0 mb-0"> Yes</label>
                             @else
                                 --
                             @endif 
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">First Order</h6>
                          <p class="mb-0"> 
                           @if($offer->first_order == 'on')
                              <label class="badge badge-success p-0 mb-0"> Yes</label>
                             @else
                                 --
                             @endif 
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Picture 1</h6>
                          <div class="list-img mt-3"> 
                            <img src="{{asset('offers/image_one/'.$offer->picture_one)}}"  class="offer_image_box "  current_image='pic_one' style="height:130px;"> 
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Picture 2</h6>
                          <div class="list-img mt-3"> 
                            <img src="{{asset('offers/image_two/'.$offer->picture_two)}}" class="offer_image_box " current_image='pic_two'   style="height:130px;"> 
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Description</h6>
                          <p class="mb-0"> {{ $offer->description }}</p>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Terms and conditions</h6>
                          <p class="mb-0"> {{ $offer->terms_and_conditions }}</p>
                        </div>
                      </div>
                        
                      <div class="col-md-12">
                        <div class="list mt-4">
                          <h6 class="text-uppercase">Status</h6>
                          @if($offer->status == '0')
                          <label class="badge badge-danger p-0 mb-0">Inactive</label>
                          @elseif($offer->status == '1')
                          <label class="badge badge-success p-0 mb-0">Active</label>
                          @elseif($offer->status == '2')
                          <label class="badge badge-danger p-0 mb-0">Expire</label>
                          @endif
                        </div>
                      </div>
                   </div>
                </div>
             </div>
         </div>
      </div>
   </div>
</div>




        <!-- /.card-body -->
        
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Offer Images</h5>
                      <button type="button" class="close"
                          data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">
                              ×
                          </span>
                      </button>
                    </div>
                    <div class="modal-body" class="image_preview">


                 
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner" style=" width:100%; height:400px !important;">
    
    
    
      

   <div class="carousel-item   pic_show_one remove_active">
      <img class="d-block " style="width: 100%; height: 400px;"     src="{{asset('offers/image_one/'.$offer->picture_one)}}" alt="First slide" >
    </div>



   <div class="carousel-item pic_show_two remove_active">
      <img class="d-block " style="width: 100%; height: 400px;"     src="{{asset('offers/image_two/'.$offer->picture_two)}}" alt="Second slide" >
    </div>

 



  </div>

  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>






                     
 
                    </div>
                  </div>
                </div>
              </div>

 
              <!---fsdfdsfd---->

@endsection 

@section('css')
@stop
 
@section('js')
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
