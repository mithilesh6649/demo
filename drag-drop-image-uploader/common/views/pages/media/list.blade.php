  @extends('adminlte::page')

  @section('title', 'Super Admin | Page Contents')

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
                              <h3>Media</h3>
                          <!--     @can('add_banner')
                                  <a class="btn btn-success" href="{{ route('banners.add') }}">Add Banner</a>
                              @endcan -->
                          </div>
                          <div class="card-body table form mb-0">
                              <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th>Page Name</th>
                                           @can('edit_media')
                                              <th>Actions</th>
                                           @endcan
                                      </tr>
                                  </thead>
                                  <tbody>
                                  	
                                  	
                                      @foreach ($banner as $bannerdata)
                                          <tr>
                                              <td>{{$bannerdata->page_name}}</td>
                                                 @can('edit_media') 
                                               <td>                                   
                                                     <a class="action-button" title="Edit" href="{{route('media-page.edit',$bannerdata->page_slug)}}"><i class="text-warning fa fa-edit"></i></a>
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
  @endsection

  @section('css')
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  @stop

  @section('js')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script>
          $('#pages-list').DataTable({
              sorting: false
          });


          // delete
          $(document).on('click', '.delete-button', function(e) {
              var type = $(this).attr('data-type');
              var page = $(this).attr('data-page');
              var obj = $(this);

              // console.log({id});
              swal({
                  title: "Are you sure?",
                  text: "Are you sure you want to move this Banner to the Recycle Bin?",
                  type: "warning",
                  showCancelButton: true,
              }, function(willDelete) {
                  if (willDelete) {
                      $.ajax({
                          url: "{{ route('banners.softdelete') }}",
                          type: 'post',
                          data: {
                              'type': type,
                              'page': page

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
                                  $('#flash-message').html('Banner Deleted Successfully');
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
  @stop
