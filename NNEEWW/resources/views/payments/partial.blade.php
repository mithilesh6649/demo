<?php for ($i=0; $i < count($paymentTransactionsList); $i++) { ?>
<tr>
    <th class="display-none"></th>

    <td>{{ $paymentTransactionsList[$i]->transfer_id }}</td>

    @if ($paymentTransactionsList[$i]->transferBy == $paymentTransactionsList[$i]->transferTo)
        <td>{{ \Crypt::decryptString($paymentTransactionsList[$i]->sender_account->accountNumber) }}</td>
    @else
        @if ($paymentTransactionsList[$i]->txnType == 'debit')
            <td>{{ \Crypt::decryptString($paymentTransactionsList[$i]->sender_account->accountNumber) }}</td>
        @elseif($paymentTransactionsList[$i]->txnType == 'credit')
            <td>{{ \Crypt::decryptString($paymentTransactionsList[$i]->accountNumber) }}</td>
        @endif
    @endif

    <td> {{ ucfirst($paymentTransactionsList[$i]->name) }} </td>

    <td> {{ ucfirst($paymentTransactionsList[$i]->transferType) }} </td>

    @if (($paymentTransactionsList[$i]->transferType == 'ach' && $paymentTransactionsList[$i]->txnType == 'credit') ||
        ($paymentTransactionsList[$i]->transferType == 'physicalCheck' &&
            $paymentTransactionsList[$i]->txnType == 'credit') ||
        $paymentTransactionsList[$i]->transferType == 'debitCard')
        <td class="text-success">Credit</td>
    @elseif(($paymentTransactionsList[$i]->transferType == 'ach' && $paymentTransactionsList[$i]->txnType == 'debit') ||
        ($paymentTransactionsList[$i]->transferType == 'physicalCheck' && $paymentTransactionsList[$i]->txnType == 'debit'))
        <td class="text-warning">Debit</td>
    @elseif ($paymentTransactionsList[$i]->txnType == 'debit')
        <td class="text-warning">Debit</td>
    @else
        <td class="text-success">Credit</td>
    @endif

    <td> ${{ $paymentTransactionsList[$i]->amount }} </td>

    <td> {{ ucfirst($paymentTransactionsList[$i]->status) }} </td>

    <td> {{ date('m/d/Y', strtotime($paymentTransactionsList[$i]->created_at)) }}
    </td>

    <td>
        @can('view_payments')
            <a class="action-button" title="View" href="view/{{ $paymentTransactionsList[$i]->id }}"><i
                    class="text-info fa fa-eye"></i></a>
        @endcan
    </td>

</tr>
<?php } ?>
<script>
    $(document).ready(function() {
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
                sEmptyTable: "No Transaction Found"
            },
            columnDefs: [{
                targets: 0,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }],
        });
    });
</script>
