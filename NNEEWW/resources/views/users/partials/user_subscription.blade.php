 <div class="container">

     <!-- Nav tabs -->
     <ul class="nav nav-tabs" role="tablist">

             <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center active" data-toggle="tab" href="#DietPlanSubscription">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Diet Plan</a>
         </li>

         <li class="nav-item d-none">
             <a class="nav-link nav_nutritionist d-flex align-items-center  " data-toggle="tab" href="#TestSubsctiption">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Test</a>
         </li>
       
        
     </ul>

     <!-- Tab panes -->
     <div class="tab-content">
         <div id="DietPlanSubscription" class="container tab-pane active"><br>
             @include('users.partials.subscription.diet_plans_subscription')
         </div>

         <div id="TestSubsctiption" class="container tab-pane fade  "><br>
             @include('users.partials.subscription.test_subscription')
         </div>
        
         
     </div>
 </div>
