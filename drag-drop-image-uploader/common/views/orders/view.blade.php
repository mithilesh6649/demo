@extends('adminlte::page')

@section('title', 'Super Admin | Order Details')

@section('content_header')
 

@section('content')
 
 

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Order Details</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body order_details p-0">
             <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item nav-tab-active">
                  <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Order details</a>
                </li>
                <li class="nav-item nav-tab-active">
                  <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"> Order details</a>
                </li>
                <li class="nav-item nav-tab-active">
                  <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Order details</a>
                </li>
             </ul>
<div class="tab-content">
  <div class="tab-pane active  " id="tabs-1" role="tabpanel">
     
     <!-- start section one -->
      
        <form id="editUserForm" method="post", action="">
                <div class="card-body table p-0 mb-0">
                  <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label class="text-capitalize">Order id</label>
                        <input type="text"  class="form-control"  placeholder="{{ $particularOrder->id ?? ' ' }}"    readonly>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group ">
                        <label class="text-capitalize">Payment method</label>           
                            <select class="form-control" name="status" disabled>
                            <option value="1" {{ $particularOrder->payment_method == 1 ? 'selected':''  }}  >credit card</option>
                            <option  value="0" {{ $particularOrder->payment_method == 2 ? 'selected':''  }}  >Cash</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label class="text-capitalize">Total amount</label>
                        <input type="text"  class="form-control"  placeholder="{{ $particularOrder->total_amount ?? ' ' }} KD" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label class="text-capitalize">Current Offer</label>
                        <input type="text"  class="form-control"  placeholder="0 KD" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label class="text-capitalize">Checkout Offer</label>
                        <input type="text"  class="form-control"  placeholder="0 KD" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label class="text-capitalize">Coupon Code</label>
                        <input type="text"  class="form-control"  placeholder="0 KD" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group">
                        <label class="text-capitalize">Loyalty</label>
                        <input type="text"  class="form-control"  placeholder="0 KD" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                      <div class="form-group ">
                        <label class="text-capitalize">Discount</label>
                        <input type="text"   class="form-control"  placeholder="{{ $particularOrder->discount ?? ' ' }} KD" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mb-3">
                        <label class="text-capitalize">Final amount </label>
                        <input type="text"   class="form-control"  placeholder="{{ $particularOrder->final_amount ?? ' ' }} KD"  readonly>
                      </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mb-3">
                        <label class="text-capitalize">Delivery type</label>
                            <select class="form-control" name="status" disabled>
                            <option value="1" {{ $particularOrder->delivery_type == 'take_away' ? 'selected':''  }}  >Take Away</option>
                            <option  value="0" {{ $particularOrder->delivery_type == 'delivery' ? 'selected':''  }}  >Delivery</option>
                        </select>
                     
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mb-3">
                        <label class="text-capitalize">Cutlery</label>          
                            <select class="form-control" name="status" disabled>
                            <option value="1" {{ $particularOrder->cutlery == 1 ? 'selected':''  }}  >Yes</option>
                            <option  value="0" {{ $particularOrder->cutlery == 0 ? 'selected':''  }}  >No</option>
                        </select>
                      </div>
                    </div>
              
                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mb-3">
                        <label class="text-capitalize">Special Instruction</label>
                        <input type="text"   class="form-control"  placeholder="{{ $particularOrder->special_instruction ?? ' ' }}  "  readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mb-3">
                        <label class="text-capitalize">Status</label>
                        <input type="text" name="status" class="form-control" id="status" value="Delivered" readonly>
                       
                        @if($errors->has('status'))
                          <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mb-3">
                        <label class="text-capitalize">Order Placed At</label>
                        <input type="text"  class="form-control"   placeholder="{{ date('d/m/Y h:i A',strtotime($particularOrder->created_at))}}  " readonly>
                       
                        @if($errors->has('status'))
                          <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                      </div>
                    </div>    

    <div class="col-md-12 col-lg-12 col-xl-12 col-md-12">
                      <div class="form-group ">
                        <label class="text-capitalize">Order Type</label>
                         <ul class="nav nav-tabs p-0" role="tablist">
