 
<form id="addCustomizeForm" enctype="multipart/form-data" class="model-back p-0">
                                @csrf
                                <input type="hidden" value="{{$DietSubPlanSubscriptionMap[0]->diet_plan_subscription_id}}" id="diet_plan_subscription_id">
                                <div class="card-body form">
                                    <div class="row">
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                        <div class="form-group">
                                            <label for="diet_id">Select Sub Plan</label>
                                            <select name="diet_id" id="diet_id" class="form-control">
                                                <!-- <option value="10"> Met Max </option> -->
                                                @forelse ($DietSubPlanSubscriptionMap as $DietSubPlanSubscription)
                                                 <option {{$DietSubPlanSubscription->diet->id == $firstSubPlanId ? 'selected':''}} value="{{$DietSubPlanSubscription->diet->id}}">{{@$DietSubPlanSubscription->diet->title}}</option>
                                                @empty
                                                  <option disabled>Not Found</option>
                                                @endforelse
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label for="sub_plan">Sub Plan<span class="text-danger">
                                            *</span></label>
                                            <input type="text" name="sub_plan" class="form-control"
                                            id="sub_plan" maxlength="100"
                                            value="{{$firstSubPlanName}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                        <div class="form-group">
                                            <label for="sub_plan">Description<span class="text-danger">
                                            *</span></label>
                                            <textarea >A house plan is a drawing that illustrates the layout of a home. House plans are useful because they give you an idea of the flow of the home and how each room connects with each other. Typically house plans include the location of walls, windows, doors, and stairs, as well as fixed installations. Sometimes they include suggested furniture layouts and built-out outdoor areas like terraces and balconies. They are usually drawn to scale and indicate room types along with room sizes and key wall lengths.</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                        <div class="modal_content">
                                            <div class="add-choices d-flex justify-content-end" style="margin-top: 20px;">
                                                <button type="button" class="add_new_plan">Add More </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="choices_parent w-100" id="plan_container">
                                       

                                        @foreach($allSubPricing as $allSubPrice)
                       <input type="hidden" name="id[]" class="form-control" value="{{@$allSubPrice->id}}"  >
                                             <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                            <div class="row choices_child mt-2">
                                                <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                                 <div class="form-group">
                                                    <label for="duration[]">Select Plan Duration</label>
                                                    <select name="duration[]" id="duration[]" class="form-control">
                                                          @foreach($MonthDurations as $MonthDuration)
                                                        <option {{$allSubPrice->duration==$MonthDuration->value ? 'selected':''}} value="{{$MonthDuration->value}}">{{$MonthDuration->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                                <div class="mainArabicChoiceContainer">
                                                    <div class="form-group">
                                                        <label for="amount">Amount<span
                                                            class="text-danger"> *</span></label>
                                                            <input type="number" name="amount[]" class="form-control"
                                                            value="{{@$allSubPrice->amount}}" step="any">
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-md-3  col-lg-3  col-xl-3 col-12">
                                                    <div class="form-group">
                                                        <label for="discount">Discount  </label>
                                                        <input type="number" name="discount[]" class="form-control"
                                                       value="{{@$allSubPrice->discount}}"step="any">
                                                    </div>
                                                </div>  

                                                  <div  class="col-md-1 col-lg-1 col-xl-1 col-1 ">
                                                 <i data-id="{{ $allSubPrice->id }}" class="text-danger fa fa-trash-alt delete-button" style="font-size:28px;cursor: pointer;"></i> <!-- <i
                                                    class="text-success"
                                                    style="font-size:14px; margin-top:20px;">Default</i> -->
                                            </div>

                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- add choices -->
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer pb-0 px-0" style="margin-top: 24px;">
                                    <button type="submit" class="button btn_bg_color common_btn text-white">Save</button>
                                </div>
                            </div>
                        </form>