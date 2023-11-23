@extends('adminlte::page')

@section('title', 'Deleted Mobile Pages')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3>Deleted Mobile Pages</h3>
          </div>
          <div class="card-body">
            <table id="pages-list" class="table table-bordered table-hover datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Section</th>
                  @can('manage_mobile_pages_actions')<th>Actions</th>@endcan
                 
                  <!-- duplicate -->
                 <th>Actions</th>
                  <!-- duplicate -->

                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($deletedMobilePages); $i++) { ?>
                  <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $deletedMobilePages[$i]->title }}</td>
                    <td>{{ $deletedMobilePages[$i]->section }}</td>
                    @can('manage_mobile_pages_actions')
                      <td>
                        <a class="action-button delete-button" title="Restore" href="javascript:void(0)" data-id="{{ $deletedMobilePages[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                      </td>
                    @endcan

                    <!-- duplicate  -->
                    <td>
                      <a class="action-button delete-button" title="Restore" href="javascript:void(0)" data-id="{{ $deletedMobilePages[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                    </td>
                    <!-- duplicate  -->

                  </tr>
                <?php } ?>
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
@stop
