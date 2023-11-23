 <div class="row"> 
 	<div class="col-6">
 		<div class="form-group">
 			<label for="status">Marital status</label>
 			<select disabled   name="status" class="form-control" id="status">
 				<option value="">Select Marital Status</option>
 				@foreach ($maritalstatus as $maritalinfo)
 				<option
 				{{ @$User->UserMetadata->personal_marital_status == $maritalinfo->value ? 'selected' : '' }}
 				value="{{ $maritalinfo->value }}">{{ $maritalinfo->name }}</option>
 				@endforeach
 			</select>
 		</div>
 	</div>



 	<div class="col-6">
 		<div class="form-group">
 			<label for="personal_bowel_movement">Bowel movements</label>
 			<select disabled    class="form-control" id="personal_bowel_movement"
 			name="personal_bowel_movement">
 			<option value="">Select Bowel movement</option>
 			@foreach ($bowel_movements as $bowel_movement)
 			<option
 			{{ @$User->UserMetadata->personal_bowel_movement == $bowel_movement->value ? 'selected' : '' }}
 			value="{{ $bowel_movement->value }}">{{ $bowel_movement->name }}</option>
 			@endforeach
 		</select>
 	</div>
 </div>
 

 <div class="col-6">
    
 	<div class="form-group">
 		<label for="personal_bowel_movement">Smoker</label>
 		 
                 <select class=" form-control  w-100 " disabled >
                <option >Select Smoker</option>
                <option {{ @$User->UserMetadata->personal_smoker == '0' ? 'selected' : '' }} >Never</option>
                    <option {{ @$User->UserMetadata->personal_smoker == '1' ? 'selected' : '' }}
                        value="1">Rarely</option>

                        <option {{ @$User->UserMetadata->personal_smoker == '2' ? 'selected' : '' }}
                            value="2">Regularly</option>


                            <option {{ @$User->UserMetadata->personal_smoker == '3' ? 'selected' : '' }}
                                value="3">Socially</option>


                            </select>
 			</div>
 		</div>
 

 		<div class="col-6">

 			<div class="form-group">
 				<label >Alcohol consumption</label>
             <select class="form-select form-control w-100" disabled>
                            <option value="">Select Alcohol consumption</option>
                            <option
                            {{ @$User->UserMetadata->personal_alcohol_consumption == '0' ? 'selected' : '' }}
                            value="0">Never</option>
                            <option
                            {{ @$User->UserMetadata->personal_alcohol_consumption == '1' ? 'selected' : '' }}
                            value="1">Rarely</option>
                            <option
                            {{ @$User->UserMetadata->personal_alcohol_consumption == '2' ? 'selected' : '' }}
                            value="2">Regularly</option>
                            <option
                            {{ @$User->UserMetadata->personal_alcohol_consumption == '3' ? 'selected' : '' }}
                            value="3">Socially</option>

                        </select>
 		</div>
 	</div>


 	<div class="col-6">
 		<div class="form-group">
 			<label for="personal_bowel_movement">Sleep Quality</label>
 			<select disabled class="form-select  w-100  form-control" aria-label="Default select example"
 			name="personal_sleep_quality">
 			<option value="">Select Sleep Quality</option>
 			@foreach ($sleep_quality as $sleep_quality_info)
 			<option
 			{{ @$User->UserMetadata->personal_sleep_quality == $sleep_quality_info->value ? 'selected' : '' }}
 			value="{{ $sleep_quality_info->value }}">{{ $sleep_quality_info->name }}</option>
 			@endforeach
 		</select>
 	</div>
 </div>

 <div class="col-6">
 	<div class="form-group">
 		<label>Usual wake up time</label>
 		<input readonly type="time" name="personal_usual_wake_up_time" class="w-100 usual_wake_up_time form-control"
 		value="{{ @$User->UserMetadata->personal_usual_wake_up_time ?? '--' }}" >
 	</div>
 </div>


 <div class="col-6">
 	<div class="form-group">
 		<label>Usual bedtime</label>
 		<input readonly type="time" name="personal_usual_bedtime" class=" w-100 usual_bedtime form-control" 
 		value="{{ @$User->UserMetadata->personal_usual_bedtime ?? '--' }}">
 	</div>
 </div>


 <div class="col-6">
 	<div class="form-group">
 		<label for="personal_bowel_movement">Physical Activity</label>
 		<select  disabled class="form-select   w-100  form-control " aria-label="Default select example"
 		name="personal_physical_activity">
 		<option value="">Select Physical Activity</option>
 		@foreach ($health_activity as $health_activity_info)
 		<option
 		{{ @$User->UserMetadata->personal_physical_activity == $health_activity_info->id ? 'selected': '' }}
 		value="{{ $health_activity_info->id }}">{{ $health_activity_info->name }}</option>
 		@endforeach
 	</select>
 </div>
</div>

<div class="col-md-12">
	<div class="form-group">
		<label for="descripiton">Other information</label>
		<textarea readonly name="description" class="form-control" rows="4" readonly="">{{@$User->UserMetadata->personal_other_information ?? '--'}}</textarea>
	</div>
</div>






</div>