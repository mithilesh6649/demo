<div class="card_apppoint">


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
                <tbody>
                    <tr>
                        <th class="border-0 table_heading text-nowrap text-start">Weight (Kg)</th>
                        <td class="border-0 table_action text-nowrap">
                            <select disabled class="form-control bg-transparent border w-100 h-100"
                            aria-label="Default select example" name="weight_action_plan"
                            style="padding-right: 44px !important;">


                            @foreach ($action_plans as $action_plan)
                            <option 
                            {{ @$User->healthStatus->goal_id == $action_plan->id ? 'selected' : '' }}
                            value="{{ $action_plan->id }}">
                            {{ str_replace('Weight', '', $action_plan->name) }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td class="border-0 table_current text-nowrap">
                    <input readonly type="number" name="current_weight" id="current_weight"
                    class="form-control goals-input_log"
                    value="{{ @$User->healthStatus->weight_into_kg }}">
                </td>
                <td class="border-0 table_goals text-nowrap">
                    <input readonly type="number" name="target_weight" id="target_weight"
                    class="form-control goals-input_log"
                    value="{{ @$User->healthStatus->target_weight }}">
                </td>
            </tr>
            <tr>
                <th class="border-0 text-nowrap text-start">Waist circumference (cm)
                </th>
                <td class="border-0 text-nowrap">
                    <select disabled class="form-control bg-transparent border w-100 h-100"
                    aria-label="Default select example" name="waist_action_plan"
                    style="padding-right: 44px !important;">
                    <option selected value="">None</option>

                    @foreach ($action_plans as $action_plan)
                    <option
                    {{ @$User->healthStatus->waist_action_plan == $action_plan->id ? 'selected' : '' }}
                    value="{{ $action_plan->id }}">
                    {{ str_replace('Weight', '', $action_plan->name) }}
                </option>
                @endforeach
            </select>
        </td>
        <td class="border-0 text-nowrap"><input readonly type="number" name="current_waist_circumference"
            value="{{ @$User->healthStatus->current_waist_circumference }}"
            class="form-control goals-input_log"> </td>
            <td class="border-0 text-nowrap"><input  readonly type="number" name="target_waist_circumference"
                value="{{ @$User->healthStatus->target_waist_circumference }}"
                class="form-control goals-input_log"> </td>
            </tr>
            <tr>
                <th class="border-0 text-nowrap text-start">Hip circumference (cm)</th>
                <td class="border-0 text-nowrap">
                    <select disabled  class="form-control bg-transparent border w-100 h-100"
                    aria-label="Default select example" name="hip_action_plan"
                    style="padding-right: 44px !important;">
                    <option selected value="">None</option>
                    @foreach ($action_plans as $action_plan)
                    <option
                    {{ @$User->healthStatus->hip_action_plan == $action_plan->id ? 'selected' : '' }}
                    value="{{ $action_plan->id }}">
                    {{ str_replace('Weight', '', $action_plan->name) }}</option>
                    @endforeach
                </select>
            </td>
            <td class="border-0 text-nowrap"><input readonly type="number" name="current_hip_circumference"
                class="form-control goals-input_log"
                value="{{ @$User->healthStatus->current_hip_circumference ?? '' }}"> </td>
                <td class="border-0 text-nowrap"><input readonly type="number" name="target_hip_circumference"
                    class="form-control goals-input_log"
                    value="{{ @$User->healthStatus->target_hip_circumference ?? '' }}"> </td>
                </tr>

                <tr>
                    <th class="border-0 text-nowrap text-start">Height (cm)</th>

                    <td class="border-0 text-nowrap" colspan="3"><input readonly type="number" name="height"
                        id="height" class="form-control goals-input_log"
                        value="{{ @$User->healthStatus->height_into_cm ?? '' }}"> </td>

                    </tr>


                    <tr>
                        <th class="border-0 text-nowrap text-start">BMI</th>
                        <td class="border-0 text-nowrap">
                            <select disabled class="form-control bg-transparent border w-100 h-100"
                            aria-label="Default select example" name="bmi_action_plan"
                            style="padding-right: 44px !important;">
                            <option selected value="">None</option>
                            @foreach ($action_plans as $action_plan)
                            <option
                            {{ @$User->healthStatus->bmi_action_plan == $action_plan->id ? 'selected' : '' }}
                            value="{{ $action_plan->id }}">
                            {{ str_replace('Weight', '', $action_plan->name) }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="border-0 text-nowrap"><input readonly type="number" name="bmi"
                        class="form-control goals-input_log"
                        value="{{ @$User->healthStatus->bmi ?? '' }}" id="current_bmi"> </td>
                        <td class="border-0 text-nowrap"><input readonly type="number" name="target_bmi"
                            class="form-control goals-input_log" id="goal_bmi"
                            value="{{ @$User->healthStatus->target_bmi ?? '' }}"> </td>
                        </tr>

                        <tr>
                            <th class="border-0 border-top text-nowrap text-start">Weekly Goals</th>

                            <td class="border-0 border-top text-nowrap" colspan="3">
                               <select disabled class="form-control" name="weekly_goals">
                             <!-- <option value="7"> 0.2 kg per week</option>
                             <option value="8"> 0.5 kg per week</option>
                             <option value="9"> 0.8 kg per week</option>
                             <option value="10"> 1 kg per week</option> -->
                             @foreach ($weekly_goals as $weekly_goal)
                             <option
                             {{ @$User->healthStatus->weekly_goals == $weekly_goal->id ? 'selected' : '' }}
                             value="{{ $weekly_goal->id }}">
                             {{ str_replace('Loose', '', $weekly_goal->name) }}</option>
                             @endforeach
                         </select>
                     </td>

                 </tr>   

                 <tr>
                    <th class="border-0 border-top text-nowrap text-start">Other
                    information</th>

                    <td class="border-0 border-top text-nowrap" colspan="3">
                        <textarea readonly class="form-control" name="ant_other_information" row="2">{{ @$User->healthStatus->ant_other_information }}</textarea>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
