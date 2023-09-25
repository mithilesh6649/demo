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
                  <h3>Branch Locality</h3>
                  <!-- @can('add_branch')
                  <a class="btn btn-sm btn-success" href="{{route('add_branch')}}">Add Branch</a>
                  @endcan -->
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
                           <th>Status </th>
                           @if(Gate::check('add_branch_locality') || Gate::check('edit_branch_locality') ) 
                           <th>{{ __('adminlte::adminlte.actions') }}</th>
                           @endcan
                        </tr>
                     </thead>
                     <tbody>

                       @foreach($branches as $branch)
                         <tr>
                            <th class="display-none"></th>
                            <td>{{$branch->title_en }}</td>
                            <td>{{$branch->title_ar }}</td>
                            <td>{{$branch->email ?? 'N/A'  }}</td>
                            <td> (+{{$branch->country}}) {{$branch->phone_number}}</td>
                            <td>
                              @foreach($status as $status_data)
                              @if($status_data->value==$branch->status)
                              <label class="badge {{$branch->status==1?'badge-success':'badge-danger'}} p-1">{{$status_data->name}}</label>
                              @endif
                              @endforeach
                           </td> 
                             @if(Gate::check('add_branch_locality') || Gate::check('edit_branch_locality') ) 
                           <td>
                               @can('add_branch_locality')
                              <span class="add_locality" data-name="{{$branch->title_en}}" data-id="{{$branch->id}}">
                                <i class=" text-success fa fa-plus" aria-hidden="true"></i>
                                </span>
                                @endcan
                                @can('edit_branch_locality')
                                <a class="action-button edit_locality" title="Edit " data-id="{{$branch->id}}" href=""  data-name="{{$branch->title_en}}"><i class="text-warning fa fa-edit"></i></a>
                                @endcan
                           </td>
                           @endif

                         </tr>
                       @endforeach
                       
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="exampleModalCenterTitle">Add Branch Locality</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="form-branch-city" class="model-back">
          <div class="modal_content d-flex align-items-center justify-content-between">
            <h6 class="body-heading mb-0">Branch Name : <strong id="branch_name"></strong></h6>
            <input type="hidden" name="branch_id" id="branch_id">
           
          </div>
          <div class="row  mk_branch_cities" id="branches_cities">           
          
          </div>
          <!-- <div class="row">
            <button class="btn btn-danger addbranches_cities">Add</button>
          </div>  -->
          <div class="modal-footer justify-content-center added">
            <input type="submit" value="Save All" class="btn btn-danger m-0">
            <button class="btn btn-danger float-right addbranches_cities">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="editexampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editexampleModalCenterTitle">Edit Branch Locality</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form id="editform-branch-city" class="model-back">
         <div class="modal_content d-flex align-items-center justify-content-between">
           <h6 class="body-heading mb-0"><strong id="branch_name"></strong></h6>
           <button class="text-white btn btn-danger print_document" data-name="" id="del_branch_name">Download</button>
           <input type="hidden" name="editbranch_id" id="editbranch_id">
         </div>
         
         <!-- testing -->
           
           <div class="row">
              <div class="col-md-1">
                    <label for="password"> S.No<span class="text-danger"> *</span></label>
              </div>
              <div class="col-md-2">
                    <label for="password"> City<span class="text-danger"> *</span></label>
              </div>
               <div class="col-md-2">
                    <label for="password"> Branch<span class="text-danger"> *</span></label>
              </div>
               <div class="col-md-2">
                  <label for="delivery_charge">Delivery Fee<span class="text-danger"> *</span></label>
              </div>
               <div class="col-md-2">
                    <label for="minimum_order_amount">Mini Order Amt<span class="text-danger"> *</span></label>
              </div>

               <div class="col-md-2">
                    <label for="minimum_order_amount">Delivery Time(min)<span class="text-danger"> *</span></label>
              </div>

                <div class="col-md-1">
                   
              </div>


           </div> 

          <!-- ffff -->

         <div class="nodata text-center d-block row mk_branch_cities_edit" id="editbranches_cities">            
         </div>
         <div class="modal-footer justify-content-center">
           <input type="submit" value="Update All" class="btn btn-danger m-0">
         </div>
       </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style type="text/css">
    .tabs {
  display: block;
  padding: 10px;
  margin-bottom: 2px;
  color: #fff;
}
  </style>
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>

    function selectcities(id)
    {
      $.ajax({
         url:"{{route('locality.listlicality')}}",
         method:"post",
         data:{
            'id':id
         },
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         success:function(response)
         {

            if(response.status=='success')
            {
              $('#branches_cities').append(response.html);
               
            }

            $(document).ready(function(){
                 
                 $(".catselect").select2();

                //Start mk coding //
                 
                var main_container =   $('.mk_branch_cities')[0];
                console.log(main_container);
               
              
                  // For Serial number.................................

               var getinput_serial_number =  main_container.getElementsByClassName('serial_number');
               $(getinput_serial_number).each(function(index,data){
                     data.innerHTML = index+1;
               });
               


              // For Delivery Fee input.................................

               var getinput_delivery_charge =  main_container.getElementsByClassName('delivery_charge');
               
               var total_delivert_charge_length = getinput_delivery_charge.length-1;     
               var prev_delivert_charge_value = 0;
               $(getinput_delivery_charge).each(function(index,data){
                     //console.log(index);
                  if(total_delivert_charge_length-1 == index){
                     prev_delivert_charge_value =this.value;
                  }
                  if(total_delivert_charge_length == index){
                     this.value = prev_delivert_charge_value;
                  }

               });


                // For Delivery order amount input.................................

               var getinput_delivery_charge =  main_container.getElementsByClassName('minimum_order_amount');
               
               var total_delivert_charge_length = getinput_delivery_charge.length-1;     
               var prev_delivert_charge_value = 0;
               $(getinput_delivery_charge).each(function(index,data){
                     //console.log(index);
                  if(total_delivert_charge_length-1 == index){
                     prev_delivert_charge_value =this.value;
                  }
                  if(total_delivert_charge_length == index){
                     this.value = prev_delivert_charge_value;
                  }

               });



                // For Delivery order amount input.................................

               var getinput_delivery_charge =  main_container.getElementsByClassName('delivery_time');
               
               var total_delivert_charge_length = getinput_delivery_charge.length-1;     
               var prev_delivert_charge_value = 0;
               $(getinput_delivery_charge).each(function(index,data){
                     //console.log(index);
                  if(total_delivert_charge_length-1 == index){
                     prev_delivert_charge_value =this.value;
                  }
                  if(total_delivert_charge_length == index){
                     this.value = prev_delivert_charge_value;
                  }

               });


                //End mk coding //  

               var selected_element_id = [];
                $('.city_search').each(function(){
                

                if($(this).val()!=''){
                 selected_element_id.push($(this).val());
                // console.log(selected_element_id);
                }
                 
                 
                 
                });

            
        //Remove  selected value for option 


           var all_city_options =  main_container.getElementsByClassName('city_search');
               
               var total_delivert_charge_length = all_city_options.length-1;     
               var prev_delivert_charge_value = 0;
               $(all_city_options).each(function(index,data){
                  
                  if(total_delivert_charge_length == index){
                    var last_select = data;
                    var all_city_options =  last_select.getElementsByTagName('OPTION');
                    $(all_city_options).each(function(index,data){
                       var current_option = data;   
                       // console.log($(data).attr('value'));
                       // console.log(data);

                       $(selected_element_id).each(function(index,data){
                            if($(current_option).attr('value') == data){
                                 $(current_option).remove();
                            }
                       });
                    

                    });                     

 
                  }

               });



            

             });



         }
      });
   }

    function viewselectcities(id)
    {
      $.ajax({
         url:"{{route('loyality.view')}}",
         method:"post",
         data:{
            'id':id
         },
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         success:function(response)
         {
            if(response.status=='success')
            {
                $('#branches_cities').html('');
               $('#branches_cities').prepend(response.html)


            }
           
             $(document).ready(function(){
                 
                 $(".catselect").select2();

                //Start mk coding //
                 
                var main_container =   $('.mk_branch_cities')[0];
                console.log(main_container);
               
              
                  // For Serial number.................................

               var getinput_serial_number =  main_container.getElementsByClassName('serial_number');
               $(getinput_serial_number).each(function(index,data){
                     data.innerHTML = index+1;
               });
               


                //End mk coding //  

               var selected_element_id = [];
                $('.city_search').each(function(){
                

                if($(this).val()!=''){
                 selected_element_id.push($(this).val());
                 console.log(selected_element_id);
                }
                 
                 
       

                });

            
        //Remove  selected value for option 


           var all_city_options =  main_container.getElementsByClassName('city_search');
               
               var total_delivert_charge_length = all_city_options.length-1;     
               var prev_delivert_charge_value = 0;
               $(all_city_options).each(function(index,data){
                  
                  if(total_delivert_charge_length == index){
                      var last_select = data;
                    var all_city_options =  last_select.getElementsByTagName('OPTION');
                    $(all_city_options).each(function(index,data){
                       var current_option = data;   
                       // console.log($(data).attr('value'));
                       // console.log(data);

                       $(selected_element_id).each(function(index,data){
                            if($(current_option).attr('value') == data){
                                 $(current_option).remove();
                            }
                       });
                    

                    });                     

 
                  }

               });



            

             });

         }
      });
   }
    
   function editselectcities(id)
    {
      $.ajax({
         url:"{{route('locality.edit')}}",
         method:"get",
         data:{
            'id':id
         },
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         success:function(response)
         {
            if(response.status=='success')
            {
              $('#editbranches_cities').html(response.html)
            }
         
            $(document).ready(function(){
                 
                  $(".catselect").select2();

              
                var main_container =   $('.mk_branch_cities_edit')[0];
                var getinput_serial_number =  main_container.getElementsByClassName('serial_number');
                    $(getinput_serial_number).each(function(index,data){
                       data.innerHTML = index+1;
                     });

               

             });

         }

      });
   }

   function deletebranchCity(id)
    {
      $.ajax({
         url:"{{route('locality.delete')}}",
         method:"post",
         data:{
            'id':id
         },
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         success:function(response)
         {
            if(response.status=='success')
            {
                  toastr.success(response.msg);
            
            }else{
                  toastr.error(response.msg);
            }
         }

      });
   }

   $(document).ready(function(){

      $('.print_document').on('click',function(){
        var name=$(this).attr('data-name');
        var d=new Date($.now());
        var today = d.getDate()+"_"+(d.getMonth()+1)+"_"+d.getFullYear()+"_time_"+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();

         var id=$('#editbranch_id').val();
         $.ajax({
            type: "get",
            url:"{{ route('locality.download') }}",
            data:{'id':id},
            cache: false,
            xhrFields:{
                responseType: 'blob'
            },
            success:function(data){
                 var link = document.createElement('a');
                link.href = window.URL.createObjectURL(data);
                link.download = name.replaceAll(' ','_')+"_"+today+`.xlsx`;
                link.click();
            }
         })
    })


    $(document).on('click','.branch_city_delete',function(){
        var id=$(this).attr('data-bid');  
        deletebranchCity(id);
      $(this).parent().parent().parent().remove();

    });


     $('#editform-branch-city').submit(function(e){
        e.preventDefault();
        
        $('.branch_search').each(function() {
            if($(this).val().trim() == '') {
                $(this).perv().remove();
                $("<span class='text-danger compare'>Branch is required </span>").insertBefore(this);
            }
        });

         $('.branch_search').each(function() {
          $(this).on('input', function() {
                $(this).perv().remove();
            });
        });


         $('.city_search').each(function() {
            if($(this).val().trim() == '') {
               var ele = $(this).next();
                 $(ele).next().remove();
                $("<span class='text-danger compare'>City is required </span>").insertAfter(ele);
            }
        });

         $('.city_search').each(function() {
            $(this).on('input', function() {
            var ele = $(this).next();
                $(ele).next().remove();
            });
        });


         $('.delivery_charge').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Delivery Fee is required </span>").insertAfter(this);
            }
        });

         $('.delivery_charge').each(function() {
          $(this).on('input', function() {
                $(this).next().remove();
            });
        });
    
       $('.minimum_order_amount').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Mini Order Amt is required </span>").insertAfter(this);
            }
        });

         $('.minimum_order_amount').each(function() {
          $(this).on('input', function() {
                $(this).next().remove();
            });
        });
         

       $('.delivery_time').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Delivery Time is required </span>").insertAfter(this);
            }
        });

         $('.delivery_time').each(function() {
          $(this).on('input', function() {
                $(this).next().remove();
            });
        });
        // end form validation

        if($('#editform-branch-city .compare').length==0)
        {
           $.ajax({
              type: "POST",
              url: "{{route('locality.update')}}",
              data: new FormData(this),
              contentType: false,
              processData: false,
              success: function(response) {
                 if(response.status=='success')
                 {
                    
                 toastr.success(response.msg);
                 $('#exampleModalCenter').modal('hide');
                     setTimeout(function(){ 
                        
                           window.location.reload()
                        
                          }, 2000);
               
                 }else{
                       toastr.error(response.msg); 
                 }

                }
            });
        }

      });
   });


    $(document).ready(function() {

      $('.edit_locality').on('click',function(e){
        var id=$(this).attr('data-id');
            e.preventDefault();
        var branch_name=$(this).attr('data-name');
            $('#del_branch_name').attr('data-name',branch_name);
            $('#editbranch_id').val(id);
           editselectcities(id);

         $('#editexampleModalCenter').modal({backdrop: 'static', keyboard: false,'show':true});

      });

      $('.addbranches_cities').on('click',function(e){
         e.preventDefault();
           var flags = 0;
         $('.city_search').each(function(){
             
             if($(this).val() == ''){
                 flags++;
                     swal({
                       title: "Branch locality",
                     text:"Select locality city first",
                     type: "warning",
                     },
                   function(){ 
                      
                   }
                )

               // alert('select city first');
             }


         });
         if(flags==0){
         
          var id=$('#branch_id').val();
          selectcities(id);
          }
        })

      $(document).on('click','.citydelete',function(e){
        e.preventDefault();
        $(this).parent().parent().remove();
      });


       $("body").on("change",".city_search", function(){
          
           var val=$(this).val();
          // alert(val);
           var flg=0;
          $('.city_search').each(function() {
              console.log('hello');
            if($(this).val().trim()!='')
            {
            if($(this).val().trim()== val) {
                 flg++;
              if(flg>1)
              {
                $(this).prev().remove();
                $("<span class='text-danger compare'>City Already selected</span>").insertBefore(this);
              }
            }
           }
          });

           $('.city_search').each(function() {
              $(this).on('input', function() {
                    $(this).prev().remove();
                });
            });



       });
     

 




      $('#form-branch-city').submit(function(e){
        e.preventDefault();
        
         $('.city_search').each(function() {
               if($(this).val().trim() == '') {
               var ele = $(this).next();
                 $(ele).next().remove();
                $("<span class='text-danger compare'>City is required </span>").insertAfter(ele);
            }
        });

         $('.city_search').each(function() {
            $(this).on('input', function() {
            var ele = $(this).next();
                $(ele).next().remove();
            });
        });


         $('.delivery_charge').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Delivery Fee is required </span>").insertAfter(this);
            }
        });

         $('.delivery_charge').each(function() {
          $(this).on('input', function() {
                $(this).next().remove();
            });
        });
    
       $('.minimum_order_amount').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Mini Order Amt is required </span>").insertAfter(this);
            }
        });

         $('.minimum_order_amount').each(function() {
          $(this).on('input', function() {
                $(this).next().remove();
            });
        });
         

       $('.delivery_time').each(function() {
            if($(this).val().trim() == '') {
                $(this).next().remove();
                $("<span class='text-danger compare'>Delivery Time is required </span>").insertAfter(this);
            }
        });

         $('.delivery_time').each(function() {
          $(this).on('input', function() {
                $(this).next().remove();
            });
        });

        // end form validation

        if($('.compare').length==0)
        {
           $.ajax({
              type: "POST",
              url: "{{route('locality.save')}}",
              data: new FormData(this),
              contentType: false,
              processData: false,
              error:function(xhr,response,error){
                   toastr.error('Locality already saved'); 
              },
              success: function(response) {
                 if(response.status=='success')
                 {
                 toastr.success(response.msg);
                 $('#exampleModalCenter').modal('hide');
                     setTimeout(function(){ 
                        
                           window.location.reload()
                        
                          }, 2000);
               
                 }else{
                       toastr.error(response.msg); 
                 }

                }
            });
        }

      });

      //end save form

      $("a.tabs").click(function (e) {
        var $groupName = $(this).data("group");
        $("[data-group='" + $groupName + "']").each(function () {
            $($(this).data("target")).addClass('collapse').removeClass("in");
        });
    });
             
    $('.add_locality').on('click',function(){
         
         var id=$(this).attr('data-id');
          $('#branch_id').val('')
          $('#branch_id').val(id);
         
          $('#branch_name').val('');
          $('#branch_name').text($(this).attr('data-name'));
          viewselectcities(id);
          $('#exampleModalCenter').modal({backdrop: 'static', keyboard: false,'show':true});

      });


      $('#jobseekers-list').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data ;
          }
        }]
      });
    });

    

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
   //  setInterval(function(){ 
   //   $(".catselect").select2();
   // },1000);
    </script>
@stop
