@extends('adminlte::page')

@section('title', 'Drivers')

@section('content_header')
 

@section('content') 

<div class="container">
   

  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Drivers</h3>
               @can('add_driver')
               <a class="btn btn-sm btn-success" href="{{ route('drivers.add') }}">Add Driver</a>
               @endcan
            </div>            
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <div class="alert d-none" role="alert" id="flash-message">        
               </div> 
               
              <table style="width:100%" id="citiesList" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="display-none"></th>
                    <th>Driver Name</th>
                    <th>Status</th>
                          
                 @if(Gate::check('view_driver') || Gate::check('edit_driver') || Gate::check('delete_driver'))  
                    <th>{{ __('adminlte::adminlte.actions') }}</th> 
                 @endif  
                  </tr>
                </thead>
                <tbody> 

                  @forelse($list as $driver)
                   <tr>
                     <th class="display-none"></th>
                     <td>{{$driver->drivers_name}}</td>
                     <td><span class="{{$driver->status==1?'text-success':'text-danger'}}">{{$driver->status==1?'Active':'Inactive'}}</span></td>
                 @if(Gate::check('view_driver') || Gate::check('edit_driver') || Gate::check('delete_driver'))  

                     <td>  
                      @can('view_driver')
                      <a class="action-button" title="View" href="{{route('drivers.view',['id'=>$driver->id])}}"><i class="text-info fa fa-eye"></i></a>
                      @endcan
                      @can('edit_driver')
                       <a class="action-button" title="Edit" href="{{route('drivers.edit',['id'=>$driver->id])}}"><i class="text-warning fa fa-edit"></i></a>
                       @endcan
                      @can('delete_driver')
                       <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$driver->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                       @endcan
                     </td>
                   @endif  
                   </tr>

                  @empty
                  @endforelse


                 
                 
               
                
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#citiesList').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });
    
 


     $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Drivers to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url:  '{{ route("drivers.deletes") }}',
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
              if(response.success == 1) {
                $( "#flash-message" ).css("display","block");
                $( "#flash-message" ).removeClass("d-none");
                $( "#flash-message" ).addClass("alert-danger");
                $('#flash-message').html('Driver deleted Successfully');
                obj.parent().parent().remove();
                setTimeout(() => {
                $( "#flash-message" ).addClass("d-none");
                }, 5000);
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                alert("Something went wrong! Please try again.");
                }, 500);
                
              }
            }
          });
        } 
      });
    });

  </script>
@stop
