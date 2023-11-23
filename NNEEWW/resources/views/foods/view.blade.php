@extends('adminlte::page')
@section('title', '  Food Details')
@section('content_header')
@section('content')


<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">   Food Details</h3>
                            <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ route('food.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body main_body form p-3">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form style="pointer-events: none;" id="addSpecializationForm" method="post" action="{{ route('food.save') }}"
                            enctype="multipart/form-data">
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
                                <div class="row">
                                   <div class="col-md-4 font-weight-bold text-success">  Details</div>
                               </div>
                               <hr>
                               <div class="information_fields mb-0">
                                <div class="row">

                                    <div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
                                        <div class="form-group"> <label>Name</label>
                                            <input readonly type="text" name="brand_name" class="form-control"
                                            id="brand_name" maxlength="100" value="{{ $data->brand_name ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
                                        <div class="form-group"> <label>Description </label>
                                            <input readonly type="text" name="brand_description" class="form-control"
                                            id="brand_description" maxlength="100" value="{{ $data->brand_description ?? ''}}">
                                        </div>
                                    </div>



                                    <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                                        <div class="list mb-3">
                                            <label>Image (500 x 300) </label>

                                            <div class="list-img">
                                                @if (!empty($data->image))
                                                <img src="{{ $data->image }}"
                                                class="offer_image_box show-modal "
                                                current_image='pic_one' style="height:130px;">
                                                @else
                                                Image not available
                                                @endif
                                            </div>


                                        </div>
                                    </div>

                                     <!--  -->
                    <div class="col-md-12 text-success font-weight-bold">
                     Serving  
                     <hr>
                 </div>

                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                  <div class="form-group">
                    <label>Health Label</label>
                    <select data-placeholder="Select Health Label" multiple class="chosen-select form-control" name="health_label_id[]" id="managers">
                      <option value="" disabled>Select Health Label</option>
                      @forelse ($healthLabels as $healthLabel)
                      <option 
                      
                      @foreach ($data->foodHealthLabelMap as $mm)
                      @if ($mm['health_label_id'] == $healthLabel->id)
                      selected
                      @endif @endforeach  
                      
                      value="{{ $healthLabel->id }}">
                      {{ $healthLabel->title ?? ' ' }}
                  </option>
                  @empty
                  <option disabled>Test Not Found!</option>
                  @endforelse
              </select>
          </div>
      </div>

      <div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
         <div class="form-group">
          <label>Serving size<span class="text-danger">
          *</span></label>
          <div class="food_value_unit_box">
           <input type="number" name="serving_size" class="form-control"
           id="serving_size" maxlength="100" value="{{ $data->serving_size ?? ''}}">
         <!--   <select class="form-control" name="calories_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select> -->
    </div>
</div> 
</div>
<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
 <div class="form-group">
  <label>Serving type<span class="text-danger">
  *</span></label>
  <div class="food_value_unit_box">
   <input type="text" name="serving_type" class="form-control"
   id="serving_type" maxlength="19" placeholder="Ex-Cup,Tablespoon" value="{{ $data->serving_type ?? ''}}">

</div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Weight<span class="text-danger">
    *</span></label>
    <div class="food_value_unit_box">
        <input type="number" name="total_weight" class="form-control"
        id="total_weight" maxlength="100" value="{{ $data->total_weight ?? ''}}">
        
        <select class="form-control" name="total_weight_unit">
           <option class="text-center" value=""> Select Unit</option>
           @foreach($foodUnits as $foodUnit)
           <option
           {{$data->total_weight_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
           @endforeach 
       </select>  
   </div>
</div>
</div>

<!--  -->

                                    <div class="col-md-12 font-weight-bold text-success">  Macro Nutrients  <hr> </div>

                             

                    <div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
                        <div class="form-group"> <label>Protein</label>
                        <div class="food_value_unit_box">
                            <input step="any" type="number" name="protein" class="form-control"
                            id="protein"  step="any" value="{{ $data->protein ?? ''}}">
                            <select class="form-control" name="protein_unit">
                                <option class="text-center" value=""> Select Unit</option>
                                @foreach($foodUnits as $foodUnit)
                                <option {{$data->protein_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

 
                <div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
                    <div class="form-group"> <label>Fat</label>
                    <div class="food_value_unit_box">
                        <input step="any" type="number" name="total_fat" class="form-control"
                        id="total_fat" maxlength="100" value="{{ $data->total_fat ?? ''}}">
                        <select class="form-control" name="fat_unit">
                      
                            <option class="text-center" value=""> Select Unit</option>
                            @foreach($foodUnits as $foodUnit)
                            <option {{$data->total_fat_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Carbohydrate</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="total_carbohydrate" class="form-control"
    id="total_carbohydrate" maxlength="100" value="{{ $data->total_carbohydrate ?? ''}}">
     <select class="form-control" name="total_carbohydrate_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->total_carbohydrate_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Fiber</label>
    <div class="food_value_unit_box">
        <input type="number" name="fiber" class="form-control"
        id="fiber" maxlength="100" value="{{ $data->fiber ?? ''}}">
        <select class="form-control" name="fiber_unit" >
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->fiber_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>
            
<div class="col-md-6">

</div>

<div class="col-md-12 font-weight-bold text-success">  Micro Nutrients  <hr> </div>

<!-- 
<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Serving size</label>
    <input step="any" type="number" name="serving_size" class="form-control"
    id="serving_size" maxlength="100" value="{{ $data->serving_size ?? ''}}">
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Serving type</label>
    <input step="any" type="number" name="serving_type" class="form-control"
    id="serving_type" maxlength="100" value="{{ $data->serving_type ?? ''}}">
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Serving size in gram</label>
    <input step="any" type="number" name="serving_size_in_gram" class="form-control"
    id="serving_size_in_gram" maxlength="100" value="{{ $data->serving_size_in_gram ?? ''}}">
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Serving container</label>
    <input step="any" type="number" name="serving_container" class="form-control"
    id="serving_container" maxlength="100" value="{{ $data->serving_container ?? ''}}">
</div>
</div> -->


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
                <div class="form-group"> <label>Saturated fat</label>
                <div class="food_value_unit_box">
                    <input step="any" type="number" name="saturated_fat" class="form-control"
                    id="saturated_fat" maxlength="100" value="{{ $data->saturated_fat ?? ''}}">
                    <select class="form-control" name="saturated_fat_unit">
                        <option class="text-center" value=""> Select Unit</option>
                        @foreach($foodUnits as $foodUnit)
                        <option {{$data->saturated_fat_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
            <div class="form-group"> <label>Polyunsaturated fat </label>
            <div class="food_value_unit_box">
                <input step="any" type="number" name="polyunsaturated_fat" class="form-control"
                id="polyunsaturated_fat" maxlength="100" value="{{ $data->polyunsaturated_fat ?? ''}}">
                <select class="form-control" name="polyunsaturated_fat_unit">
                    <option class="text-center" value=""> Select Unit</option>
                    @foreach($foodUnits as $foodUnit)
                    <option {{$data->polyunsaturated_fat_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
        <div class="form-group"> <label>Monounsaturated fat </label>
        <div class="food_value_unit_box">
            <input step="any" type="number" name="monounsaturated_fat" class="form-control"
            id="monounsaturated_fat" maxlength="100" value="{{ $data->monounsaturated_fat ?? ''}}">
            <select class="form-control" name="monounsaturated_fat_unit">
                <option class="text-center" value=""> Select Unit</option>
                @foreach($foodUnits as $foodUnit)
                <option {{$data->monounsaturated_fat_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Trans fat</label>
    <div class="food_value_unit_box">
        <input step="any" type="number" name="trans_fat" class="form-control"
        id="trans_fat" maxlength="100" value="{{ $data->trans_fat ?? ''}}">
        <select class="form-control" name="trans_fat_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->trans_fat_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Calories</label>
    <div class="food_value_unit_box">
        <input step="any" type="number" name="calories" class="form-control"
        id="calories" maxlength="100" value="{{ $data->calories ?? ''}}">
        
            <select>
            <option class="text-center">kcal</option>
         
        </select>
    </div>
</div>
</div>



<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Cholesterol</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="cholesterol" class="form-control"
    id="cholesterol" maxlength="100" value="{{ $data->cholesterol ?? ''}}">
     <select class="form-control" name="cholesterol_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->cholesterol_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Sodium</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="sodium" class="form-control"
    id="sodium" maxlength="100" value="{{ $data->sodium ?? ''}}">
     <select class="form-control" name="sodium_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->sodium_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Potassium</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="potassium" class="form-control"
    id="potassium" maxlength="100" value="{{ $data->potassium ?? ''}}">
     <select class="form-control" name="potassium_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->potassium_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>



<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Sugar</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="sugar" class="form-control"
    id="sugar" maxlength="100" value="{{ $data->sugar ?? ''}}">
     <select class="form-control" name="sugar_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->sugar_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Added sugar</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="added_sugar" class="form-control"
    id="added_sugar" maxlength="100" value="{{ $data->added_sugar ?? ''}}">
     <select class="form-control" name="added_sugar_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->added_sugar_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Sugar alcohol</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="sugar_alcohol" class="form-control"
    id="sugar_alcohol" maxlength="100" value="{{ $data->sugar_alcohol ?? ''}}">
     <select class="form-control" name="sugar_alcohol_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->sugar_alcohol_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>




<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Vitamin A</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="vitamin_a" class="form-control"
    id="vitamin_a" maxlength="100" value="{{ $data->vitamin_a ?? ''}}">
     <select class="form-control" name="vitamin_a_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->vitamin_a_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div> 
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Vitamin B6</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="vitamin_b_6" class="form-control"
    id="vitamin_b_6" maxlength="100" value="{{ $data->vitamin_b_6 ?? ''}}">
     <select class="form-control" name="vitamin_b_6_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->vitamin_b_6_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>



<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Vitamin B12</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="vitamin_b_12" class="form-control"
    id="vitamin_b_12" maxlength="100" value="{{ $data->vitamin_b_12 ?? ''}}">
     <select class="form-control" name="vitamin_b_12_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->vitamin_b_12_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Vitamin k</label>
    <div class="food_value_unit_box">
        <input step="any" type="number" name="vitamin_k" class="form-control"
        id="vitamin_k" maxlength="100" value="{{ $data->vitamin_k ?? ''}}">
       <select class="form-control" name="vitamin_k_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->vitamin_k_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Vitamin C</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="vitamin_c" class="form-control"
    id="vitamin_c" maxlength="100" value="{{ $data->vitamin_c ?? ''}}">
     <select class="form-control" name="vitamin_c_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->vitamin_c_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>



<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Vitamin D</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="vitamin_d" class="form-control"
    id="vitamin_d" maxlength="100" value="{{ $data->vitamin_d ?? ''}}">
     <select class="form-control" name="vitamin_d_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->vitamin_d_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Calcium</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="calcium" class="form-control"
    id="calcium" maxlength="100" value="{{ $data->calcium ?? ''}}">
     <select class="form-control" name="calcium_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->calcium_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Iron</label>
      <div class="food_value_unit_box">
    <input step="any" type="number" name="iron" class="form-control"
    id="iron" maxlength="100" value="{{ $data->iron ?? ''}}">
     <select class="form-control" name="iron_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->iron_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<!--  -->
 
 <div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Dietary Fibre</label>
    <div class="food_value_unit_box">
        <input type="number" name="dietary_fibre" class="form-control"
        id="dietary_fibre" maxlength="100" value="{{ $data->dietary_fibre ?? ''}}">
        <select class="form-control" name="dietary_fibre_unit">
            <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->dietary_fibre_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Magnesium</label>
    <div class="food_value_unit_box">
        <input type="number" name="magnesium" class="form-control"
        id="magnesium" maxlength="100" value="{{ $data->magnesium ?? ''}}">
        <select class="form-control" name="magnesium_unit">
             <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->magnesium_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Zinc</label>
    <div class="food_value_unit_box">
        <input type="number" name="zinc" class="form-control"
        id="zinc" maxlength="100" value="{{ $data->zinc ?? ''}}">
        <select class="form-control" name="zinc_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->zinc_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Phosphorus</label>
    <div class="food_value_unit_box">
        <input type="number" name="phosphorus" class="form-control"
        id="phosphorus" maxlength="100" value="{{ $data->phosphorus ?? ''}}">
        <select class="form-control" name="phosphorus_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->phosphorus_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Thiamin</label>
    <div class="food_value_unit_box">
        <input type="number" name="thiamin" class="form-control"
        id="thiamin" maxlength="100" value="{{ $data->thiamin ?? ''}}">
        <select class="form-control" name="thiamin_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->thiamin_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Riboflavin</label>
    <div class="food_value_unit_box">
        <input type="number" name="riboflavin" class="form-control"
        id="riboflavin" maxlength="100" value="{{ $data->riboflavin ?? ''}}">
        <select class="form-control" name="riboflavin_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->riboflavin_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Niacin</label>
    <div class="food_value_unit_box">
        <input type="number" name="niacin" class="form-control"
        id="niacin" maxlength="100" value="{{ $data->niacin ?? ''}}">
        <select class="form-control" name="niacin_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->niacin_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Folate DFE</label>
    <div class="food_value_unit_box">
        <input type="number" name="folate_dfe" class="form-control"
        id="folate_dfe" maxlength="100" value="{{ $data->folate_dfe ?? ''}}">
        <select class="form-control" name="folate_dfe_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->folate_dfe_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Folate Food</label>
    <div class="food_value_unit_box">
        <input type="number" name="folate_food" class="form-control"
        id="folate_food" maxlength="100" value="{{ $data->folate_food ?? ''}}">
        <select class="form-control" name="folate_food_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->folate_food_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Folic</label>
    <div class="food_value_unit_box">
        <input type="number" name="folic" class="form-control"
        id="folic" maxlength="100" value="{{ $data->folic ?? ''}}">
        <select class="form-control" name="folic_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->folic_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>



<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Water</label>
    <div class="food_value_unit_box">
        <input type="number" name="water" class="form-control"
        id="water" maxlength="100" value="{{ $data->water ?? ''}}">
        <select class="form-control" name="water_unit">
              <option class="text-center" value=""> Select Unit</option>
            @foreach($foodUnits as $foodUnit)
            <option {{$data->water_unit == $foodUnit->value ? 'selected':''}} class="text-center">{{$foodUnit->value}}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

<!--  -->

</div>
</div>
<!-- /.card-body -->
 
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('css')
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />



@stop
@section('js')
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
</script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
<script>
    $(document).ready(function() {
           $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!",
    });
           
        $('#addSpecializationForm').validate({
            ignore: [],

            rules: {
                title:{
                    required: true
                },
                thumbnail:{
                    required:true
                }
            },
            messages: {
                title: {
                    required: "Title is required"
                },
                thumbnail: {
                    required: "Image is required"
                },
            },


        });

    });
</script>
<!-- show image on change -->
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#thumbnail_preview').css('display', 'block');
                $(".remove-pro-img").removeClass("d-none");
                $('#thumbnail_preview').attr('src', e.target.result);

                setTimeout(function() {

                    let image_pre = document.getElementById('thumbnail_preview');
                    var width = image_pre.naturalWidth;
                    var height = image_pre.naturalHeight;

                    console.log(width);
                    console.log(height);

                        //            if(width!=500 || height!=300){
                        //                swal({
                        //   title: "To Large Image",
                        //   text: "Please upload an image with 500 x 300   pixels dimension !",
                        //   type: "warning",
                        //  // showCancelButton: true,
                        //   confirmButtonColor: "#DD6B55",
                        //   confirmButtonText: "Change Image!",
                        //  // closeOnConfirm: false 
                        //   //  cancelButtonText: "Upload Any Way",   
                        // },
                        // function(){
                        //     //swal("Deleted!", "'Please upload an image with 500 x 300   pixels dimension'", "success");  
                        //      $(".remove-pro-img").addClass("d-none");
                        //      $("#thumbnail_preview").css('display', 'none');
                        //      $(".thumbnail_pic").val(null);   


                        // });

                        // }


                });




            };

            reader.readAsDataURL(input.files[0]);
                // alert(URL.createObjectURL(input.files[0]));


        }
    }



    $(".remove-pro-img").click(function(evt) {

        $(".remove-pro-img").addClass("d-none");
        $("#thumbnail_preview").css('display', 'none');

        $(".thumbnail_pic").val(null);


    });
</script>
<!-- show image on change -->

@stop
