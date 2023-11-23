@extends('adminlte::page')

@section('title', 'Contact Us')

@section('content_header')


@section('content')



    <div class="container-fluid p-0">
        <div class="col-lg-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0">Contact Us</h3>
                            </div>
                            <div class="">
                                <table style="width:100%" id="deleted-jobseekers-list"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="display-none"></th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            {{-- <th>Status</th>    --}}
                                            @if (Gate::check('view_contact_us') || Gate::check('reply_contact_us'))
                                                <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($contactUsMessagesList as $contactUsMessagesList)
                                            <tr>
                                                <td class="display-none"></td>
                                                <td>{{ $contactUsMessagesList->first_name ?? '' }} </td>
                                                <td> {{ $contactUsMessagesList->last_name ?? '' }}</td>
                                                <td>{{ $contactUsMessagesList->email }}</td>


                                                <td>
                                                    @if (!empty($contactUsMessagesList->contact_number))
                                                        (+{{ $contactUsMessagesList->country_code }})
                                                        {{ $contactUsMessagesList->contact_number }}
                                                    @else
                                                        --
                                                    @endif
                                                </td>

                                                {{-- <td>
                                                  <select class="form-control">
                                                      <option>Pending</option>
                                                      <option>Resolved</option>
                                                      <option>Dropped</option>
                                                  </select>
                                                </td> --}}



                                                @if (Gate::check('view_contact_us') || Gate::check('reply_contact_us'))
                                                    <td>
                                                        @can('view_contact_us')
                                                            <a href="{{ route('view_contact_us_message', ['id' => $contactUsMessagesList->id]) }}"
                                                                title="View"><i class="text-success fa fa-eye"></i></a>
                                                        @endcan

                                                        @can('reply_contact_us')
                                                            <a href="mailto:{{ $contactUsMessagesList->email }}"
                                                                title="Reply"><i class="text-info fa fa-reply"></i></a>
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
            $('#deleted-jobseekers-list').DataTable({
                stateSave: true,
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }]
            });
        });





        $(document).on('change', '.changestatus', function() {

            var id = $(this).attr('data-id');

            var status = $(this).find(':selected').val();

            $.ajax({
                url: "{{ route('contact.status.update') }}",
                method: "POST",
                data: {
                    'status': status,
                    'id': id,

                },
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if (response.status == 'true') {
                        // swal("Status!", "Status Successfully Updated. ", "success");
                    }

                }
            });

        });
    </script>
@stop
