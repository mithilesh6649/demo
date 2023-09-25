@extends('adminlte::page')

@section('title', 'Security questions')

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
                 <h3> Security Questions</h3>
                  @can('add_question')
                 <a class="btn btn-sm btn-success" href="{{route('add.security.question')}}">Add Questions</a>
                  @endcan
              </div>
              <div class="card-body table p-0 mb-0">
                 @if (session('status'))
                 <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                 </div>
                 @endif
                 <table style="width:100%" id="review-list" class="table table-bordered table-hover yajra-datatable">
                    <thead>
                       <tr>
                          <th>Title {{ labelEnglish() }}</th>
                          <th>Title {{ labelArabic() }}</th>
                          <th>Status</th>
                        @if(Gate::check('view_question') || Gate::check('edit_question') || Gate::check('delete_question')  )

                          <th>Action</th>
                          @endif

                       </tr>
                    </thead>
                    <tbody>
                       @forelse($allQuestions as $key => $data)
                       <tr>
                          <td>{{ substr($data->title_en, 0,80) }}</td>
                          <td >{{ substr($data->title_ar, 0,80) }}</td>

                          <td>
                             @foreach($status as $status_data)
                             @if($status_data->value==$data->status)
                             <label class="badge {{$data->status==1?'badge-success':'badge-danger'}} p-1">{{$status_data->name}}</label>
                             @endif
                             @endforeach
                          </td>
                        @if(Gate::check('view_question') || Gate::check('edit_question') || Gate::check('delete_question')  )

                          <td>
                              @can('view_question')
                             <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a>
                               @endcan
                              @can('edit_question')

                                <a class="action-button" title="Edit" href="edit/{{$data->id}}"><i class="text-warning fa fa-edit"></i></a>
                                @endcan
                              @can('delete_question')

                             <a data-id="{{ $data->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
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
      $('#review-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data ;
          }
        }]
      });
    });








     $(document).on('click','.delete-button',function(e){
      var id = $(this).attr('data-id');
      var obj = $(this);

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this Security Question ?",
        type: "warning",
        showCancelButton: true,

        },function(willDelete) {

        if (willDelete) {
          $.ajax({
            type: 'post',
            url: "{{route('delete.security.question')}}",
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
                   $('#flash-message').html('Security Question Deleted Successfully');

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
