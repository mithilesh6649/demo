@extends('adminlte::page')

@section('title', 'Consultation Session')

@section('content_header')
 

@section('content')

   <div id="flash-message" class="alert alert-success alert d-none" role="alert">
        <a href="javascript:void(0)" id="close_button" class="float-right text-white close" data-dismiss="alert"
            aria-label="Close">X</a>
    </div>

<div class="container-fluid p-0">
  <div class="col-lg-12">
    <div class="card order_outer rounded_circle">
      <div class="card-body rounded_circle table p-0 mb-0">
        <div class="order_details">
          <div class="card-main pt-3">
            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
              <h3 class="mb-0">Consultation Session</h3>
            </div>
            <div class="">
              <table style="width:100%" id="deleted-jobseekers-list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="display-none"></th>
                    <th>Consultation Type</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                            
                      @if(Gate::check('view_consultation_session') || Gate::check('delete_consultation_session')) 
                    <th>Actions</th>
                      @endif
                  </tr>
                </thead>
                <tbody> 
                
                @foreach($ConsultantSession as $contactUsMessagesList )
                  
                        <tr>
                      <td class="display-none"></td>
                      <td>{{@$contactUsMessagesList->consultant->type ?? '--'}}</td>
                      <td>{{ $contactUsMessagesList->first_name ?? '' }}</td>
                       <td> {{ $contactUsMessagesList->last_name ?? '' }}</td>
                      <td>{{ $contactUsMessagesList->email ?? '--' }}</td>
                     
                      
                       <td>
                            @if (!empty($contactUsMessagesList->contact))
                                (+{{ $contactUsMessagesList->country_code }}){{ $contactUsMessagesList->contact }}
                            @else
                                --
                            @endif
                        </td>  
                      
                        @if(Gate::check('view_consultation_session') || Gate::check('delete_consultation_session') ) 
                      <td>
                         <!-- <a href="mailto:{{ $contactUsMessagesList->email }}" title="Reply"><i class="text-info fa fa-reply"></i></a> -->

                         @can('view_consultation_session')
                        <a href="{{ route('consultation.session.view', ['id' => $contactUsMessagesList->id]) }}" title="View"><i class="text-success fa fa-eye"></i></a>
                        @endcan
                           
                           @can('delete_consultation_session')
                          <a class="action-button delete-button" title="Delete"
                                                            href="javascript:void(0)" data-id="{{ $contactUsMessagesList->id }}"><i
                                                                class="text-danger fa fa-trash-alt"></i></a>
                            @endcan                                    
                       
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
        "order": [],
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




 





    <!-- my delete is my delete non of ur delete -->
    <script type="text/javascript">
        $('.delete-button').click(function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);

            swal({
                title: "Are you sure?",
                text: "Are you sure you want to  delete this Consultation Session ?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('consultation.session.delete') }}",
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
                            if (response.success == 1) {
                                obj.parent().parent().remove();

                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html(
                                    'Consultation Session has been Deleted Successfully');

                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);

                            } else {
                                console.log("FALSE");
                                swal("Error!", "Something went wrong! Please try again.",
                                    "error");
                            }
                        }
                    });
                } else {
                    //swal("Cancelled", "User is Safe", "error");
                }
            });
        });
    </script>
    <!-- my delete is my delete non of ur delete -->
@stop
