  @forelse($branchcity as $key=>$branch_city)
     @if($key==0)
         <div class="col-12 addcities">
		    <div class="row tt">
	    	  <div class="col-md-1 mb-4">
		        <div class="form-group">
		            <label for="delivery_charge">S.No<span class="text-danger"> *</span></label>
		            <div class="d-flex align-items-center justify-content-center" style="height: 45px;"> 
			            <span class="serial_number">1</span>
			        </div>
		        </div>
	          </div>

		      <div class="col-md-3 mb-4">
		        <div class="form-group">
		         <label for="password"> City<span class="text-danger"> *</span></label>           
		           <select  class=" catselects form-control" style="pointer-events:none"  >
		                <option value="">City</option>
		             
		                 @forelse ($city as $citys)
		                  <option value="{{$citys->id}}" @if($branch_city->city_id==$citys->id) selected @else  @endif  >{{ $citys->city }}</option>
		                 @empty
		                   <option disabled>All cities already allocated in other branch . Please add more cities </option>
		                 @endforelse
		            </select>  
		        </div> 
		      </div>

		      <div class="col-md-2 mb-4">
		        <div class="form-group">
		           <label for="delivery_charge">Delivery Fee<span class="text-danger"> *</span></label>
		           <input type="number" readonly  class="form-control delivery_charge "  maxlength="100" value="{{$branch_city->delivery_fee}}" style="background-color:white;border:1px solid #ced4da;">  
		        </div>
		      </div>

		      <div class="col-md-3 mb-4">
		        <div class="form-group">
		           <label for="minimum_order_amount">Mini Order Amt<span class="text-danger"> *</span></label>
		           <input type="number" readonly class="form-control minimum_order_amount " value="{{$branch_city->minimum_order_amount}}" maxlength="100" style="background-color:white;border:1px solid #ced4da;">  
		        </div>
		      </div>

		      <div class="col-md-3 mb-4">
		        <div class="form-group">
		           <label for="minimum_order_amount"> Delivery Time(minutes)<span class="text-danger"> *</span></label> 
		           <input type="number" readonly value="{{$branch_city->delivery_time}}" class="form-control delivery_time"  maxlength="100" style="background-color:white;border:1px solid #ced4da;">  
		        </div>
		      </div>
		    </div>
		</div>
      @else
          <div class="col-12 addcities">
		    <div class="row tt">
	    		 <div class="col-md-1">
			         <div class="form-group">
			            <label class="d-none" for="delivery_charge">S.No<span class="text-danger"> *</span></label>
			            <div class="d-flex align-items-center justify-content-center" style="height: 45px;"> 
				            <span class="serial_number">1</span>
				        </div>
			        </div>
		         </div>

		    	<div class="col-md-3 mb-4">
			        <div class="form-group">
			                  
			           <select    class="catselects form-control" style="pointer-events:none">
			                <option value="">City</option>
			             
			                 @forelse ($city as $citys)
			                  <option value="{{$citys->id}}" @if($branch_city->city_id==$citys->id) selected @else  @endif >{{ $citys->city }}</option>
			                 @empty
			                   <option disabled>All cities already allocated in other branch . Please add more cities </option>
			                 @endforelse
			            </select>  
			        </div>
			    </div>
		    	
		       <div class="col-md-2 mb-4">
		        <div class="form-group">
		            <input type="number" readonly class="form-control delivery_charge "  maxlength="100" value="{{$branch_city->delivery_fee}}" style="background-color:white;border:1px solid #ced4da;">  
		         </div>
		       </div>

		       <div class="col-md-3 mb-4">
		         <div class="form-group">
		            <input type="number" readonly  class="form-control minimum_order_amount" value="{{$branch_city->minimum_order_amount}}" style="background-color:white;border:1px solid #ced4da;">  
		         </div>
		       </div>

		      <div class="col-md-3 mb-4">
		        <div class="form-group">
		            <input type="number" readonly value="{{$branch_city->delivery_time}}"  class="form-control delivery_time" tyle="background-color:white;border:1px solid #ced4da;">  
		         </div>
		       </div>
		    </div>
		</div>
     @endif
  @empty
  <div class="col-md-1 mb-4">
	<div class="form-group">
	    <label class="d-none" for="delivery_charge">S.No<span class="text-danger"> *</span></label>
	    <div class="d-flex align-items-center justify-content-center" style="height: 45px;"> 
		    <span class="serial_number">1</span>
		</div>
	</div>
  </div>
	
   <div class="col-3 mb-4">
    <div class="form-group ">
     <label for="password"> City<span class="text-danger"> *</span></label>           
       <select class="city_search catselect form-control" name="localities_id[]"  >
            <option value="">City</option>
         @forelse ($newcity as $newcitys)
              <option value="{{$newcitys->id}}" >{{ $newcitys->city }}</option>
          @empty
               <option  disabled class="disabled">All cities already allocated in other branch  Please add more cities </option>
          @endforelse
        </select>  
    </div>
   </div>
 
   <div class="col-2 mb-4">
    <div class="form-group">
        <label for="delivery_charge">Delivery Fee<span class="text-danger"> *</span></label>
        <input type="number"  step="any" name="delivery_fee[]" class="form-control delivery_charge "  maxlength="5" style="background-color:white;border:1px solid #ced4da;">  
     </div>
   </div>


  <div class="col-3 mb-4">
    <div class="form-group">
        <label for="minimum_order_amount">Mini Order Amt<span class="text-danger"> *</span></label>
        <input type="number"  step="any" name="minimum_order_amount[]" class="form-control minimum_order_amount"  maxlength="5" style="background-color:white;border:1px solid #ced4da;">  
     </div>
   </div>
  <div class="col-3 pr-0 mb-4">
    <div class="form-group">
        <label for="minimum_order_amount"> Delivery Time(minutes)<span class="text-danger"> *</span></label>
        <input type="number" name="delivery_time[]"  class="form-control delivery_time "  maxlength="5" style="background-color:white;border:1px solid #ced4da;">  
     </div>
   </div> 
  @endforelse

 


