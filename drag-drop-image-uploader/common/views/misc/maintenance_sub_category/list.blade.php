@extends('adminlte::page')

@section('title', 'Super Admin |Maintenance Sub Category')

@section('content_header')


@section('content')

<div class="container">
   <div class="alert d-none" role="alert" id="flash-message">
    </div>

  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Maintenance Sub Category</h3>
               @can('add_maintenance_sub_category')  
               <a class="btn btn-sm btn-success" href="{{ route('add_maintenance_sub_category') }}">Add Maintenance Sub Category</a>
                 @endcan  
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <table style="width:100%" id="sub_cat_list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="display-none"></th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Status</th>
                     @if(Gate::check('view_maintenance_sub_category') || Gate::check('edit_maintenance_sub_category') || Gate::check('delete_maintenance_sub_category'))  
                     <th>{{ __('adminlte::adminlte.actions') }}</th>
                     @endcan  
                  </tr>
                </thead>
                <tbody>


                  @foreach ($MaintenanceSubCategoryList as $list)

                     <tr>
                    <th class="display-none"></th>
                    <td>{{ optional($list->category)->cat_name }}</td>
                     <td>{{ $list->sub_cat_name  }}</td>
                       <td>
                  @if($list->status == 1)
                     <span class="badge badge-pill badge-success">Active</span>
                    @else
                     <span class="badge badge-pill badge-danger">Inactive</span>
                    @endif
                  </td>
                      @if(Gate::check('view_maintenance_sub_category') || Gate::check('edit_maintenance_sub_category') || Gate::check('delete_maintenance_sub_category'))  

                      <td>
                          @can('view_maintenance_sub_category') 
                          <a class="action-button" title="View" href="{{route('view_maintenance_sub_category',['id'=>$list->id])}}"><i class="text-info fa fa-eye"></i></a>
                          @endcan  
                         @can('edit_maintenance_sub_category')  

                          <a class="action-button" title="Edit" href="{{route('edit_maintenance_sub_category',['id'=>$list->id])}}"><i class="text-warning fa fa-edit"></i></a>
                          @endcan  

                           @can('delete_maintenance_sub_category')  

                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$list->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                         @endcan  

                      </td>
                        @endcan 

                  </tr>

             @endforeach



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
      $('#sub_cat_list').DataTable( {
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
        text: "Are you sure you want to move this Maintenance Sub Category to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url:  '{{ route("delete_maintenance_sub_category") }}',
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
                $('#flash-message').html('Maintenance Sub Category Deleted Successfully');
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
