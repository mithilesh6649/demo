@extends('adminlte::page')

@section('title', 'Super Admin | Deleted Coupon Code')

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
                            <h3> Deleted Coupon Code</h3>

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
                                        @if (Gate::check('restore_coupon_code') || Gate::check('permanent_deleted_coupon_code'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($CouponCode as $offer)
                                        <tr>
                                            <td class="display-none"></td>
                                            <td class="text-uppercase">{{ $offer->coupon_name ?? 'N/A' }}</td>
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
                                            @if (Gate::check('restore_coupon_code') || Gate::check('permanent_deleted_coupon_code'))
                                                <td>

                                                    @can('restore_coupon_code')
                                                        <a class="action-button restore-button" title="Restore"
                                                            href="javascript:void(0)" data-id="{{ $offer->id }}"><i
                                                                class="text-success fa fa-undo"></i></a>
                                                    @endcan

                                                    @can('permanent_deleted_coupon_code')
                                                        <a class="action-button delete-button" title=" Permanent Delete"
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


        //Restore Users.........


        $('body').on('click', '.restore-button', function(e) {

            var id = $(this).attr('data-id');
            var obj = $(this);

            swal({
                title: "Are you sure?",
                text: "Are you sure you want to restore this Coupon Code ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('restore_coupon') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function(response) {

                            if (response.trim() == 'success') {

                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-success");
                                $('#flash-message').html('Coupon Code Restore Successfully');
                                obj.parent().parent().remove();
                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);

                            } else {
                                console.log("FALSE");
                                setTimeout(() => {
                                    alert("Something went wrong! Please try again.");
                                }, 500);

                            }



                        }
                    });
                }
            });
        });



        //Permanent Delete

        $('body').on('click', '.delete-button', function(e) {

            var id = $(this).attr('data-id');
            var obj = $(this);

            swal({
                title: "Are you sure ?",
                text: "Are you sure you want to Permanently Delete this Record  ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('permanent_delete_coupon') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function(response) {

                            if (response.trim() == 'success') {

                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html('Coupon Code Deleted Successfully');
                                obj.parent().parent().remove();
                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                }, 5000);

                            } else {
                                console.log("FALSE");
                                setTimeout(() => {
                                    alert("Something went wrong! Please try again.");
                                }, 500);

                            }


                        }
                    });
                }
            });
        });
    </script>
@stop
