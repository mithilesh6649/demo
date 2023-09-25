@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="alert d-none" id="flash-message"></div>
    <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-main">
              <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                <h3 style="display:inline;">{{ __('adminlte::adminlte.roles') }}</h3>
              @can('add_role')
               <a class=" btn btn-sm btn-success float-right clear" href="add"> Add Role</a>
              @endcan
              </div>
              <div class="card-body table p-0 mb-0">
               
                <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="display-none"></th>
                      <th>{{ __('adminlte::adminlte.name') }}</th>
                      
                         @if(Gate::check('edit_role') || Gate::check('delete_role')) 
                      <th>{{ __('adminlte::adminlte.actions') }}</th>
                        @endif
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i=0; $i < count($roles); $i++) { ?>
                      <tr id="role_{{ $roles[$i]->id }}">
                        <th class="display-none"></th>
                        <td>{{ $roles[$i]->name }}</td>

                       @if(Gate::check('edit_role') || Gate::check('delete_role')) 
                         
                      
                          <td>
                           
                    
                             @can('edit_role')
                              <a title="Edit" href="{{ route('admins.role.edit', ['id' => $roles[$i]->id]) }}"><i class="text-warning fa fa-edit"></i></a>
                             @endcan 
                             
                               @can('delete_role')
                              <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $roles[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                              @endcan
                          </td>
                      
                      @endif 
                      </tr>
                    <?php } ?>
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
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#roles-list').DataTable( {
        stateSave: true,
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
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Role to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('admins.role.delete') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              if(response.success == 1) {
                 $("#role_"+id).remove();
                $("#flash-message").removeClass("d-none");
                $("#flash-message").addClass("alert-danger");
                $("#flash-message").css("display","block");
                $("#flash-message").text(" Role Deleted Successfully");
                 setTimeout(function(){ $("#flash-message").css("display","none"); }, 4000);
              }
              else {
                console.log(response);
                setTimeout(() => {
                  swal("Warning!", response.message, "warning");
                }, 500);
              }
            }
          });
        } 
      });
    });
  </script>
@stop
