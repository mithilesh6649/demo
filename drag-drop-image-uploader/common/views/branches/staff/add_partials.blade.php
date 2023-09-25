  
@if($count == 0) 

<div class="row mb-3">

    <div class="col-md-1 col-lg-1 col-xl-1 col-12">
        <div class="form-group">
           <!--  <label for="name_en">S/No<span class="text-danger"> *</span> </label> -->
            <div class="d-flex align-items-center justify-content-center" style="height: 45px;">
             <span class="serial_number">1</span>
         </div>
     </div>
 </div>

  <div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
       <!--  <label for="name_en">Staff Code<span class="text-danger"> *</span></label> -->
        <input type="text" name="staff_code[]" class="form-control staff_code" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;">
    </div>
  </div> 

  <div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
      <!--   <label for="name_en">Staff name<span class="text-danger"> *</span></label> -->
        <input type="text" name="staff_name[]" class="form-control staff_name" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" readonly>
    </div>
  </div>

  <div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
      <!--   <label for="name_en">Designation<span class="text-danger"> *</span></label> -->
        <input type="text" name="designation[]" class="form-control designation" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" readonly>
    </div>
  </div>
  <div class="col-md-2 col-lg-2 col-xl-2 col-12">
      <div class="form-group">
        <!--   <label for="name_en">Points </label> -->
          <input type="text" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" readonly>
      </div>
  </div>


  <div class="col-md-2 col-lg-2 col-xl-2 col-12"> 
      <div class="form-group">
         <!--  <label for="name_en">Start Date<span class="text-danger"> *</span></label> -->
         <!--  <input type="date" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;"  > -->
        <input disabled data-date-format="dd/mm/yyyy" id="datepicker" name="start_date[]" class="datepicker start_date" style="width:180px !important;">
      </div>
  </div>
</div>
   <!--         
             <div class="col">
            <input data-date-format="dd/mm/yyyy" id="datepicker" class="datepicker">
        </div>
 -->
           <!-- <div class="col-md-1 col-lg-1 col-xl-1 col-1" style="margin-top:30px;display:flex;justify-content:center;align-items:center;">
             <i class="text-success" style="font-size:14px;cursor:pointer;">Default</i> 
         </div> -->
         <!--     <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete" style="margin-top:30px;display:flex;justify-content:center;align-items:center;">
              <i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:14px;cursor:pointer"></i> 
          </div> -->

  </div>

</div> 


@endif

@if($count == 1)

@foreach ($CheckData as $keys => $allExistingData)
{{--$allExistingData--}}

@if($keys == 0)
<div class="row mb-3">

    <div class="col-md-1 col-lg-1 col-xl-1 col-12">
        <div class="form-group">
          <!--   <label style="opacity: 0;" for="name_en">S/No </label> -->
            <div class="d-flex align-items-center justify-content-center" style="height: 45px;">
             <span class="serial_number">1</span>
         </div>
     </div>
 </div>

 <div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
        <!-- <label for="name_en">Staff Code<span class="text-danger"> *</span></label> -->
        <input type="text" name="staff_code[]" class="form-control staff_code" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->staff_code}}" readonly>
    </div>
</div> 

<div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
        <!-- <label for="name_en">Staff name<span class="text-danger"> *</span></label> -->
        <input type="text" name="staff_name[]" class="form-control staff_name" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->staff_name}}" readonly>
    </div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
        <!-- <label for="name_en">Designation<span class="text-danger"> *</span></label> -->
        @forelse ($Alldesignation as $designation)
        @if($designation->id==$allExistingData->staff->designation_id)
        <input type="text" name="designation[]" class="form-control designation" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{ $designation->designation }}" readonly>
        @endif
        @empty
        @endforelse
    </div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group"> 
        <!-- <label for="name_en">Points </label> -->
        <input type="text" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->points}}" readonly>
    </div>
