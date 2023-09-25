@extends('adminlte::page')

@section('title', 'Customer Reviews')

@section('content_header')
@section('content')

<div class="container">
   <div class="alert d-none" role="alert" id="flash-message">
   </div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <h3> Customer Reviews</h3>
               @can('add_review')
               <a class="btn btn-sm btn-success" href="{{route('reviews.add')}}">Add Review</a>
               @endcan  
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <table style="width:100%" id="review-list" class="table table-bordered table-hover yajra-datatable">
                  <thead>
                     <tr>
                        <th>Customer Name</th>
                        <th>Message</th>
                        <th>Status</th>
                        @if(Gate::check('view_review') || Gate::check('edit_review') || Gate::check('delete_review')) 
                        <th>Action</th>
                        @endif
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($allReviews as $key => $review)
                     <tr>
                        <td>{{ $review->name}} </td>
                        <td >{{ substr($review->message, 0,80) }}..</td>
                        <!--  <td style="width:120px;">
                           <div class="form-group">
                            <select class="form-control changestatus" name="cars" data-id="{{ $review->id}}">
                                 <option value="1" data-hours="0"  @if($review->status==1) selected @endif >Active</option>
                           
                                 <option value="0" data-hours="0" @if($review->status==0) selected @endif>Deactive</option>   
                            </select>
                           </div>
                           </td> -->
                        <td>
                           @foreach($status as $status_data)
                           @if($status_data->value==$review->status)
                           <label class="badge {{$review->status==1?'badge-success':'badge-danger'}} p-1">{{$status_data->name}}</label>
                           @endif
                           @endforeach
                        </td>
                        @if(Gate::check('view_review') || Gate::check('edit_review') || Gate::check('delete_review')) 
                        <td>
                           @can('view_review')
                           <a class="action-button" title="View" href="view/{{$review->id}}"><i class="text-info fa fa-eye"></i></a>
                           @endcan
                           @can('delete_review')
                           <a data-id="{{ $review->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
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




$(document).on('change','.changestatus',function(){
  
     var id = $(this).attr('data-id');
     
     var status=$(this).find(':selected').val();
    
      $.ajax({
        url:"{{route('changereview.status')}}",
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
        text: "Are you sure you want to delete this Review?",
        type: "warning",
        showCancelButton: true,
        
        },function(willDelete) {

        if (willDelete) {
          $.ajax({
            type: 'post',
            url: "{{route('reviews.delete')}}",
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
                   $('#flash-message').html('Review Deleted Successfully');
                  
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