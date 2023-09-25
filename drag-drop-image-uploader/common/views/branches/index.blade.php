@extends('adminlte::page')

@section('title', 'Super Admin | Branch List')

@section('content_header')


@section('content')

<div class="container">
   <div class="alert d-none" role="alert" id="flash-message">        
   </div> 
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Branches</h3>
                  @can('add_branch')
                  <a class="btn btn-sm btn-success" href="{{route('add_branch')}}">Add Branch</a>
                  @endcan
              </div>
              <div class="card-body table p-0">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                 </div>
                 @endif 
                 <table style="width:100%" id="jobseekers-list" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th class="display-none"></th>
                           <th>Title{{ labelEnglish() }}</th>
                           <th>Title{{ labelArabic() }}</th>
                           <th>{{ __('adminlte::adminlte.email') }}</th>
                           <th>Contact Number</th>
                           @if(Gate::check('add_staff') || Gate::check('edit_staff'))
                           <th>Branch Staff</th>
                           @endif
                           <th>Status </th> 
                           @if(Gate::check('view_branch') || Gate::check('edit_branch') || Gate::check('delete_branch')) 
                           <th>{{ __('adminlte::adminlte.actions') }}</th>
                           @endcan
                       </tr>
                   </thead>
                   <tbody>
                    @forelse ($branches as $branch)
                    <tr>
                       <td class="display-none"></td>
                       <td>{{$branch->title_en }}</td>
                       <td>{{$branch->title_ar }}</td>
                       <td>{{$branch->email ?? 'N/A'  }}</td>
                       <td> (+{{$branch->country}}) {{$branch->phone_number}}</td>

                       @if(Gate::check('add_staff') || Gate::check('edit_staff'))
                       <td>
                        <span> 
                         @can('add_staff') 
                         <i class="fa fa-plus branch_add_staff" branch-id='{{$branch->id}}' branch-name='{{$branch->title_en}}' style="font-size:14px;cursor: pointer;padding: 4px 3px;color: #6a6a6a;" title="Add Staff"></i>
                         @endcan
                         @can('edit_staff') 
                         <i class="fa fa-edit branch_edit_staff"  branch-id='{{$branch->id}}' branch-name='{{$branch->title_en}}' style="font-size:14px;cursor: pointer;padding: 4px 3px;color: #07c8f7;" title="Edit Staff"></i>
                         @endcan
                     </span>

                 </td>
                 @endif



                 <td>
                  @foreach($status as $status_data)
                  @if($status_data->value==$branch->status)
                  <label class="badge {{$branch->status==1?'badge-success':'badge-danger'}} p-1">{{$status_data->name}}</label>
                  @endif
                  @endforeach
              </td>
              @if(Gate::check('view_branch') || Gate::check('edit_branch') || Gate::check('delete_branch')) 
              <td>
                  @can('view_branch') 
                  <a class="action-button" title="View" href="view/{{$branch->id}}"><i class="text-info fa fa-eye"></i></a>
                  @endcan 
                  @can('edit_branch')
                  <a class="action-button" title="Edit" href="edit/{{$branch->id}}"><i class="text-warning fa fa-edit"></i></a>
                  @endcan
                  @can('delete_branch')   
                  <a data-id="{{ $branch->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
                  @endcan
              </td>
              @endcan
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



<!-- Start add staff modal -->

