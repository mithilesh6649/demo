 <div class="container">

     <!-- Nav tabs -->
     <ul class="nav nav-tabs" role="tablist">
         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center active" data-toggle="tab" href="#WeightTracker">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Weight </a>
         </li>
         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#PulseTracker">
             <img src="{{asset('assets/images/heartbeat.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Heart/Pulse Rate </a>
         </li>
         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#MedicineTracker">
             <img src="{{asset('assets/images/medicine.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Medicine </a>
         </li>
         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#Steps">
             <img src="{{asset('assets/images/steps.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Steps </a>
         </li>

         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center" data-toggle="tab" href="#Water">
             <img src="{{asset('assets/images/water.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Water </a>
         </li>
     </ul>

     <!-- Tab panes -->
     <div class="tab-content">
         <div id="WeightTracker" class="container tab-pane active"><br>
             @include('users.partials.trackers.weight_tracker')
         </div>
         <div id="PulseTracker" class="container tab-pane fade "><br>
             @include('users.partials.trackers.heart_pulse_tracker')
         </div>

         <div id="MedicineTracker" class="container tab-pane fade "><br>
             @include('users.partials.trackers.medicine_tracker')
         </div>
         <div id="Steps" class="container tab-pane fade "><br>
             @include('users.partials.trackers.steps_tracker')
         </div>

         <div id="Water" class="container tab-pane fade "><br>
             @include('users.partials.trackers.water_tracker')
         </div>
     </div>
 </div>
