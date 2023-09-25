 @foreach($categories as $category)

    <tr class="row1" data-id="{{$category->id}}">
        
        <td>{{ $category->category_position }}</td>
        <td>{{ $category->name_en }}</td>
        <td>{{ $category->name_ar }}</td>
        <!-- <th><img src="{{asset('background_images/back1.jpg')}}" style="height:60px;width:100px;"></th> -->
        <td>
        @if($category->status == 1)
           <span class="badge badge-pill badge-success">Active</span>
          @else
           <span class="badge badge-pill badge-danger">Inactive</span>
          @endif
        </td>
        
        <td>
            <a class="action-button" title="View" href="{{route('categories.view',['id' => $category->id])}}"><i class="text-info fa fa-eye"></i></a>
          
            <a class="action-button" title="Edit" href="{{route('categories.edit',['id' => $category->id])}}"><i class="text-warning fa fa-edit"></i></a>
         
            <a data-id="{{ $category->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
        </td>
    </tr>
 @endforeach