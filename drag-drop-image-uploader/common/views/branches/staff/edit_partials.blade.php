  
 @if($count == 0) 
  
        <div class="content-staff row">
               
             <p class="nostaff">No Staff added yet</p>   
       

        </div> 


 @endif

@if($count == 1)
 
 @foreach ($CheckData as $key => $allExistingData)
   
{{--$allExistingData--}}
 
<div class="row mb-3">
 
<div class="col-md-1 col-lg-1 col-xl-1 col-12">
<div class="form-group d-flex align-items-center justify-content-start" style="height: 50px;">
 <div class="mt-2">
   <span class="serial_number">1</span>
 </div>
</div>
</div>
<div class="col-md-2 col-lg-2 col-xl-2 col-12">
<div class="form-group">
<!-- <label for="name_en">Staff Code<span class="text-danger"> *</span></label> -->
<input type="text" name="staff_code[]" class="form-control staff_code" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->staff_code}}"  readonly>
</div>
</div> 


<div class="col-md-2 col-lg-2 col-xl-2 col-12">
<div class="form-group">
<!-- <label for="name_en">Staff name<span class="text-danger"> *</span></label> -->
<input type="text" name="staff_name[]" class="form-control staff_name" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->staff_name}}" readonly >
</div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2 col-2">
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



<div class="col-md-1 col-lg-1 col-xl-1 col-12">
<div class="form-group">

<input type="text" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$allExistingData->staff->points}}"  readonly>
</div>
</div>



<div class="col-md-2 col-lg-2 col-xl-2 col-12">
<div class="form-group branch">
<!-- <label for="password">  Branch<span class="text-danger"> *</span></label>            -->
<select class="branch_search catselect form-control" name="branch_id[]"  >
<!-- <option value="">Branch</option> -->

@forelse ($Allbranch as $branch)
<option value="{{$branch->id}}"   {{$allExistingData->branch_id==$branch->id?'selected':' ' }} >{{ $branch->title_en }}</option>
@empty
<option class="disabled">Branch not found</option>
@endforelse
</select>   
</div>
</div>



<div class="col-md-1 col-lg-1 col-xl-1 col-12"> 
<div class="form-group">
<!-- <label for="name_en">Start Date<span class="text-danger"> *</span></label> -->
<!--  <input type="date" name="points[]" class="form-control points" id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;"  > -->
<input data-date-format="dd/mm/yyyy" value="{{date('d/m/Y ',strtotime($allExistingData->start_date))}}" id="datepicker" name="start_date[]" class="datepicker start_date" style="width:100px !important;" start-date="{{date('d/m/Y ',strtotime($allExistingData->start_date))}}" staff-id="{{$allExistingData->staff_id}}" branch-id="{{$allExistingData->branch_id}}">
</div>
</div>



<div class="col-md-1 col-lg-1 col-xl-1 col-1 ">

<i class="text-danger fa fa-trash-alt choice_remove_btn_flags" data-id="{{$allExistingData->staff_id}}" style="font-size: 14px;
    cursor: pointer;
    text-align: right;
    display: flex;
    align-items: center;
    justify-content: end;
    height: 50px;"></i> 
 

</div> 

</div>    


@endforeach


@endif

 