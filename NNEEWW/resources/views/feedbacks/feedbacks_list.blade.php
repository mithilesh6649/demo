@extends('adminlte::page')

@section('title', 'Feedbacks')

@section('content_header')
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header alert d-flex justify-content-between align-items-center">
                        <h3>Feedbacks</h3>
                    </div>
                    <div class="card-body">
                        <table id="pages-list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>User Name</th>
                                    <th>Rating</th>
                                    @can('view_feedbacks')
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=0; $i < count($feedbacks); $i++) {
                  $user = null;
                  $userType = null;
                  $username = null;
                  if($feedbacks[$i]->user_id != null) {
                    $user = \App\Models\User::find($feedbacks[$i]->user_id);
                    $username = $user->first_name.' '.$user->last_name;
                    $userType = 'user';
                  }
                 
                  else { 
                    $username = "";
                    $userType = 'Guest';
                  }
                  ?>
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ ucfirst($feedbacks[$i]->user->first_name) }} {{ ucfirst($feedbacks[$i]->user->last_name) }}</td>
                                    <td style="white-space:nowrap;">
                                        <span style="display:none">{{ $feedbacks[$i]->rating }}</span>
                                        <input type="hidden" class="rating" id="{{ $feedbacks[$i]->id }}"
                                            value="{{ $feedbacks[$i]->rating }}">
                                        <div>
                                            <i class="fa fa-star text-dark" id="1_{{ $feedbacks[$i]->id }}"
                                                aria-hidden="true"></i>
                                            <i class="fa fa-star text-dark" id="2_{{ $feedbacks[$i]->id }}"
                                                aria-hidden="true"></i>
                                            <i class="fa fa-star text-dark" id="3_{{ $feedbacks[$i]->id }}"
                                                aria-hidden="true"></i>
                                            <i class="fa fa-star text-dark" id="4_{{ $feedbacks[$i]->id }}"
                                                aria-hidden="true"></i>
                                            <i class="fa fa-star text-dark" id="5_{{ $feedbacks[$i]->id }}"
                                                aria-hidden="true"></i>
                                        </div>
                                    </td>
                                    <td>
                                        @can('view_feedbacks')
                                            <a href="{{ route('view_feedback', ['id' => $feedbacks[$i]->id]) }}"
                                                title="View"><i class="text-info fa fa-eye"></i></a>
                                        @endcan
                                    </td>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    
    <script>
        $('#pages-list').DataTable({

            dom: 'Bfrtip',
            
            buttons: [

                {

                    extend: 'copyHtml5',

                    text: '<i class="fa fa-copy mr-1"></i> Copy',

                    titleAttr: 'Copy',

                    exportOptions: {
                        columns: [0, 1, 2]
                    },

                },

                {

                    extend: 'excelHtml5',

                    text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                    titleAttr: 'Excel',

                    exportOptions: {
                        columns: [0, 1, 2]
                    },

                },

                {

                    extend: 'csvHtml5',

                    text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                    titleAttr: 'CSV',

                    exportOptions: {
                        columns: [0, 1, 2]
                    },

                },

                {

                    extend: 'pdfHtml5',

                    text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                    titleAttr: 'PDF',

                    exportOptions: {
                        columns: [0, 1, 2]
                    },

                }

            ],

            oLanguage: {
                sEmptyTable: "No Feedback"
            },

            columnDefs: [{
                targets: 0,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }]
        });

        var ratingEl = document.getElementsByClassName('rating');
        var rating;
        var id;
        for (let i = 0; i < ratingEl.length; i++) {
            const element = ratingEl[i];
            rating = $(element).val();
            id = $(element).attr('id');
            for (let j = 1; j <= rating; j++) {
                if (rating >= j) {
                    $("#" + j + "_" + id).removeClass('text-dark');
                    $("#" + j + "_" + id).addClass('text-warning');
                }
            }
        }
    </script>
@endpush
