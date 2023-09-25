@extends('adminlte::page')

@section('title', 'Designation')

@section('content_header')


@section('content')

    <div class="container">
        <div class="alert d-none" role="alert" id="flash-message">
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Designations</h3>
                            @can('add_designations')
                                <a class="btn btn-sm btn-success" href="{{ route('designations.add') }}">Add Designation</a>
                            @endcan
                        </div>
                        <div class="card-body table p-0 mb-0">


                            <table style="width:100%" id="citiesList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th>Designation</th>
                                        <th>Status</th>

                                        @if (Gate::check('view_designations') || Gate::check('edit_designations') || Gate::check('delete_designations'))
                                            <th>{{ __('adminlte::adminlte.actions') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($list as $designation)
                                        <tr>
                                            <th class="display-none"></th>
                                            <td>{{ $designation->designation }}</td>
                                            <td><span
                                                    class="{{ $designation->status == 1 ? 'text-success' : 'text-danger' }}">{{ $designation->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            @if (Gate::check('view_designations') || Gate::check('edit_designations') || Gate::check('delete_designations'))
                                                <td>
                                                    @can('view_designations')
                                                        <a class="action-button" title="View"
                                                            href="{{ route('designations.view', ['id' => $designation->id]) }}"><i
                                                                class="text-info fa fa-eye"></i></a>
                                                    @endcan
                                                    @can('edit_designations')
                                                        <a class="action-button" title="Edit"
                                                            href="{{ route('designations.edit', ['id' => $designation->id]) }}"><i
                                                                class="text-warning fa fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete_designations')
                                                        <a class="action-button delete-button" title="Delete"
                                                            href="javascript:void(0)" data-id="{{ $designation->id }}"><i
                                                                class="text-danger fa fa-trash-alt"></i></a>
                                                    @endcan
                                                </td>
                                            @endif
                                        </tr>

                                    @empty
                                    @endforelse






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
        $(document).ready(function() {
            $('#citiesList').DataTable({
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }]
            });
        });




        $('.delete-button').click(function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);
            // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this Designation to the Recycle Bin?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: '{{ route('designations.delete') }}',
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
                                $('#flash-message').html('Designation Deleted Successfully');
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
