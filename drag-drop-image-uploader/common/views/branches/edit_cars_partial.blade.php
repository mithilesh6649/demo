          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group branches">
                       <label for="password">  Cars<span class="text-danger"> *</span></label>
                        
                         <input type="hidden" name="current_id" value="{{$branch_car_id}}">
                        
                         <select class="advance_category_search catselect" name="cars_id"  style="width:200px;">
                              
                             
                             @forelse ($cars as $car)
                                  <option value="{{$car->id}}" {{$car->id == $selcar ? 'selected':''}} {{in_array($car->id,$assign_cars) ? 'disabled' :' ' }}>{{ $car->model}} ({{ $car->no_plate}})</option>
                              @empty
                                   <option disabled>Car not found</option>
                              @endforelse

                            </select>  

                      </div>
                    </div>