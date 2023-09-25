@extends('adminlte::page')

@section('title', 'Super Admin | Page Contents')

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
            <h3>Management</h3>
          </div>
          <div class="card-body table form mb-0">
            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Name(en)</th>
                  <th>Name(ar)</th>

                  <th>Organization(en)</th>
                  <th>Organization(ar)</th>

                  <th>Designation(en)</th>
                  <th>Designation(ar)</th>
                  <th>Status</th>
                  @if(Gate::check('edit_management') || Gate::check('view_management')) 
                  <th>Actions</th>
                    @endif 
                
                </tr>
              </thead> 
              <tbody>
                @foreach ($managementList as $data)
                   <tr>
                    <td class="display-none"></td>
                    <td>{{$data->name_en ?? ''}}</td>
                    <td>{{$data->name_ar ?? ''}}</td>
                     <td>{{$data->organization_en ?? ''}}</td>
                       <td>{{$data->organization_ar ?? ''}}</td>
                     <td>{{@$data['managementrole']['name_en'] ?? ''}}</td>
                     <td>{{@$data['managementrole']['name_ar'] ?? ''}}</td>
                     <td><span class="{{$data->status==1?'text-success':'text-danger'}}">{{$data->status==1?'Active':'inactive'}}</span></td>
                    @if(Gate::check('edit_management') || Gate::check('view_management')) 
                     <td> 
                        @can('view_management')
                        <a class="action-button" title="View" href="{{route('management.view',$data->id)}}"><i class="text-info fa fa-eye"></i></a>
                         @endcan
                        @can('edit_management')
                          <a href="{{route('management.edit',$data->id)}}" title="Edit"><i class="text-warning fa fa-edit"></i></a>
                        @endcan   
                        
                        <!--   <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$data->id}}"><i class="text-danger fa fa-trash-alt"></i></a> -->
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
    $('#pages-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });


    // delete
    $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
     
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Page Content to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{route('pages.delete')}}",
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
                   $('#flash-message').html('Content Deleted Successfully');
                   obj.parent().parent().remove();
                   setTimeout(() => {
                   $( "#flash-message" ).addClass("d-none");
                   }, 5000);
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
    // delete

  </script>
@stop
