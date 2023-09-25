@extends('adminlte::page')

@section('title', 'Contact Us')

@section('content_header')
 

@section('content')

 

<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Contact Us</h3>
          </div>
          <div class="card-body">
            <table style="width:100%" id="deleted-jobseekers-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Subject</th>
                  <th>Status</th>
                    @if(Gate::check('view_contact_us') || Gate::check('reply_contact_us')) 
                  <th>Actions</th>
                    @endif
                </tr>
              </thead>
              <tbody> 
              
              @foreach($contactUsMessagesList as $contactUsMessagesList )
                
                       <tr>
                    <td class="display-none"></td>
                    <td>{{ $contactUsMessagesList->name }}</td>
                    <td>{{ $contactUsMessagesList->email }}</td>
                    <td>{{ $contactUsMessagesList->contact_number }}</td>
                    <td>{{ $contactUsMessagesList->subject }}</td>
                    <td>
                       <select @can('edit_contact_us') @else disabled @endcan class="form-control changestatus" name="status" data-id="{{ $contactUsMessagesList->id}}"  >
                      @foreach ($contact_us_status as $contact_status)

                     <option value="{{ $contact_status->value }}" {{ $contact_status->value == $contactUsMessagesList->status ? 'selected':'' }} > {{ $contact_status->name }}</option>


                        @endforeach
 
                      </select>

                    </td>
                       @if(Gate::check('view_contact_us') || Gate::check('reply_contact_us') ) 
                     <td>
                      <a href="{{ route('view_contact_us_message', ['id' => $contactUsMessagesList->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                       <a href="mailto:{{ $contactUsMessagesList->email }}" title="Reply"><i class="text-info fa fa-reply"></i></a>
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
        url:"{{route('contact.status.update')}}",
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

  </script>
@stop
