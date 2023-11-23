   <!-- Start Profile  -->

   <form id="editUserForm" method="post" action="{{ route('update_nutritionist') }}" enctype="multipart/form-data">
       @csrf
       <div class="card-body form">
           <input type="hidden" name="id" class="form-control" id="id" value="{{ @$User->id }}">
           <div class="row">
               
                 <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Daily calories intake</label>
                       <input readonly type="text" name="name" class="form-control" id="name"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->daily_calories_intake ?? '--' }} ">
                       
                   </div>
               </div> 
              
               <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Fats per day</label>
                       <input readonly type="text" name="name" class="form-control" id="name"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->total_fats_per_day ?? '--' }} ">
                       
                   </div>
               </div>

                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Carbs per day</label>
                       <input readonly type="text" name="name" class="form-control" id="name"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->total_carbs_per_day ?? '--' }} ">
                     
                   </div>
               </div>


                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Protein per day</label>
                       <input readonly type="text" name="total_protein_per_day" class="form-control" id="total_protein_per_day"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->total_protein_per_day ?? '--' }} ">
                      
                   </div>
               </div>


                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Recommended breakfast min calorie intake</label>
                       <input readonly type="text" name="recommended_breakfast_min_calorie_intake" class="form-control" id="recommended_breakfast_min_calorie_intake"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->recommended_breakfast_min_calorie_intake ?? '--' }} ">
                     
                   </div>
               </div>


                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Recommended breakfast max calorie intake</label>
                       <input readonly type="text" name="recommended_breakfast_max_calorie_intake" class="form-control" id="recommended_breakfast_max_calorie_intake"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->recommended_breakfast_max_calorie_intake ?? '--' }} ">
                       
                   </div>
               </div>


                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Recommended lunch min calorie intake</label>
                       <input readonly type="text" name="recommended_lunch_min_calorie_intake" class="form-control" id="recommended_lunch_min_calorie_intake"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->recommended_lunch_min_calorie_intake ?? '--' }} ">
                      
                   </div>
               </div>


                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Recommended lunch max calorie intake</label>
                       <input readonly type="text" name="recommended_lunch_max_calorie_intake" class="form-control" id="recommended_lunch_max_calorie_intake"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->recommended_lunch_max_calorie_intake ?? '--' }} ">
                      
                   </div>
               </div>


                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Recommended snacks min calorie intake</label>
                       <input readonly type="text" name="recommended_snacks_min_calorie_intake" class="form-control" id="v"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->recommended_snacks_min_calorie_intake ?? '--' }} ">
                     
                   </div>
               </div>

                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Recommended snacks max calorie intake</label>
                       <input readonly type="text" name="recommended_snacks_max_calorie_intake" class="form-control" id="recommended_snacks_max_calorie_intake"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->recommended_snacks_max_calorie_intake ?? '--' }} ">
                       
                   </div>
               </div>


                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Recommended dinner min calorie intake</label>
                       <input readonly type="text" name="recommended_dinner_min_calorie_intake" class="form-control" id="recommended_dinner_min_calorie_intake"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->recommended_dinner_min_calorie_intake ?? '--' }} ">
                        
                   </div>
               </div>


                <div class="col-sm-6">
                   <div class="form-group">
                       <label for="name">Recommended dinner max calorie intake</label>
                       <input readonly type="text" name="recommended_dinner_max_calorie_intake" class="form-control" id="recommended_dinner_max_calorie_intake"
                           maxlength="100"
                           placeholder="{{ @$User->HealthStatus->recommended_dinner_max_calorie_intake ?? '--' }} ">
                        
                   </div>
               </div>

                


             

                 
               

        
 
 


           </div>
       </div>

   </form>

   <!-- End Profile -->