<div class="modal fade " id="addNewStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalCenterTitle">Add Branch Staff </h4>
            <h6 class="body-heading mb-0 mr-3">Branch Name : <strong id="branch_name"> </strong></h6>
            <button type="button" class="close add_staff_modal_close" data-dismiss="modals" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="add_new_staff" class="model-back">

               <input type="hidden" name="branch_id" id="branch_id_dynamic" class="form-control" value="">

               <div>
                   <div class="row mb-3">
                       
                    <div class="col-md-1 col-lg-1 col-xl-1 col-2">
                        <div class="form-group">
                           <label for="name_en">S/No<span class="text-danger"> *</span> </label>

                        </div>
                    </div> 

                     <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Staff Code<span class="text-danger"> *</span></label>

                        </div>
                    </div> 
                   
                    <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Staff name<span class="text-danger"> *</span></label>

                        </div>
                    </div> 

                     <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Designation<span class="text-danger"> *</span></label>

                        </div>
                    </div> 


                    <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Points<span class="text-danger"> *</span></label>

                        </div>
                    </div> 

                        <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Start Date<span class="text-danger"> *</span></label>

                        </div>
                    </div> 
 
 

                   </div>
               </div>

               <div class="staff_parent"> 

               </div>

               <div class="modal-footer d-flex align-items-center justify-content-center pb-0" style="margin-top: 24px;">
                <button type="submit" class="button btn_bg_color common_btn text-white">Save</button>
                <div class="add-choices ml-2">
                  <!-- <p style="font-weight:700;font-size:16px;color:#343e49;border-bottom:1px solid grey;">Choices</p>  -->
                  <button type="button" class="add_new_staff">Add Staff</button>
              </div>
          </div>
      </form>
  </div>
</div>
</div>
</div>


<!--end add staff modal -->




<!-- Start edit staff modal -->

<div class="modal fade" id="EditStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="max-width: 1000px;">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="exampleModalCenterTitle">Edit Branch Staff </h4>
            <h6 class="body-heading mb-0 mr-3">Branch Name : <strong id="branch_edit_name"> </strong></h6>
            <button type="button" class="close add_staff_modal_close" data-dismiss="modals" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="edit_new_staff" class="model-back">

               <input type="hidden" name="branch_id_dynamic" id="branch_edit_id_dynamic" class="form-control" value=""  >


               <div>
                   <div class="row mb-3">

                     <div class="col-md-1 col-lg-1 col-xl-1 col-2">
                        <div class="form-group">
                           <label for="name_en">S/No<span class="text-danger"> *</span> </label>

                        </div>
                    </div> 
                      
                     <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Staff Code<span class="text-danger"> *</span></label>

                        </div>
                    </div> 
                   
                    <div class="col-md-1 col-lg-1 col-xl-1 col-1">
                        <div class="form-group">
                            <label for="name_en">Staff name<span class="text-danger"> *</span></label>

                        </div>
                    </div> 

                     <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Designation<span class="text-danger"> *</span></label>

                        </div>
                    </div> 


                    <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Points<span class="text-danger"> *</span></label>

                        </div>
                    </div> 
                    

                    <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Branch<span class="text-danger"> *</span></label>

                        </div>
                    </div> 


                        <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                        <div class="form-group">
                            <label for="name_en">Start Date<span class="text-danger"> *</span></label>

                        </div>
                    </div> 
 
 

                   </div>
               </div>


               <div class="staff_parent_edit"> 

               </div>

<!--           <div class="add-choices d-flex justify-content-center">
          
</div> -->

<div class="modal-footer d-flex justify-content-center pb-0" style="margin-top: 24px;">
  <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
</div>


</form>
</div>
</div>
</div>
</div>


<!--end edit staff modal -->

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<!-- <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>

<style type="text/css">
    .datepicker {
            font-size: 0.875em;
        }
</style>

