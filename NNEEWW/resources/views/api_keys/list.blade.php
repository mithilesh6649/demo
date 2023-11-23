  @extends('adminlte::page')

  @section('title', 'Super Admin | Confidential Api Key ')

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
                                    <h3 class="mb-0">Confidential Api Key </h3>
                                </div>
                                <div class="">
                                    <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Provider Name</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($allAPIKeys as $allAPIKey)
                                                <tr>
                                                    <td>{{ $allAPIKey->name }}</td>

                                                    <td>
                                                        <a class="action-button" title="Edit"
                                                            href="{{ route('edit_apiKey', $allAPIKey->slug) }}"><i
                                                                class="text-warning fa fa-edit"></i></a>
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
                          url: "",
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
