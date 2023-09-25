@php
 $myArr = [];
@endphp
  
  @forelse($branchcity as $key=>$branch_city)
    @if($key==0)
      <div class="col-12 addcities">
		    <div class="row tt">
		    	 <div class="col-md-1 mb-4">
		    	 	<!-- <label for="password"> S.No<span class="text-danger"> *</span></label> -->
			        <div class="d-flex align-items-center justify-content-center" style="height: 45px;"> 
			            <span class="serial_number">1</span>
			        </div>
			     </div>

		    	<div class="col-md-2 mb-4">
			        <div class="form-group branch">
			        <!--  <label for="password"> City<span class="text-danger"> *</span></label>            -->
			           <select  class="city_search catselect form-control"  name="localities_id[]"  >
			              <!--   <option value="">City</option> -->
			             
			                 @forelse ($city as $citys)
                        
                           @if(in_array($citys->id,$branchcityAll))
                           
                           @if($citys->id ==$branch_city->city_id)

			                  <option value="{{$citys->id}}" @if($branch_city->city_id==$citys->id) selected @else  @endif 
                         {{$branch_city->city_id==$citys->id ?
                            array_push($myArr,$citys->id):'';
                            }}

			                   >{{ $citys->city }}</option>

			                   @endif

			                   @else

			                      <option value="{{$citys->id}}" @if($branch_city->city_id==$citys->id) selected @else  @endif 
                         {{$branch_city->city_id==$citys->id ?
                            array_push($myArr,$citys->id):'';
                            }}

			                   >{{ $citys->city }}</option>


			                   @endif

			                 @empty
			                   <option disabled class="disabled">All cities already allocated in other branch  Please add more cities </option>
			                 @endforelse
			            </select>  
			        </div>
		        </div>

		    	<div class="col-md-2 mb-4">
			        <div class="form-group branch">
			        <!--  <label for="password">  Branch<span class="text-danger"> *</span></label>  -->          
			            <select class="branch_search catselect form-control" name="branch_id[]"  >
			                <!-- <option value="">Branch</option> -->
			             
			                 @forelse ($branches as $branch)
			                  <option value="{{$branch->id}}"   {{$branch_city->branch_id==$branch->id?'selected':' ' }} >{{ $branch->title_en }}</option>
			                 @empty
			                   <option disabled class="disabled">Branch not found</option>
			                 @endforelse
			            </select>   
			        </div>
		        </div>
		     
		       <div class="col-md-2 mb-4">
		         <div class="form-group">
		            <!-- <label for="delivery_charge">Delivery Fee<span class="text-danger"> *</span></label> -->
		            <input type="number" name="delivery_fee[]" class="form-control delivery_charge"  maxlength="6" value="{{$branch_city->delivery_fee}}" step="any" style="background-color:white;border:1px solid #ced4da;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
		         </div>
		       </div>

		       <div class="col-md-2 mb-4">
		         <div class="form-group">
		           <!--  <label for="minimum_order_amount">Mini Order Amt<span class="text-danger"> *</span></label> -->
		            <input type="number" name="minimum_order_amount[]" class="form-control minimum_order_amount" value="{{$branch_city->minimum_order_amount}}" step="any" maxlength="6" style="background-color:white;border:1px solid #ced4da;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
		         </div>
		        </div>
		        <div class="col-md-2 mb-4">
		         <div class="form-group">
		           <!--  <label for="minimum_order_amount"> Delivery Time(min)<span class="text-danger"> *</span></label>  -->
		            <input type="number" value="{{$branch_city->delivery_time}}" name="delivery_time[]" step="any" class="form-control delivery_time"  maxlength="6" style="background-color:white;border:1px solid #ced4da;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
		         </div>
		        </div>
		       <div class="col-1">
		       	    <a href="#" class="action-button branch_city_delete"  data-bid="{{$branch_city->id}}"><i class="text-danger fa fa-trash" aria-hidden="true"></i></a>
		       </div>
		    </div>
		</div>
      @else

@php

@endphp
<!--  print_r($myArr); -->
       <div class="col-12 addcities">
		    <div class="row tt">
	    	  <div class="col-md-1 mb-4 d-flex align-items-center justify-content-center">
		        <label class="d-none" for="password"> S.No<span class="text-danger"> *</span></label>  
		        <span class="serial_number">1</span>
		      </div>
		      <div class="col-md-2 mb-4">
		        <div class="form-group">
		           <select  class="city_search catselect form-control" name="localities_id[]"  >
	                <!-- <option value="">City</option>		   -->           
	                 @forelse ($city as $citys)
                      
                         @if(in_array($citys->id,$branchcityAll))
                           
                           @if($citys->id ==$branch_city->city_id)

			                  <option value="{{$citys->id}}" @if($branch_city->city_id==$citys->id) selected @else  @endif 
                         {{$branch_city->city_id==$citys->id ?
                            array_push($myArr,$citys->id):'';
                            }}

			                   >{{ $citys->city }}</option>

			                   @endif

			                   @else

			                      <option value="{{$citys->id}}" @if($branch_city->city_id==$citys->id) selected @else  @endif 
                         {{$branch_city->city_id==$citys->id ?
                            array_push($myArr,$citys->id):'';
                            }}

			                   >{{ $citys->city }}</option>


			                   @endif
                    
	                 @empty
	                   <option disabled class="disabled">All cities already allocated in other branch  Please add more cities </option>
	                 @endforelse
		            </select>  
		        </div>
		      </div>
		      <div class="col-md-2 mb-4">
		        <div class="form-group">   
		           <select class="branch_search catselect form-control" name="branch_id[]"  >
	                 @forelse ($branches as $branch)
	                  <option value="{{$branch->id}}"   {{$branch_city->branch_id==$branch->id?'selected':' ' }} >{{ $branch->title_en }}</option>
	                 @empty
	                   <option class="disabled">Branch not found</option>
	                 @endforelse
		            </select>  
		        </div>
	          </div>
		     
		      <div class="col-md-2 mb-4">
		        <div class="form-group">
		            <input type="number" name="delivery_fee[]" class="form-control delivery_charge"  maxlength="5" value="{{$branch_city->delivery_fee}}" step="any" style="background-color:white;border:1px solid #ced4da;"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
		         </div>
		       </div>

		       <div class="col-md-2 mb-4">
		        <div class="form-group">
		            <input type="number" name="minimum_order_amount[]" class="form-control minimum_order_amount" value="{{$branch_city->minimum_order_amount}}" step="any" maxlength="5" style="background-color:white;border:1px solid #ced4da;"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
		        </div>
		       </div>
		      <div class="col-md-2 mb-4">
		        <div class="form-group">
		        	
		            <input type="number" value="{{$branch_city->delivery_time}}" name="delivery_time[]" step="any" class="form-control delivery_time"  maxlength="5" style="background-color:white;border:1px solid #ced4da;"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
		         </div>
		       </div>
		       <div class="col-1 delete">
               <a href="#" class="action-button branch_city_delete" data-bid="{{$branch_city->id}}"><i class="text-danger fa fa-trash" aria-hidden="true"></i></a>
		       </div>
		    </div>
		</div>
     @endif
  @empty
      <div class="">
      	<p>No Locality</p>
      </div>
  @endforelse

 


