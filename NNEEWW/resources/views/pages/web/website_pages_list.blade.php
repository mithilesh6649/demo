@extends('adminlte::page')

@section('title', 'Website Pages')

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
                              <!--   @can('edit_website')
                                <h3 class="mb-0">Website Pages</h3>
                                   <a class="btn btn-sm btn-success add-advance-options" href="{{route('website_pages_seeder_list')}}">Website Logs</a> 
                                   @endcan -->
                            </div>
                            <div class="">
                                <table style="width:100%" id="WebsiteContent"
                                    class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th class="display-none"></th>
                                            <th>Title</th>

                                            @can('edit_website')
                                                <th>Actions</th>
                                            @endcan

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($websitePagesList); $i++) {?>
                                        <tr>
                                            <td class="display-none"></td>
                                            <td>{{ $websitePagesList[$i]->title }}
                                                @if ($websitePagesList[$i]->section == 'faq')
                                                    <span
                                                        class="badge badge-pill badge-primary">{{ App\Models\Faq::count() }}</span>
                                                @endif
                                            </td>
                                            @can('edit_website')
                                                <td>





                                                    <a @if ($websitePagesList[$i]->section == 'faq') href="{{ route('mobile_pages_faq_list') }}"   @else  href="{{ route('edit_website_page', ['id' => $websitePagesList[$i]->id]) }}" @endif
                                                        title="Edit"><i class="text-warning fa fa-edit"></i></a>


                                                </td>
                                            @endcan

                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
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

    <script type="text/javascript">
        $('#WebsiteContent').DataTable({
            columnDefs: [{
                targets: 0,
                "ordering": false,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }]
        });
    </script>
@stop
