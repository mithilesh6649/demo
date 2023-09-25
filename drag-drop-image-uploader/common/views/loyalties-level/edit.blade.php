@extends('adminlte::page')
@section('title', 'Super Admin | Edit Loyalty    ')
@section('content_header')

@section('content')
 
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                <h3>Edit Loyalty </h3>
                <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body table form mb-0">
             
               <form id="addLoyaltyLevelForm" method="post" action="{{route('loyalty.level.update')}}" enctype="multipart/form-data">
                
                    <input type="hidden" name="loyalty_id" class="form-control" maxlength="100"  value="{{ $loyalty->id }}"  >
                 <div class="row">
                
                        <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                <div class="form-group">
                                    <label>Loyalty Name<span class="text-danger"> *</span></label>
                                    <input type="text" name="loyalty_name" class="form-control rewards_names"      maxlength="100"  value="{{ $loyalty->loyalty_name }}"  >
                                </div>
                            </div>


                        <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                <div class="form-group">
                                    <label>Description<span class="text-danger"> *</span></label>
                                    <input type="text" name="loyalty_description" class="form-control"    maxlength="500" value="{{ $loyalty->loyalty_description }}">
                                </div>
                        </div>

                              <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                               <div class="form-group mt-3">
                                  <label for="discount_type">Loyalty Type<span class="text-danger"> *</span></label> <div  style="pointer-events: none;">
                                  <select class="form-control" name="rewards_programm" id="rewards_programm" >
                                     <option value="">Select Rewards</option>
                                     
                                     
                                    @foreach($rewards_programm as $rewards)
                                        <option value="{{$rewards->name}}"  {{ $loyalty->rewards_programm == $rewards->name ? 'selected': ''}} >{{$rewards->value}}</option>
                                    @endforeach

                                  </select>
                                  </div>
                               </div>
                             </div>
                             


                            <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                <div class="form-group mt-3">
                                    <label>Status</label>
                                    <select  class="form-control" name="status">
                                    <option value="1" {{ $loyalty->status == 1 ? 'selected': ''}}  >Active</option>
                                    <option  value="0"  {{ $loyalty->status == 0 ? 'selected': ''}}  >Inactive</option>
                                    </select>
                                </div>
                            </div>
                       

                            
                            <div class="col-md-12 rewards-container">

                             <!-- 01 Start for Loyalty level -->

                               <div class="{{ $loyalty->rewards_programm=='loyality_level' ? '':'d-none' }}" id="loyality_level">
                                   
                                      <div class="card-body form">
                        <div class="row">
                         
                            <div class="col-md-12">
                          
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>KWD Spents From<span class="text-danger"> *</span></label>
                                    <input type="number" name="points_from" class="form-control loyality_level_pro " id="points_from"    min="0" dyanmic_msg='KWD spents from is required'  value="{{ $loyalty->points_from ?? '' }}" >
                                     
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>KWD Spents To</label>
                                    <input type="number" name="points_to" class="form-control loyality_level_prso" id="points_to"   min="0"  dyanmic_msg='KWD spents to is required' value="{{ $loyalty->points_to ?? '' }}">
                                    
                                </div>
                            </div>



                            <div class="col-md-12">
                            
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>Loyalty Points on Regular Menu Items / KD <span class="text-danger"> *</span></label>
                                    <input type="number" name="regular_items_points" class="form-control loyality_level_pro" id="regular_items_points"   min="0"  dyanmic_msg='Loyalty Points on Regular Menu Items / KD is required ' value="{{ $loyalty->regular_items_points ?? '' }}">
                                     
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label> Loyalty Points on Offers and Discount Items / KD  <span class="text-danger"> *</span></label>
                                    <input type="number" name="offers_items_points" class="form-control loyality_level_pro" id="offers_items_points"   min="0"  dyanmic_msg='Loyalty Points on Offers and Discount Items is required / KD' value="{{ $loyalty->offers_items_points ?? '' }}">
                                     
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>Birthday Points <span class="text-danger"> *</span></label>
                                    <input type="number" name="birthday_points" class="form-control loyality_level_pro" id="offers_items_points"   min="0" dyanmic_msg='Birthday Points is required'  value="{{ $loyalty->events_points ?? '' }}" >
                                     
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>Birthday Point Expiry in Days<span class="text-danger"> *</span></label>
                                    <input type="number" name="birthday_points_expiry_day" class="form-control loyality_level_pro" id="offers_items_points"   min="0" dyanmic_msg='Birthday Point Expiry Days is required'  value="{{ $loyalty->events_points_expiry ?? '' }}" >
                                     
                                </div>
                            </div>


                            
                            </div>
                     
                     
                       
                        </div>


                               </div> 
                              <!-- end for Loyalty level -->   
                              

                               <!-- 02 start sign_up   -->
                               <div class="{{ $loyalty->rewards_programm=='sign_up' ? '':'d-none' }}" id="sign_up">
                                                <div class="card-body form">
                        <div class="row">
                          
                           

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label> Signup Points <span class="text-danger"> *</span></label>
                                    <input type="number" name="sign_up_items_points" class="form-control loyality_level_sign_up" id="offers_items_points"  dyanmic_msg='Signup Points  is required' min="0" value="{{ $loyalty->events_points ?? '' }}" >
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>Signup Points Expiry in Days<span class="text-danger"> *</span></label>
                                    <input type="number" name="sign_up_points_expiry_day" class="form-control loyality_level_sign_up" id="sign_up_points_expiry_day"  dyanmic_msg='Signup Points Expiry in Days is required'  min="0" value="{{ $loyalty->events_points_expiry ?? '' }}" >
                                </div>
                            </div>


                            
                            </div>
                     
                           
                       
                        </div>
                               </div> 
                              <!-- 02  end sign_up -->   
                              
                                        <!-- for Loyalty level -->
                               <div class="{{ $loyalty->rewards_programm=='referral' ? '':'d-none' }}" id="referral">
                                   
                                         <div class="card-body form">
                        <div class="row">
                          
                           

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label> Referral bonus, on new user registration(%) <span class="text-danger"> *</span></label>
                                    <input type="number" name="register_bonus_newuser" class="form-control loyality_level_register" id="offers_items_points" dyanmic_msg='Referral bonus, on new user registration(%) is required'  min="1" max="100"  value="{{ $loyalty->register_bonus_newuser ?? '' }}" >
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label> Referral bonus, after total hours of reffered person successfull order<span class="text-danger"> *</span></label>
                                    <input type="number" name="bonus_active_newuser" class="form-control loyality_level_register" id="offers_items_points"   min="0" dyanmic_msg='Referral bonus, after total hours of reffered person successfull order is required'  value="{{ $loyalty->bonus_active_newuser ?? '' }}">
                                </div>
                            </div>


                            
                            </div>
                     
                           
                       
                        </div>


                               </div> 
                              <!-- for Loyalty level -->  

                                            <!-- for Loyalty level -->
                               <div class="{{ $loyalty->rewards_programm=='online_order' ? '':'d-none' }}" id="online_order">
                                 

                                                <div class="card-body form">
                        <div class="row">
                          
                           

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 d-none">
                                <div class="form-group mt-3">
                                    <label> Minimum order amount  </label>
                                    <input type="number" name="online_order_minimun_order_amount" class="form-control" id="offers_items_points"   min="0"   value="{{ $loyalty->minimun_order_amount ?? '' }}" >
                                </div>
                            </div>


                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                <div class="form-group mt-3">
                                    <label> Online Order Points / KD <span class="text-danger"> *</span></label>
                                    <input type="number" name="online_order_points" class="form-control loyality_level_online_order" id="offers_items_points" dyanmic_msg='Online Order Points / KD is required'   min="0"  value="{{ $loyalty->events_points ?? '' }}" >
                                </div>
                            </div>


                            
                            </div>
                     
                            
                       
                        </div> 



                               </div> 
                              <!-- for Loyalty level -->  


                                             <!-- for Loyalty level -->
                               <div class="{{ $loyalty->rewards_programm=='dine_in' ? '':'d-none' }}" id="dine_in">
                                   

                                                          <div class="card-body form">
                        <div class="row">
                          
                           

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 d-none">
                                <div class="form-group mt-3">
                                    <label> Minimum order amount <span class="text-danger"> *</span>  </label>
                                    <input type="number" name="dine_in_minimun_order_amount" class="form-control loyality_level_dine_in_min_order_amt" id="offers_items_points" dyanmic_msg='Minimum order amount is required'   min="0"  value="{{ $loyalty->minimun_order_amount ?? '' }}" >
                                </div>
                            </div>


                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                <div class="form-group mt-3">
                                    <label> Dine in Points / KD <span class="text-danger"> *</span></label>
                                    <input type="number" name="dine_in_points" class="form-control loyality_level_dine_in" id="offers_items_points"  dyanmic_msg='Dine in Points / KD is required'  min="0" value="{{ $loyalty->events_points ?? '' }}" >
                                </div>
                            </div>


                            
                            </div>
                  
                        </div> 



                               </div> 
                              <!-- for Loyalty level -->  

                            </div> 
                            


                 </div>


                      <div class="col-md-12 col-lg-12 col-xl-12 col-12 d-none">
                                <div class="form-group mt-3">
                                    <label>Position<span class="text-danger"> *</span></label>
                                    <input type="hidden" name="position" class="form-control "   min="0"  value="{{ $loyalty->position  ?? '' }}" >
                                </div>
                            </div>
                <div class="card-footer pb-0"> <button type="submit" class="button btn_bg_color common_btn text-white">Update</button></div>
               </form>  
            </div> 
            
          </div> 
        </div>
    </div>
  </div>
