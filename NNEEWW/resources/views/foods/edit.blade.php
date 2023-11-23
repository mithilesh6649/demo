@extends('adminlte::page')
@section('title', 'Edit Food')
@section('content_header')
@section('content')


<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Edit Food</h3>
                            <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ route('food.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body main_body form p-3">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form id="addSpecializationForm" method="post" action="{{ route('food.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="food_id" value="{{$data->id}}">
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
                                        <div class="form-group"> <label>Name<span class="text-danger">
                                        *</span></label>
                                        <input type="text" name="brand_name" class="form-control"
                                        id="brand_name" maxlength="100" value="{{ $data->brand_name ?? ''}}">
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
                                    <div class="form-group"> <label>Description<span class="text-danger">
                                    *</span></label>
                                    <input type="text" name="brand_description" class="form-control"
                                    id="brand_description" maxlength="100" value="{{ $data->brand_description ?? ''}}">
                                </div>
                            </div>



                            <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                                <div class="form-group">
                                    <label>Image (500 x 300) </label>
                                    <span class="position-relative">
                                        <input type="file" name="thumbnail"
                                        class="thumbnail_pic input-file" onchange="readURL(this);"
                                        accept=".png, .jpg, .jpeg" class="form-control">
                                    </span>
                                    <div class="upload-img" style="position:relative; margin-top:10px;">
                                        <a href="javascript:;"
                                        class="remove-pro-img {{ $data->image != null ? '' : 'd-none' }} "
                                        style="display:block;position: absolute;right:-10px;top:-6px;">
                                        <svg width="25" height="25" viewBox="0 0 257 256"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2088_553)">
                                            <path
                                            d="M254.85 141.81C253.9 157.47 249.21 172.11 241.97 185.85C222.7 222.45 192.59 244.9 152.18 253.57C150.9 253.85 149.55 253.82 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                            fill="#F7F9FA" />
                                            <path
                                            d="M254.85 141.81C251.98 142.27 250.79 139.87 249.24 138.32C230 119.18 210.83 99.9701 191.64 80.7801C190.08 79.2301 188.55 77.6401 186.86 76.2301C186.73 76.1101 186.6 76.0101 186.47 75.9101C186.37 75.8201 186.27 75.7401 186.17 75.6601C179.43 68.4101 174.9 68.2601 167.78 75.3201C156.31 86.6701 144.95 98.1401 133.52 109.53C128.75 114.28 128.21 114.29 123.52 109.63C111.61 97.7701 99.7803 85.8401 87.8503 74.0101C83.5703 69.7701 79.6603 69.0701 75.8503 71.6001C70.9103 74.8801 70.1903 80.2701 74.3803 84.8201C79.1203 89.9501 84.2103 94.7501 89.1403 99.7001C96.6603 107.24 104.24 114.72 111.71 122.31C115.58 126.24 115.59 127.4 111.66 131.37C100.3 142.84 88.8503 154.21 77.4403 165.63C76.0403 167.04 74.5503 168.4 73.4803 170.11C70.4303 174.98 71.1603 179.23 75.6803 182.84C76.5803 183.56 77.6903 184.03 78.3503 185.05C78.4203 185.21 78.4903 185.36 78.5803 185.51C78.5903 185.55 78.6103 185.59 78.6403 185.63C79.4203 187.06 80.6103 188.16 81.7603 189.31C101.43 208.97 121.13 228.61 140.72 248.36C142.99 250.65 145.76 252.04 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                            fill="#E11B1B" />
                                            <path
                                            d="M254.851 141.81C253.901 157.47 249.211 172.11 241.971 185.85C222.701 222.45 192.591 244.9 152.181 253.57C150.901 253.85 149.551 253.82 148.231 253.94C145.631 253.93 143.601 252.98 141.691 251.05C121.101 230.32 100.401 209.7 79.8109 188.98C79.0309 188.19 76.6309 187.69 78.2509 185.61C78.3609 185.58 78.471 185.55 78.581 185.51C85.011 183.79 89.421 179.22 93.911 174.65C103.951 164.44 114.101 154.34 124.281 144.26C128.391 140.18 129.551 140.18 133.721 144.32C144.961 155.46 156.111 166.68 167.301 177.86C168.361 178.92 169.391 180.01 170.501 181.02C174.681 184.83 179.601 185.14 183.031 181.84C186.531 178.46 186.521 172.88 182.621 168.86C172.881 158.82 162.871 149.04 153.001 139.13C151.001 137.13 148.991 135.13 146.991 133.12C141.341 127.44 141.331 127.19 146.851 121.66C156.381 112.11 165.821 102.47 175.501 93.0802C180.591 88.1502 185.511 83.2702 186.471 75.9102C186.521 75.5802 186.551 75.2502 186.581 74.9102C188.681 75.4402 189.791 77.2202 191.171 78.6002C211.061 98.4402 230.911 118.32 250.781 138.17C252.071 139.45 253.491 140.6 254.851 141.81V141.81Z"
                                            fill="#C30606" />
                                            <path
                                            d="M186.59 74.9098C187.91 79.9298 186.29 83.8598 182.62 87.4598C170.4 99.4598 158.43 111.72 146.19 123.7C143.59 126.25 143.08 127.63 146.03 130.49C158.57 142.64 170.82 155.09 183.14 167.46C187.36 171.69 188.23 176.25 185.8 180.48C182.3 186.59 174.86 187.29 169.34 181.82C156.93 169.53 144.51 157.25 132.36 144.72C129.44 141.71 127.98 141.78 125.1 144.75C113.17 157.04 100.91 169.01 88.8705 181.2C85.8805 184.23 82.5405 185.95 78.2505 185.62C68.6605 181.06 67.5405 174.17 75.2105 166.49C87.3205 154.35 99.3805 142.15 111.65 130.17C114.22 127.66 114 126.36 111.57 123.97C98.8505 111.49 86.3205 98.8298 73.7205 86.2298C70.1505 82.6498 69.0905 78.4998 71.5605 73.9798C73.7705 69.9098 77.4505 68.2598 82.0605 68.8998C84.8505 69.2898 86.8105 71.0798 88.7205 72.9998C100.71 85.0298 112.83 96.9298 124.67 109.11C127.65 112.18 129.28 112.74 132.58 109.3C144.34 97.0498 156.48 85.1698 168.52 73.1898C175.19 66.5498 181.31 67.1798 186.6 74.9198L186.59 74.9098Z"
                                            fill="#FEFEFE" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2088_553">
                                                <rect width="256.1" height="255.86"
                                                fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <img src="{{ $data->image }}" id="thumbnail_preview"
                                class="{{ $data->image != null ? '' : 'd-none' }}"
                                style="width:300;height:130px;">
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
    <div class="form-group"> <label>Protein<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Fat<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Carbohydrate<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Fiber<span class="text-danger">
    *</span></label>
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



<div class="col-md-2 col-lg-2 col-xl-2 col-2 mb-3">
    <div class="form-group"> <label>Saturated fat<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Polyunsaturated fat<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Monounsaturated fat<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Trans fat<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Calories<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Cholesterol<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Sodium<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Potassium<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Sugar<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Added sugar<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Sugar alcohol<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Vitamin A<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Vitamin B6<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Vitamin B12<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Vitamin k<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Vitamin C<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Vitamin D<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Calcium<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Iron<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Dietary Fibre<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Magnesium<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Zinc<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Phosphorus<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Thiamin<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Riboflavin<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Niacin<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Folate DFE<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Folate Food<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Folic<span class="text-danger">
    *</span></label>
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
    <div class="form-group"> <label>Water<span class="text-danger">
    *</span></label>
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
<div class="card-footer">
    <button type="text"
    class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.save') }}</button>
</div>
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

<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>

<script>
    $(document).ready(function() {
       $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!",
    });
       $('#addSpecializationForm').validate({
        ignore: [],

        rules: {
            brand_name:{
                required: true
            },
            
        },
        messages: {
            brand_name: {
                required: "Name is required"
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
