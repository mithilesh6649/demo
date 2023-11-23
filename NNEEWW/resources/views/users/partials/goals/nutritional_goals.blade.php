 

 <div class="row mb-0 px-3">
    <div class="table-responsive">
        <table class="table align-middle text-center   mb-0">
            <thead>
                <tr>
                    <th class="border-0 text-nowrap"></th>
                    <th class="border-0 text-nowrap">Action plan</th>
                    <th class="border-0 text-nowrap">Goal</th>
                </tr>
            </thead>
            <tbody class="nutritional_goal_main_container">

                @forelse($nutritionalGoals as $nutritionalGoal)
  
                   <tr class="remove_nutritional_goals" id="{{@$nutritionalGoal->nutritional_goal_id}}">
                    <th class="border-0 text-nowrap text-start">{{App\Models\UserClinicalGoal::getClinicalGoalName(@$nutritionalGoal->nutritional_goal_id)}} </th>
                    <td class="border-0 text-nowrap">
                        <select disabled class="form-control bg-transparent border w-100 h-100"
                        aria-label="Default select example" name="nutritional_action_plan[]">
                           <option selected value="">None</option>
                    <option {{@$nutritionalGoal->action_plan_id == "12" ? "selected":"" }}  value="12">Lose</option>
                    <option {{@$nutritionalGoal->action_plan_id == "13" ? "selected":"" }} value="13">Maintain</option>
                    <option {{@$nutritionalGoal->action_plan_id == "14" ? "selected":"" }} value="14">Gain</option>
                    </select>
                </td>
                <td class="border-0 text-nowrap">
                 <input readonly  type="hidden" name="nutritional_goals_id[]" value="{{@$nutritionalGoal->nutritional_goal_id}}">
                 <input readonly type="text" name="nutritional_goals[]" class="form-control" value="{{@$nutritionalGoal->goal}}">
                </td>
                <!-- <td>
                    <i class="fa fa-trash delete_nutritional_goals" aria-hidden="true" style="font-size: 25px;cursor:pointer;"  data-id="{{@$nutritionalGoal->id}}"></i>
                 </td> -->
            </tr>
                @empty
                  
                @endforelse 

            </tbody>
        <tr>
            <th class="border-0 border-top text-nowrap text-start">Other
            information</th>
             
                 <td class="border-0 border-top text-nowrap" colspan="3">
                <textarea readonly class="form-control" name="nutritional_goals_other_information">{{@$getUserDetails->healthStatus->nutritional_goals_other_information}}
                </textarea>
            </td>
        </tr>
    </table>
 </div>
</div>
 