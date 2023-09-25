@extends('adminlte::page')

@section('title', ' Super Admin | Deleted Blocks')

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
        <h3> Deleted Blocks</h3>
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
         
          <th>Blocks</th>
          @if(Gate::check('restore_question') || Gate::check('permanent_deleted_question')    ) 

          <th>Action</th>
          @endif

        </tr>
      </thead> 
      <tbody>
       @forelse($deletedBlocks as $key => $data)
       <tr>
        <td>{{ substr($data->block, 0,80) }}</td>
    

        
        @if(Gate::check('restore_question') || Gate::check('permanent_deleted_question')    ) 

        <td>

          @can('restore_question')
          <a class="action-button restore-button" title="Restore" href="javascript:void(0)"  data-id="{{ $data->id}}"><i class="text-success fa fa-undo"></i></a>
          @endcan

          @can('permanent_deleted_question')
          <a class="action-button delete-button" title=" Permanent Delete" href="javascript:void(0)" data-id="{{ $data->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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




 $('body').on('click','.restore-button',function(e){

  var id = $(this).attr('data-id');
  var obj = $(this);

  swal({
    title: "Are you sure?",
    text: "Are you sure you want to restore this  Block ?",
    type: "warning",
    showCancelButton: true,
  }, function(willDelete) {
    if (willDelete) {
      $.ajax({
        url: "{{ route('restore_blocks') }}",
        type: 'post',
        data: {
          id: id
        },
        success: function(response) {

          if(response.trim() == 'success') {

           $( "#flash-message" ).css("display","block");
           $( "#flash-message" ).removeClass("d-none");
           $( "#flash-message" ).addClass("alert-success");
           $('#flash-message').html(' Blocks Restore Successfully');
           obj.parent().parent().remove();
           setTimeout(() => {
             $( "#flash-message" ).addClass("d-none");
           }, 5000);

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


 
//Permanent Delete

 $('body').on('click','.delete-button',function(e){

  var id = $(this).attr('data-id');
  var obj = $(this);

  swal({
    title: "Are you sure ?",
    text: "Are you sure you want to Permanently Delete this Record  ?",
    type: "warning",
    showCancelButton: true,
  }, function(willDelete) {
    if (willDelete) {
      $.ajax({
        url: "{{ route('permanent_delete_blocks') }}",
        type: 'post',
        data: {
          id: id
        }, 
        success: function(response) {

          if(response.trim() == 'success') {

           $( "#flash-message" ).css("display","block");
           $( "#flash-message" ).removeClass("d-none");
           $( "#flash-message" ).addClass("alert-danger");
           $('#flash-message').html(' Block Deleted Successfully');
           obj.parent().parent().remove();
           setTimeout(() => {
             $( "#flash-message" ).addClass("d-none");
           }, 5000);

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