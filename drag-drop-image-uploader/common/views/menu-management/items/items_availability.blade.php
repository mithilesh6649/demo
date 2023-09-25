@extends('adminlte::page')

@section('title', ' Super Admin |   Items Availability')

@section('content_header')
 <style type="text/css">
   .first{
    width: 120px !important;
   }
   .second{
    width: 120px !important;
   }
 </style>

@section('content')


<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">        
  </div>
  <div class="row justify-content-center ">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main "> 
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3></h3>
            <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options  ">Advance Options <i class="fa fa-caret-down"></i></a> 
          </div>
          <div class=" mb-3 collapse" id="advanceOptions">
            <div class="advance-options" style="">
             <div class="title">
               <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
              </div> 
               <div  class="bg-light w-50">
                  <h6>Select  Category</h6>
                   <div class="left_option">
                       <div class="left_inner">
                         
                         <div class="button_input_wrap">
                          <div class="date_range_wrapper">
                           <i class="fas fa-calendar-alt mr-2"></i>
                            
                            <select class="advance_category_search catselect">
                              <option>Select Category</option>
                             
                              @forelse ($menuCategory as $allCateogry)
                                  <option value="{{$allCateogry->id}}">{{ $allCateogry->name_en }}</option>
                               @empty
                                   <option class="disabled">Category not found</option>
                              @endforelse

                            </select> 


                          </div>
                          <div class="apply_reset_btn">
                             <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                             <button class="btn btn-primary reset-button" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>                          
                           </div>                              
                         </div>                                                    
                       </div>
                          
                     </div>
               </div>
            </div>
          </div> 
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Items Availability</h3>
      
          </div>           
          <div class="card-body table p-0 mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <div class="table-responsive">
              <table style="width:100%" id="menuitem-list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                     <th>Order BY Position</th>
                    <th class="first">Image</th>
                    <th class="first">Item Name{{ labelEnglish() }}</th>
                    <th class="second">Item Name{{ labelArabic() }}</th>
                    <th>Category</th>
                    <th>Price</th>
                  @if(Gate::check('view_item_availability') || Gate::check('edit_item_availability')) 

                    <th>Actions</th>
                   @endif
                  </tr>
                </thead>
                <tbody id='menuitemlist-items'>
                  @forelse ($menuItem as $menuItem)
                    <tr class="row1" data-id="{{$menuItem->id}}">
                      <td>{{$menuItem->orderedby}}</td>
                     <td data-toggle="popover"  class="popover_td"  data-img="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                       <img src="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                     </td>
                    
                    <td >{{ $menuItem->item_name_en ?? 'N/A'}}</td>
                    <td  >{{ $menuItem->item_name_ar ?? 'N/A'}}</td>
                    <td>{{ optional($menuItem->menuCategory)->name_en ?? 'N/A'}}   {{  optional($menuItem->menuCategory)->name_ar==null ? ' ':'('}}  {{  optional($menuItem->menuCategory)->name_ar ?? ''}}  {{  optional($menuItem->menuCategory)->name_ar==null ? ' ':')'}}</td>
                     
                    <td>
                      @if($menuItem->item_type=='loyalty')
                        {{(int)$menuItem->price." ".env('LOYALTY_POINT')}}
                     @else 
                         {{env('AMOUNT_SIGN')." ".$menuItem->price}}    
                     @endif
                    </td>
                    
                  @if(Gate::check('view_item_availability') || Gate::check('edit_item_availability')) 
                  
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
                    @endif

                  </tr>
                @empty
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>






<div id="branches-modal" class="modal  fade  " role="dialog">
<div class="modal-dialog ">
<!-- Modal content-->
<div class="modal-content menu">
<div class="modal-header">
<button type="button" class="close modal_close_icon" data-dismiss="modald">&times;</button>
<h4 class="modal-title">
<div> 
Items Availability For Branches
</div>
</h4>


