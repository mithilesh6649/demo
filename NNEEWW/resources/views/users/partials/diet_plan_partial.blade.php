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