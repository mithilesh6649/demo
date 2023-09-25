@extends('adminlte::page')

@section('title', 'Super Admin | Inquiries')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Inquiries</h3>
           <!-- <a class="btn btn-sm btn-success" href="add">Add New Admin</a> -->
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="admins-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
                  <tr>
                    <td class="display-none"></td>
                    <td>Demo User</td>
                    <td>demo-user@mission22.com</td>
                    <td>+56498767</td>
                    <td>Catering Service</td>
                    <td>
                      @php
                        $status = 'pending';
                        $background = 'orange';
                      @endphp
                      <select class="form-control" name="status" id="status" style="background-color:{{$background}};color:white">
                        <option selected value="0">Pending</option>
                        <option value="1">Resolved</option>
                        <option value="2">In progress</option>
                        <option value="3">Spam</option>
                      </select>
                    </td>
                   
                      <td>
                        <a class="action-button" title="View" href="{{route('inquiries.view')}}"><i class="text-info fa fa-eye"></i></a>
                     
                        <!-- <a class="action-button" title="Edit" href="edit"><i class="text-warning fa fa-edit"></i></a> -->
                    
                        <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                          
                      </td>
                  </tr>
               
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <th>{{ __('adminlte::adminlte.role') }}</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
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
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $('#admins-list').DataTable( {
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
        text: "Are you sure you want to move this ticket to the Recycle Bin?",
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


  <script type="text/javascript">
    $(document).on('change','#status',function(){
      var background = 'orange';
      if($(this).val()==0){
        background = 'orange';
      }else if($(this).val()==1){
        background = '#23d323';
      }else if($(this).val()==2){
        background = 'grey';
      }else if($(this).val()==3){
        background = '#f95c5c';
      }

      $(this).css('background-color',background);
    })
  </script>

@stop
