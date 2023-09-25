
 
         <div class="row">
                         
                          <input type="hidden" name="current_localities_id"  value="{{ $branchLocalities->id }}">

                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3

                     ">
                      <div class="form-group branch">
                       <label for="password">  City<span class="text-danger"> *</span></label>
                        
                        
                         <select class="advance_category_search catselect" name="localities_id"  style="width:200px;">
                              
                             
                             @forelse ($city_list as $city)
                                  <option value="{{$city->id}}"   {{ $city->id == $branchLocalities->city_id ? 'selected':''  }}  {{in_array($city->id,$branchLocalitiesCities) ? 'disabled' :' ' }}>{{ $city->city }} {{ $city->city_ar }}</option>
                              @empty
                                   <option class="disabled">City not found</option>
                              @endforelse

                            </select>  

                      </div>
                    </div>

                               <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="delivery_charge">Delivery Fee<span class="text-danger"> *</span></label>
                                    <input type="number" value="{{$branchLocalities->delivery_fee ?? 'N/A'}}" name="delivery_fee" class="form-control " id="delivery_charge" maxlength="100">  
                                 </div>
                               </div>

                               <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="minimum_order_amount">Minimum Order Amount<span class="text-danger"> *</span></label>
                                    <input type="number" name="minimum_order_amount" class="form-control " id="minimum_order_amount" maxlength="100" value="{{$branchLocalities->minimum_order_amount ?? 'N/A'}}">  
                                 </div>
                               </div>

                               <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="edelivery_time">Delivery Time(minutes)<span class="text-danger"> *</span></label>
                                    <input type="number" name="edelivery_time" class="form-control " id="edelivery_time" maxlength="100" value="{{$branchLocalities->delivery_time ?? 'N/A'}}">  
                                 </div>
                               </div>

                     </div>

                       <div class="card-footer" style="padding-top: 24px;">
                            <button type="submit" class="button btn_bg_color common_btn text-white p-0">Update</button>
                        </div>