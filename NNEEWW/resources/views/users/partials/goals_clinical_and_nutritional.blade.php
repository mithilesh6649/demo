 <div class="container">

     <!-- Nav tabs -->
     <ul class="nav nav-tabs" role="tablist">

             <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center active" data-toggle="tab" href="#AnthropometricGoals">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Anthropometric measurements goals</a>
         </li>

         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center  " data-toggle="tab" href="#ClinicalGoals">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Clinical goals </a>
         </li>

          <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center  " data-toggle="tab" href="#NutritionalGoals">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Nutritional  goals </a>
         </li>

         <li class="nav-item d-none">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#ExerciseGoals">
             <img src="{{asset('assets/images/heartbeat.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Exercise goals</a>
         </li>
         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#WaterGoals">
             <img src="{{asset('assets/images/medicine.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Water goals</a>
         </li>

             
        
     </ul>

     <!-- Tab panes -->
     <div class="tab-content">
         <div id="AnthropometricGoals" class="container tab-pane  active"><br>
             @include('users.partials.goals.anthropometric_goals')
         </div>

         <div id="ClinicalGoals" class="container tab-pane fade "><br>
             @include('users.partials.goals.clinical_goals')
         </div>

           <div id="NutritionalGoals" class="container tab-pane fade  "><br>
             @include('users.partials.goals.nutritional_goals')
         </div>

         <div id="ExerciseGoals" class="container tab-pane fade "><br>
             @include('users.partials.history.dietary_history')
         </div>

         <div id="WaterGoals" class="container tab-pane fade "><br>
             @include('users.partials.goals.water')
         </div> 
     </div>
 </div>
