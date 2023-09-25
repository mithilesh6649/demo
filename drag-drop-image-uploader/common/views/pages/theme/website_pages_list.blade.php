@extends('adminlte::page')

@section('title', 'Super Admin | Themes')

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
            <h3>Themes</h3>
          </div>
          <div class="card-body table form mb-0">
            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Name</th>
                  <th>Status</th>
                  @if(Gate::check('view_theme')  ) 
                  <th>Actions</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($allThemes as $data)
                <tr>
                  <td class="display-none"></td>
                  <td>{{$data->name ?? ''}}</td>
                  <td> 
                   
                   <label class="switch">
                    <input  @can('edit_theme') @else disabled @endcan type="checkbox" class="change_status_of_theme"
                    data-id="{{ $data->id }}"
                    {{ $data->status == '1' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                  </label>

                </td>
                

                @if(Gate::check('view_theme')  ) 
                <td> 
                  


                  @can('view_theme')
                  <a class="action-button" title="View" href="{{route('theme.view',['id' => $data->id])}}"><i class="text-info fa fa-eye"></i></a>
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
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
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









  
    //Active and incactive choices

  $(document).ready(function() {
        // $(document).on('change', '.change_status_of_theme', function() {
        //     var id = $(this).data("id");
        //     var status_value = $(this).prop('checked') == true ? 1 : 0;
    
        //   alert(status_value);

        //     // $.ajax({
        //     //     type: "post",
        //     //     url: "{{ route('change.choice.group.status') }}",
        //     //     data: {
        //     //         "_token": "{{ csrf_token() }}",
        //     //         id: id,
        //     //         status_value: status_value,
        //     //     },
        //     //     success: function(response) {
        //     //         //toastr.success(response.message);
        //     //         console.log(response);
        //     //     }
        //     // });
        // })
    
    $('.change_status_of_theme').each(function(){
     $(this).click(function(){
       var current_element = this;
       var id = $(this).data("id");
       var status_value = $(this).prop('checked') == true ? 1 : 0;
       
       $('.change_status_of_theme').each(function(){
        $(this).prop('checked',false); 
      });

       $(current_element).prop('checked',true);
       

       $.ajax({
        type: "post",
        url: "{{ route('change.theme.status') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          id: id,
          
        },
        success: function(response) {
                      //toastr.success(response.message);
          console.log(response);
        }
      });



     });
   });
    


  });
  

</script>
@stop