@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
      $('#jobseekers-list').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data ;
        }
    }]
});
  });

    // $('.delete-button').click(function(e) {
        $(document).on('click','.delete-button',function(e){  
          var id = $(this).attr('data-id');
          var obj = $(this);

          swal({
            title: "Are you sure?",
            text: "Are you sure you want to move this Branch to the Recycle Bin?",
            type: "warning",
            showCancelButton: true,
        }, function(willDelete) {
            if (willDelete) {
              $.ajax({
                url: "{{route('delete_branch')}}",
                type: 'post',
                data: {
                  id: id
              },
              dataType: "JSON",
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                  console.log("Response", response);
                  if(response.success == 1) {
                   $( "#flash-message" ).css("display","block");
                   $( "#flash-message" ).removeClass("d-none");
                   $( "#flash-message" ).addClass("alert-danger");
                   $('#flash-message').html('Branch Deleted Successfully');
                   obj.parent().parent().remove();
                   setTimeout(() => {
                       $( "#flash-message" ).addClass("d-none");
                   }, 5000);
               }
               else {
                console.log("FALSE");
                setTimeout(() => {
                  swal('Error','Something went wrong','error');
                // alert("Something went wrong! Please try again.");
            }, 500);
            } 
        }
    });
          } 
      });
      });



//check data 

$(document).ready(function(){
  $message = localStorage.getItem('success_data'); 
  if($message != null){

   $( "#flash-message" ).css("display","block");
   $( "#flash-message" ).removeClass("d-none");
   $( "#flash-message" ).addClass("alert-success");
   $('#flash-message').html($message);

   setTimeout(function(){
    $('#flash-message').html( );
    localStorage.removeItem("success_data");
},1000);


}  
});
</script>