<!--   <li class="nav-item">
    <a class="nav-link  {{ $particularOrder->date != null ? 'active' : 'd-none' }}" data-toggle="tab" href="#later" role="tab">Order Later</a>
  </li> -->
  <li class="nav-item">
    <a class="nav-link {{ $particularOrder->date == null ? 'active' : 'd-none' }}" data-toggle="tab" href="#now" role="tab">Order Now</a>
  </li>
 
</ul><!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane {{ $particularOrder->date != null ? 'active' : 'd-none' }}" id="later" role="tabpanel">
     

    <div class="row p-0">
                
          
              <div class="col-md-12 mb-3">
            
            <div class="card p-3"  >
              
                

                       <div class="info-wrap">
                   <label>Date : </label>
                   <span>{{ date('d/m/Y ',strtotime($particularOrder->date))}}  </span>
                 </div>

                 <div class="info-wrap">
                   <label>Time : </label>
                   <span>{{ date('h:i A',strtotime($particularOrder->from_time))}}  - {{ date('h:i A',strtotime($particularOrder->to_time))}}</span>
                 </div>

                  

               


            </div> 

           

       
       
        </div>


    </div>  


  </div>
  <div class="tab-pane {{ $particularOrder->date == null ? 'active' : 'd-none' }}" id="now" role="tabpanel">
      

        <div class="row p-0">
                
          
              <div class="col-md-12 mb-3">
            
            <div class="card p-3" style="box-shadow: none;">
              
                
          
         <div class="w-100">Order now</div>
                  

               


            </div> 

           

       
       
        </div>


    </div>  




  </div>
 
</div>
                      </div>
                    </div>

 
               

           <div class="col-md-12">

            <div class="form-group ">
                        <label>Order Status</label>
                  <ul class="nav nav-tabs p-0" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Order Logs</a>
  </li>
  
  
</ul><!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="tabs-1" role="tabpanel">
     
         <div class="row p-0">
                
          
              <div class="col-md-12 mb-3">
            
            <div class="card p-3" style="box-shadow: none;">
              
                

                       <div class="info-wrap">
                        
                        <ul  class="mb-0">
                          <li style="padding:5px;"><i class="fa fa-stop text-success"></i> <span>Placed  at 12/08/2022 04:45 AM </span></li>
                          <li style="padding:5px;"><i class="fa fa-stop text-success"></i> <span>Accepted  at 12/08/2022 04:45 AM </span></li>
                           <li style="padding:5px;"><i class="fa fa-stop text-success"></i> <span>  Delivered at 12/08/2022 04:45 AM</span></li>
                          <li style="padding:5px;"><i class="fa fa-stop text-danger"></i> <span class="text-danger"> Cancelled  at 12/08/2022 04:45 AM </span></li>
                        </ul>

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
                <!-- /.card-body -->
                
                
              </form> 
     

     <!-- end section two -->
  </div>
  <div class="tab-pane   " id="tabs-2" role="tabpanel">
  
                 
        <div class="card" style="box-shadow: none;">
          <div class="card-body font-weight-bold" style="height: 60px;">Branch :- {{ $particularOrder->branch->title_en }}  ({{ $particularOrder->branch->title_ar }} )</div>
        </div>
        
        <div class="row mt-3">
         
         @forelse ($particularOrder->orderItems as $allItems)
            
              <div class="col-md-4">
            
            <div class="card order_categories">
              
                    <div class="order-image mb-2">
                    
                    <img src="{{asset('background_images/back7.jpg')}}" id="thumbnail_preview" style="width:100%;height:130px;">
                 </div>

                       <div class="info-wrap">
                   <label class="mb-0 mr-2">Item Name:</label>
                   <p class="mb-0">{{$allItems->menuItems->item_name_en ?? ''}}</p>
                 </div>
                 <div class="info-wrap">
                   <label class="mb-0 mr-2">Category:</label>
                   <p class="mb-0">{{$allItems->menuItems->menuCategory->name_en ?? ''}}</p>
                 </div>
                  <div class="info-wrap">
                   <label class="mb-0 mr-2">Test of choice:</label>
                  <!--  <p>{{$allItems->orderChoices}}</p> -->
                  <ul class="mb-0">
                   @forelse ($allItems->orderChoices as $allItemsChoices)
                    <li class="p-0 mb-0"> {{$allItemsChoices->choice->name_en ?? ''}} </li>

                    @empty
                     No choices 
                   @endforelse
                 </ul>
                 </div>

                 <div class="info-wrap">
                   <label class="mb-0 mr-2">Item Price:</label>
                   <p class="mb-0">{{$allItems->menuItems->price ?? ''}} KD </p>
                 </div>
                 <div class="info-wrap">
                   <label class="mb-0 mr-2">Item Quantity:</label>
                   <p class="mb-0">{{$allItems->quantity ?? ''}}</p>
                 </div>
            </div> 

           </div>

        @empty
            <p>No Items</p>
        @endforelse 
       
        </div>
  </div>
  <div class="tab-pane  " id="tabs-3" role="tabpanel">
   
   
    
   <form id="editUserForm" method="post", action="">
                <div class="card-body table p-0 mb-0">
                 
                  <div class="row">
        
                     

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Name</label>
                        <input type="text"   class="form-control"   value="{{$particularOrder->address->first_name ?? 'N/A'}} {{$particularOrder->address->last_name ?? ''}}"  readonly>
                        
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Email</label>
                        <input type="text"   class="form-control"  placeholder="{{ $particularOrder->user->email ?? 'N/A' }}" readonly>
                       
                        
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Phone Number</label>
                         <input type="text"   class="form-control"  placeholder="{{ $particularOrder->address->mobile_number ?? 'N/A' }}" readonly>
                      </div>
                    </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Landline Number</label>
                         <input type="text"   class="form-control"  placeholder="{{ $particularOrder->address->landline_number ?? 'N/A' }}" readonly>
                      </div>
                    </div>



                 

                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 d-none">
                      <div class="form-group mt-3">
                        <label>Age</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ @$particularOrder->user->age}}" readonly>
                       
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>


                     <div class="col-md-12 col-lg-12 col-xl-12 col-md-12">
                      <div class="form-group mt-3">
                        <label>Delivery Address</label>
                         
