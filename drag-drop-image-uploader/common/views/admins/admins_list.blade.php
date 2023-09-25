@extends('adminlte::page')

@section('title', 'Super Admin | Admins List')

@section('content_header')
 
 
@section('content')
<div class="container">
        @if (session('status'))
              <div class="alert {{ session('class') }}" role="alert">
                {{ session('status') }}
              </div>
            @endif
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card"> 
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Admins</h3>
          @can('add_admin')  
           <a class="btn btn-sm btn-success" href="add">Add Admin</a>
           @endcan
          </div>           
          <div class="card-body table p-0 mb-0">
      
            <table style="width:100%" id="admins-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <th>{{ __('adminlte::adminlte.role') }}</th>
                   <th>Status</th>
                    @if(Gate::check('view_admin') || Gate::check('edit_admin') || Gate::check('delete_admin')) 

                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($admin_list as $key=>$admin)
                  <tr>
                    <td class="display-none"></td>
                    <td>{{ $admin->first_name ?? 'N/A'}}</td>
                    <td>{{ $admin->last_name ?? 'N/A'}}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->role->name }}</td>
                  <td>
                   @foreach($status as $status_data)
                    @if($admin->status==$status_data->value) <span class="badge badge-pill {{$admin->status==1?'badge-success':'badge-danger'}} "> {{$status_data->name}} </span> @endif
                   @endforeach
                 
                </td>

                     @if(Gate::check('view_admin') || Gate::check('edit_admin') || Gate::check('delete_admin')) 
                      <td>
                     @can('view_admin')

                        <a class="action-button" title="View" href="{{ route('view_admin',$admin->id)}}"><i class="text-info fa fa-eye"></i></a>
                     @endcan

                      @can('edit_admin')
                        <a class="action-button" title="Edit" href="{{ route('edit_admin',$admin->id)}}"><i class="text-warning fa fa-edit"></i></a>
                     @endcan
                      @can('delete_admin')
                        <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$admin->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                       @endcan   
                      </td>
                      @endif
                  </tr>
                  @endforeach
               
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <th>{{ __('adminlte::adminlte.role') }}</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </tfoot>
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
    $('#admins-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
    
    $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Admin to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_admin') }}",
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
                window.location.reload();
                /* console.log("response", response);
                obj.parent().parent().remove(); */
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                swal('Error',"Something went wrong! Please try again.",'error');
                }, 500);
                // swal("Error!", "Something went wrong! Please try again.", "error");
                // swal("Something went wrong! Please try again.");
              }
            }
          });
        } 
      });
    });



    //admin enable disable
      $(document).ready(function(){  
  
    $('.admin_status').change(function(){

              var id = $(this).data("id");
              var status_value = $(this).prop('checked') == true ? 1 : 0;

              $.ajax({
                     type:"post",
                     url:"{{ route('change.admin.status') }}",
                     data:{
                      "_token": "{{ csrf_token() }}", 
                  id:id,
                  status_value:status_value,
                 },
                 success:function(response){
                  // toastr.success(response.message);
                    console.log(response);
                 }
              }); 
      });    
   });
  </script>
@stop
 