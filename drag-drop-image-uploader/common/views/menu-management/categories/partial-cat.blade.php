 @foreach($categories as $category)

    <tr class="row1" data-id="{{$category->id}}">
        
        <td><div class="drag"></div>{{ $category->category_position ?? 'N/A' }}</td>
        <td>{{ $category->name_en ?? 'N/A' }}</td>
        <td>{{ $category->name_ar ?? 'N/A' }}</td>
        <!-- <th><img src="{{asset('background_images/back1.jpg')}}" style="height:60px;width:100px;"></th> -->
        <td>
        @if($category->status == 1)
           <span class="badge badge-pill badge-success">Active</span>
          @else
           <span class="badge badge-pill badge-danger">Inactive</span>
          @endif
        </td>

                @if(Gate::check('view_category') || Gate::check('edit_category') || Gate::check('delete_category')) 
                    
                    <td>
                         @can('view_category')
                        <a class="action-button" title="View" href="{{route('categories.view',['id' => $category->id])}}"><i class="text-info fa fa-eye"></i></a>
                         @endcan
                          @can('edit_category')
                        <a class="action-button" title="Edit" href="{{route('categories.edit',['id' => $category->id])}}"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                         @can('delete_category')
                          @if($category->category_type == 'most_selling' || $category->category_type == 'loyalty_treasures' || $category->category_type == 'current_offers')
                         <i class="fa fa-question-circle" title="Default Category"  href="javascript:void(0)" style="cursor: pointer;"></i>
                        @else
                        <a data-id="{{ $category->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
                        @endif 
                       
                        @endcan
                    </td> 
               
                     @endif 
        
       <!--  <td>
            <a class="action-button" title="View" href="{{route('categories.view',['id' => $category->id])}}"><i class="text-info fa fa-eye"></i></a>
          
            <a class="action-button" title="Edit" href="{{route('categories.edit',['id' => $category->id])}}"><i class="text-warning fa fa-edit"></i></a>
         
            <a data-id="{{ $category->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
        </td> -->
    </tr>
 @endforeach