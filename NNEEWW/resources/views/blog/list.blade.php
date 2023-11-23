@extends('adminlte::page')

@section('title', 'Super Admin | Blog')

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
                                <h3 class="mb-0"> Blogs</h3>

                                @can('add_blog')
                                    <a class="btn btn-sm btn-success add-advance-options"
                                        href="{{ route('blogs.add') }}">Add Blog</a>
                                @endcan

                            </div>
                            <div class="">
                                <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="display-none"></th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Reviewer Name</th>
                                            <th>Status</th>

                                            @if (Gate::check('view_blog') || Gate::check('edit_blog') || Gate::check('delete_blog'))
                                                <th>Actions</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $blog)
                                      
                                            <tr>
                                                <td class="display-none"></td>
                                                <td> {{Str::limit($blog->title,30)}}</td>
                                                <td>{{ $blog->author_name ?? 'N/A' }}</td>
                                                <td>{{ $blog->reviewer_name ?? 'N/A' }}</td>    

                                              
                                                  <!--  @if($blog->reviewer_id == null)
                                                    <td id="not-{{ $blog->id }}">
                                                    <a  class="action-button border verify-now-button" title=" Click  for Verify"
                                                                href="javascript:void(0)" data-id="{{ $blog->id }}"><i
                                                   class="text-warning  fas fa-exclamation" style='cursor: pointer;'></i>   Pending</a> 
                                                   </td> 
                                                   @else
                                                    
                                                    <td>

                                                    <a class="action-button see-details-button" title="See Details"
                                                                href="javascript:void(0)" data-id="{{ $blog->id }}" data-blog="{{ $blog->title }}" data-author="{{ $blog->author->full_name }}" data-reviewer="{{ $blog->reviewer->full_name }}"><i
                                                   class="text-success  fa fa-check-circle" style='cursor: pointer;'></i> Verified</a>  
                                                    </td>
                                                   @endif -->

                                               




                                                @if ($blog->status == 1)
                                                    <td style="color:green;"> <span
                                                            class="active_text_success">Active</span> </td>
                                                @else
                                                    <td style="color:orange;"> <span
                                                            class="inactive_text_warning">Inactive</span> </td>
                                                @endif

                                                @if (Gate::check('view_blog') || Gate::check('edit_blog') || Gate::check('delete_blog'))
                                                    <td>

                                                        @can('view_blog')
                                                            <a class="action-button" title="View"
                                                                href="{{ route('blogs.view', ['id' => $blog->id]) }}"><i
                                                                    class="text-success fa fa-eye"></i></a>
                                                        @endcan


                                                        @can('edit_blog')
                                                            <a href="{{ route('blogs.edit', ['id' => $blog->id]) }}"
                                                                title="Edit"><i class="text-warning fa fa-edit"></i></a>
                                                        @endcan
                                                          
                                                          

                                                        @can('delete_blog')
                                                            <a class="action-button delete-button" title="Delete"
                                                                href="javascript:void(0)" data-id="{{ $blog->id }}"><i
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



<!-- Modal -->
<div id="myModal" class="modal  fade  " role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <p id="blog_heading"></p>
      </div>
      <div class="modal-body">

       <!--start container -->
       <div class="model-back container-fluid" id="quick_view_container">
       
        <div class="row">
             <div class="col-md-5 border p-3">
                 <p id="blog_author">Author : Mithilesh Kumar</p>
                 <p>Blog Post Date : 10/10/2020</p>
             </div>
              <div class="col-md-2">
                 
             </div>
              <div class="col-md-5 border p-3">
                   <p id="blog_reviewer">Author : Mithilesh Kumar</p>
                 <p>Blog Post Date : 10/10/2020</p>
             </div>
        </div>

       </div>

       <!--end container -->

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
                text: "Are you sure you want to  delete this blog ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('blogs.delete') }}",
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
                                    ' Blog  Deleted Successfully');
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
        //Active and incactive choices

        $(document).ready(function() {
            $(document).on('change', '.change_status_of_status', function() {
                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "post",
                    url: " ",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                        //toastr.success(response.message);
                        console.log(response);
                    }
                });
            })

            //        $('.change_status_of_group').change(function(){

            // });



        });
    </script>
    <script type="text/javascript">
        //Active and incactive choices

        $(document).ready(function() {
            $(document).on('change', '.change_status_of_popup', function() {
                var id = $(this).data("id");
                var status_value = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status_value: status_value,
                    },
                    success: function(response) {
                        //toastr.success(response.message);
                        console.log(response);
                    }
                });
            })

            //        $('.change_status_of_group').change(function(){

            // });



        });
    </script>

    <script type="text/javascript">
           $(document).on("click", ".verify-now-button", function() {
            var id = $(this).attr('data-id');
            var obj = $(this);
    
            // console.log({id});
            swal({
                title: "Are you sure ?",
                text: "Are you sure ? Do you want to verify this blog?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: " Yes , Verify this blog",
            }, function(confirm) {
                if (confirm) {
                    $.ajax({
                        url: "{{ route('blogs.verify') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                           $('#not-' + id).html(`  <a class="action-button "  
                                                                href="javascript:void(0)" ><i
                                                   class="text-success  fa fa-check-circle" style='cursor: pointer;'></i> Verified</a>`);
                        }
                    });
                }
            });
        });

 

         $('body').on('click', '.see-details-button', function(e) {

         $('#myModal').modal({
            'show':true,
            backdrop: 'static',
            keyboard: false
          });

        var data_id = $(this).attr('data-id');
        var data_author = $(this).attr('data-author');
        var data_reviewer = $(this).attr('data-reviewer');
        var data_blog = $(this).attr('data-blog');
 

        var obj = $(this);
         
            $('#blog_heading').html("Blog :-"+data_blog);
            $('#blog_author').html("Author :-"+data_author);
            $('#blog_reviewer').html("Reviewer :-"+data_reviewer);

      });  
    </script>


@stop