<ul class="nav nav-tabs p-0" role="tablist">
  <li class="nav-item">
    <a class="nav-link {{ $particularOrder->address->address_type == 0 ? 'active':'d-none' }} " data-toggle="tab" href="#apartment" role="tab">Apartment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $particularOrder->address->address_type == 1 ? 'active':'d-none' }}" data-toggle="tab" href="#house" role="tab">House</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $particularOrder->address->address_type == 2 ? 'active':'d-none' }}" data-toggle="tab" href="#office" role="tab">Office</a>
  </li>
</ul><!-- Tab panes -->
<div class="tab-content">

  <div class="tab-pane  {{ $particularOrder->address->address_type == 0 ? 'active':'d-none' }}" id="apartment" role="tabpanel">
    
 <div class="row p-0">
  
          
         
         
            
              <div class="col-md-12">
            
            <div class="card p-3" style="box-shadow: none;">
              
                

                       <div class="info-wrap">
                   <label>Address</label>
                   <p>{{optional($particularOrder->address->city)->city !="" ? $particularOrder->address->city->city: '' }} 
                    {{ $particularOrder->address->block !="" ? ",".$particularOrder->address->block:' ' }}
                    {{ $particularOrder->address->street !="" ? ",".$particularOrder->address->street:' ' }} {{ $particularOrder->address->avenue !="" ? ",".$particularOrder->address->avenue:'' }}{{$particularOrder->address->building !="" ? ",".$particularOrder->address->building:'' }}{{ $particularOrder->address->floor != "" ? ",".$particularOrder->address->floor:' ' }} {{ $particularOrder->address->apertment_number !=""? ",".$particularOrder->address->apertment_number:'' }} </p>
                 </div>


                       <div class="info-wrap">
                   <label>Additional Directions</label>
                   <p class="mb-0">{{ $particularOrder->address->additional_directions ?? 'N/A' }}</p>
                 </div>
                 

               


            </div> 

           

       
       
        </div>
   
 </div>



  </div>
  <div class="tab-pane {{ $particularOrder->address->address_type == 1 ? 'active':'d-none' }}" id="house" role="tabpanel">
   

              <div class="row p-0">
        
                     
              <div class="col-md-4 mb-3">
            
            <div class="card p-3"  >
              
                

                       <div class="info-wrap">
                   <label>Address</label>
                   <p>{{optional($particularOrder->address->city)->city !="" ? $particularOrder->address->city->city: '' }} 
                    {{ $particularOrder->address->block !="" ? ",".$particularOrder->address->block:' ' }} {{ $particularOrder->address->street !="" ?  ",".$particularOrder->address->street:' ' }} {{ $particularOrder->address->avenue != "" ? ",".$particularOrder->address->avenue:' ' }} {{ $particularOrder->address->house!="" ? ",".$particularOrder->address->house:' ' }}   </p>
                 </div>


                       <div class="info-wrap">
                   <label>Additional Directions</label>
                   <p>{{ $particularOrder->address->additional_directions ?? 'N/A' }}</p>
                 </div>
                 

               


            </div> 

           

       
       
        </div>
                 
               </div>






  </div>
  <div class="tab-pane {{ $particularOrder->address->address_type == 2 ? 'active':'d-none' }}" id="office" role="tabpanel">
    
    <div class="row p-0">
                
          
              <div class="col-md-4 mb-3">
            
            <div class="card p-3"  >
              
                

                       <div class="info-wrap">
                   <label>Address</label>
                   <p>{{optional($particularOrder->address->city)->city !="" ? $particularOrder->address->city->city: '' }}  
                    {{ $particularOrder->address->block!="" ? ','.$particularOrder->address->block: ' ' }}
                    {{ $particularOrder->address->street != "" ? ','.$particularOrder->address->street:' ' }} 
                    {{ $particularOrder->address->avenue != "" ? ','.$particularOrder->address->avenue: '' }}
                    {{ $particularOrder->address->building != "" ? ",".$particularOrder->address->building:' ' }} 
                     {{ $particularOrder->address->floor ?? ' ' }} , {{ $particularOrder->address->office ?? '' }} </p>
                 </div>


                       <div class="info-wrap">
                   <label class="font-weight-bolder">Additional Directions</label>
                   <p>{{ $particularOrder->address->additional_directions ?? 'N/A' }}</p>
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
                <!-- /.card-body -->
                
              </form> 




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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .editable_field {
      position: relative;
      top: -25px;
      right: 10px;
      float: right;
    }
    .non_editable_field {
      position: relative;
      top: -25px;
      right: 10px;
      float: right;
    }

    #job_alerts_modal label.error {
    position: absolute;
    bottom: -12px;
    left: 17px;
}
  </style>
  <style type="text/css">
    .ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 9999;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  text-align: left;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
}

