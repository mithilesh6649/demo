@extends('adminlte::page')

@section('title', 'Super Admin | Loyalties')

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
            <h3>Loyalty Levels</h3>
          <!--   <a class="btn btn-success" href="{{ route('loyalty.level.add') }}">Add Loyalty</a> -->
          </div>           
          <div class="card-body table form mb-0">
            @if(session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="categories-list" class="table table-bordered table-hover">
            <thead> 
              <tr>
                 <th>S.No</th>
                 <th>Loyalty Name </th>
                  
                 <th>Status</th>
                      @if(Gate::check('view_loyalty') || Gate::check('edit_loyalty') ) 

                <th>{{ __('adminlte::adminlte.actions') }}</th>
                 @endif
              </tr>
            </thead>
             <tbody>
             
              @foreach($loyalties as $loyalty)

                 <tr>
                
                <td>{{ $loyalty->position }}</td>  
                <td>{{ $loyalty->loyalty_name }}</td>
                  
               
                <td>
                @if($loyalty->status == 1)
                   <span class="badge badge-pill badge-success">Active</span>
                  @else
                   <span class="badge badge-pill badge-danger">Inactive</span>
                  @endif
                </td>
                      @if(Gate::check('view_loyalty') || Gate::check('edit_loyalty') ) 
                 
                <td>
                   @can('view_loyalty')
                    <a class="action-button" title="View" href="{{route('loyalty.level.view',['id' => $loyalty->id])}}"><i class="text-info fa fa-eye"></i></a>
                  @endcan
                  @can('edit_loyalty')
                    <a class="action-button" title="Edit" href="{{route('loyalty.level.edit',['id' => $loyalty->id])}}"><i class="text-warning fa fa-edit"></i></a>
                  @endcan
                  <!--   <a data-id="{{ $loyalty->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a> -->
                </td>

                @endif
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
    $('#categories-list').DataTable( {
        "order": [],
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data ;
        }
      }]
    });
    

     $(document).on('click','.delete-button',function(e){  
      var id = $(this).attr('data-id');
 
      var obj = $(this);

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Category to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            type: 'post',
            url: "{{route('categories.delete')}}",
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
                   $('#flash-message').html('Category Deleted Successfully');
                   obj.parent().parent().remove();
                   setTimeout(() => {
                   $( "#flash-message" ).addClass("d-none");
                   }, 5000);
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                  swal('Error','Something went wrong','error');
                // alert("Something went wrong! Please try again.");
                }, 500);
              }
            }
          });
        } 
      });
    });

  </script>
@stop
