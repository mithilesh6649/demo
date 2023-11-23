 
 <div class="row" >
 	<div class="col-6">
 		<div class="form-group">
 			<label for="status">Type of diet</label>
 			  <input readonly name="dietary_type_of_diet" class="w-100 dietary_type_of_diet" value="{{ @$User->UserMetadata->dietary_type_of_diet ?? '' }}">
 		 
 	</div>
 </div>

     

 <div class="col-6">
 	<div class="form-group">
 		<label for="personal_bowel_movement">Favorite Food</label>
 		   <input readonly name="dietary_favorite_food" class="w-100" value="{{ @$User->UserMetadata->dietary_favorite_food ?? '' }}">
 		 
 	</div>
 </div>


 <div class="col-6">
 	<div class="form-group">
 		<label for="personal_bowel_movement">Disliked Food</label>
 		  <input readonly name="dietary_disliked_food" class="w-100" value="{{ @$User->UserMetadata->dietary_disliked_food ?? '' }}">
 		 
 	</div>
 </div>


 <!-- <div class="col-6">
 	<div class="form-group">
 		<label for="personal_bowel_movement">Allergies</label>
 		<select disabled class="form-select w-100 form-control" id="allergies"
 		name="allergies[]">
 		@foreach ($AllAllergies as $AllAllergy)
 		<option   value="{{ $AllAllergy->id }}">
 			{{ $AllAllergy->name }}</option>
 			@endforeach
 		</select>


 	</div>
 </div>
 -->

  <div class="col-6" style="pointer-events: none;">
 	<div class="form-group">
 		<label for="personal_bowel_movement">Allergies</label>
 		  <select   class="js-select2" multiple="multiple" name="allergies[]"> @foreach ($AllAllergies as $AllAllergy) <option @if (in_array($AllAllergy->id, $userhealthcomplaintids)) selected @endif value="{{ $AllAllergy->id }}"> {{ $AllAllergy->name }}</option> @endforeach </select>


 	</div>
 </div>


  <div class="col-6" style="pointer-events: none;">
 	<div class="form-group">
 		<label for="personal_bowel_movement">Food Preferences</label>
 		  <select   class="js-select2" multiple="multiple" name="food_perferences[]">  @foreach ($AllFoodPerfrences as $AllFoodPerfrence) <option @if (in_array($AllFoodPerfrence->id, $userfoodperfrencesids)) selected @endif value="{{ $AllFoodPerfrence->id }}">{{ $AllFoodPerfrence->name }}</option> @endforeach</select>


 	</div>
 </div>

<!--  <div class="col-6">
 	<div class="form-group">
 		<label for="personal_bowel_movement">Food Preferences</label>
 		  <select class="form-select w-100 dropdown-select-input" multiple="multiple" id="food_perfrence_s" name="food_perferences[]"> @foreach ($AllFoodPerfrences as $AllFoodPerfrence) <option @if (in_array($AllFoodPerfrence->id, $userfoodperfrencesids)) selected @endif value="{{ $AllFoodPerfrence->id }}">{{ $AllFoodPerfrence->name }}</option> @endforeach </select>
 </div>
</div> -->






<div class="col-6">
	<div class="form-group">
		<label>Eating out pattern</label>
		  <select disabled class="form-control   w-100  dietary_eating_out_pattern" aria-label="Default select example" name="dietary_eating_out_pattern">
            <option value="">Select Eating out pattern</option> @foreach ($eating_patterns as $eating_pattern) <option {{ @$User->UserMetadata->dietary_eating_out_pattern == $eating_pattern->value ? 'selected' : '' }} value="{{ $eating_pattern->value }}">{{ $eating_pattern->name }}</option> @endforeach
          </select>
	</div>
</div>


<div class="col-12">
	<div class="form-group">
		<label>Supplements intake</label>
		  <textarea readonly class="w-100 dietary_supplements_intake" rows="1" name="dietary_supplements_intake">{{ @$User->UserMetadata->dietary_supplements_intake }}</textarea>
	</div>
</div>

<div class="col-md-12">
	<div class="form-group">
		<label for="descripiton">Nutritional deficiencies</label>
		<textarea readonly name="description" class="form-control" rows="4" readonly="">{{@$User->UserMetadata->dietary_nutritional_deficiencies ?? '--'}}</textarea>
	</div>
</div>
 

<div class="col-md-12">
	<div class="form-group">
		<label for="descripiton">Other information</label>
		<textarea readonly name="description" class="form-control" rows="4" readonly="">{{@$User->UserMetadata->dietary_other_information ?? '--'}}</textarea>
	</div>
</div>






</div>