<script type="text/javascript">

   $(document).ready(function(){



            // $('#addNewStaffModal').modal({
            //     show:true,
            // });

            $(document).on('click','.branch_add_staff',function(){

             var branch_id = $(this).attr('branch-id');
             var branch_name = $(this).attr('branch-name');
             $
             $('#addNewStaffModal').modal({
                show:true,
                backdrop: 'static',
                keyboard: false
            });

             $('#branch_name').html(branch_name);
             $('#branch_id_dynamic').val(branch_id);


            //check and entry exist or not...........

            $.ajax({
              type:"post",
              url:"{{route('check.staff.entry')}}",
              data:{
                 "_token": "{{ csrf_token() }}",
                 branch_id:branch_id

             },
             dataType: "JSON",
             success:function(response)
             {

               $('.staff_parent').html(response.html); 

               $(document).ready(function(){

            $('.datepicker').datepicker({
            // weekStart: 1,
            // daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
            });
            //$('.datepicker').datepicker("setDate", new Date());


            });


               $(".catselect").select2(); 
               getSerialNumber();             

                  //Remove delete btn

                  $('.choice_remove_btn_flags').each(function(){
                      $(this).click(function(){
                        var staff_id = $(this).attr('data-id');
                        var current_del_tr = this.parentElement;
                        
                        swal({
                            title: "Are you sure ?",
                            text: "Are you sure you want to Permanently Delete this Branch Staff  ?",
                            type: "warning",
                            showCancelButton: true,
                        }, function(willDelete) {
                            if (willDelete) {

                                $.ajax({
                                    type:"POST",
                                    url:"{{route('branchstaff.delete')}}",
                                    data:{ 
                                        "_token": "{{ csrf_token() }}",
                                        staff_id:staff_id,
                                        branch_id:branch_id
                                    },
                                    success:function(response){
                                        if(response.success){
                                           var parent_td = current_del_tr.parentElement;
                                           parent_td.remove();
                                           getSerialNumber();
                                       } 
                                   }
                               });

                            } 
                        });







                      //  var current_del_tr = this.parentElement;
                      //  var parent_td = current_del_tr.parentElement;
                      // //remove td
                      // parent_td.remove(); 
                      //getSerialNumber();
                  });
                  });


                  $('.choice_remove_btn').each(function(){
                      $(this).click(function(){
                         var current_del_tr = this.parentElement;
                         var parent_td = current_del_tr.parentElement;
                      //remove td
                      parent_td.remove();
                      getSerialNumber();
                  });
                  });
                  
                  function getSerialNumber()
                  {
                   var main_container =   $('.staff_parent')[0];
                   var getinput_serial_number =  main_container.getElementsByClassName('serial_number');
                   $(getinput_serial_number).each(function(index,data)
                   {
                      data.innerHTML = index+1;
                  }); 
               }



           }
       });







           //add_new_staff
           
           $('.add_new_staff').click(function(){

            $.ajax({
              type:"post",
              url:"{{route('add.staff')}}",
              data:{
                 "_token": "{{ csrf_token() }}",

             },
             dataType: "JSON",
             success:function(response)
             {

               $('.staff_parent').append(response.html);
               $('.staff_code').focus(); 
               $(".catselect").select2(); 
               getSerialNumber();             

                  //Remove delete btn

                  $('.datepicker').datepicker({
        // weekStart: 1,
        // daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });




                  $('.choice_remove_btn').each(function(){
                      $(this).click(function(){
                         var current_del_tr = this.parentElement;
                         var parent_td = current_del_tr.parentElement;
                      //remove td
                      parent_td.remove();
                      getSerialNumber();
                  });
                  });
                  
                  function getSerialNumber(){
                     var main_container =   $('.staff_parent')[0];
                     var getinput_serial_number =  main_container.getElementsByClassName('serial_number');
                     $(getinput_serial_number).each(function(index,data){
                         data.innerHTML = index+1;
                     }); 
                 }



             }
         });

        });  
           



       });
});

</script>


<script type="text/javascript">

 $(".catselect").select2();

</script>



<script type="text/javascript">


    $('#add_new_staff').submit(function(e){
        e.preventDefault();
        
        $('.staff_code').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Staff code is required </span>").insertAfter(this);
            }
        });

        $('.staff_code').each(function() {
          $(this).on('input', function() {
            $(this).next().remove();
        });
      });



        //  $('.staff_name').each(function() {
        //     if($(this).val().trim() == '') {
        //         $(this).next().remove();
        //         $("<span class='text-danger compare'>Staff name is required </span>").insertAfter(this);
        //     }
        // });

        //  $('.staff_name').each(function() {
        //   $(this).on('input', function() {
        //         $(this).next().remove();
        //     });
        // });

        $('.start_date').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>start date is required</span>").insertAfter(this);
            }
        });

        $('.start_date').each(function() {
          $(this).on('change', function() {
            console.log(this);
            $(this).next().remove();
        });
      });



        $('.designation').each(function() {
            if($(this).val().trim() == '') {
               var ele = $(this).next();
               $(ele).next().remove();
               $("<span class='text-danger compare'>Designation is required </span>").insertAfter(ele);
           }
       });

        $('.designation').each(function() {
          $(this).on('input', function() {
            var ele = $(this).next();
            $(ele).next().remove();
        });
      });

        // end form validation

        if($('.compare').length==0)
        {
           $.ajax({
              type: "POST",
              url: "{{route('save.staff')}}",
              data: new FormData(this),
              contentType: false,
              processData: false,
              success: function(response) {
                console.log(response);

                if(response.success)
                {

                 //$('#exampleModalCenter').modal('hide');

                 swal({
                   title: "Branch Staff",
                   text:"Branch Staff Added Successfully",
                   type: "success",
               },
               function(){ 
                window.location.reload(); 
            }
            )

             }else{

             }

         }
     });
       }

   });



</script>





