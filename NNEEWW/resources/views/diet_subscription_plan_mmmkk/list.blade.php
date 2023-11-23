@extends('adminlte::page')

@section('title', 'Super Admin | Diet Subscription Plan ')

@section('content_header')

@section('content')

 
<div class="container-fluid p-0">
    <div class="alert d-none" role="alert" id="flash-message">
    </div>
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Diet Subscription Plans</h3>




                        </div>
                        <div class="">
                            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th>Title</th>
                                        <th>Status</th>




                                        @if (Gate::check('edit_diet_subscription_plans') || Gate::check('view_diet_subscription_plans'))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($DietSubscriptionPlanList as $DietSubscriptionPlan)
                                    <tr>
                                        <td class="display-none"></td>
                                        <td>{{ $DietSubscriptionPlan->name ?? '--' }} 
                                            @if($DietSubscriptionPlan->is_free == 1)
                                            <span class="badge badge-pill badge-primary">Free</span>
                                            @endif

                                            @if(!empty($DietSubscriptionPlan->discount))
                                            <span class="badge badge-pill badge-danger">{{$DietSubscriptionPlan->discount}} % Off</span>
                                            @endif

                                        </td>

                                        @if ($DietSubscriptionPlan->status == 1)
                                        <td class="text-success"><span class="active_text_success">Active</span>
                                        </td>
                                        @else
                                        <td class="text-warning"><span
                                            class="inactive_text_warning">Inactive</span></td>
                                            @endif


                                            @if (Gate::check('edit_diet_subscription_plans') || Gate::check('view_diet_subscription_plans') )
                                            <td>
                                               <!--  @if($DietSubscriptionPlan->id == 2 or $DietSubscriptionPlan->id == 3) 
                                                <a class="action-button plan-create-button" title="Plans"
                                                href="javascript:void(0)" data-id="{{ $DietSubscriptionPlan->id }}"> <i class="fa fa-list-alt" aria-hidden="true"></i></a>
                                                 @endif -->

                                                @can('view_diet_subscription_plans')
                                                <a class="action-button" title="View"
                                                href="{{ route('diet.subscription.plan.view', ['id' => $DietSubscriptionPlan->id]) }}"><i
                                                class="text-success fa fa-eye"></i></a>
                                                @endcan

                                                @can('edit_diet_subscription_plans')

                                                <a href="{{ route('diet.subscription.plan.edit', ['id' => $DietSubscriptionPlan->id]) }}"
                                                    title="Edit"><i class="text-warning fa fa-edit"></i></a>
                                                    @endcan

                                                    


                                                </td>
                                                @endcan

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
        </div>




        <!-- choice group modal -->
        <div id="choice_group_modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Customize plans Metabolic Diet Sub Plan Price</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" data-bs-dismiss="modal">×</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <div class="card-main m-0" id="price_details_form_container">
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- choice group modal -->

    @endsection

    @section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stop

    @section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
       //    $('#choice_group_modal').modal('show');
        $('#pages-list').DataTable({
            columnDefs: [{
                targets: 0,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }]
        });


        // delete
        //$('.delete-button').click(function(e) {
        $(document).on("click", ".delete-button", function() {
            var id = $(this).attr('data-id');
            var obj = $(this);

            // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to  delete this Specialization ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_specialization') }}",
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
                            if (response.success == 1) {
                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html(
                                    ' Specialization  Deleted Successfully');
                                obj.parent().parent().remove();
                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);
                            } else {
                                console.log("FALSE");
                                setTimeout(() => {
                                    swal('Error',
                                        "Something went wrong! Please try again.",
                                        'error');
                                }, 500);
                                // swal("Error!", "Something went wrong! Please try again.", "error");
                                // swal("Something went wrong! Please try again.");
                            }
                        }
                    });
                }
            });
        });
        // delete
    </script>
    <script type="text/javascript">
        //Active and incactive choices

        $(document).ready(function() {
            $(document).on('change', '.change_status_of_status', function() {
                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "post",
                    url: " ",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                        //toastr.success(response.message);
                        console.log(response);
                    }
                });
            })

            //        $('.change_status_of_group').change(function(){

            // });



        });
    </script>
    <script type="text/javascript">
        //Active and incactive choices

        $(document).ready(function() {
            $(document).on('change', '.change_status_of_popup', function() {
                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                        //toastr.success(response.message);
                        console.log(response);
                    }
                });
            })

            //        $('.change_status_of_group').change(function(){

            // });



        });
    </script>


    <script>
        
        $(document).ready(function(){

            $(document).on("click", ".plan-create-button", function() {
                var id = $(this).attr('data-id');
                var obj = $(this);

                $.ajax({
                   type:"post",
                   url:"{{route('get.pricing.details')}}",
                   data:{
                     "_token": "{{ csrf_token() }}",
                     "id":id,
                 },
                 dataType: "JSON",
                 success:function(response){
                     $('#choice_group_modal').modal('show');
                  console.log(response);
                  if(response.status) {
                     $('#price_details_form_container').html(response.html);
                     handlSubmit();
                 }
             }

         });

            });
        });
    </script>



    <script type="text/javascript">

      $(document).ready(function(){
       $(document).on("click", ".add_new_plan", function() {

        $.ajax({
           type:"post",
           url:"{{route('get.html')}}",
           data:{
             "_token": "{{ csrf_token() }}",
         },
         dataType: "JSON",
         success:function(response){
          console.log(response);
          if(response.status) {
             $('#plan_container').append(response.html);
         }
     }

 });
    });

  //-----------------------------------------------
  

      //Delete Choices 
    $(document).on('click', '.delete-button-just-created', function(e) {
        $(this).parent().parent().remove();
    });
    $(document).on('click', '.delete-button', function(e) {
       // $(this).parent().remove();
       //  return false;
        var id = $(this).attr('data-id');
       
        var obj = $(this);
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to  this plan  ?",
            type: "warning",
            showCancelButton: true,
        }, function(willDelete) {
            if (willDelete) {
                $.ajax({
                    type: 'post',
                    url: "{{route('delete.sub.plan')}}",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                    $(obj).parent().parent().remove();
                       if(response.success ==1){
                                toastr.success(response.message);
                             }else{
                                toastr.error(response.message);
                             }
                    }
                });
            }
        });
    });     

 //-------------------------------------------
           $(document).on("change", "#diet_id", function() {
               var id = $(this).val();
               var diet_plan_subscription_id = $('#diet_plan_subscription_id').val();
                   $.ajax({
                     type:"post",
                     url:"{{route('get.pricing..details.bydietid')}}",
                     data:{
                       "_token": "{{ csrf_token() }}",
                       "dietId":id,
                       "id":diet_plan_subscription_id
                   },
                   dataType: "JSON",
                   success:function(response){
                       $('#choice_group_modal').modal('show');
                       console.log(response);
                       if(response.status) {
                           $('#price_details_form_container').html(response.html);
                           handlSubmit();   
                       }
                   }

               });
           });
 //------------------------------       

       
   });
  


        function handlSubmit(){

        $('#addCustomizeForm').validate({
            ignore: [],
            rules: {
                sub_plan: {
                    required: true,
                    
                },
                
            },
            messages: {
                sub_plan: {
                    required: "Sub plan is required"
                }

            },
            submitHandler: function(form) {
                 console.log(form);


                         $.ajax({
                             type:"POST",
                             url:"{{route('save.sub.plans')}}",
                             data: new FormData(form), 
                             contentType: false,
                             cache: false,
                             processData: false,
                           success:function(response){ 
                              console.log(response);
                             if(response.success ==1){
                                toastr.success(response.message);
                             }else{
                                toastr.error(response.message);
                             }
                       }

                   });
                 return false;
            }
        });
    } 
  </script>


  @stop
