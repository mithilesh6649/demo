@if(isset($foods))
<ul style="list-style: none; padding: 0;">
    @forelse ($foods as $food)
    <!--    <li class="p-3 border-bottom">
         <div class="d-flex align-items-center">
             <div class="pl-3">
                <img width="50" src="{{@$food['food']['image']}}">
             </div>
             <div class="px-5">
                 <p class="font-weight-bold m-0">  {{@$food['food']['label']}}</p>
                 <small>kcal : {{ round(@$food['food']['nutrients']['ENERC_KCAL'], 2) }}
                        </small>   
             </div>
             <div>                 
                @if(in_array(@$food['food']['foodId'],$allFoodIds))
                   <button disabled class="btn btn-success" food-id="{{ @$food['food']['foodId'] }}">Already added</button>
                @else
                 <button class="btn btn-primary food_add" food-id="{{ @$food['food']['foodId'] }}" food-image="{{ @$food['food']['image'] }}">Add</button>
                @endif                 
             </div>
         </div>
        </li> -->
    <ul style="list-style: none; padding: 0;">
        <li class="p-3 border-bottom">
            <div class="d-flex row align-items-center">
                <div class="col-md-1">
                  <div>
                    <img class="img-fluid rounded border p-1" width="100" src="{{@$food['food']['image'] ?? 'https://www.edamam.com/food-img/6e0/6e04857756d0876f14bfc035ff238e0b.png'}}" />
                  </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex form-group mb-0">
                        <input type="number" id="serving_size" class="serving_size" name="" value="1" placeholder="Size" />
                        <input type="hidden" id="food_id" class="food_id ml-2" name="" value="{{ @$food['food']['foodId'] }}" placeholder="Size" />
                        <select id="serving_type" class="serving_type serving_type ml-3">
                            <!-- <option value="">Options 1</option>
                    <option value="">Options 2</option>
                    <option value="">Options 3</option>   
                    <option value="">Options 4</option>
                    <option value="">Options 5</option>
                    <option value="">Options 6</option> -->
                            <option value="">Serving Type</option>
                            @forelse ($food['measures'] as $measure) @if(@$measure['label'])
                            <option value="{{@$measure['uri'] }}">{{ @$measure['label']}}</option>
                            @endif @empty
                            <option value="">Measure not available </option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3 item-details">
                    <p class="font-weight-bold mb-1">{{@$food['food']['label']}} <span class="measure_calories">( {{ round(@$food['food']['nutrients']['ENERC_KCAL'], 2) }} kcal )</span></p>
                    <small class="d-inline-block border p-1 measure_protein">Protein : {{ round(@$food['food']['nutrients']['PROCNT'], 2) }}</small>
                    <small class="d-inline-block border p-1 measure_fat">Fat : {{ round(@$food['food']['nutrients']['FAT'], 2) }}</small>
                    <small class="d-inline-block border p-1 measure_chocdf">Carbohydrate : {{ round(@$food['food']['nutrients']['CHOCDF'], 2) }}</small>
                    <small class="d-inline-block border p-1 measure_fiber">Fiber : {{ round(@$food['food']['nutrients']['FIBTG'], 2) }}</small>
                </div>

                <div class="Col-md-2">
                  <!-- <label for="blank">&nbsp;</label> -->
                    <button class="mt-2 btn btn-primary food_add add-advance-options" food-id="{{ @$food['food']['foodId'] }}" food-image="{{ @$food['food']['image'] }}">Add</button>
                </div>
            </div>
        </li>
    </ul>

    @empty
    <div class="empty_content">
        <br />
        <p style="text-align: center; color: #666666;"><b>No Result Found!</b></p>
    </div>
    @endforelse
</ul>
@endif
