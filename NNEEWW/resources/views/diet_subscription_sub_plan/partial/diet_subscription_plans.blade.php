  <form id="EditSpecializationForm" method="post"
  action="{{ route('diet.subscription.sub.plan.save') }}" enctype="multipart/form-data">
  @csrf
  
  <div class="card-body">
   @if ($errors->any())
   <div class="alert alert-warning">
      <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
   @endif  
   <div class="information_fields mb-0">
      <div class="row">

       <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
         <div class="form-group ">
            <label for="status">Select Diet Subscription Plan<span class="text-danger">
            *</span></label>
            <select class="form-control" id="select" name="diet_plan_subscription_id">
               @foreach ($DietSubscriptionPlanList as $DietSubscriptionPlan)
               <option value="{{ $DietSubscriptionPlan->id }}">{{ $DietSubscriptionPlan->name }}
               </option>
               @endforeach
            </select>
         </div>
      </div>

      <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
         <div class="form-group"> <label>Title <span class="text-danger"> *</span>
         </label>
         <input   type="text" name="name" class="form-control"
         id="name" maxlength="100"  >
      </div>
   </div>
   <div class="col-sm-6  ">
      <div class="form-group">
         <label for="amount">  Monthly Price </label>
         <input type="text" name="amount" class="form-control"
         id="amount"  >
      </div>
   </div>

   <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
      <div class="form-group ">
         <label for="status">Status<span class="text-danger">
         *</span></label>
         <select class="form-control" id="select" name="status">
            @foreach ($status as $statu)
            <option  value="{{ $statu->value }}">{{ $statu->name }}
            </option>
            @endforeach
         </select>
      </div>
   </div>

   <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
      <div class="form-group">
         <label>Diet Subscription Sub Feature</label>
         <select data-placeholder="Select Diet Subscription Sub Feature" multiple
         class="chosen-select form-control" name="features_id[]"
         id="managers">
         <option value="" disabled>Select Diet Subscription Feature</option>
         @forelse ($allDietSubPlanFeatures as $featuress)
         <option value="{{$featuress->id}}">{!!$featuress->name?? '--'!!}</option> 
         @empty
         <option disabled>Diet Subscription Feature Not Found
         </option>
         @endforelse
      </select>
   </div>
</div>


<div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 ">
   {{-- start discount input  --}}
   <div class="d-flex align-items-center">
      <label class="mb-0">Is Discount</label><input type="checkbox"
      class="w-auto ml-2" name="is_paid" id="is_paid" >
   </div>
   <div id="discountInput" class="d-none" 
   >
   <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
            <label for="first_name">Discount(%) </label>
            <input type="number"  name="discount" max="100"
            class="form-control" id="discount"
            >
         </div>
      </div>
   </div>
</div>
</div>
</div>

<!--  -->
<span class="badge badge-pill badge-primary mb-3"> Step 2 :- Pricing of  Sub Plan</span>
<div class="row">

   <div class="col-md-12 col-lg-12 col-xl-12 col-12" id="plan_container">

      <!-- <input type="hidden" name="id[]" class="form-control"  > -->
      
      <div class="row choices_child border p-4 mb-3">
         <div class="col-md-4  col-lg-4  col-xl-4 col-12">
            <div class="form-group">
               <label for="duration[]">Select Plan Duration</label>
               <select name="plan_duration[0][]" id="plan_duration" class="form-control">
                  <option value="">Select Plan Duration</option>
                  @foreach($MonthDurations as $MonthDuration)
                  <option value="{{$MonthDuration->value}}">{{$MonthDuration->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-4  col-lg-4  col-xl-4 col-12">
            <div class="mainArabicChoiceContainer">
               <div class="form-group">
                  <label for="amount">Amount<span
                     class="text-danger"> *</span></label>
                     <input type="number" name="plan_amount[0][]" class="form-control"
                     value="" step="any">
                  </div>
               </div>
            </div>
            <div class="col-md-3  col-lg-3  col-xl-3 col-12">
               <div class="form-group">
                  <label for="discount">Discount  </label>
                  <input type="number" name="plan_discount[0][]" class="form-control"
                  value="" step="any">
               </div>
            </div>
           <!--  <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">
            <i class="text-danger fa fa-trash-alt delete-button-just-created" style="font-size:28px;cursor:pointer;"></i>  
            </div> -->
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
               <div class="form-group">
                  <label>Diet Subscription Sub Feature</label>
                  <select data-placeholder="Select Diet Subscription Sub Feature" multiple
                  class="chosen-select form-control" name="plan_feature_id[0][]"
                  id="managers">
                  <option value="" disabled>Select Diet Subscription Feature</option>
                  @forelse ($allDietSubPlanDurationFeatures as $featuress)
                  <option value="{{$featuress->id}}">{!!$featuress->name?? '--'!!}</option>
                  @empty
                  <option disabled>Diet Subscription Feature Not Found
                  </option>
                  @endforelse
               </select>
            </div>
         </div>

      </div>
   </div>
   <button type="button" class="btn btn-success" id="add_plan_btn">Add Plans</button>
</div>
<!--  -->

</div>
</div>
<!-- /.card-body -->
<div class="card-footer">
   <button type="text"
   class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.save') }}</button>
</div>
</form>