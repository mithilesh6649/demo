 @forelse ($all_active_branches_cars as $all_active_branches_car)
 <option    value="{{ $all_active_branches_car->id }}"> {{$all_active_branches_car->model ?? ''}} ({{ $all_active_branches_car->no_plate }}) 
 </option>
 @empty
 <option disabled>Car Not Found</option>
 @endforelse