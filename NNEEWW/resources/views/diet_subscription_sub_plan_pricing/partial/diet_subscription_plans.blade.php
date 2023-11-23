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
               <option {{$data->status == $statu->value ? 'selected':''}} value="{{ $statu->value }}">{{ $statu->name }}
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
            @forelse ($allPlanFeatures as $featuress)
            <option value="{{$featuress->id}}">{{$featuress->name?? '--'}}</option> 
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
</div>
</div>
<!-- /.card-body -->
<div class="card-footer">
   <button type="text"
   class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.save') }}</button>
</div>
</form>