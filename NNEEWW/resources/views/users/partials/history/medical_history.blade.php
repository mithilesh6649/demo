 <div class="row">


 	<div class="col-12" style="pointer-events:none;">
 		<div class="form-group">
 			<label for="personal_bowel_movement">Diseases</label>
 		 
              <select   class="js-select2" multiple="multiple" name="diseases[]"> @foreach ($AllDiseases as $AllDisease) <option @if (in_array($AllDisease->id, $userhealthcomplaintids)) selected @endif value="{{ $AllDisease->id }}"> {{ $AllDisease->name }}</option> @endforeach </select>
 		</div>
 	</div>


 	<div class="col-md-6">
 		<div class="form-group">
 			<label for="descripiton">Medication</label>
 			<textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->medical_medication ?? '--' }}</textarea>
 		</div>
 	</div>

 	<div class="col-md-6">
 		<div class="form-group">
 			<label for="descripiton">Personal history	</label>
 			<textarea name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->personal_history ?? '--' }}</textarea>
 		</div>
 	</div>

 	<div class="col-md-6">
 		<div class="form-group">
 			<label for="descripiton">Family history</label>
 			<textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->medical_family_history ?? '--' }}</textarea>
 		</div>
 	</div>


 	<div class="col-md-6">
 		<div class="form-group">
 			<label for="descripiton">Other information</label>
 			<textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->medical_other_information ?? '--' }}</textarea>
 		</div>
 	</div>
  

     <div class="medical_table  "  >
         <h4>Medical history family Continued</h4>
         <div class="table-responsive">
             <table class="table text-center align-middle table-bordered">
                 <thead>
                     <tr class="table_heading">
                         <th scope="col">Condition</th>
                         <th scope="col">Mother</th>
                         <th scope="col">Father</th>
                         <th scope="col">Sibling 1</th>
                         <th scope="col">Sibling 2</th>
                         <th scope="col">Maternal Grandmother</th>
                         <th scope="col">Maternal Grandfather</th>
                         <th scope="col">Paternal Grandmother</th>
                         <th scope="col">Paternal Grandfather</th>
                     </tr>
                 </thead>
                 <tbody style="pointer-events:none;">

                     <tr>
                         <th style="white-space:nowrap;">Diabetes</th>

                         <td style="white-space:nowrap;">
                             <input type="radio" ids="one" class="diseases_radio_check" name="mohter_diabetes"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['mohter_diabetes'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check" name="mohter_diabetes"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['mohter_diabetes'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>


                         <td style="white-space:nowrap;">
                             <input type="radio" ids="three" class="diseases_radio_check" name="father_diabetes"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['father_diabetes'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check" name="father_diabetes"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['father_diabetes'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>

                         <td style="white-space:nowrap;">
                             <input type="radio" ids="five" class="diseases_radio_check" name="sibling_one_diabetes"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['sibling_one_diabetes'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check" name="sibling_one_diabetes"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['sibling_one_diabetes'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>

                         <td style="white-space:nowrap;">
                             <input type="radio" ids="seven" class="diseases_radio_check" name="sibling_two_diabetes"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['sibling_two_diabetes'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check" name="sibling_two_diabetes"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['sibling_two_diabetes'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>


                         <td style="white-space:nowrap;">
                             <input type="radio" ids="one" class="diseases_radio_check"
                             name="maternal_grandmother_diabetes" value="1"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['maternal_grandmother_diabetes'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check"
                             name="maternal_grandmother_diabetes" value="0"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['maternal_grandmother_diabetes'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>


                         <td style="white-space:nowrap;">
                             <input type="radio" ids="three" class="diseases_radio_check"
                             name="maternal_grandfater_diabetes" value="1"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['maternal_grandfater_diabetes'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check"
                             name="maternal_grandfater_diabetes" value="0"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['maternal_grandfater_diabetes'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="five" class="diseases_radio_check"
                             name="paternal_grandmother_diabetes" value="1"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['paternal_grandmother_diabetes'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check"
                             name="paternal_grandmother_diabetes" value="0"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['paternal_grandmother_diabetes'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="seven" class="diseases_radio_check"
                             name="paternal_grandfather_diabetes" value="1"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['paternal_grandfather_diabetes'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check"
                             name="paternal_grandfather_diabetes" value="0"
                             {{ @$User->UserMetadata->family_medical_history['diabetes']['paternal_grandfather_diabetes'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>
                     </tr>



                     <tr>
                         <th style="white-space:nowrap;">Hypertension</th>
                         <td>
                             <input type="radio" ids="one" class="diseases_radio_check"
                             name="mohter_hypertension" value="1"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['mohter_hypertension'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check"
                             name="mohter_hypertension" value="0"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['mohter_hypertension'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>

                         <td>
                             <input type="radio" ids="three" class="diseases_radio_check"
                             name="father_hypertension" value="1"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['father_hypertension'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check"
                             name="father_hypertension" value="0"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['father_hypertension'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>

                         <td>
                             <input type="radio" ids="five" class="diseases_radio_check"
                             name="sibling_one_hypertension" value="1"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['sibling_one_hypertension'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check"
                             name="sibling_one_hypertension" value="0"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['sibling_one_hypertension'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>

                         <td>
                             <input type="radio" ids="seven" class="diseases_radio_check"
                             name="sibling_two_hypertension" value="1"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['sibling_two_hypertension'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check"
                             name="sibling_two_hypertension" value="0"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['sibling_two_hypertension'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>

                         <td style="white-space:nowrap;">
                             <input type="radio" ids="one" class="diseases_radio_check"
                             name="maternal_grandmother_hypertension" value="1"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['maternal_grandmother_hypertension'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check"
                             name="maternal_grandmother_hypertension" value="0"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['maternal_grandmother_hypertension'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="three" class="diseases_radio_check"
                             name="maternal_grandfater_hypertension" value="1"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['maternal_grandfater_hypertension'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check"
                             name="maternal_grandfater_hypertension" value="0"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['maternal_grandfater_hypertension'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="five" class="diseases_radio_check"
                             name="paternal_grandmother_hypertension" value="1"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['paternal_grandmother_hypertension'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check"
                             name="paternal_grandmother_hypertension" value="0"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['paternal_grandmother_hypertension'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="seven" class="diseases_radio_check"
                             name="paternal_grandfather_hypertension" value="1"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['paternal_grandfather_hypertension'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check"
                             name="paternal_grandfather_hypertension" value="0"
                             {{ @$User->UserMetadata->family_medical_history['hypertensions']['paternal_grandfather_hypertension'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>
                     </tr>
                     <tr>
                         <th style="white-space:nowrap;">Cardiovascular Diseases</th>
                         <td>
                             <input type="radio" ids="one" class="diseases_radio_check"
                             name="mohter_cardiovascular_diseases" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['mohter_cardiovascular_diseases'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check"
                             name="mohter_cardiovascular_diseases" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['mohter_cardiovascular_diseases'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>
                         <td>
                             <input type="radio" ids="three" class="diseases_radio_check"
                             name="father_cardiovascular_diseases" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['father_cardiovascular_diseases'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check"
                             name="father_cardiovascular_diseases" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['father_cardiovascular_diseases'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>
                         <td>
                             <input type="radio" ids="five" class="diseases_radio_check"
                             name="sibling_one_cardiovascular_diseases" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['sibling_one_cardiovascular_diseases'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check"
                             name="sibling_one_cardiovascular_diseases" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['sibling_one_cardiovascular_diseases'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>
                         <td>
                             <input type="radio" ids="seven" class="diseases_radio_check"
                             name="sibling_two_cardiovascular_diseases" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['sibling_two_cardiovascular_diseases'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check"
                             name="sibling_two_cardiovascular_diseases" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['sibling_two_cardiovascular_diseases'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="one" class="diseases_radio_check"
                             name="maternal_grandmother_cardiovascular_diseases" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['maternal_grandmother_cardiovascular_diseases'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check"
                             name="maternal_grandmother_cardiovascular_diseases" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['maternal_grandmother_cardiovascular_diseases'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="three" class="diseases_radio_check"
                             name="maternal_grandfater_cardiovascular_diseases" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['maternal_grandfater_cardiovascular_diseases'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check"
                             name="maternal_grandfater_cardiovascular_diseases" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['maternal_grandfater_cardiovascular_diseases'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="five" class="diseases_radio_check"
                             name="paternal_grandmother_cardiovascular_diseases" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['paternal_grandmother_cardiovascular_diseases'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check"
                             name="paternal_grandmother_cardiovascular_diseases" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['paternal_grandmother_cardiovascular_diseases'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="seven" class="diseases_radio_check"
                             name="paternal_grandfather_cardiovascular_diseases" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['paternal_grandfather_cardiovascular_diseases'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check"
                             name="paternal_grandfather_cardiovascular_diseases" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cardiovascular_diseasess']['paternal_grandfather_cardiovascular_diseases'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>
                     </tr>


                     <tr>
                         <th style="white-space:nowrap;">Asthma</th>
                         <td>
                             <input type="radio" ids="one" class="diseases_radio_check" name="mohter_asthma"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['mohter_asthma'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check" name="mohter_asthma"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['mohter_asthma'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>
                         <td>
                             <input type="radio" ids="three" class="diseases_radio_check" name="father_asthma"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['father_asthma'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check" name="father_asthma"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['father_asthma'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>



                         <td>
                             <input type="radio" ids="five" class="diseases_radio_check" name="sibling_one_asthma"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['sibling_one_asthma'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check" name="sibling_one_asthma"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['sibling_one_asthma'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>
                         <td>
                             <input type="radio" ids="seven" class="diseases_radio_check" name="sibling_two_asthma"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['sibling_two_asthma'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check" name="sibling_two_asthma"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['sibling_two_asthma'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="one" class="diseases_radio_check"
                             name="maternal_grandmother_asthma" value="1"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['maternal_grandmother_asthma'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check"
                             name="maternal_grandmother_asthma" value="0"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['maternal_grandmother_asthma'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="three" class="diseases_radio_check"
                             name="maternal_grandfater_asthma" value="1"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['maternal_grandfater_asthma'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check"
                             name="maternal_grandfater_asthma" value="0"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['maternal_grandfater_asthma'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="five" class="diseases_radio_check"
                             name="paternal_grandmother_asthma" value="1"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['paternal_grandmother_asthma'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check"
                             name="paternal_grandmother_asthma" value="0"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['paternal_grandmother_asthma'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="seven" class="diseases_radio_check"
                             name="paternal_grandfather_asthma" value="1"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['paternal_grandfather_asthma'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check"
                             name="paternal_grandfather_asthma" value="0"
                             {{ @$User->UserMetadata->family_medical_history['asthmas']['paternal_grandfather_asthma'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>
                     </tr>

                     <tr>
                         <th style="white-space:nowrap;">Cancer</th>
                         <td>
                             <input type="radio" ids="one" class="diseases_radio_check" name="mohter_cancer"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['mohter_cancer'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check" name="mohter_cancer"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['mohter_cancer'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>
                         <td>
                             <input type="radio" ids="three" class="diseases_radio_check" name="father_cancer"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['father_cancer'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check" name="father_cancer"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['father_cancer'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>
                         <td>
                             <input type="radio" ids="five" class="diseases_radio_check" name="sibling_one_cancer"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['sibling_one_cancer'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check" name="sibling_one_cancer"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['sibling_one_cancer'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>
                         <td>
                             <input type="radio" ids="seven" class="diseases_radio_check" name="sibling_two_cancer"
                             value="1"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['sibling_two_cancer'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check" name="sibling_two_cancer"
                             value="0"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['sibling_two_cancer'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="one" class="diseases_radio_check"
                             name="maternal_grandmother_cancer" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['maternal_grandmother_cancer'] == '1' ? 'checked' : '' }}>
                             <label for="one" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="two" class="diseases_radio_check"
                             name="maternal_grandmother_cancer" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['maternal_grandmother_cancer'] == '0' ? 'checked' : '' }}>
                             <label for="two" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="three" class="diseases_radio_check"
                             name="maternal_grandfather_cancer" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['maternal_grandfather_cancer'] == '1' ? 'checked' : '' }}>
                             <label for="three" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="four" class="diseases_radio_check"
                             name="maternal_grandfather_cancer" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['maternal_grandfather_cancer'] == '0' ? 'checked' : '' }}>
                             <label for="four" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="five" class="diseases_radio_check"
                             name="paternal_grandmother_cancer" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['paternal_grandmother_cancer'] == '1' ? 'checked' : '' }}>
                             <label for="five" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="six" class="diseases_radio_check"
                             name="paternal_grandmother_cancer" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['paternal_grandmother_cancer'] == '0' ? 'checked' : '' }}>
                             <label for="six" class="ms-3 me-4">No</label>
                         </td>
                         <td style="white-space:nowrap;">
                             <input type="radio" ids="seven" class="diseases_radio_check"
                             name="paternal_grandfather_cancer" value="1"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['paternal_grandfather_cancer'] == '1' ? 'checked' : '' }}>
                             <label for="seven" class="ms-3 me-4">Yes</label>

                             <input type="radio" ids="eight" class="diseases_radio_check"
                             name="paternal_grandfather_cancer" value="0"
                             {{ @$User->UserMetadata->family_medical_history['cancers']['paternal_grandfather_cancer'] == '0' ? 'checked' : '' }}>
                             <label for="eight" class="ms-3 me-4">No</label>
                         </td>
                     </tr>
                     
                     <tr>
                         <th style="white-space:nowrap;">Other Conditions please specify</th>
                         <td>
                             <textarea name="mohter_other_conditions" class="w-100 mohter_other_conditions" rows="1" >{{ @$User->UserMetadata->family_medical_history['others_conditions']['mohter_other_conditions'] }}</textarea>

                         </td>
                         <td>
                           <textarea name="father_other_conditions" class="w-100 father_other_conditions" rows="1" >{{ @$User->UserMetadata->family_medical_history['others_conditions']['father_other_conditions'] }}</textarea>

                        <!--    <input type="text" name="father_other_conditions"
                         value="{{ @$User->UserMetadata->family_medical_history['others_conditions']['father_other_conditions'] }}"> -->
                     </td>
                     <td>
                       
                        <textarea name="sibling_one_other_conditions" class="w-100 sibling_one_other_conditions" rows="1" >{{ @$User->UserMetadata->family_medical_history['others_conditions']['sibling_one_other_conditions'] }}</textarea>

                      <!--   <input type="text" name="sibling_one_other_conditions"
                        value="{{ @$User->UserMetadata->family_medical_history['others_conditions']['sibling_one_other_conditions'] }}"> -->
                    </td>
                    <td>
                        <textarea name="sibling_two_other_conditions" class="w-100 sibling_two_other_conditions" rows="1" >{{ @$User->UserMetadata->family_medical_history['others_conditions']['sibling_two_other_conditions'] }}</textarea>

                      <!--   <input type="text" name="sibling_two_other_conditions"
                        value="{{ @$User->UserMetadata->family_medical_history['others_conditions']['sibling_two_other_conditions'] }}"> -->
                    </td>
                    <td>
                       <textarea name="maternal_grandmother_other_conditions" class="w-100 maternal_grandmother_other_conditions" rows="1" >{{ @$User->UserMetadata->family_medical_history['others_conditions']['maternal_grandmother_other_conditions'] }}</textarea>
<!-- 
                     <input type="text" name="maternal_grandmother_other_conditions"
                     value="{{ @$User->UserMetadata->family_medical_history['others_conditions']['maternal_grandmother_other_conditions'] }}"> -->
                 </td>
                 <td>
                     <textarea name="maternal_grandfather_other_conditions" class="w-100 maternal_grandfather_other_conditions" rows="1" >{{ @$User->UserMetadata->family_medical_history['others_conditions']['maternal_grandfather_other_conditions'] }}</textarea>
                 <!--   <input type="text" name="maternal_grandfather_other_conditions"
                     value="{{ @$User->UserMetadata->family_medical_history['others_conditions']['maternal_grandfather_other_conditions'] }}"> -->
                 </td>
                 <td>
                    <textarea name="paternal_grandmother_other_conditions" class="w-100 paternal_grandmother_other_conditions" rows="1" >{{ @$User->UserMetadata->family_medical_history['others_conditions']['paternal_grandmother_other_conditions'] }}</textarea>
              <!--   <input type="text" name="paternal_grandmother_other_conditions"
                value="{{ @$User->UserMetadata->family_medical_history['others_conditions']['paternal_grandmother_other_conditions'] }}"> -->
            </td>
            <td>
               <textarea name="paternal_grandfather_other_conditions" class="w-100 paternal_grandfather_other_conditions" rows="1" >{{ @$User->UserMetadata->family_medical_history['others_conditions']['paternal_grandfather_other_conditions'] }}</textarea>
<!-- 
             <input type="text" name="paternal_grandfather_other_conditions"
             value="{{ @$User->UserMetadata->family_medical_history['others_conditions']['paternal_grandfather_other_conditions'] }}"> -->
         </td>
     </tr>
 </tbody>
</table>
</div>
</div>


</div>