</div>
<div class="modal-body">
<!--start container -->
<div class="availabality_branches container-fluid" id="quick_view_container">
  <div class="Item_names mb-2">
    <p class="mb-0">Item Name :- <label></label><span class="text-success selected_items_count_show" id="show_item_name"></span></p> 
  </div>
    <form> 
      <p class=" d-none select_status_warning bg-danger">Please Select item status</p>
        <div class="form-group mb-2">
            <select class="form-control changestatus" name="cars" data-id="{{$menuItem->id}}">
              <option value="select_item_status">Select Item Status</option>
             @foreach ($menu_item_availability as $item_availability)
            <option value="{{$item_availability->value==1 ? '1':'0' }}" data-minutes="{{ $item_availability->value }}"  data-name="{{$item_availability->name}}"> {{ $item_availability->name }}</option>
            @endforeach
            </select>
        </div>


<p class=" d-none select_branch_warning bg-danger">Please Select branch and proceed</p>
<div class="accordion" id="accordionExample">
  <div class="card categories">
    <div class="card-header " data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">     
      <span class="title">Select Branch</span>
      <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
      </div>
      <div class="card-body branch_all_inputs_container">
        <div class="all-content d-flex align-items-center">
          <div class="custom-check">
            <input type="checkbox" id="category" name="branch[]" class="checkBranchAll">  
            <span></span>                             
          </div>
          <strong class="list-text"> &nbsp; All </strong>
        </div>
        <div class="branch-container">
          @forelse ($branches as $branch)
          <div class="d-flex align-items-center">
            <div class="custom-check">
              <input type="checkbox" id="category" name="branches[]" class="ckbCheckAll branch_inputs" value="{{$branch->id}}"  branch-id-attr="{{$branch->id}}" branch-name-attr="{{$branch->title_en}}">  
              <span></span>                             
            </div>
            <strong class="list-text"> &nbsp; {{$branch->title_en}} <span class="text-success selected_items_count_show dynamic_availability_show">Available</span></strong>
          </div>
          @empty
          <p>No users</p>
          @endforelse
        </div>
      </div>
  </div> 
</div>  
<!--end container -->
</div>
</div>
<div class="card-footer pt-0 pb-4 " align="center"> 
<div class="btn-group">
<button type="button" class="btn btn-success"   id="branch_unselect_all">Close</button>
<button type="button" class="btn btn-danger" id="branch_save_countinue">Save and Continue</button>
</div>
</div>
</form>

</div>
</div>
<!--end modal -->
<!-- end branch modal -->
<div class="pl-3 mb-3">
<span class="text-danger  d-none  select_notice"> Select at least one </span>
</div>
<!-- /.card-body -->
</div>



<!-- Modal -->
<div id="MyBranchAvailability" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
        <div> 
        Item Name  :  <span class="placed_date">Steamed White Rice أرز أبيض على البخار</span>
        </div>
        </h4>
      </div>
      <div class="modal-body">
        
       <!--start container -->
         <div class="" id="quick_view_container_item_availabilty">
         </div>

        <!--end container -->
      </div>
    </div>
  </div>
</div>

<!--end modal -->
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
 <style type="text/css">
  .ui-sortable-helper {
        display: table;
    }

 
</style>
@stop

