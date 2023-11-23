@extends('adminlte::page')

@section('title', 'Mobile Pages')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0">Mobile Pages</h3>
                            </div>
                            <div class="">
                                <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th class="display-none"></th>
                                            <th>Title</th>
                                                  @can('edit_mobile')  
                                                <th>Actions</th>
                                                 @endcan

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i=0; $i < count($mobilePagesList); $i++) { ?>
                                        <tr>
                                            <td class="display-none"></td>
                                            <td>{{ $mobilePagesList[$i]->title }}</td>
                                           @can('edit_mobile')  
                                            <td>
                                                
                                                <!--   <a href="{{ route('view_mobile_page', ['id' => $mobilePagesList[$i]->id]) }}"
                                                        title="View"><i class="text-info fa fa-eye"></i></a> -->
                                                
                                                    <a href="{{ route('edit_mobile_page', ['id' => $mobilePagesList[$i]->id]) }}"
                                                        title="Edit"><i class="text-warning fa fa-edit"></i></a>
                                                
                                            </td>
                                             @endcan
                                        </tr>
                                        <?php } ?>
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
@stop
