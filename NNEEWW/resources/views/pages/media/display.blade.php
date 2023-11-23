  @extends('adminlte::page')

  @section('title', 'Super Admin | Page Contents')

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
                                    <h3 class="mb-0">{{ $page_title }} Media</h3>
                                    <a class="btn btn-sm btn-success add-advance-options"href="{{ route('media_list') }}">{{ __('adminlte::adminlte.back') }}</a>
                                </div>
                                <div class="">
                                    <table id="pages-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Section</th>
                                                <th>Image</th>
                                                <th> Image Size(Width x Height) in pixel</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sections as $section)
                                                <tr>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $section->section)) }} <span
                                                            class="badge badge-pill badge-primary d-none">{{ $section->image_slug }}</span>
                                                    </td>
                                                    <td>
                                                        <!-- <img class="view_full{{ $section->id }}"
                                                                src="{{ asset('images/media/' . $section->image) }}">
                                                                -->
                                                        <img class="view_full_img view_full{{ $section->id }}" src="{{ $section->image }}"
                                                            width="100">

                                                    </td>
                                                    <td> {{ $section->image_width ?? ' ' }}x{{ $section->image_height ?? ' ' }}
                                                    </td>

                                                    <td>
                                                        <a class="action-button big1" title="View" id="{{ $section->id }}"
                                                            href="#"><i class="text-success fa fa-eye"></i></a>
                                                        <a class="action-button" title="Edit"
                                                            href="{{ route('sections-media.editpage', $section->id) }}"><i
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

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Media</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div>
                          <img src="" id="put_me" width="100%" height="100%">
                      </div>
                  </div>
                  <div class="modal-footer">

                  </div>
              </div>
          </div>
      </div>

  @endsection

  @section('css')
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
      <style type="text/css">
          .modal-body {
              margin: 0px auto;
          }

          .table-bordered tr td img {
              width: 100px !important;
          }
      </style>
  @stop

  @section('js')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script>
          $('#pages-list').DataTable({
              sorting: false
          });

           $(document).on("click",".big1",function() {
          // $(".big1").click(function() {
              id = $(this).attr('id');
              src = $("." + 'view_full' + id).attr('src');
              $("#put_me").attr("src", src);
              $("#exampleModal").modal('show');
          });
      </script>
  @stop
