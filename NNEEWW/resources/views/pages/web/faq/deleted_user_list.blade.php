@extends('adminlte::page')

@section('title', 'Deleted Jobseekers')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>Deleted Users</h3>
          <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>         
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <table style="width:100%" id="deleted-users-list" class="table table-bordered table-hover">
            <thead>
              <tr>
                  <th class="display-none"></th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                @can('restore_user', 'delete_user_permanent')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < count(is_countable($deletedJobseekers)?$deletedJobseekers:[]); $i++) { ?>
              <tr>
                <th class="display-none"></th>
                <td>{{ $deletedJobseekers[$i]->email }}</td>
                <td>{{ $deletedJobseekers[$i]->first_name }}</td>
                <td>{{ $deletedJobseekers[$i]->last_name ? $deletedJobseekers[$i]->last_name : '' }}</td>
                  <td>
                    @can('restore_user')<a class="action-button restore-button" title="Restore" href="javascript:void(0)" data-id="{{ $deletedJobseekers[$i]->id}}"><i class="text-success fa fa-undo"></i></a>@endcan
                    @can('delete_user_permanent')<a class="action-button remove-button" title="Permanent Delete" href="javascript:void(0)" data-id="{{ $deletedJobseekers[$i]->id}}"><i class="text-danger fa fa-trash"></i></a>@endcan
                  </td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                  <th class="display-none"></th>
                <th> Email </th>
                <th> First Name </th>
                <th> Last Name </th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <style>
    /* .action-button {
      margin-left: 5px;
    } */
  </style>
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $('#deleted-users-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
    $(document).ready(function() {

    $('.restore-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to restore the User?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          console.log("id", id);
          $.ajax({
            url: "{{ route('restore_user') }}",
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
                alert("Something went wrong! Please try again.");
                }, 500);
                // swal("Error!", "Something went wrong! Please try again.", "error");
                // swal("Something went wrong! Please try again.");
              }
            }
          });
        } 
      });
    });

    $('.remove-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to Permanently Delete this Record?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('permanent_delete_user') }}",
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
                alert("Something went wrong! Please try again.");
                }, 500);
                // swal("Error!", "Something went wrong! Please try again.", "error");
                // swal("Something went wrong! Please try again.");
              }
            }
          });
        } 
      });
    });
  });
  </script>
@stop
