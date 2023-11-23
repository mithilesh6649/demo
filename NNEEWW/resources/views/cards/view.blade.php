@extends('adminlte::page')

@section('title', 'Card Details')

@section('content_header')
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header alert d-flex justify-content-between align-items-center">
                        <h3>Card Details</h3>
                        <a class="btn btn-sm btn-success ml-2"
                            href="{{ url('admin/cards/list') }}">{{ __('adminlte::adminlte.back') }}</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="tab_wrapper" id="tab_box_wrapper">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link-header {{ $tablink == 'home' ? 'active' : '' }}" id="pills-home-tab"
                                        data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                                        aria-selected="true" data-id="home"> <i class="fas fa-credit-card mr-2"></i> Card
                                        Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header {{ $tablink == 'transactions' ? 'active' : '' }}"
                                        id="pills-transaction-status-tab" data-toggle="pill"
                                        href="#pills-transaction-status" role="tab"
                                        aria-controls="pills-transaction-status" aria-selected="false"
                                        data-id="transactions"><i class="fas fa-exchange-alt mr-2"></i> Transaction</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <form class="form_wrap customers-management-view">
                                        <div class="row">

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Card Holder</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst($card_detail->person->firstName) }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Card Id</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst($card_detail->card_id) }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Card Label</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst($card_detail->label) }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Spending Limit</label>
                                                    <input class="form-control"
                                                        placeholder="${{ $card_detail->limitAmount }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Card Type</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst($card_detail->cardType) }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Limit Interval</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst($card_detail->limitInterval) }}" readonly>
                                                </div>
                                            </div>

                                            @if ($card_detail->allowedCategories != null)
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group">
                                                        <label>Allowed Categories</label>
                                                        <div class="categories row">
                                                            <?php foreach ($selected_card_category as $category) {
                                                                echo '<li class="col-3">' . ucwords($category) . '</li>';
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($card_detail->blockedCategories != null)
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group">
                                                        <label>Blocked Categories</label>
                                                        <div class="categories row">
                                                            <?php foreach ($selected_card_category as $category) {
                                                                echo '<li class="col-3">' . ucwords($category) . '</li>';
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($card_detail->activatedAt != null)
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Activated At</label>
                                                        <input class="form-control"
                                                            placeholder="{{ date('m/d/Y', strtotime($card_detail->activatedAt)) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Is Active</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ($card_detail->cardStatus == 'pendingActivation') ? 'PendingActivation' : (($card_detail->cardStatus == 'canceled') ? 'Canceled' : ((($card_detail->cardStatus == 'active')) ? 'Yes' : 'No')) }}"
                                                        readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-transaction-status" role="tabpanel"
                                    aria-labelledby="pills-transaction-status-tab">
                                    <table style="width:100%" id="transaction-list"
                                        class="table table-bordered table-hover">
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
                                                @can('view_cards')
                                                    <th>Action</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($money_transfer))
                                                @foreach ($money_transfer as $transfer)
                                                    <tr>
                                                        <th class="display-none"></th>

                                                        <td>{{ $transfer->transfer_id }}</td>

                                                        @if ($transfer->transferBy == $transfer->transferTo)
                                                            <td>{{ $transfer->sender_account->accountNumber }}
                                                            </td>
                                                        @else
                                                            @if ($transfer->txnType == 'debit')
                                                                <td>{{ $transfer->sender_account->accountNumber }}
                                                                </td>
                                                            @elseif($transfer->txnType == 'credit')
                                                                <td>{{ $transfer->accountNumber }}</td>
                                                            @endif
                                                        @endif

                                                        <td> {{ ucfirst($transfer->name) }} </td>

                                                        <td> {{ ucfirst($transfer->transferType) }} </td>

                                                        @if (($transfer->transferType == 'ach' && $transfer->txnType == 'credit') ||
                                                            ($transfer->transferType == 'physicalCheck' && $transfer->txnType == 'credit') ||
                                                            ($transfer->transferType == 'debitCard' && $transfer->txnType == 'credit'))
                                                            <td class="text-success">Credit</td>
                                                        @elseif(($transfer->transferType == 'ach' && $transfer->txnType == 'debit') ||
                                                            ($transfer->transferType == 'physicalCheck' && $transfer->txnType == 'debit') ||
                                                            ($transfer->transferType == 'debitCard' && $transfer->txnType == 'debit'))
                                                            <td class="text-warning">Debit</td>
                                                        @elseif($transfer->txnType == 'debit')
                                                            <td class="text-warning">Debit</td>
                                                        @else
                                                            <td class="text-success">Credit</td>
                                                        @endif

                                                        <td> ${{ $transfer->amount }} </td>
                                                        
                                                        <td> {{ ucfirst($transfer->status )}} </td>

                                                        <td> {{ date('m/d/Y', strtotime($transfer->created_at)) }}
                                                        </td>

                                                        <td>
                                                            @can('view_cards')
                                                                <a class="action-button" title="View"
                                                                    href="{{ url('admin/payment_transactions/view', $transfer->id) }}"><i
                                                                        class="text-info fa fa-eye"></i></a>
                                                            @endcan
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
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
    <style>
        .categories {
            background-color: #efefef;
            border: 1px solid #efefef;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
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
            $('#transaction-list').DataTable({
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
                    sEmptyTable: "No Transaction"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

        });

        $(document).on('click', '.nav-item', function() {
            $('.nav-link-header').each(function() {
                if ($(this).hasClass('active')) {
                    var target = $(this).attr('href');
                    $('.tab-pane').removeClass('show');
                    $('.tab-pane').removeClass('active');
                    $(target).addClass('show');
                    $(target).addClass('active');
                }
            })
        })

        $(document).ready(function() {
            $('.nav-link-header').each(function() {
                if ($(this).attr("data-id") == '{{ $tablink }}') {
                    var target = $(this).attr('href');
                    $('.tab-pane').removeClass('show');
                    $('.tab-pane').removeClass('active');
                    $(target).addClass('show');
                    $(target).addClass('active');
                }
            })
        })
    </script>
@endpush
