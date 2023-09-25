@forelse ($menuItem as $menuItem)
    <tr class="row1" data-id="{{$menuItem->id}}">
	
		<td><div class="drag"></div>{{$menuItem->orderedby}}</td>

		 <td  style="cursor:pointer;" data-toggle="popover"  origin_url="{{asset('')}}"  class="popover_td"  data-id="{{$menuItem->id}}" data-img="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                      <img src="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                    </td>


		<td  >{{ @$menuItem->item_name_en ?? 'N/A'}}</td>
		<td >{{ @$menuItem->item_name_ar ?? 'N/A'}}</td>
		<td >{{ @$menuItem->menuCategory->name_en ?? ' '}}   {{  @$menuItem->menuCategory->name_ar==null ? ' ':'('}}  {{  @$menuItem->menuCategory->name_ar ?? ''}}  {{  @$menuItem->menuCategory->name_ar==null ? ' ':')'}}</td>
 
		<td> 
			@if($menuItem->item_type=='loyalty')
        {{(int)$menuItem->price." ".env('LOYALTY_POINT')}}
     @else 
         {{env('AMOUNT_SIGN')." ".$menuItem->price}}    
     @endif
            
		<td>
			@foreach($status as $status_data)
             @if($menuItem->status==$status_data->value)
              <span class="{{@$menuItem->status==1?'text-success':'text-danger'}}"> {{$status_data->name}}</span>
             @endif
          @endforeach
	
		</td> 
		  @if(Gate::check('view_item') || Gate::check('edit_item') || Gate::check('delete_item')) 

		<td class="actions_wrapper">
			 @can('edit_item')
	    <div data-id="{{ $menuItem->id}}" class="upload-item-images-button">
	     <i class="fa fa-upload"  style="cursor:pointer;"  title="Upload Menu Item Image"></i> 
	     <input type="file" class="sr-only" id="input" name="image"  accept="image/*" onchange="readURL(this);" data-id="{{ $menuItem->id}}">
	    </div>
				@endcan
				@can('view_item')
		    <a class="action-button" title="View" href="{{route('menu.item.view',['id' => $menuItem->id])}}"><i class="text-info fa fa-eye"></i></a>
		    @endcan
		    @can('edit_item')
		    <a class="action-button" title="Edit" href="{{route('menu.item.edit',['id' => $menuItem->id])}}"><i class="text-warning fa fa-edit"></i></a>
		   @endcan
		    @can('delete_item')
		   <a data-id="{{ $menuItem->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
		   @endcan
		</td>
		@endif
	</tr>
@empty
@endforelse
