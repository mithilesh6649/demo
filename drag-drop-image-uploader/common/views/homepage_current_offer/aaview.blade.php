@extends('adminlte::page')

@section('title', 'Super Admin | Checkout Offer Details  ')

@section('content_header')
 

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                  <h3> Checkout Offer Details</h3>
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
                          <h6 class="">Offer Name</h6>
                          <p class="mb-0"> {{ $offer->offer_name ?? 'N/A' }}</p>
                        </div>
                      </div>
                  
                       <div class="col-md-6">
                        <div class="list  ">
                          <h6 class="">Description</h6>
                          <p class="mb-0"> {{ $offer->description ?? 'N/A' }}</p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="">Offer type</h6>
                          <p class="mb-0">
                            @foreach($offerType as $offertypes)
                              @if($offertypes->value==$offer->offer_type)
                                {{$offertypes->name}}
                              @endif
                            @endforeach
                         
                          </p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6 class="">Percentage/Amount</h6>
                          <p class="mb-0"> 
                           @if($offer->offer_type == 0)
                               {{ $offer->offer_amount." ".env('AMOUNT_PERCENTAGE')}} 
                           @else
                              {{ $offer->offer_amount." ".env('AMOUNT_SIGN') }}
                           @endif 
                          </p>
                        </div> 
                      </div>

                     
                      <div class="col-md-6">
                        <div class="list mt-4"> 
                          <h6>Start Date/ Time </h6>
                          <p class="mb-0">{{date('d/m/Y h:00 A',strtotime($offer->start_date))}}</p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="list mt-4">
                          <h6>End Date/ Time</h6>
                          <p class="mb-0">{{date('d/m/Y h:00 A',strtotime($offer->end_date))}}</p>
                        </div>
                      </div>
                      
                      <div class="col-md-6 COL-12">
                        <div class="list mt-4 mb-4">
                          <h6 class="">Status</h6>

                          @foreach($status as $status_data)
                            @if($status_data->value==$offer->status)
                              <label class="badge {{$offer->status==1?'badge-success':'badge-danger'}} p-0 mb-0">{{$status_data->name}}</label>
                            @endif
                            
                          @endforeach
                          
                        </div>
                      </div>
                  
                     </div>
                     <div class="row mt-3">
                     <div class="col-md-6">
                      <div class="container">
                  <!-- data-toggle="collapse" data-target="#branch" -->
                      <button type="button" class="btn btn-info mb-3">Selected  Branch</button>
                      <div id="branch" class=" ">
                         <table style="width:100%"  class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Branch Name</th>
                            </tr>
                          </thead>
                          <tbody>
                           @foreach ($offer->CheckoutOfferBranch as $checkoutOffers)              
                              <tr>
                               <td class="text-uppercase">{{$checkoutOffers->branch->title_en}}</td>
                              
                               </tr>
                            @endforeach   

                          </tbody>
                          </table>
                        </div>
                      </div>
                      </div>
                   <div class="col-md-6">
 

                      <div class="container">
                           <!-- data-toggle="collapse" data-target="#category" -->
                        <button type="button" class="btn btn-info mb-3">Selected  Category/ Menu Items</button>
                        <div id="category" class=" ">
                           
                       <div class="container-fluid  category_all_inputs_container " id="quick_view_container">
                             <div class="accordion" id="accordionExample">
                                @forelse ($selected_menuItem as $key=>$selectitem)

                                   <div class="main_container">
                                   <div class="card categories">
                                      <div class="position-relative">
                                        <div class="card-header collapsed" data-toggle="collapse" data-target="#{{$key}}categories" aria-expanded="false">
                                           <span class="title">catgory</span>
                                           <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                        </div>
                                        
                                      </div>
                                      <div id="{{$key}}categories" class="collapse" data-parent="#accordionExample" >
                                         <div class="card-body ">
                                            <div class="items-container">
                                              @foreach($selectitem as $value)
                                               <div class="col-md-12">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                      
                                                       <strong class="list-text"> &nbsp;</strong>
                                                    </div>
                                                 </div>
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




  

@endsection 

@section('css')
@stop
 
@section('js')
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
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
