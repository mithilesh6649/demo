@extends('adminlte::page')

@section('title', 'Super Admin | Blogs')

@section('content_header')
 

@section('content')
 
<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">        
    </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Blogs</h3>
             @can('add_blog')
           <a class="btn btn-sm btn-success" href="{{route('blogs.add')}}">Add Blog</a>
             @endcan
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
               
                <th>Title {{ labelEnglish() }}</th>
                <th>Title {{ labelArabic() }}</th>
                 @if(Gate::check('view_blog') || Gate::check('edit_blog') || Gate::check('delete_blog')) 
                <th>{{ __('adminlte::adminlte.actions') }}</th>
                 @endif
              </tr>
            </thead>
            <tbody>

              @forelse ($blogs as $blog)
                  <tr>
                <th class="display-none"></th>
                <td>{{$blog->title_en}}</td>
                <td>{{$blog->title_ar}}</td>
               
                  @if(Gate::check('view_blog') || Gate::check('edit_blog') || Gate::check('delete_blog')) 

                <td>
                     @can('view_blog') 
                    <a class="action-button" title="View" href="{{route('blogs.view',['id' => $blog->id])}}"><i class="text-info fa fa-eye"></i></a>
                     @endcan
                     @can('edit_blog')
                    <a class="action-button" title="Edit" href="{{route('blogs.edit',['id'=>$blog->id])}}"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                        @can('delete_blog')
                    <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$blog->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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
    
       $(document).on('click','.delete-button',function(e){  
      var id = $(this).attr('data-id');
 
      var obj = $(this);

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Blog to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            type: 'post',
            url: "{{route('blogs.delete')}}",
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
                   $('#flash-message').html('Blog Deleted Successfully');
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
