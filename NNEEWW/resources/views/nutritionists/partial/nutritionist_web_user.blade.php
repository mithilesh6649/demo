 {{-- appoinments view start --}}

 <table style="width:100%" id="appoinment-list" class="table table-bordered table-hover yajra-datatable">
     <thead>
         <tr>  
             <th>User Name</th>
             <th> Date</th>
             

         </tr>
     </thead>
     <tbody>
         @forelse($Nutritionist->webUserAssociation as $key => $data)
             <!-- {{ $data }} -->
             <tr>
                 <td><a href="{{route('user_view',['id'=>@$data->user->id])}}">{{ @$data->user->name ?? '--' }}</a></td>

                  
                

              <td>{{ date('m/d/Y', strtotime( @$data->created_at)) }}</td>

             </tr>
         @empty
         @endforelse
     </tbody>
 </table>

 {{-- appoinments view end --}}
