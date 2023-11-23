
@extends('adminlte::page')

@section('title', 'Website Contents')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Website Contents</h3> 
            <!-- <a class="btn btn-sm btn-success" href="{{ route('power_equipment-categories.add') }}">Add New</a> -->
          </div>            
          <div class="card-body">
            
            <table style="width:100%" id="exampleTable" class="table table-bordered table-hover">
              <thead>
               <tr>
                  <th style="display:none">Title</th>
                  <th>Title(English)</th>
                  <th>Title(French)</th>
                  <th>Title(Haitian Creole)</th>
                  <th>Title(Spanish)</th>
                  @can('view_website_page', 'edit_website_page', 'delete_website_page')<th>Action</th>@endcan
               </tr>
           </thead>
            <tfoot>
              <tr>
                <th style="display:none">Title</th>
                <th>Title(English)</th>
                <th>Title(French)</th>
                <th>Title(Haitian Creole)</th>
                <th>Title(Spanish)</th>
                <th>Action</th> 
              </tr>
            </tfoot>
                <tbody>
                @foreach($contents as $content)
                <tr>
                  <td style="display:none">{{$content->title}}</td>
                  <td>{{$content->title}}</td>                 
                  <td>{{$content->title_fr}}</td>                 
                  <td>{{$content->title_ht}}</td>                 
                  <td>{{$content->title_es}}</td>                 
                  <td>
                   
                    @can('view_website_page')
                      <a href="{{route('website-contents.view',['id'=>$content->id,'type'=>$content->type])}}"><i class="text-info fa fa-eye" style="color:teal"></i></a>@endcan
                    @can('edit_website_page')
                      <a href="{{route('website-contents.edit',['id'=>$content->id,'type'=>$content->type])}}"><i class="text-warning fa fa-edit" style="color:teal"></i></a>
                    @endcan
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
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#makeList').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });

      $(document).on("click", '.delete-button', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var image = $(this).attr('data-image');
        var obj = $(this);
        swal({
          title: "Are you sure?",
          text: "Are you sure you want to delete this?",
          type: "warning",
          showCancelButton: true,
        }, function(willDelete) {
          if (willDelete) {
            $.ajax({
              url: "{{ route('power_equipment-categories.delete') }}",
              type: 'post',
              data: {
                id: id,
                image:image
              },
              dataType: "JSON",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                console.log("Response", response);
                if(response.status == true) {
                  
                  obj.parent().parent().remove(); 
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
    });
  </script>
@stop
