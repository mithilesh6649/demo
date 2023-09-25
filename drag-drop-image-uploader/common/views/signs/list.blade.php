@extends('adminlte::page')

@section('title', 'Signs')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>Signs</h3>
          <a class="btn btn-sm btn-success" href="{{route('add_sign')}}">Add Sign</a>
        </div>        
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <table style="width:100%" id="sign-list" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="display-none"></th>
      
                <th>Sign</th>
                <th>Created Date</th>
             
              
                <th>{{ __('adminlte::adminlte.actions') }}</th>
              </tr>
            </thead>
            <tbody>
               <?php for ($i=0; $i < count($sign); $i++) { ?>
              <tr>
                <th class="display-none"></th>
    
                <td>{{ $sign[$i]->name }}</td>
                <td>{{ date('m/d/Y ',strtotime($sign[$i]->created_at))}}</td>
              
                  <td>
                   
                      <a class="action-button" title="View" href="view/{{$sign[$i]->id}}"><i class="text-info fa fa-eye"></i></a>
                    
                      <a class="action-button" title="Edit" href="edit/{{$sign[$i]->id}}"><i class="text-warning fa fa-edit"></i></a>
                   
                      <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $sign[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                   
                  </td>
                
              </tr>
              <?php } ?>
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
      $('#sign-list').DataTable( {
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
        swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Sign to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{route('delete_sign')}}",
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
                // window.location.reload(); 
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
  </script>
@stop
