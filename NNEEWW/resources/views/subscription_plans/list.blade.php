@extends('adminlte::page')

@section('title', 'Subscription Plan')

@section('content_header')


@section('content')

    <div id="flash-message" class="alert alert-success alert d-none" role="alert">
        <a href="javascript:void(0)" id="close_button" class="float-right text-white close" data-dismiss="alert"
            aria-label="Close">X</a>
    </div>

    <div class="container-fluid p-0">

        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon_main">

                                    </div>
                                    <h3 class="mb-0">Subscription Plan</h3>
                                </div>

                                
                                @can('add_subscription_plans')
                                 <a class="btn btn-sm btn-success add-advance-options"
                                 href="{{ route('subscription-plan.add_plan') }}"> Add Subscription Plan</a>
                                 @endcan


                            </div>
                            <div class="">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <table style="width:100%" id="users-list"
                                    class="table table-bordered table-hover yajra-datatable">
                                    <thead>
                                        <tr>
                                            <th> Title</th>
                                            <th>Monthly Price</th>
                                            <th>Quarterly Price</th>
                                            <th>Yearly Price</th>
                                            <th>Status</th>



                                            @if (Gate::check('view_subscription_plans') || Gate::check('edit_subscription_plans') || Gate::check('delete_subscription_plans'))
                                            <th>Actions</th>
                                           @endif


                                        </tr>
                                    </thead>
                                    <tbody>


                                        @forelse ($plansList as $data)
                                            <tr>
                                                <td>{{ $data->title ?? '' }}</td>
                                                <td>{{ $data->monthly_amount ?? '' }}</td>
                                                <td>{{ $data->quarterly_amount ?? '' }}</td>
                                                <td>{{ $data->annual_amount ?? '' }}</td>

                                                @foreach ($status as $status_data)
                                                    @if ($status_data->value == $data->status)
                                                        @if ($status_data->value == 1)
                                                            <td class="text-success"><span
                                                                    class="active_text_success">Active</span></td>
                                                        @else
                                                            <td class="text-warning"><span
                                                                    class="inactive_text_warning">Inactive</span></td>
                                                        @endif
                                                    @endif
                                                @endforeach

                                                @if (Gate::check('view_subscription_plans') || Gate::check('edit_subscription_plans') || Gate::check('delete_subscription_plans'))
                                               
                                                <td>
                                                   
                                                   @can('edit_subscription_plans')
                                                   <a class="action-button" title="Edit"
                                                   href="edit/{{ $data->id }}"><i
                                                   class="text-warning fa fa-edit"></i></a>
                                                   @endcan
                                                   
                                                   @can('delete_subscription_plans')
                                                   <a class="action-button delete-button" title="Delete"
                                                   href="javascript:void(0)" data-id="{{ $data->id }}"><i
                                                   class="text-danger fa fa-trash-alt"></i></a>
                                                   @endcan

                                                </td>
                                                @endif
                                            </tr>
                                        @empty

                                        @endforelse
                                        {{-- @forelse($plansList as $key => $data)
                              <tr>
                                 <td> {{ $data->title  ?? ''}}  @if ($data->is_free == '1') <span class="badge badge-pill badge-primary p-1">Free Plan</span> @endif </td>
                              <td>
                                             @foreach ($plans as $plan)
                                             @if ($plan->value == $data->plans)
                                             {{$plan->name}}
                                             @endif
                                             @endforeach
                                          </td>
                                 <td> {{ $data->amount }}</td>

                                 @if ($data->status == 1)
                                 <td style="color:green;"> Active </td>
                                 @else
                                       <td style="color:orange;"> Inactive </td>
                                 @endif

                                 <td>

                                    <!-- <a class="action-button" title="View" href="view/{{$data->id}}"><i class="text-info fa fa-eye"></i></a> -->


                                    <a class="action-button" title="Edit" href="edit/{{$data->id}}"><i class="text-warning fa fa-edit"></i></a>




                                    @if ($data->is_free == '1')
                                    <a class="action-button" title="This is Free Subscription Plan" href="javascript:void(0)" data-id="{{$data->id}}"><i class="text-dark fa fa-question-circle"></i></a>
                                    @else
                                    <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$data->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                                    @endif

                                 </td>

                              </tr>
                              @empty
                              <tr>
                                 <td colspan="4">No Record Found</td>
                              </tr>
                              @endforelse --}}
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
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $('#users-list').DataTable({
                    stateSave: true,
                    columnDefs: [{
                        targets: 0,
                        render: function(data, type, row) {
                            return data.substr(0, 100);
                        }
                    }]
                });
            });


            //User Delete...........

            $('body').on('click', '.delete-button', function(e) {
                var id = $(this).attr('data-id');
                var obj = $(this);
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to move this Plan to the Recycle Bin  ?",
                    type: "warning",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('subscription-plan.delete_plan') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id
                            },
                            success: function(response) {
                                if (response.trim() == 'success') {
                                    $("#flash-message").css("display", "block");
                                    $("#flash-message").removeClass("d-none");
                                    $("#flash-message").addClass("alert-danger");
                                    $('#flash-message').html(
                                        ' Subscription Plan Deleted Successfully');
                                    obj.parent().parent().remove();
                                    setTimeout(() => {
                                        $("#flash-message").addClass("d-none");
                                    }, 5000);
                                } else {
                                    console.log("FALSE");
                                    setTimeout(() => {
                                        alert(
                                            "Something went wrong! Please try again.");
                                    }, 500);
                                }
                            }
                        });
                    }
                });
            });
        });

        $('.plan_status').change(function() {

            var id = $(this).data("id");
            var status_value = $(this).prop('checked') == true ? 1 : 0;
            $.ajax({
                type: "post",
                url: "{{ route('subscription-plan.change_plan_status') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    status_value: status_value,
                },
                success: function(response) {

                    console.log(response)

                }


            });
        });
    </script>
@stop
