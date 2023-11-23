@extends('adminlte::page')
@section('title', 'Payments Transactions')
@section('content_header')
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header alert d-flex justify-content-between align-items-center">
                        <h3>Transactions</h3>
                        <a class="btn btn-sm btn-success invisible"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
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
                                            <div class="apply_reset_btn" style="display:block">
                                                <div class="button_input_wrap w-100  row" id="btn_wrapper">
                                                    <div class="input_box col-md-3 m-0">
                                                        <input type="text" class="form-control mr-2"
                                                            placeholder="Account Number" id="account_number"
                                                            name="account_number">
                                                    </div>
                                                    <div class="input_box col-md-3 m-0">
                                                        <input type="text" class="form-control mr-2"
                                                            placeholder="Contact Name" id="user_name" name="user_name">
                                                    </div>
                                                    <div class="input_box col-md-3 m-0">
                                                        <input type="text" class="form-control mr-2"
                                                            placeholder="Payment Method" id="payment_method"
                                                            name="payment_method">
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
                                                <div class="d-flex mt-4">
                                                    <button
                                                        class="btn btn-primary apply apply-filter mr-2 d-flex align-items-center"><i
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


                            <table style="width:100%" id="payment_transaction_list"
                                class="table table-bordered table-hover datatable">
                                <thead>
                                    <tr>
                                        <th class="display-none"></th>
                                        <th>Transaction Id</th>
                                        <th>Account Number</th>
                                        <th>Send To Contact</th>
                                        <th>Payment Method</th>
                                        <th>Transaction Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        @can('view_payments')
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="payments_list">
                                    <?php for ($i=0; $i < count($paymentTransactionsList); $i++) { ?>
                                    <tr>
                                        <th class="display-none"></th>

                                        <td>{{ $paymentTransactionsList[$i]->transfer_id }}</td>

                                        @if ($paymentTransactionsList[$i]->transferBy == $paymentTransactionsList[$i]->transferTo)
                                                @if($paymentTransactionsList[$i]->sender_account->accountNumber!="")
                                                    <td>{{ \Crypt::decryptString($paymentTransactionsList[$i]->sender_account->accountNumber) }}</td>
                                                @else
                                                <td>{{ $paymentTransactionsList[$i]->sender_account->accountNumber }}</td>
                                                @endif

                                            @else
                                            @if ($paymentTransactionsList[$i]->txnType == 'debit')
                                                    @if($paymentTransactionsList[$i]->sender_account->accountNumber!="")
                                                    <td>{{ \Crypt::decryptString($paymentTransactionsList[$i]->sender_account->accountNumber) }}</td>
                                                @else
                                                <td>{{ $paymentTransactionsList[$i]->sender_account->accountNumber }}</td>
                                                @endif
                                            @elseif($paymentTransactionsList[$i]->txnType == 'credit')

                                                @if($paymentTransactionsList[$i]->accountNumber!="")
                                                <td>{{ \Crypt::decryptString($paymentTransactionsList[$i]->accountNumber) }}</td>
                                            @else
                                            <td>{{ $paymentTransactionsList[$i]->accountNumber }}</td>
                                            @endif
                                
                                            @endif
                                        @endif

                                        <td> {{ ucfirst($paymentTransactionsList[$i]->name) }} </td>

                                        <td> {{ ucfirst($paymentTransactionsList[$i]->transferType) }} </td>

                                        @if (($paymentTransactionsList[$i]->transferType == 'ach' && $paymentTransactionsList[$i]->txnType == 'credit') ||
                                            ($paymentTransactionsList[$i]->transferType == 'physicalCheck' &&
                                                $paymentTransactionsList[$i]->txnType == 'credit') ||
                                            ($paymentTransactionsList[$i]->transferType == 'debitCard' && $paymentTransactionsList[$i]->txnType == 'credit'))
                                            <td class="text-success">Credit</td>
                                        @elseif(($paymentTransactionsList[$i]->transferType == 'ach' && $paymentTransactionsList[$i]->txnType == 'debit') ||
                                            ($paymentTransactionsList[$i]->transferType == 'physicalCheck' &&
                                                $paymentTransactionsList[$i]->txnType == 'debit') ||
                                            ($paymentTransactionsList[$i]->transferType == 'debitCard' && $paymentTransactionsList[$i]->txnType == 'credit'))
                                            <td class="text-warning">Debit</td>
                                        @elseif ($paymentTransactionsList[$i]->txnType == 'debit')
                                            <td class="text-warning">Debit</td>
                                        @else
                                            <td class="text-success">Credit</td>
                                        @endif

                                        <td> ${{ $paymentTransactionsList[$i]->amount }} </td>
                                        <td>{{ ucfirst($paymentTransactionsList[$i]->status) }}</td>
                                        <td> {{ date('m/d/Y', strtotime($paymentTransactionsList[$i]->created_at)) }}
                                        </td>

                                        <td>
                                            @can('view_payments')
                                                <a class="action-button" title="View"
                                                    href="view/{{ $paymentTransactionsList[$i]->id }}"><i
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
            $('#payment_transaction_list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {
                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Transaction Done"
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


        var user_name = '';
        var account_name = '';
        var paymentmethod = '';
        var date = '';

        $('body').on('click', '.apply-filter', function() { 
            filter_callback();
        });

        $("#user_name, #account_number, #payment_method").keyup(function() { 
            filter_callback();
        });

        function filter_callback() {
            var date_range = $('input[name="date_range"]').val().split('-');
            var username = $('input[name="user_name"]').val();
            var account = $('input[name="account_number"]').val();
            var payment_method = $('input[name="payment_method"]').val();

            if ((date_range[0] == date[0] && date_range[1] == date[1] && username == user_name && account == account_name &&
                    payment_method == paymentmethod))
                return false;

            user_name = username;
            account_name = account;
            paymentmethod = payment_method;
            date = date_range;

            $("#payment_transaction_list").dataTable().fnDestroy();

            $('#payment_transaction_list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Transaction Done"
                },
                ajax: {
                    url: '{{ route('payment_transactions_filter') }}',
                    method: 'POST',
                    data: {
                        date_range: date_range,
                        username: username,
                        account: account,
                        payment_method: payment_method
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {  console.log(response);
                        $("#payment_transaction_list").dataTable().fnDestroy();
                        if (response.status == "true") {
                           
                            $('#payments_list').html(response.html);
                        }
                    }
                },
            });
        }

        $('body').on('click', '.reset-button', function() {
            $('input[name="date_range"]').val('');
            $('#user_name').val('');
            $('#account_number').val('');
            $('#payment_method').val('');

            if (date == '' && user_name == '' && account_name == '' && paymentmethod == '')
                return false;


            $("#payment_transaction_list").dataTable().fnDestroy()

            $('#payment_transaction_list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Transaction Done"
                },
                ajax: {
                    url: '{{ route('payment_transactions_reset') }}',
                    method: 'post',
                    data: {
                        reset: true
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $("#payment_transaction_list").dataTable().fnDestroy();
                        if (response.status) {
                            $('#payments_list').html(response.html);
                            user_name = '';
                            account_name = '';
                            paymentmethod = '';
                            date = '';
                        }
                    }

                },
            });

        })
    </script>
@endpush
