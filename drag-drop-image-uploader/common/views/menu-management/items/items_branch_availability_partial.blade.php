
  <div class="availability_list">
    <div class="d-flex justify-content-between flex-wrap">
    <div class="card categories left p-2">
      <div class="all-content m-0">
        <strong>Available (in Branch)</strong>
      </div>
      <div class="branch-container m-0 w-100">
         @php $counts_one = 0 @endphp 

          @forelse ($particularOrder  as $key => $data)

            @if($data['status'] == 1)
            @php $counts_one++; @endphp   
                    

            @if($data['branch_id'] != '')
              <li>{{$data['branch_id']}}</li>
            @endif
            
            @endif
            
         @empty
            
        @endforelse

        @if($counts_one == 0)
              <li>No Branch </li>   
            @endif
      </div>
     </div>    
  
     <div class="card categories right p-2">
      <div class="all-content m-0">
        <strong>Unavailable (in Branch)</strong>
      </div>
      <div class="branch-container m-0 w-100">
         @php $counts_two = 0 @endphp 

        @forelse ($particularOrder  as $key => $data)
           @if($data['status'] == 0)
            @php $counts_two++; @endphp  
                
                
               <!--   @php
                  $updated_at =strtotime($data['updated_at']);
                  $now = \Carbon\Carbon::now();
                  $n=strtotime($now);

                  $mins=  round(abs($updated_at - $n) / 60,2)." minute";
                  $sec =   ($n-$updated_at);   
                  $min =  round(abs(3600-$sec) /60,2)." Minutes left" ;
                   

                  echo $min;
                    
                  @endphp -->


         <li>{{$data['branch_id']}}   
             
              @foreach ($menu_item_availability as $item_availability)
            @if($data['availabality'] == $item_availability->value)
            <span class="text-warning p-2">{{ $item_availability->name }}  <small class="text-danger">@php
                   echo $data['created_at'];
                @endphp</small>  </span>
            @endif
           @endforeach 

         </li>
         @endif 


         

      @empty
         
      @endforelse

       @if($counts_two == 0)
            <li>No Branch  </li>   
          @endif
      
    </div> 
  </div>
       
    </div>  
  </div> 





            
 