<script type="text/javascript">

 //Start edit staff coding.........



 $(document).ready(function(){

     $(document).on('click','.branch_edit_staff',function(){

         var branch_id = $(this).attr('branch-id');
         var branch_name = $(this).attr('branch-name');

         $('#EditStaffModal').modal({
            show:true,
        });

         $('#branch_edit_name').html(branch_name);
         $('#branch_edit_id_dynamic').val(branch_id);


            //check and entry exist or not...........

            $.ajax({
              type:"post",
              url:"{{route('edit.staff')}}",
              data:{
                 "_token": "{{ csrf_token() }}",
                 branch_id:branch_id

             },
             dataType: "JSON",
             success:function(response)
             {

               $('.staff_parent_edit').html(response.html); 
               $(".catselect").select2(); 
               getSerialNumber();             

                  //Remove delete btn

                  
                  $('.datepicker').datepicker({
        // weekStart: 1,
        // daysOfWeekHighlighted: "6,0",
        autoclose: true,
        // todayHighlight: true,
    });

    
      //Start Dec 6 coding......
      
        $(document).ready(function(){
        $('.start_date').each(function(){
            $(this).on('change',function(){
                var current_element = $(this)[0];
                var selected_date = $(current_element).val();
                var old_start_date = $(current_element).attr('start-date');
                var old_staff_id = $(current_element).attr('staff-id');
                var old_branch_id = $(current_element).attr('branch-id');
                // Check Staff On Leave Or Not On This Date......... 
                     $.ajax({
                         type:"POST",
                         url:"{{route('check.staff.OnLeaveOnNot')}}",
                         data:{
                              "_token": "{{ csrf_token() }}",
                              "branch_id":old_branch_id,
                              "staff_id":old_staff_id,
                              "selected_date":selected_date  
                         },
                          dataType: "JSON",
                         success:function(response){
                            console.log(response);
                              if(response.success == "true"){
                                         swal({
                                    title: "Staff On Leave",
                                    text: "This Staff is on Leave For this date",
                                    type: "warning",
                                 },
                                 function () {
                                    $(current_element).val(old_start_date);
                                    console.log(current_element);
                                    // $('current_element').val(old_start_date);
                                 });

                              }
                              else{
                              //   alert('ok fine');
                              }
                         }
                     });

            });
        });
    });

      // End Dec 6 Coding ..........            


                  $('.choice_remove_btn').each(function(){
                      $(this).click(function(){
                         var current_del_tr = this.parentElement;
                         var parent_td = current_del_tr.parentElement;
                      //remove td
                      parent_td.remove();
                      getSerialNumber();
                  });
                  });
                  
                  function getSerialNumber()
                  {
                      var main_container =   $('.staff_parent_edit')[0];
                      var getinput_serial_number =  main_container.getElementsByClassName('serial_number');
                      $(getinput_serial_number).each(function(index,data)
                      {
                         data.innerHTML = index+1;
                     }); 
                  }

                //Delete

                         //Remove delete btn

                         $('.choice_remove_btn_flags').each(function(){
                          $(this).click(function(){
                            var staff_id = $(this).attr('data-id');
                            var current_del_tr = this.parentElement;

                            swal({
                                title: "Are you sure ?",
                                text: "Are you sure you want to Permanently Delete this Branch Staff  ?",
                                type: "warning",
                                showCancelButton: true,
                            }, function(willDelete) {
                                if (willDelete) {

                                    $.ajax({
                                        type:"POST",
                                        url:"{{route('branchstaff.delete')}}",
                                        data:{ 
                                            "_token": "{{ csrf_token() }}",
                                            staff_id:staff_id,
                                            branch_id:branch_id
                                        },
                                        success:function(response){
                                            if(response.success){
                                               var parent_td = current_del_tr.parentElement;
                                           //Remove icon
                                           parent_td.remove();
                                           //Remove Parent Elements
                                           current_del_tr.parentElement.parentElement.remove();
                                           getSerialNumber();
                                       } 
                                   }
                               });

                                } 
                            });







                      //  var current_del_tr = this.parentElement;
                      //  var parent_td = current_del_tr.parentElement;
                      // //remove td
                      // parent_td.remove(); 
                      //getSerialNumber();
                  });
                      });










                     }
                 });








        });
});



</script>