@section('js')
 
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.2.0/tata.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
   $(document).ready(function () {
      var table=$('#menuitem-list').DataTable({
        // order: [[2, 'asc'],[1, 'asc']],
      });

      
   
         $('body').on('click', '.item_availability_edit', function(e) {
               
               var data_id = $(this).attr('data-id');
               //alert(data_id);
               var item_name_en = $(this).attr('item_name_en');
               var item_name_ar = $(this).attr('item_name_ar');
               var id =''; 
               var minutes = '';
               var status = '';
               var selected_name = '';
              $('#show_item_name').html(item_name_en+" "+item_name_ar);
           //Open Modal of each edit click
              $("#branches-modal").find('form').trigger('reset');
              $('#branches-modal').modal({
                 'show':true,
                  backdrop: 'static',
                  keyboard: false
              });


          $('.changestatus').on('change',function(){
               //  id = $(this).attr('data-id');
                minutes=$(this).find(':selected').data('minutes');
                status=$(this).find(':selected').val();
                selected_name=$(this).find(':selected').attr('data-name');
             //alert(id+"" +minutes+" "+status);
               
            var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
            var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
            $(all_inputs).each(function(){
            $(this).prop('checked', false);

            }); 

          });



          $('#branch_save_countinue').on('click',function(){
           
           var get_selected_value = selected_name;


        if(get_selected_value == '' || get_selected_value == undefined){
              $('.select_status_warning').removeClass('d-none');

              setTimeout(function(){
              $('.select_status_warning').addClass('d-none');
              },2000); 
              return false;  
        }
           
    
     var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
     var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
     var  branch_sel_count = 0;
     var all_selected_branch_id = [];
     $(all_inputs).each(function(){
           
           if($(this).is(':checked')){
               branch_sel_count++;
               if($(this).attr('branch-name-attr') != undefined){
               all_selected_branch_id.push($(this).attr('branch-id-attr'));
                  }
           } 
     }); 

     if(branch_sel_count == 0){
       $('.select_branch_warning').removeClass('d-none');

       setTimeout(function(){
           $('.select_branch_warning').addClass('d-none');
       },2000); 
       return false;  
     }else{
  


         
         //$('#branches-modal').modal('hide');
       //  alert(id+"" +minutes+" "+status);
        // console.log(all_selected_branch_id);


         $.ajax({
      url:"{{route('change.branch.menu.items.status')}}",
      method:"POST",
      data:{
          'status':status,
          'minutes':minutes,
          'menu_item_id':data_id,
          'branch_id':all_selected_branch_id, 
        },
      dataType:"JSON",
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
      success:function(response){
       //console.log(response);
       if(response.status==true)
       {
                swal({
             title: "Item Availability",
                 text:"Status Successfully Updated.",
                 type: "success",
           },
         function(){ 

             var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
             var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
             var  branch_sel_count = 0;
             var all_selected_branch_id = [];
             $(all_inputs).each(function(){
                   
                   if($(this).is(':checked')){
                      var get_lable = this.parentElement.parentElement;
                      var current_lable = get_lable.getElementsByClassName('dynamic_availability_show')[0];
                      if(status==0){
                      $(current_lable).html("<small class='text-danger'>"+get_selected_value+"</small>");
                      }
                      
                      if(status==1){
                      $(current_lable).html("<small class='text-success'>"+get_selected_value+"</small>");
                      }

                   } 
             }); 
           // $('#branches-modal').modal('hide');
             // window.location.href="{{route('menu.item.availabality.list')}}"
         }
       );

       }

      }
    });


          
     }
  }); 
           
          // var data_id = $(this).attr('data-id');
          // var order_placed_date = $(this).attr('order-placed-on');

          // var obj = $(this);

          //  $.ajax({
          //    type:"post",
          //     url:"{{route('orders.show')}}",
          //     data:{
          //        "_token": "{{ csrf_token() }}",
          //        "id": data_id
          //     },
          //     dataType: "JSON",
          //     success:function(response){
          //               $('.placed_date').html(order_placed_date);
          //           if(response.status) {
          //              $('#quick_view_container').html(response.html);
          //             $('#myModal').modal({
          //               'show':true,
          //                backdrop: 'static',
          //                keyboard: false
          //             });

          //           }
          //     }

          //  });



         //Show availabilty dynamically..................

          var  menu_item_id =  data_id;
       
      var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
     var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
     var  branch_sel_count = 0;
     var all_selected_branch_id = [];
     $(all_inputs).each(function(){
    
               if($(this).attr('branch-name-attr') != undefined){
               all_selected_branch_id.push($(this).attr('branch-id-attr'));
                  }
           
     });  

       
      $(all_selected_branch_id).each(function(index,value){
            // console.log(value);

            var branch_id = value;

             $.ajax({
                 type:"POST",
                 url:"{{route('branch.items.availability.each.show')}}",
                 data:{
                    "_token": "{{ csrf_token() }}",
                   "branch_id":branch_id,
                   "menu_item_id":menu_item_id,
                 },
                 success:function(response){
                  console.log(response);
                  var res_status = '';
                  var unavailabile_time ='';


                    if(response.availabality==0){
                       unavailabile_time = 'Unavailable';  
                     }

                    if(response.availabality==60){
                       unavailabile_time = 'Unaivalibale for 1 Hour'+'  <span> '+response.created_at+'</span>';
                     }
                     
                     if(response.availabality==120){
                       unavailabile_time = 'Unaivalibale for 2 Hour'+'  <span> '+response.created_at+'</span>';
                     }

                     if(response.availabality==240){
                       unavailabile_time = 'Unaivalibale for 4 Hour'+'  <span> '+response.created_at+'</span>';
                     } 

                     if(response.availabality==1440){
                       unavailabile_time = 'Unaivalibale Untill Next Day'+'  <span> '+response.created_at+'</span>';
                     }  

                    if(response.status ==1){
                     res_status = "<small class='text-success'>Available</small>";
                    }
                    else if(response.status == 0){
                      res_status = "<small class='text-danger'>"+unavailabile_time+"</small>";
                    }


                  var all_selected_count_box = $('.dynamic_availability_show')[index];
                  all_selected_count_box.innerHTML = res_status; 
                  // all_selected_count_box.each(function(){
                  // this.innerHTML = "ssdfsd";
                  // });
                 // dynamic_availability_show 
                 }
             });



      });   

      


  
          });
  

// $(document).on('change','.changestatus',function(){
//     // alert();
//      var id = $(this).attr('data-id');
//      var minutes=$(this).find(':selected').data('minutes');
//      var status=$(this).find(':selected').val();
//      //alert(id+"" +minutes+" "+status);
//      var item_name_en = $(this).find(':selected').attr('item_name_en');
//      var item_name_ar = $(this).find(':selected').attr('item_name_ar');

//      $('#show_item_name').html(item_name_en+" "+item_name_ar);

//     if(status!='select_item_status'){
//         $('#branches-modal').modal({
//     'show':true,
//     backdrop: 'static',
//     keyboard: false
//     });
//     }

         
    
    


//           $('#branch_save_countinue').on('click',function(){
    
//        var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
//      var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
//      var  branch_sel_count = 0;
//      var all_selected_branch_id = [];
//      $(all_inputs).each(function(){
           
//            if($(this).is(':checked')){
//                branch_sel_count++;
//                if($(this).attr('branch-name-attr') != undefined){
//                all_selected_branch_id.push($(this).attr('branch-id-attr'));
//                   }
//            } 
//      }); 

//      if(branch_sel_count == 0){
//        $('.select_branch_warning').removeClass('d-none');

//        setTimeout(function(){
//            $('.select_branch_warning').addClass('d-none');
//        },2000); 
//        return false;  
//      }else{

         
//          //$('#branches-modal').modal('hide');
//        //  alert(id+"" +minutes+" "+status);
//         // console.log(all_selected_branch_id);


//          $.ajax({
//       url:"{{route('change.branch.menu.items.status')}}",
//       method:"POST",
//       data:{
//           'status':status,
//           'minutes':minutes,
//           'id':id,
//           'branch_id':all_selected_branch_id, 
//         },
//       dataType:"JSON",
//       headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//       success:function(response){
//        console.log(response);
//        if(response.status==true)
//        {
//                 swal({
//              title: "Item Availability",
//                  text:"Status Successfully Updated.",
//                  type: "success",
//            },
//          function(){ 
//               window.location.href="{{route('menu.item.availabality.list')}}"
//          }
//        );

//        }

//       }
//     });


          
//      }
//   });



//       // $.ajax({
//       //   url:"{{route('changebranchitems.status')}}",
//       //   method:"POST",
//       //   data:{
//       //       'status':status,
//       //       'minutes':minutes,
//       //       'id':id, 
//       //     },
//       //   dataType:"JSON",
//       //   headers: {
//       //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       //       },
//       //   success:function(response){
        
//       //    if(response.status=='true')
//       //    {
//       //     // swal("Status!", "Status Successfully Updated. ", "success");
//       //    }

//       //   }
//       // });
 
//     });  





    });
  
  
