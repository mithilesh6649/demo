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
                 <td class="d-flex align-items-center justify-content-center" style="border: none; height: 73px;">
<!--                   <input  class="change_status_of_group w-auto"  data-id="{{$choicegroup->id}}" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Active" data-off="Inactive" {{ $choice->status==1 ? 'checked':'' }}  >  -->
                  <label class="switch">
                    <input type="checkbox" class="change_status_of_group"  data-id="{{$choice->id}}" {{ $choice->status==1 ? 'checked':'' }}>
                    <span class="slider round"></span>

                  </label>
                  
                <!--   <div class="custom-check">
                    <input type="checkbox" id="category" name="branch[]" class="checkBranchAll">  
                    <span></span>                             
                  </div> -->
                </td>

               <td>
                <a data-id="{{ $choice->id}}" class="action-button edit-button" title="Edit" href="javascript:void(0)" ><i class="text-warning fa fa-edit" ></i></a>
                <a data-id="{{ $choice->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
            </td>
        </tr>
@endforeach
 