<script type="text/javascript">


    $('#edit_new_staff').submit(function(e){
        e.preventDefault();
        
        $('.staff_code').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Staff code is required </span>").insertAfter(this);
            }
        });

        $('.staff_code').each(function() {
          $(this).on('input', function() {
            $(this).next().remove();
        });
      });



        $('.staff_name').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Staff name is required </span>").insertAfter(this);
            }
        });

        $('.staff_name').each(function() {
          $(this).on('input', function() {
            $(this).next().remove();
        });
      });

        $('.designation').each(function() {
            if($(this).val().trim() == '') {
               var ele = $(this).next();
               $(ele).next().remove();
               $("<span class='text-danger compare'>Designation is required </span>").insertAfter(ele);
           }
       });

        $('.designation').each(function() {
          $(this).on('input', function() {
            var ele = $(this).next();
            $(ele).next().remove();
        });
      });

        // end form validation

        if($('.compare').length==0)
        {
           $.ajax({
              type: "POST",
              url: "{{route('update.staff')}}",
              data: new FormData(this),
              contentType: false,
              processData: false,
              success: function(response) {
                console.log(response);

                if(response.success)
                {

                 //$('#exampleModalCenter').modal('hide');

                 swal({
                   title: "Branch Staff",
                   text:"Branch Staff Updated Successfully",
                   type: "success",
               },
               function(){ 
                window.location.reload(); 
            }
            )

             }else{

             }

         }
     });
       }

   });



</script>



<script type="text/javascript">

  $('form').bind("keypress", function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});


  $('body').on('keyup', '.staff_code', function(e) {
   var code = e.keyCode || e.which;
   if (code == '13') {  

       var current_element = this;
       var getParentContainer = current_element.parentElement.parentElement.parentElement;
       var getAllInput = getParentContainer.getElementsByTagName('INPUT');

       var flags = 0;

       $('.staff_code').each(function(){
         if(this.value == current_element.value || this.value == "MM"+current_element.value){
            flags++;

            if(flags!=1){
              toastr.error('Duplicate Entry');
                  // alert('Duplicate');
                  // $("<span class='text-danger compare'>Duplicate code </span>").insertAfter(current_element);
                 // alert('yes');
                 flags = 0;
                 return false;
             }else{

             }
         }
     }); 

       if(flags ==1){
        $.ajax({
            type:"POST",
            url:"{{route('check-staff.code')}}",
            data:{
                "_token": "{{ csrf_token() }}",
                id:"{{$branch->id}}",
                code:current_element.value
            },
            success:function(response){
                if(response.status == 2){
                    var AllResponsedData =  response.data;
                    var staff_name = AllResponsedData.staff_name;
                    var designation = response.designation;
                     var staff_code = response.suffix_code;
                    var points = AllResponsedData.points;
                    //console.log(points);
                    getAllInput[0].value = staff_code;
                    getAllInput[1].value = staff_name;
                    getAllInput[2].value = designation;
                    getAllInput[3].value = points;
                    


                    var counts = 0;
                    $('.staff_name').each(function(){
                        if(this.value == ""){       
                           counts++;
                       }
                   })

                    if(counts == 0){
                       //  $('.add_new_staff').trigger('click');
                       $(getAllInput[4]).removeAttr('disabled');
                       $(getAllInput[4]).focus();
                       
                       $(getAllInput[4]).on('change',function(){

                         $(getAllInput[4][0]).next().remove();
                         scounts = 0;
                         $('.staff_name').each(function(){
                            if(this.value == ""){       
                                scounts++;
                            }
                        })

                         if(scounts==0){
                          $('.add_new_staff').trigger('click');
                      }

                  });

                   }
                  //  $('.add_new_staff').trigger('click');
              }

              if(response.status == 0){
                console.log(response);
                getAllInput[1].value =  '';
                getAllInput[2].value =  '';
                getAllInput[3].value = '';
                $(current_element).on('input', function() {
                    $(current_element).next().remove();
                });
                $(current_element).next().remove();
                $("<span class='text-danger compare'>"+response.message+"</span>").insertAfter(current_element);


            }


            if(response.status == 1){
                console.log(response);
                getAllInput[1].value =  '';
                getAllInput[2].value =  '';
                getAllInput[3].value = '';
                $(current_element).on('input', function() {
                    $(current_element).next().remove();
                });
                $(current_element).next().remove();
                $("<span class='text-danger compare'>"+response.message+"</span>").insertAfter(current_element);


            }
        }
    });  
    } 
}

       // getAllInput.each(function(){

       // var staff_code = getAllInput[1];
       // console.log(staff_code.value = "dfdsf");  

       // });

   });

