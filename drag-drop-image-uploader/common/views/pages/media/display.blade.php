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
                              <h3>{{$page_title}} Media</h3>
                          <!--     @can('add_banner')
                                  <a class="btn btn-success" href="{{ route('banners.add') }}">Add Banner</a>
                              @endcan -->
                          </div>
                          <div class="card-body table form mb-0">
                              <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                  <thead>
                                      <tr>
                                         <th>Section</th>
                                         <th>Image</th>
                                         <th>Width x Height</th>
                                         <th>Action</th>
                                      </tr>
                                  </thead> 
                                  <tbody>
                                        @foreach($section as $sec)

                                          <tr>
                                              <td>{{ucfirst(str_replace("_"," ",$sec->sections))}}</td>
                                              <td><img  class="view_full{{$sec->id}}" src="{{ asset('media/'.$sec->image) }}"></td>
                                              <td><span style="font-weight:bold;">{{$sec->image_width}}</span> x <span style="font-weight:bold;">{{$sec->image_height}}</span></td>

                                              <td>
                                                <a class="action-button big1" title="View" id="{{$sec->id}}" href="#"><i class="text-info fa fa-eye"></i></a>
                                                <a class="action-button" title="Edit" href="{{route('sections-media.editpage',$sec->id)}}"><i class="text-warning fa fa-edit"></i></a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Media</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="height:300px;width:376px">
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
    .modal-body{
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

        $(".big1").click(function(){
          id = $(this).attr('id');
          src = $("."+'view_full'+id).attr('src');
          $("#put_me").attr("src",src);
          $("#exampleModal").modal('show');
        });

   
      </script>
  @stop