</div>

        <div class="col-md-2 col-lg-2 col-xl-2 col-12"> 
            <div class="form-group">
                <!-- <label for="name_en">Start Date<span class="text-danger"> *</span></label> -->
               <!--  <input type="date" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;"  > -->
                <input data-date-format="dd/mm/yyyy" value="{{date('d/m/Y ',strtotime($allExistingData->start_date))}}" id="datepicker" name="start_date[]" class="datepicker start_date" style="width:120px !important;pointer-events: none;">
             </div>
            </div>

            <!--  <div class="col-md-1 col-lg-1 col-xl-1 col-1 " style="margin-top:30px;display:flex;justify-content:center;align-items:center;">
               <i class="text-success" style="font-size:14px;cursor:pointer">Default</i>   
           </div> -->

           <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete" style="margin-top:0px;display:flex;justify-content:center;align-items:center;">
              <i class="text-danger fa fa-trash-alt choice_remove_btn_flags" data-id="{{$allExistingData->staff_id}}" style="font-size:14px;cursor:pointer"></i> 
          </div>

      </div>

      @else 

      <div class="row mb-3">

        <div class="col-md-1 col-lg-1 col-xl-1 col-12">
            <div class="form-group">
            
             <div class="d-flex align-items-center justify-content-center" style="height: 45px;">
                 <span class="serial_number">1</span>
             </div>
         </div>
     </div>

     <div class="col-md-2 col-lg-2 col-xl-2 col-12">
        <div class="form-group">
         <!--  <label for="name_en">Staff Code<span class="text-danger"> *</span></label> -->
         <input type="text" name="staff_code[]" class="form-control staff_code" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->staff_code}}" readonly>
     </div>
 </div> 

 <div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
     <!--  <label for="name_en">Staff name<span class="text-danger"> *</span></label> -->
     <input type="text" name="staff_name[]" class="form-control staff_name" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->staff_name}}" readonly>
 </div>
</div>


<div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
      <!--   <label for="name_en">Designation<span class="text-danger"> *</span></label> -->
      @forelse ($Alldesignation as $designation)
      @if($designation->id==$allExistingData->staff->designation_id)
      <input type="text" name="designation[]" class="form-control designation" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{ $designation->designation }}" readonly>
      @endif
      @empty
      @endforelse
  </div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
        <!-- <label for="name_en">Points </label> -->
        <input type="text" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->points}}" readonly>
    </div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-12"> 
  <div class="form-group">
     <!--  <label for="name_en">Start Date<span class="text-danger"> *</span></label> -->
     <!--  <input type="date" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;"  > -->
      <input data-date-format="dd/mm/yyyy" value="{{date('d/m/Y ',strtotime($allExistingData->start_date))}}" id="datepicker" name="start_date[]" class="datepicker start_date" style="width:120px !important;pointer-events: none;">
   </div>
</div>
  <!--  <div class="col-md-1 col-lg-1 col-xl-1 col-1 " style="margin-top:30px;display:flex;justify-content:center;align-items:center;">
     <i class="text-success" style="font-size:14px;cursor:pointer">Default</i>   
 </div> -->

 <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete" style="margin-top:0px;display:flex;justify-content:center;align-items:center;">
    <i class="text-danger fa fa-trash-alt choice_remove_btn_flags" data-id="{{$allExistingData->staff_id}}" style="font-size:14px;cursor:pointer"></i> 
</div>
</div>



      @endif 

      @endforeach


      @endif



      @if($count == 3) 
      <div class="row mb-3">

       <div class="col-md-1 col-lg-1 col-xl-1 col-12">
           <div class="form-group">
             
             <div class="d-flex align-items-center justify-content-center" style="height: 45px;">
                <span class="serial_number">1</span>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-lg-2 col-xl-2 col-12">
        <div class="form-group">
            <!-- <label for="name_en">Staff Code<span class="text-danger"> *</span></label> -->
            <input type="text" name="staff_code[]" class="form-control staff_code" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;">
        </div>
    </div> 


    <div class="col-md-2 col-lg-2 col-xl-2 col-12">
      <div class="form-group">
        <!--   <label for="name_en">Staff name<span class="text-danger"> *</span></label> -->
        <input type="text" name="staff_name[]" class="form-control staff_name" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" readonly>
    </div>
</div>
<div class="col-md-2 col-lg-2 col-xl-2 col-12">
    <div class="form-group">
       <!--    <label for="name_en">Designation<span class="text-danger"> *</span></label> -->
       <input type="text" name="designation[]" class="form-control designation" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;"  readonly>
   </div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-12">
  <div class="form-group">
     <!--    <label for="name_en">Points </label> -->
     <input type="text" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" readonly>
 </div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-12"> 
    <div class="form-group">
      <input disabled data-date-format="dd/mm/yyyy" id="datepicker" name="start_date[]" class="datepicker start_date" style="width:120px !important;">
    </div>
</div>

<div class="col-md-1 col-lg-1 col-xl-1 col-1 delete" style="margin-top:0px;display:flex;justify-content:center;align-items:center;">
    <i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:14px;cursor:pointer"></i> 
</div>

  @endif

  