</script>




<script type="text/javascript">



 $('body').on('change', '.staff_code', function(e) {



   var current_element = this;
   var getParentContainer = current_element.parentElement.parentElement.parentElement;
   var getAllInput = getParentContainer.getElementsByTagName('INPUT');

   var flags = 0;
   $('.staff_code').each(function(){
     if(this.value == current_element.value || this.value == "MM"+current_element.value){
        flags++;

        if(flags!=1){
                  // alert('Duplicate');
                  // $("<span class='text-danger compare'>Duplicate code </span>").insertAfter(current_element);
                 // alert('yes');
                 toastr.error('Duplicate Entry');
                 flags = 0;
                 return false;
             }else{

             }
         }
     }); 

   if(flags ==1){
    $.ajax({
        type:"POST",
        url:"{{route('check-staff.code')}}",
        data:{
            "_token": "{{ csrf_token() }}",
            id:"{{$branch->id}}",
            code:current_element.value
        },
        success:function(response){
            if(response.status == 2){
                var AllResponsedData =  response.data;
                var staff_name = AllResponsedData.staff_name;
                var designation = response.designation;
                var staff_code = response.suffix_code;
                var points = AllResponsedData.points;
                    //console.log(points);
                    getAllInput[0].value = staff_code;
                    getAllInput[1].value = staff_name;
                    getAllInput[2].value = designation;
                    getAllInput[3].value = points;

                    var counts = 0;
                    $('.staff_name').each(function(){
                        if(this.value == ""){       
                           counts++;
                       }
                   })

                    if(counts == 0){
                       //  $('.add_new_staff').trigger('click');
                       $(getAllInput[4]).removeAttr('disabled');
                       $(getAllInput[4]).focus();
                       
                       $(getAllInput[4]).on('change',function(){
                        var ss  =  $(getAllInput[4])[0];
                        $(ss).next().remove();
                          //$(getAllInput[4][0]).next().remove();
                       //   $('.add_new_staff').trigger('click');
                   });

                   }   
                  //  $('.add_new_staff').trigger('click'); 
              }

              if(response.status == 0){
                console.log(response);
                getAllInput[1].value =  '';
                getAllInput[2].value =  '';
                getAllInput[3].value = '';
                $(current_element).on('input', function() {
                    $(current_element).next().remove();
                });
                $(current_element).next().remove();

                $("<span class='text-danger compare'>"+response.message+"</span>").insertAfter(current_element);


            }

            if(response.status == 1){
                console.log(response);
                getAllInput[1].value =  '';
                getAllInput[2].value =  '';
                getAllInput[3].value = '';
                $(current_element).on('input', function() {
                    $(current_element).next().remove();
                });
                $(current_element).next().remove();
                $("<span class='text-danger compare'>"+response.message+"</span>").insertAfter(current_element);


            }
        }
    });  
} 


       // getAllInput.each(function(){

       // var staff_code = getAllInput[1];
       // console.log(staff_code.value = "dfdsf");  

       // });

   });

</script>


<script type="text/javascript">
    
    $('.add_staff_modal_close').click(function() {

    $('#addNewStaffModal').modal('hide');
     
    location.reload();

});

     $('.edit_staff_modal_close').click(function() {

    $('#EditStaffModal').modal('hide');
     
    location.reload();

});

</script>


<script type="text/javascript">
    // $(document).ready(function(){
    //     $('.start_date').each(function(){
    //         $(this).on('change',function(){
    //             alert();
    //         });
    //     });
    // });
</script>

@stop
