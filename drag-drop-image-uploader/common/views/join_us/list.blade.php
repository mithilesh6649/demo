@extends('adminlte::page')

@section('title', 'Join Us')

@section('content_header')
 

@section('content')
 

<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">
   </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Join Us</h3>
          </div>
          <div class="card-body">
            <table style="width:100%" id="deleted-jobseekers-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Name</th>
                  
                  <th>Contact Number</th>
                  <th>Position</th>
                  
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              
              @foreach($joinUsList as $joinUsList)
                
                       <tr>
                    <td class="display-none"></td>
                    <td>{{ $joinUsList->first_name ?? 'N/A' }} {{ ucfirst($joinUsList->last_name) ?? 'N/A' }}</td>
                    <td>{{ $joinUsList->phone_number ?? 'N/A' }}</td>
                    <td>{{ $joinUsList->positions }}</td>
                    
                    <td>
                       <select class="form-control changestatus" name="status" data-id="{{ $joinUsList->id}}"  >

                        @foreach($join_us_status as $join_us_all_status)
                         
                          <option value="{{ $join_us_all_status->value }}" {{ $join_us_all_status->value == $joinUsList->status ? 'selected':'' }} > {{ $join_us_all_status->name }}</option>         
                        @endforeach
 
            
 
                      </select>

                    </td>
                     <td>
                     
                       <a href="mailto:{{ $joinUsList->email }}" title="Reply"><i class="text-info fa fa-reply"></i></a>
                        <a href="{{ route('joinus.view', ['id' => $joinUsList->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                         <a data-id="{{ $joinUsList->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
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
      $('#deleted-jobseekers-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });


 


 $(document).on('change','.changestatus',function(){
  
     var id = $(this).attr('data-id');
     
     var status=$(this).find(':selected').val();
    
      $.ajax({
        url:"{{route('joinus.status.update')}}",
        method:"POST",
        data:{
            'status':status,
            'id':id,
            
          },
        dataType:"JSON",
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success:function(response){

         if(response.status=='true')
         {
          // swal("Status!", "Status Successfully Updated. ", "success");
         }

        }
      });
 
    });






  $(document).on('click','.delete-button',function(e){  
      var id = $(this).attr('data-id');
      var obj = $(this);

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this Record ? ",
        type: "warning",
        showCancelButton: true,
        
        },function(willDelete) {

        if (willDelete) {
          $.ajax({
            type: 'post',
            url: "{{route('joinus.delete')}}",
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

              if(response.success == 1) {

                 obj.parent().parent().remove();
                   $( "#flash-message" ).css("display","block");
                   $( "#flash-message" ).removeClass("d-none");
                   $( "#flash-message" ).addClass("alert-danger");
                   $('#flash-message').html('Record Deleted Successfully');
                  
                   setTimeout(() => {
                   $( "#flash-message" ).addClass("d-none");
                   }, 5000);
              }
              else {
               
                setTimeout(() => {
                  swal('Error','Something went wrong','error');
                }, 500);

              }
            }
            
          });
        } 
      });
    });

  </script>
@stop
