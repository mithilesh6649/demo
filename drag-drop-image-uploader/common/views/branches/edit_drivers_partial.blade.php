          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group branches">
                       <label for="password">  Drivers<span class="text-danger"> *</span></label>
                        
                         <input type="hidden" name="current_id" value="{{$branch_dri_id}}">
                        
                         <select class="advance_category_search catselect" name="driver_id"  style="width:200px;">
                              
                             
                             @forelse ($drivers as $driver)
                                  <option value="{{$driver->id}}" {{$driver->id == $seldri ? 'selected':''}} {{in_array($driver->id,$assign_drivers) ? 'disabled' :' ' }}>{{ $driver->drivers_name}}</option>
                              @empty
                                   <option disabled>Driver not found</option>
                              @endforelse

                            </select>  

                      </div>
                    </div>