</script>
<script type="text/javascript">
      $(".catselect").select2();
</script>
<script type="text/javascript">
  
  $(document).ready(function(){
     $('.apply-filter').on('click',function(){

       $value = $('.advance_category_search').val();
        
        if($value=='Select Category')
        {
          return false;
        }else{
        
           $.ajax({
           url: "{{ route('filter_menu_categories') }}",
           method: 'post',
           data: {
               category_id: $value,
               from:'item_availability'
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {               
            if(response.status) {
             $("#menuitem-list").DataTable().clear().destroy();
             $('#menuitemlist-items').html(response.html);
             $('#menuitem-list').DataTable( {
                order: [[2, 'asc'],[1, 'asc']],
                });    
              }
           }
       });
        }

     });
  });



   $('body').on('click','.reset-button',function(){
      
        $(".catselect").val('Select Category').trigger('change'); 
        $(".menu advance_category_search[value='0']").attr("selected", true);
        $('.advance_options_btn').hide();
        $.ajax({
           url: "{{ route('reset_menu_categories') }}",
           method: 'post',
           data: {
               reset: true,
                from:'item_availability'
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               if(response.status) {
                 $('#menuitem-list').DataTable().clear().destroy();
                  $('#menuitemlist-items').html(response.html);
              $('#menuitem-list').DataTable( {
               //  order: [[2, 'asc'],[1, 'asc']],

                });

               }
           }
        });
   
     })












   $('.checkBranchAll').click(function(){
           var branches  = $('.branch-container')[0];
           var all_branches_input = branches.getElementsByTagName('INPUT');

        if($(this).is(':checked')){
                for(var i=0;i<all_branches_input.length;i++){
               $(all_branches_input[i]).prop('checked', 'true'); 
            }
        }else{
            for(var i=0;i<all_branches_input.length;i++){
               $(all_branches_input[i]).prop('checked', false); 
            }
        } 
    });

    var all_branches_input = $('.branch_inputs');
    var branches_input_length = all_branches_input.length;    
   $(all_branches_input).each(function(){
     $(this).click(function(){
          var counts = 0;
         $(all_branches_input).each(function(data){

                 if($(this).is(':checked')){
                    counts++;
                 }
            });
         if(branches_input_length  == counts) {
            $(".checkBranchAll").prop('checked', 'true');
          }
          else {
            $(".checkBranchAll").prop('checked', false);
          }

     });
   });

     $('.ckbCheckAll').each(function(){
        
        $(this).click(function(){
            var count = 0;
            var getParent = this.parentElement.parentElement.parentElement.parentElement;

            var getParentInput = this.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
             var parentInput = getParentInput.getElementsByTagName('INPUT')[0];
           
             var all_input = getParent.getElementsByTagName('INPUT');
            console.log(all_input.length);
            $(all_input).each(function(data){
                 if($(this).is(':checked')){
                    count++;
                 }
            });
            
              if(all_input.length == count) {
                    $(parentInput).prop('checked', 'true');
                  }
                  else {
                  //  alert("false");
                    $(parentInput).prop('checked', false);
                  }
            
        });
     });



 $(document).ready(function(){

  $('#branch_unselect_all,.modal_close_icon').on('click',function(){
   // location.reload();
     var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
     var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
     $(all_inputs).each(function(){
        $(this).prop('checked', false);
         $('#branches-modal').modal('hide');
          $('#all_selected_branch_container').html();
          $('#all_selected_branch_container').addClass('d-none'); 
        // $('#all_selected_branch_container').removeClass('d-none');
     }); 
       
  });

 });

</script>



<script type="text/javascript">
  


         $('body').on('click', '.quick_view_item_availability', function(e) {

          var data_id = $(this).attr('data-id');
          var item_name_en_ar = $(this).attr('item-name-on');
          // alert(data_id);
          var obj = $(this);

           $.ajax({
             type:"post",
              url:"{{route('branch.items.availability.show')}}",
              data:{
                 "_token": "{{ csrf_token() }}",
                 "id": data_id
              },
              dataType: "JSON",
              success:function(response){
 
                      
                        $('.placed_date').html(item_name_en_ar);
                    if(response.status) {
                       $('#quick_view_container_item_availabilty').html(response.html);
                      $('#MyBranchAvailability').modal({
                        'show':true,
                         backdrop: 'static',
                         keyboard: false
                      });

                    }
              }

           });
 
    });

</script>

<script>
  function popover(){
    $('[data-toggle="popover"]').popover({
        placement : 'auto',
    trigger : 'hover',
        html : true,
         content: function () {
    return '<img src="'+$(this).data('img') + '" width="200" />';
  }
    });

}

 
 setInterval(function () { popover(); }, 100);


</script>


@stop
