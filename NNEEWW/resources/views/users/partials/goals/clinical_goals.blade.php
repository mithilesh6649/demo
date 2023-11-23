 
 

<div class="row mb-0 px-3">
	<div class="table-responsive">
		<table class="table align-middle text-center   mb-0">
			<thead>
				<tr>
					<th class="border-0 text-nowrap"></th>
					<th class="border-0 text-nowrap">Action plan</th>
					<th class="border-0 text-nowrap">Current</th>
					<th class="border-0 text-nowrap">Goal</th>
				</tr>
			</thead>
			<tbody class="clinical_goal_main_container">
				

				@forelse($healthStatusdata as $healthStatus)
                      
				   <tr class="remove_goals" id="{{@$healthStatus['clinical_goal_id']}}">
                    <th class="border-0 table_heading text-start">{{App\Models\UserClinicalGoal::getClinicalGoalName(@$healthStatus['clinical_goal_id'])}}</th>

                    <td class="border-0 table_action text-nowrap">
						<select disabled name='action_plan[]' class="form-select h-auto bg-transparent border form-control"
						aria-label="Default select example" style="padding-right: 44px !important;padding: 0.375rem 2.25rem 0.375rem 0.75rem;">
						<option selected value="">None</option>
						<option {{@$healthStatus["action_plan_id"] == "12" ? "selected":"" }}  value="12">Lose</option>
						<option {{@$healthStatus["action_plan_id"] == "13" ? "selected":"" }} value="13">Maintain</option>
						<option {{@$healthStatus["action_plan_id"] == "14" ? "selected":"" }} value="14">Gain</option>
						</select>
                    </td>
                    <td class="border-0 table_current text-nowrap">
						<input readonly type="text" name="current_goal[]" class="form-control goals-input_log" value="{{@$healthStatus['current_goal']}}">
						<input readonly type='hidden' name="clinical_goals_id[]" value="{{@$healthStatus['clinical_goal_id']}}">
                    </td>
                    <td class="border-0 table_goals text-nowrap">
                    <input readonly type="text" name="target_goal[]" class="form-control goals-input_log" value="{{@$healthStatus['target_goal']}}">
                    </td>
				<!-- 	<td>
						<i class="fa fa-trash delete_clinical_goals" aria-hidden="true" style="font-size: 25px;cursor:pointer;"  data-id="{{@$healthStatus['id']}}"></i>
					 </td> -->
                    </tr>
				@empty
				  
				@endforelse	
				
			</tbody>
			<tr>
				<th class="border-0 border-top text-start">Other information</th>
			 
				 <td class="border-0 border-top text-nowrap" colspan="4">
                <textarea readonly class="form-control" name="user_clinical_goals_other_information">{{@$User->healthStatus->user_clinical_goals_other_information}}</textarea>
            </td>
			</tr>  
		</table>
	</div>
</div>