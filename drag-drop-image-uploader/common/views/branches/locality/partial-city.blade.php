<div class="col-12 addcities ">
   
    <div class="row tt"> 
      <div class="col-md-1 mb-4">
          <div class="d-flex align-items-center justify-content-center" style="height: 45px;"> 
           <span class="serial_number">1</span>
         </div>
       </div>
             <div class="col-3">
              <div class="form-group ">
              <!--  <label for="password">  City<span class="text-danger"> *</span></label>       -->     
                 <select class="city_search catselect form-control" name="localities_id[]"  >
                      <option value="">City</option>
                   
                       @forelse ($city as $citys)
                        <option value="{{$citys->id}}">{{ $citys->city }}</option>
                       @empty
                         <option disabled class="disabled">All cities already allocated in other branch  Please add more cities    </option>
                       @endforelse

                  </select>  
              </div>
           </div>
       
       <div class="col-2 mb-4">
        <div class="form-group">
           <!--  <label for="delivery_charge">Delivery Fee<span class="text-danger"> *</span></label> -->
            <input type="number" step="any" name="delivery_fee[]" class="form-control delivery_charge"  maxlength="6" style="background-color:white;border:1px solid #ced4da;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
         </div>
       </div>


      <div class="col-3 mb-4">
        <div class="form-group">
           <!--  <label for="minimum_order_amount">Minimum Order Amt<span class="text-danger"> *</span></label> -->
            <input type="number" step="any" name="minimum_order_amount[]" class="form-control minimum_order_amount" maxlength="6" style="background-color:white;border:1px solid #ced4da;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
         </div>
       </div>
      <div class="col-2 mb-4 pr-0">
        <div class="form-group">
           <!--  <label for="minimum_order_amount"> Delivery Time(minutes)<span class="text-danger"> *</span></label> -->
            <input type="number" name="delivery_time[]" class="form-control delivery_time"  maxlength="6" style="background-color:white;border:1px solid #ced4da;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">  
         </div>
       </div>
      <div class="col-1 delete" style="height: fit-content;">
        
         <a href="#" class="action-button citydelete"><i class="text-danger fa fa-trash" aria-hidden="true"></i></a>
      </div>
    </div>
  <!--  <div class="row justify-content-end">
         
   </div> -->
</div>