</div>


@endsection
@section('css')
@stop
@section('js')


 <script type="text/javascript">
     
     $(document).ready(function(){
        $('#rewards_programm').on('change',function(){
            var rewards_name = $(this).val();

            if(rewards_name == ''){
                 $('#dine_in').addClass('d-none');

            $('#loyality_level').addClass('d-none');
                $('#sign_up').addClass('d-none');
                $('#referral').addClass('d-none');
                 $('#online_order').addClass('d-none');

           }
           
           // alert(rewards_name);

           if(rewards_name == 'loyality_level'){
             $('#loyality_level').removeClass('d-none');
              $('.rewards_names').attr("placeholder",'Ex - Buddy ,Friend , Best Friend');

               $('#sign_up').addClass('d-none');
                $('#referral').addClass('d-none');
                $('#online_order').addClass('d-none');
                 $('#dine_in').addClass('d-none');
           }

           if(rewards_name == 'sign_up'){
            $('#sign_up').removeClass('d-none');

            $('.rewards_names').attr("placeholder",'Ex - Sign Up');

            $('#loyality_level').addClass('d-none');
                $('#referral').addClass('d-none');
                $('#online_order').addClass('d-none');
                 $('#dine_in').addClass('d-none');
           }

            if(rewards_name == 'referral'){
            $('#referral').removeClass('d-none');
             
             $('.rewards_names').attr("placeholder",'Ex - Referral'); 

            $('#loyality_level').addClass('d-none');
                $('#sign_up').addClass('d-none');
                $('#online_order').addClass('d-none');
                 $('#dine_in').addClass('d-none');

           }

            if(rewards_name == 'online_order'){
            $('#online_order').removeClass('d-none');

            $('.rewards_names').attr("placeholder",'Ex - Online order'); 

             $('#loyality_level').addClass('d-none');
                $('#sign_up').addClass('d-none');
                $('#referral').addClass('d-none');
                 $('#dine_in').addClass('d-none');

           }

            if(rewards_name == 'dine_in'){
            $('#dine_in').removeClass('d-none');

            $('.rewards_names').attr("placeholder",'Ex - Dine in'); 

            $('#loyality_level').addClass('d-none');
                $('#sign_up').addClass('d-none');
                $('#referral').addClass('d-none');
                 $('#online_order').addClass('d-none');
           }



           
        });
     });
 </script>


 <script>
    $(document).ready(function() {  
    
      $('#addLoyaltyLevelForm').validate({
        ignore: [],
        debug: false,
        rules: {
          rewards_programm: {
            required: true,
             
          },
           loyalty_name: {
            required: true, 
          },
            loyalty_description: {
            required: true, 
          },
          position:{
            required:true,
          }
        },
        messages: {
          rewards_programm: {
            required: "Loyalty  Type is required",
          },
          loyalty_name: {
            required: "Loyalty Name  is required",
          },
    
          loyalty_description: {
            required: "Description  is required",
          },
          position:{
            required:"Position is required",
          }
    
         
        },

         submitHandler: function () { 

            var selected_program =  $('#rewards_programm').val();  
           
        //  alert(selected_program);
           //Addition logic for loyal
            if(selected_program =='loyality_level'){
            
            var loyality_level_pro = $('.loyality_level_pro');
             
             $(loyality_level_pro).each(function() {
                var dymanic_error_msg =$(this).attr('dyanmic_msg');
                if($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare'>"+dymanic_error_msg+"</span>").insertAfter(this);
                }
            });    
             

              $(loyality_level_pro).each(function() {
                 $(this).on('input', function() {
            $(this).next().remove();
             });

            });
          
            var container = document.getElementById('addLoyaltyLevelForm');
                 var input = container.getElementsByClassName("compare"); 
                 if(input.length == 0) {
                    return true;
                 }else{
                    return false;
                 }
 
             //Addition logic for sign up         
          }else if(selected_program == 'sign_up'){
             

             var loyality_level_sign_up = $('.loyality_level_sign_up');
             
             $(loyality_level_sign_up).each(function() {
                var dymanic_error_msg =$(this).attr('dyanmic_msg');
                if($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare_sign_up'>"+dymanic_error_msg+"</span>").insertAfter(this);
                }
            });    
             

              $(loyality_level_sign_up).each(function() {
                 $(this).on('input', function() {
            $(this).next().remove();
             });

            });
          
            var container = document.getElementById('addLoyaltyLevelForm');
                 var input = container.getElementsByClassName("compare_sign_up"); 
                 if(input.length == 0) {
                    return true;
                 }else{
                    return false;
                 }






          }else if( selected_program =='referral'){

                  var loyality_level_register = $('.loyality_level_register');
             
             $(loyality_level_register).each(function() {
                var dymanic_error_msg =$(this).attr('dyanmic_msg');
                if($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare_referral'>"+dymanic_error_msg+"</span>").insertAfter(this);
                }
            });    
             

              $(loyality_level_register).each(function() {
                 $(this).on('input', function() {
            $(this).next().remove();
             });

            });
          
            var container = document.getElementById('addLoyaltyLevelForm');
                 var input = container.getElementsByClassName("compare_referral"); 
                 if(input.length == 0) {
                    return true;
                 }else{
                    return false;
                 }



          }else if(selected_program == 'online_order'){

              var loyality_level_online_order = $('.loyality_level_online_order');
             
             $(loyality_level_online_order).each(function() {
                var dymanic_error_msg =$(this).attr('dyanmic_msg');
                if($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare_online_order'>"+dymanic_error_msg+"</span>").insertAfter(this);
                }
            });    
             

              $(loyality_level_online_order).each(function() {
                 $(this).on('input', function() {
            $(this).next().remove();
             });

            });
          
            var container = document.getElementById('addLoyaltyLevelForm');
                 var input = container.getElementsByClassName("compare_online_order"); 
                 if(input.length == 0) {
                    return true;
                 }else{
                    return false;
                 }




          }else{

              var loyality_level_dine_in = $('.loyality_level_dine_in');
             
             $(loyality_level_dine_in).each(function() {
                var dymanic_error_msg =$(this).attr('dyanmic_msg');
                if($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare_dine_in'>"+dymanic_error_msg+"</span>").insertAfter(this);
                }
            });    
             

              $(loyality_level_dine_in).each(function() {
                 $(this).on('input', function() {
            $(this).next().remove();
             });

            });



                      var loyality_level_dine_in_min_order_amt = $('.loyality_level_dine_in_min_order_amt');
             
             $(loyality_level_dine_in_min_order_amt).each(function() {
                var dymanic_error_msg =$(this).attr('dyanmic_msg');
                if($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare_dine_in'>"+dymanic_error_msg+"</span>").insertAfter(this);
                }
            });    
             

              $(loyality_level_dine_in_min_order_amt).each(function() {
                 $(this).on('input', function() {
            $(this).next().remove();
             });

            });

              
          
            var container = document.getElementById('addLoyaltyLevelForm');
                 var input = container.getElementsByClassName("compare_dine_in"); 
                 if(input.length == 0) {
                    return true;
                 }else{
                    return false;
                 }



          }

          
                
         }
      });
    
     
        
    
    });
</script>




 



@stop
 