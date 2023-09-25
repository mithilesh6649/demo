@if($from=='item_availability')
     @forelse ($categoriesList as $menuItem)
                    <tr class="row1" data-id="{{$menuItem->id}}">
                       <td>{{$menuItem->orderedby}}</td>
                      <td data-toggle="popover"  class="popover_td"  data-img="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                       <img src="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                     </td>
                    
                    <td  >{{ $menuItem->item_name_en ?? 'N/A'}}</td>
                    <td  >{{ $menuItem->item_name_ar ?? 'N/A'}}</td>
                    <td>{{ optional($menuItem->menuCategory)->name_en ?? 'N/A'}}   {{  optional($menuItem->menuCategory)->name_ar==null ? ' ':'('}}  {{  optional($menuItem->menuCategory)->name_ar ?? ''}}  {{  optional($menuItem->menuCategory)->name_ar==null ? ' ':')'}}</td>
                     
                    <td>
                      @if($menuItem->item_type=='loyalty')
                        {{(int)$menuItem->price." ".env('LOYALTY_POINT')}}
                     @else 
                         {{env('AMOUNT_SIGN')." ".$menuItem->price}}    
                     @endif
                    </td>
                    
                  
                  <td >

                    <div class="d-flex justify-content-center align-items-center">
                         @can('view_item_availability')
                  <a class="btn info_btn" data-toggle="tooltip" data-placement="right" title="Item Availability In Branches">
                  <i class="fa fa-question-circle quick_view_item_availability" data-id="{{ $menuItem->id }}" item-name-on="{{$menuItem->item_name_en??''}} {{$menuItem->item_name_ar??''}} "></i>
                  </a>
                  @endcan
                         @can('edit_item_availability')
                 
                  <a class="action-button" title="Edit" ><i class="text-warning fa fa-edit item_availability_edit" style="cursor: pointer;" item_name_en="{{$menuItem->item_name_en??''}}" item_name_ar="{{$menuItem->item_name_ar??''}}" data-id="{{ $menuItem->id }}" ></i></a>
                   @endcan
                    </div>
                  </td>
                   

                  </tr>
                @empty
                @endforelse
@endif


@if($from=='menu_item')

@forelse ($categoriesList as $menuItem)
<tr class="row1" data-id="{{$menuItem->id}}">
   <td><div class="drag"></div>{{$menuItem->orderedby}}</td>
     <td  style="cursor:pointer;" data-toggle="popover"  origin_url="{{asset('')}}"  class="popover_td"  data-id="{{$menuItem->id}}" data-img="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                      <img src="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                    </td>


   <td>{{ $menuItem->item_name_en ?? 'N/A'}} 
    @if(@$menuItem->mostselling_item)
                       <hr>
                      <span class="badge badge-success"> Most Selling Item</span>
                      @endif
                      @if(@$menuItem->loyalty_item)
                    <hr>
                      <span class="badge badge-success"> Loyalty Item</span>
                      @endif 

                    

    </td>
   <td>{{ $menuItem->item_name_ar ?? 'N/A'}} 
    @if(@$menuItem->mostselling_item)
                       <hr>
                       <span class="badge badge-success"> السلعة الأكثر مبيعًا</span>
                      @endif
                        @if(@$menuItem->loyalty_item)
                       <hr>s
                      <span class="badge badge-success">عنصر الولاء</span>
                      @endif 
                      

   </td>
   <td>{{ optional($menuItem->menuCategory)->name_en ?? 'N/A'}}   {{  optional($menuItem->menuCategory)->name_ar==null ? ' ':'('}}  {{  optional($menuItem->menuCategory)->name_ar ?? ''}}  {{  optional($menuItem->menuCategory)->name_ar==null ? ' ':')'}}</td>
   <td>
      @if($menuItem->item_type=='loyalty')
      {{(int)$menuItem->price." ".env('LOYALTY_POINT')}}
      @else 
      {{env('AMOUNT_SIGN')." ".$menuItem->price}}    
      @endif
   </td>
   <!-- <th><img src="{{asset('background_images/back1.jpg')}}" style="height:60px;width:100px;"></th> -->
   <td>
      @if($menuItem->status == 1)
      <span class="badge badge-pill badge-success">Active</span>
      @else
      <span class="badge badge-pill badge-danger">Inactive</span>
      @endif
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
@endif