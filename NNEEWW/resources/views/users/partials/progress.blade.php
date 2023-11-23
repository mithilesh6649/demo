 <div class="container">

     <!-- Nav tabs -->
     <ul class="nav nav-tabs" role="tablist">

             <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center active" data-toggle="tab" href="#ProgressRecords">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Records</a>
         </li>

         <li class="nav-item">
             <a class="nav-link nav_nutritionist d-flex align-items-center  " data-toggle="tab" href="#ProgressGraph">
             <img src="{{asset('assets/images/weight.svg')}}" style="width: 15px; height: 15px;" class="mr-1" alt="">Graph</a>
         </li>
       
        
     </ul>

     <!-- Tab panes -->
     <div class="tab-content">
         <div id="ProgressRecords" class="container tab-pane active"><br>
             @include('users.partials.progress.records')
         </div>

         <div id="ProgressGraph" class="container tab-pane fade  "><br>
             @include('users.partials.progress.graph')
         </div>
        
         
     </div>
 </div>
