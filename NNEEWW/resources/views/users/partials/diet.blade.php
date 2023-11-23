 
  
 <div class="mb-3"> 
     <div id="select_type">
         <select class="form-control"  id="diet-type-select"style="width:fit-content;">
             <option value="1">General Diet Plan ( Free ) </option>
             <option value="2">Metabolic Diet Plan</option>
             <option value="3">DNA-Metabolic Diet Plan</option>
             <!-- <option value="4">Specialized Diet Plans</option> -->
         </select>
     </div>
 </div>

<div class="table-responsive"> 
<table style="width:100%" id="diet-plan-list" class="table table-bordered table-hover yajra-datatable">
   <thead>
       <tr> 
        <th>Date</th>
        <th>Breakfast</th>
        <th>Lunch</th>
        <th>Dinner</th>
        <th>Snacks</th>

    </tr>
</thead>
<tbody id="diet_plan_list">
   @forelse($UserDailyDiet  as $key => $data)

   <tr>
    <td> {{ date('m/d/Y', strtotime(@$data->meal_date)) }} </td>

    <td>
       @forelse($data->userDiet  as $key => $dietData)
       @if($dietData->meal_type_id == 31)
       <span class="badge badge-pill badge-primary"> {{@$dietData->food->brand_name ?? '--'}}</span>
       @endif
       @empty

       @endforelse
   </td>
   <td> 
      @forelse($data->userDiet  as $key => $dietData)
       @if($dietData->meal_type_id == 32)
       <span class="badge badge-pill badge-primary"> {{@$dietData->food->brand_name ?? '--'}}</span>
       @endif
       @empty

       @endforelse
</td>
<td> 
     @forelse($data->userDiet  as $key => $dietData)
       @if($dietData->meal_type_id == 33)
       <span class="badge badge-pill badge-primary"> {{@$dietData->food->brand_name ?? '--'}}</span>
       @endif
       @empty

       @endforelse
</td>
<td>
   <!--  <span class="badge badge-pill badge-primary">Spices, ginger, ground</span>
    <span class="badge badge-pill badge-primary">mangos</span> -->
  @forelse($data->userDiet  as $key => $dietData)
       @if($dietData->meal_type_id == 34)
       <span class="badge badge-pill badge-primary"> {{@$dietData->food->brand_name ?? '--'}}</span>
       @endif
       @empty
 
       @endforelse
</td>

</tr>
@empty

@endforelse
</tbody>
</table>
</div>

