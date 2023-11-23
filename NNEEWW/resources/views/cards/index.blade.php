@extends('adminlte::page')
@section('title', 'Cards')
@section('content_header')
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header alert d-flex justify-content-between align-items-center">
                        <h3>Cards</h3>
                        <a class="btn btn-sm btn-success invisible" href="../list">{{ __('adminlte::adminlte.back') }}</a>
                        <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="text-right mb-3">
                            <div class="advance-options mb-4" style="display: none;">
                                <div class="title">
                                    <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                                </div>
                                <div class="left_option">
                                    <div class="left_inner w-100">

                                        <div class="date-picker-new ">
                                            <div class="apply_reset_btn" style="display:flex; align-items: center;">
                                                <div class="button_input_wrap w-100  row" id="btn_wrapper"
                                                    style="display: contents;">
                                                    
                                                    <div class="input_box col-md-3 m-0">
                                                        <input type="text" class="form-control mr-2"
                                                            placeholder="Card Holder Name" id="holder_name"
                                                            name="holder_name">
                                                    </div>

                                                    <div class="input_box col-md-3 m-0">
                                                        <label class="position-relative">
                                                            <i class="fas fa-calendar-alt mr-2"></i>
                                                            <input type="text" name="date_range" id="date_range"
                                                                class="form-control" placeholder="Select Date Range"
                                                                autocomplete="off">
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="d-flex ml-2">
                                                    <button
                                                        class="btn btn-primary apply apply-filter mr-2 d-flex align-items-center"
                                                        id="apply-filter"><i
                                                            class="fas fa-paper-plane mr-2"></i>Apply</button>
                                                    <button
                                                        class="btn btn-primary reset-button d-flex align-items-center"><i
                                                            class="fas fa-sync-alt mr-2"></i>Reset</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                            <table style="width:100%" id="cards" class="table table-bordered table-hover datatable">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th>Card Holder</th>
                                        <th>Card Id</th>
                                        <th>Card Type</th>
                                        <th>Is Active</th>
                                        <th>Activated At</th>
                                        @can('view_cards')
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="cards_list">
                                    <?php for ($i=0; $i < count($cards); $i++) { ?>
                                    <tr>
                                        <th class="display-none"></th>

                                        <td> {{ ucwords($cards[$i]->person->firstName) }} </td>

                                        <td> {{ $cards[$i]->card_id }} </td>

                                        <td> {{ ucfirst($cards[$i]->cardType) }} </td>

                                        @if ($cards[$i]->cardStatus == 'active')
                                            <td style="color:green;">Yes</td>
                                        @elseif($cards[$i]->cardStatus == 'inactive')
                                            <td style="color:orange;">No</td>
                                        @else
                                            <td style="color:orange">{{ ucfirst($cards[$i]->cardStatus) }}</td>
                                        @endif

                                        <td> {{ $cards[$i]->activatedAt ? date('m/d/Y', strtotime($cards[$i]->activatedAt)) : '--' }}
                                        </td>

                                        <td>
                                            @can('view_cards')
                                                <a class="action-button" title="View" href="view/{{ $cards[$i]->id }}"><i
                                                        class="text-info fa fa-eye"></i></a>
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
    </div>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        td:nth-child(0) {
            width: 20px;
            max-width: 20px;
        }
    </style>
@stop
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@stop

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cards').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Cards Available"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });
        });

        $(document).ready(function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = mm + '/' + dd + '/' + yyyy;

            $('input[name="date_range"]').daterangepicker({
                "startDate": today,
                "endDate": today,
                "autoApply": true,
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
            $('body').on('click', '.show-advance-options', function(e) {
                e.preventDefault();
                $('.advance-options').slideToggle();
            });


        });

        var holdername = '';
        var date = '';

        $('body').on('click', '.apply-filter', function() {
            filter_callback();
        });

        $("#holder_name").keyup(function() {
            filter_callback();
        });

        function filter_callback() {
            var date_range = $('input[name="date_range"]').val().split('-');
            var holder_name = $('input[name="holder_name"]').val();

            if ((date_range[0] == date[0] && date_range[1] == date[1] &&
                    holder_name == holdername))
                return false;

            holdername = holder_name;
            date = date_range;

            $("#cards").dataTable().fnDestroy();

            $('#cards').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Cards Available"
                },
                ajax: {
                    url: '{{ route('filter') }}',
                    method: 'POST',
                    data: {
                        date_range: date_range,
                        holder_name: holder_name
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $("#cards").dataTable().fnDestroy();
                        if (response.status == "true") {
                            $('#cards_list').html(response.html);
                        }
                    }
                },
            });
        }

        $('body').on('click', '.reset-button', function() {
            $('input[name="date_range"]').val('');
            $('input[name="holder_name"]').val('');

            if (date == '' && holdername == '')
                return false;

            $("#cards").dataTable().fnDestroy()

            $('#cards').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Cards Available"
                },
                ajax: {
                    url: '{{ route('cards_reset') }}',
                    method: 'post',
                    data: {
                        reset: true
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $("#cards").dataTable().fnDestroy();
                        if (response.status) {
                            $('#cards_list').html(response.html);
                            holdername = '';
                            date = '';
                        }
                    }

                },
            });

        })
    </script>
@endpush
