@extends('adminlte::page')

@section('title', 'Super Admin | Menu Categories')

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
              <h3>Categories</h3>
             <a class="btn btn-sm btn-success" href="{{route('categories.add')}}">Add Category</a>
            </div>           
            <div class="card-body table p-0">
              @if(session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
             
              <table style="width:100%" id="categories-list" class="table table-bordered table-hover">
              <thead> 
                <tr>
                  
                  <th>Order By Position </th>
                   <th>Name{{ labelEnglish() }}</th>
                   <th>Name{{ labelArabic() }}</th>
                   <!-- <th>Thumbnail</th> -->
                   <th>Status</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </thead>
               <tbody id="tablecontents" >
               
                @foreach($categories as $category)

                <tr class="row1" data-id="{{$category->id}}">
                    
                    <td>{{ $category->category_position }}</td>
                    <td>{{ $category->name_en }}</td>
                    <td>{{ $category->name_ar }}</td>
                    <!-- <th><img src="{{asset('background_images/back1.jpg')}}" style="height:60px;width:100px;"></th> -->
                    <td>
                    @if($category->status == 1)
                       <span class="badge badge-pill badge-success">Active</span>
                      @else
                       <span class="badge badge-pill badge-danger">Inactive</span>
                      @endif
                    </td>
                    
                    <td>
                        <a class="action-button" title="View" href="{{route('categories.view',['id' => $category->id])}}"><i class="text-info fa fa-eye"></i></a>
                      
                        <a class="action-button" title="Edit" href="{{route('categories.edit',['id' => $category->id])}}"><i class="text-warning fa fa-edit"></i></a>
                     
                        <a data-id="{{ $category->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
                    </td>
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<style type="text/css">
  .ui-sortable-helper {
        display: table;
    }
</style>

@stop

@section('js')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>

  $(function(){
      
       var table=$('#categories-list').DataTable();
     
      $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
        
          update: function(evt, ui) {
                var order = [];
                var pageno=table.page();
                var pagecount=table.page.len();

                 $('tr.row1').each(function(index,element) {
                      order.push({
                          id: $(this).attr('data-id'),
                          position:(index+1)+(pageno*pagecount)
                      });
                    });

                var token = $('meta[name="csrf-token"]').attr('content');
         
                  $.ajax({
                    type: "post", 
                    dataType: "json", 
                    url: "{{ route('change.ordered') }}",
                    data: {
                      'position':order,
                      _token: token
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            $('#tablecontents').html('');
                            $('#categories-list').DataTable().clear().destroy();
                            $('#tablecontents').html(response.table);
                            table=$('#categories-list').DataTable();
                        }else {
                          console.log(response);
                        }
                      }
                   
                   });
                }
             });
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
