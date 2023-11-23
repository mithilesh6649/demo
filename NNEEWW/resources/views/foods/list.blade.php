@extends('adminlte::page')

@section('title', 'Super Admin | Add Food')

@section('content_header')

@section('content')


<div class="container-fluid p-0">
    <div class="alert d-none" role="alert" id="flash-message">
    </div>
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Foods</h3>


                            @can('add_food') 
                          <!--   <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ route('food.custom.add') }}">Add  Food</a> -->
                            <a class="btn btn-sm btn-success add_food add-advance-options" >Add Food</a>
                            @endcan

                        </div>
                        <div class="">
                            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th>Name</th>



                                        @if (Gate::check('view_food') || Gate::check('edit_food') || Gate::check('delete_food'))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allFoods as $allFood)
                                    <tr>
                                        <td class="display-none"></td>
                                        <td>{{ @$allFood->brand_name ?? '--'  }}</td>


                                        @if (Gate::check('view_food') || Gate::check('edit_food') || Gate::check('delete_food'))
                                        <td>

                                            @can('view_food')
                                            <a class="action-button" title="View"
                                            href="{{ route('food.view', ['id' => $allFood->id]) }}"><i
                                            class="text-success fa fa-eye"></i></a>
                                            @endcan

                                            @can('edit_food')

                                            <a href="{{ route('food.edit', ['id' => $allFood->id]) }}"
                                                title="Edit"><i class="text-warning fa fa-edit"></i></a>
                                                @endcan



                                                @can('delete_food')
                                                <!-- <a class="action-button delete-button" title="Delete"
                                                href="javascript:void(0)" data-id="{{ $allFood->id }}"><i
                                                class="text-danger fa fa-trash-alt"></i></a> -->
                                                @endcan

                                            </td>
                                            @endcan

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



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Choose Option</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">

        <div class="row">
            <div class="col-md-4 border p-2 text-center">

             <a class="text-decoration text-dark" href="{{ route('food.custom.add') }}">Custom Add food</a>
         </div> 

         <div class="col-md-4 border p-2 text-center">

          <a class="text-decoration text-dark" href="{{ route('food.edamam.add') }}">From Edamam</a>
      </div> 

      <div class="col-md-4 border p-2 text-center">
         
        <a class="text-decoration text-dark" href="{{ route('food.import') }}">  Import  form .xlsx file</a>
     </div>   
 </div> 


</div>

</div>
</div>
</div>

<!--end modal -->

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
    $('#pages-list').DataTable({
        columnDefs: [{
            targets: 0,
            render: function(data, type, row) {
                return data.substr(0, 2);
            }
        }]
    });


        // delete
        //$('.delete-button').click(function(e) {
    $(document).on("click", ".delete-button", function() {
        var id = $(this).attr('data-id');
        var obj = $(this);

            // console.log({id});
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to  delete this Food ?",
            type: "warning",
            showCancelButton: true,
        }, function(willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('food.delete') }}",
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
                            $("#flash-message").css("display", "block");
                            $("#flash-message").removeClass("d-none");
                            $("#flash-message").addClass("alert-danger");
                            $('#flash-message').html(
                                ' Recipe Category  Deleted Successfully');
                            obj.parent().parent().remove();
                            setTimeout(() => {
                                $("#flash-message").addClass("d-none");
                            }, 5000);
                        } else {
                            console.log("FALSE");
                            setTimeout(() => {
                                swal('Error',
                                    "Something went wrong! Please try again.",
                                    'error');
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


<script type="text/javascript">
  $(document).ready(function(){
   $('.add_food').click(function(){
     $('#myModal').modal({
        'show':true,
        backdrop: 'static',
        keyboard: false
    });
 });
});
</script>

@stop