.ui-autocomplete > li > div {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.42857143;
  color: #333333;
  white-space: nowrap;
}

.ui-state-hover,
.ui-state-active,
.ui-state-focus {
  text-decoration: none;
  color: #262626;
  background-color: #f5f5f5;
  cursor: pointer;
}

.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.select2-container{
    z-index: 9999;
}
</style>
@stop

@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $("select.multiple").select2();
    $(document).ready(function() {
      
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      $('#editUserForm').validate({
        ignore: [],
        debug: false,
        rules: {
          user_name: {
            required: true,
            noSpace:true
          },
          full_name: {
            required: true,
            noSpace:true
          },

          city: {
            required: true,
            noSpace:true
          },

          island: {
            required: true,
            noSpace:true
          },
          
          email: {
            required: true,
            email: true,
          },
          phone_number: {
            regex: /^[\d ()+-]+$/,
            minlength: 7,
            maxlength: 15
          },
          password:{
            required:true,
            pass_check:true
          },
          password_confirmation: {
            required: true,
            equalTo: "#password"
          }
        },
        messages: {
          user_name: {
            required: "The Username field is required.",
          },
          full_name: {
            required: "The Full Name field is required.",
          },

          city: {
            required: "The City field is required.",
          },

          island: {
            required: "The Island field is required.",
          },
          
          email: {
            required: "The Email field is required.",
            email: "Please enter a valid email"
          },

          password: {
            required: "The Password field is required."
          },
          password_confirmation: {
            required: "The Confirm Password field is required.",
            equalTo : "The Confirm Password should match to Password."
          },
        }
      });


        $.validator.addMethod("noSpace", function(value, element) { 
            return $.trim(value).length!=0; 
        }, "No space please and don't leave it empty");

        $.validator.addMethod("pass_check", function(value, element) {
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/; 
            return value.match(regex); 
        }, "Password must be 8 characters long containing atleast one upper case, one lower case and one number.");

    });
  </script>


  <!-- show image on change -->
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#thumbnail_preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <!-- show image on change -->


@stop
