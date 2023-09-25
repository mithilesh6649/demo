@extends('adminlte::page')

@section('title', 'Super Admin | Staff List') 

@section('content_header')


@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert {{ session('class') }}" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-main">
                    <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                        <h3>Staff</h3>
                         @can('add_branch_staff') 
                        <a class="btn btn-sm btn-success" href="add">Add Staff</a>
                        @endcan 
                    </div>
                    <div class="card-body table p-0 mb-0">

                        <table style="width:100%" id="status-list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="display-none"></th>
                                     <th>Staff Code</th>  
                                     <th>Staff Name</th>
                                     <th>Staff Current Branch</th>
                                     <th>Designation</th>
                                     <th>Points</th>
                                     <th>Status</th>
                                      @if (Gate::check('view_branch_staff') || Gate::check('edit_branch_staff') || Gate::check('delete_branch_staff'))  
                                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                                      @endif 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $key => $staff)
                                <tr>
                                    <td class="display-none"></td>
                                     <td>{{ $staff->staff_code }}</td>
                                     <td>{{ $staff->staff_name }}</td>
                                      <td>{{@$staff->branchStaffs->staffBranch->title_en ?? 'N/A' }}</td>
                                    <td>{{ optional($staff->designation_name)->designation }}</td>
                                    <td>{{ $staff->points }}</td>
                                    <td>
                                        @foreach ($status as $status_data)
                                        @if ($staff->status == $status_data->value)
                                        <span
                                        class="badge badge-pill {{ $staff->status == 1 ? 'badge-success' : 'badge-danger' }} ">
                                        {{ $status_data->name }} </span>
                                        @endif
                                        @endforeach

                                    </td>

                                @if (Gate::check('view_branch_staff') || Gate::check('edit_branch_staff') || Gate::check('delete_branch_staff'))  

                                    <td>
                                         @can('view_branch_staff') 

                                        <a class="action-button" title="View"
                                        href="{{ route('view_staff', $staff->id) }}"><i
                                        class="text-info fa fa-eye"></i></a>

                                         @endcan 

                                         @can('edit_branch_staff') 

                                        <a class="action-button" title="Edit"
                                        href="{{ route('edit_staff', $staff->id) }}"><i
                                        class="text-warning fa fa-edit"></i></a>

                                         @endcan 
                                         @can('delete_branch_staff') 

                                        <a class="action-button delete-button" title="Delete"
                                        href="javascript:void(0)" data-id="{{ $staff->id }}"><i
                                        class="text-danger fa fa-trash-alt"></i></a>

                                         @endcan 
                                    </td>
                                      @endif  
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Staff Name</th>
                                    <th>Staff Code</th>
                                    <th>Designation</th>
                                    <th>Points</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
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
    $('#status-list').DataTable({
        columnDefs: [{
            targets: 0,
            render: function(data, type, row) {
                return data.substr(0, 2);
            }
        }] 
    });

   

      $('body').on('click', '.delete-button', function(e) {   
        var id = $(this).attr('data-id');
        var obj = $(this);
            // console.log({id});
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to move this Staff to the Recycle Bin?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('delete_staff') }}",
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
                                window.location.reload();
                                /* console.log("response", response);
                                obj.parent().parent().remove(); */
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

    </script>
    @stop
