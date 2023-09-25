@extends('adminlte::page')

@section('title', 'Super Admin | Coupon Code')

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
                            <h3> Coupon Code</h3>
                            @can('add_coupon_offer')
                                <a class="btn btn-success" href="{{ route('coupon.code.add') }}">Add Coupon code</a>
                            @endcan
                        </div>
                        <div class="card-body table form mb-0">
                            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th> Coupon Name</th>
                                        <th>Discount type</th>
                                        <th>Amount/Percentage/Item</th>
                                        <th>Start Date/Time</th>
                                        <th>End Date/Time</th>
                                        <th>Status</th>
                                        @if (Gate::check('view_coupon_offer') || Gate::check('edit_coupon_offer') || Gate::check('delete_coupon_offer'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($CouponCode as $offer)
                                        <tr>
                                            <td class="display-none"></td>
                                            <td class="text-uppercase">{{ $offer->coupon_name }}</td>
                                            <td>
                                                @if ($offer->discount_type == '0')
                                                    Percentage
                                                @elseif($offer->discount_type == '1')
                                                    Amount
                                                @else
                                                    Item
                                                @endif
                                            </td>

                                            <td>

                                                @if ($offer->discount_type == '0')
                                                    {{ $offer->discount_amount ?? '' }} %
                                                @elseif($offer->discount_type == '1')
                                                    {{ $offer->discount_amount ?? '' }} KD
                                                @else
                                                    {{ $offer->menuItem->item_name_en ?? '' }}
                                                @endif


                                            </td>
                                            <td>{{ date('d/m/Y h:00 A', strtotime($offer->start_date)) }}</td>
                                            <td>{{ date('d/m/Y h:00 A', strtotime($offer->end_date)) }}</td>
                                            <td>
                                                @if ($offer->discount_status == '0')
                                                    <label class="badge badge-danger p-1">Inactive</label>
                                                @elseif($offer->discount_status == '1')
                                                    <label class="badge badge-success p-1">Active</label>
                                                @elseif($offer->discount_status == '2')
                                                    <label class="badge badge-danger p-1">Expire</label>
                                                @endif
                                            </td>
                                            @if (Gate::check('view_coupon_offer') || Gate::check('edit_coupon_offer') || Gate::check('delete_coupon_offer'))
                                                <td>
                                                    @can('view_coupon_offer')
                                                        <a class="action-button" title="View"
                                                            href="{{ route('coupon.code.view', ['id' => $offer->id]) }}"><i
                                                                class="text-info fa fa-eye"></i></a>
                                                    @endcan
                                                    @can('edit_coupon_offer')
                                                        <a href="{{ route('coupon.code.edit', ['id' => $offer->id]) }}"
                                                            title="Edit"><i class="text-warning fa fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete_coupon_offer')
                                                        <a class="action-button delete-button" title="Delete"
                                                            href="javascript:void(0)" data-id="{{ $offer->id }}"><i
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
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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
        $('.delete-button').click(function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);

            // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to  delete this Coupon Code ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('coupon.code.delete') }}",
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
                                $('#flash-message').html('Coupon Code  Deleted Successfully');
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
