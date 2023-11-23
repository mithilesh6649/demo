  <form id="EditSpecializationForm" method="post"
  action="{{ route('diet.subscription.sub.plan.update') }}" enctype="multipart/form-data">
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
       <input type="hidden"  name="id" value="{{$data->id}}">
       <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
         <div class="form-group ">
            <label for="status">Select Diet Subscription Plan<span class="text-danger">
            *</span></label>
            <select class="form-control" id="select" name="diet_plan_subscription_id">
               @foreach ($DietSubscriptionPlanList as $DietSubscriptionPlan)
               <option  {{@$data->dietSubPlanSubscriptionMap->diet_plan_subscription_id == $DietSubscriptionPlan->id ? 'selected':''}}  value="{{ $DietSubscriptionPlan->id }}">{{ $DietSubscriptionPlan->name }}
               </option>
               @endforeach
            </select>
         </div>
      </div>

      <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
         <div class="form-group"> <label>Title <span class="text-danger"> *</span>
         </label>
         <input   type="text" name="name" class="form-control"
         id="name" maxlength="100" value="{{$data->title}}"  >
      </div>
   </div>
   <div class="col-sm-6  ">
      <div class="form-group">
         <label for="amount">  Monthly Price </label>
         <input type="text" name="amount" class="form-control"
         id="amount"   value="{{$data->amount}}"  >
      </div>
   </div>

   <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
      <div class="form-group ">
         <label for="status">Status<span class="text-danger">
         *</span></label>
         <select class="form-control" id="select" name="status">
            @foreach ($status as $statu)
            <option {{$data->status == $statu->value ? 'selected':''}} value="{{ $statu->value }}">{{ $statu->name }}
            </option>
            @endforeach
         </select>
      </div>
   </div>

   <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
      <div class="form-group">
         <label>Diet Subscription Sub Feature</label>
         <select data-placeholder="Select Test" multiple
         class="chosen-select form-control" name="features_id[]"
         id="managers">
         <option value="" disabled>Select Diet Subscription Feature</option>
         @forelse ($allDietSubPlanFeatures as $featuress)
         <option value="{{$featuress->id}}" @foreach ($data->subPlanFeatureMap as $mm)
            @if ($mm['feature_id'] == $featuress->id)
            selected
            @endif @endforeach>{!!$featuress->name?? '--'!!}</option> 
            @empty
            <option disabled>Diet Subscription Feature Not Found
            </option>
            @endforelse
         </select>
      </div>
   </div>


   <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 {{ $data->id == 4 ? 'd-none':'' }}">
      {{-- start discount input  --}}
      <div class="d-flex align-items-center">
         <label class="mb-0">Is Discount</label><input type="checkbox"
         class="w-auto ml-2" name="is_paid" id="is_paid" {{$data->is_free != 1? 'checked':''}}>
      </div>
      <div id="discountInput" class="{{$data->is_free != 1 ? '':'d-none'}}" 
         >
         <div class="row">
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="first_name">Discount(%) </label>
                  <input type="number"  name="discount" max="100"
                  class="form-control" id="discount"
                  value="{{$data->discount}}">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

{{--$SubsSubPlanPricing--}}
<!--  -->
<span class="badge badge-pill badge-primary mb-3"> Step 2 :- Pricing of  Sub Plan</span>
<div class="row">

   <div class="col-md-12 col-lg-12 col-xl-12 col-12" id="plan_container">

          <!-- start loop  -->
           
           @forelse($SubsSubPlanPricing as $key => $SubPlanPricing)
              {{--$SubPlanPricing--}}
              <input type="hidden" name="sub_plan_pricing_id[{{$key}}][]"  value="{{$SubPlanPricing->id}}">
               <div class="row choices_child border p-4 mb-3">
         <div class="col-md-4  col-lg-4  col-xl-4 col-12">
            <div class="form-group">
               <label for="duration[]">Select Plan Duration</label>
               <select name="plan_duration[{{$key}}][]" id="plan_duration{{$key}}" class="form-control">
                    <option value="">Select Plan Duration</option>
                  @foreach($MonthDurations as $MonthDuration)

                  <option {{ $SubPlanPricing->duration == $MonthDuration->value ? 'selected':''}} value="{{$MonthDuration->value}}">{{$MonthDuration->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-4  col-lg-4  col-xl-4 col-12">
            <div class="mainArabicChoiceContainer">
               <div class="form-group">
                  <label for="amount">Amount<span
                     class="text-danger"> *</span></label>
                     <input type="number" name="plan_amount[{{$key}}][]" class="form-control"
                      step="any" value="{{ $SubPlanPricing->amount}}">
                  </div>
               </div>
            </div>
            <div class="col-md-3  col-lg-3  col-xl-3 col-12">
               <div class="form-group">
                  <label for="discount">Discount  </label>
                  <input type="number" name="plan_discount[{{$key}}][]" class="form-control"
                   step="any"  value="{{ $SubPlanPricing->discount}}">
               </div>
            </div>
              <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">
            <i data-id="{{$SubPlanPricing->id}}" class="text-danger fa fa-trash-alt delete-button-pre" style="font-size:28px;cursor:pointer;"></i>  
            </div>  
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
               <div class="form-group">
                  <label>Diet Subscription Sub Feature</label>
                  <select data-placeholder="Select Diet Subscription Sub Feature" multiple
                  class="chosen-select form-control" name="plan_feature_id[{{$key}}][]"
                  id="managers">
                 <!--  <option value="" disabled>Select Diet Subscription Feature</option>
                  @forelse ($allDietSubPlanDurationFeatures as $featuress)
                  <option value="{{$featuress->id}}">{{$featuress->name?? '--'}}</option>
                  @empty
                  <option disabled>Diet Subscription Feature Not Found
                  </option>
                  @endforelse -->

                  @forelse ($allDietSubPlanDurationFeatures as $featuress)
                  <option value="{{$featuress->id}}" @foreach ($SubPlanPricing->subPlanPricingFeatureMap as $mm)
                     @if ($mm['feature_id'] == $featuress->id)
                     selected
                     @endif @endforeach>{!!$featuress->name?? '--'!!}</option> 
                     @empty
                     <option disabled>Diet Subscription Feature Not Found
                     </option>
                     @endforelse

               </select>
            </div>
         </div>

      </div> 


           @empty 

           @endforelse 

          <!-- end loop -->
   </div>
   <button type="button" class="btn btn-success" id="add_plan_btn">Add Plans</button>
</div>
<!--  -->


</div>
</div>
<!-- /.card-body -->
<div class="card-footer">
   <button type="text"
   class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.update') }}</button>
</div>
</form>