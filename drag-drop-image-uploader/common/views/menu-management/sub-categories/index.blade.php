@extends('adminlte::page')

@section('title', 'Super Admin | Menu Sub Categories')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Sub Categories</h3>
           <a class="btn btn-sm btn-success" href="{{route('sub-categories.add')}}">Add New Sub Categories</a>
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="categories-list" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="display-none"></th>
               
                <th>Name</th>
                <th>Category</th>
               <!--  <th>Thumbnail</th> -->
                <th>Enable/Disable</th>
                <th>{{ __('adminlte::adminlte.actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="display-none"></th>
                <td>Menu Sub Category</td>
                <td>Menu Category</td>
                <!-- <th><img src="{{asset('background_images/back1.jpg')}}" style="height:60px;width:100px;"></th> -->
                <td>
                  <div class="form-group radio">
                    <div class="job_alerts" style="margin:0 auto;">
                    
                      <label class="switch">
                          <input name="status" type="checkbox" checked>
                          <span class="slider round"></span>
                      </label>
                                    
                    </div>
                  </div>
                </td>
                
                <td>
                    <a class="action-button" title="View" href="{{route('sub-categories.view')}}"><i class="text-info fa fa-eye"></i></a>
                  
                    <a class="action-button" title="Edit" href="{{route('sub-categories.edit')}}"><i class="text-warning fa fa-edit"></i></a>
                 
                    <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                </td>
              </tr>

            </tbody>
          </table>
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
    $('#categories-list').DataTable( {
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
        text: "Are you sure you want to move this Sub Category to the Recycle Bin?",
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
  </script>
@stop
