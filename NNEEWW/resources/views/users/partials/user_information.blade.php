 <div class="container">

     <!-- Nav tabs -->
     <ul class="nav nav-tabs" role="tablist">

             <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center active" data-toggle="tab" href="#AppointmentInformation">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Appointment information</a>
         </li>

         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center  " data-toggle="tab" href="#Weight">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Personal and social history </a>
         </li>
         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#Pulse">
             <img src="{{asset('assets/images/heartbeat.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Dietary history</a>
         </li>
         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#Medicine">
             <img src="{{asset('assets/images/medicine.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Medical history </a>
         </li>

              <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#recall">
             <img src="{{asset('assets/images/medicine.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">24hrs recall </a>
         </li>
        
     </ul>

     <!-- Tab panes -->
     <div class="tab-content">
         <div id="AppointmentInformation" class="container tab-pane  active"><br>
             @include('users.partials.history.appointment_information')
         </div>

         <div id="Weight" class="container tab-pane fade  "><br>
             @include('users.partials.history.personal_and_social_history')
         </div>
         <div id="Pulse" class="container tab-pane fade "><br>
             @include('users.partials.history.dietary_history')
         </div>

         <div id="Medicine" class="container tab-pane fade "><br>
             @include('users.partials.history.medical_history')
         </div>

         <div id="recall" class="container tab-pane fade "><br>
             @include('users.partials.history.recall')
         </div>
         
     </div>
 </div>
