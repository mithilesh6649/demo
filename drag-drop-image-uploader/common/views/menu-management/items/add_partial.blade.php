 @foreach($choicegroup as $choice)
            <tr>
                <td class="display-none"></td>
                <td>{{$choice->name_en}}</td>
                <td>{{$choice->name_ar}}</td>
                <td>
          
                 @foreach($choice->choice as $choicegroup)
                
                   {{$choicegroup->name_en}}({{$choicegroup->price}}),
                   
                 @endforeach
                </td>
                <td>
          
                 @foreach($choice->choice as $choicegroup)
                
                   {{$choicegroup->name_ar}}({{$choicegroup->price}}),
                   
                 @endforeach
                </td>
                

               <td>
                <a data-id="{{ $choice->id}}" class="action-button edit-button" title="Edit" href="javascript:void(0)" ><i class="text-warning fa fa-edit" ></i></a>
                <a data-id="{{ $choice->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
            </td>
        </tr>
@endforeach
 