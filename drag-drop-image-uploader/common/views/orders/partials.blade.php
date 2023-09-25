
 @forelse ($particularOrder->orderItems as $key => $allItems)
 <div class="order_modal">
   <div class="row">
      <div class="col-md-12">   
        <div class="card p-3">
          <div class="d-flex">
            <p class="order_count">{{ ++$key}})</p>
            <div class="card-body table p-0 mb-0" style="padding: 0 !important;">
               <div class="mb-0">
                  <label class="text-dark">Item Name</label> :- <span class="">{{$allItems->menuItems->item_name_en ?? 'N/A'}}</span>
               </div>
               <div class="mb-0">
                  <label class="text-dark">Quantity</label> :- <span class="">{{$allItems->quantity ?? 'N/A'}}</span>
               </div>
               <div class="mb-0">
                  <label class="text-dark">Item Choices</label> :- <span class="">@forelse ($allItems->orderChoices as $allItemsChoices)
                          {{$allItemsChoices->choice->name_en ?? 'N/A'}}
                          @empty
                         @endforelse
                  </span>
               </div>
            </div>
          </div>
        </div> 
      </div>     
   </div>
</div>

 @empty
   Data Not Found 
 @endforelse