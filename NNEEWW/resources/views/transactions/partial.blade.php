 @foreach ($crypto_transactions as $crypto_transaction)
     @if (@$crypto_transaction->account->person->person_id == $wallet_data->createdPersonId && @$type != null)
         <tr>
             <td>{{ ucfirst($crypto_transaction->title) }}</td>
             <td>{{ $crypto_transaction->cpt_id }}</td>
             <td>{{ ucfirst($crypto_transaction->transferType) }}</td>
             <td>${{ $crypto_transaction->amount }}
             </td>
             <td>{{ $crypto_transaction->cryptoCurrency }}</td>
             <td>{{ ucfirst($crypto_transaction->status) }}</td>
             <td>{{ date('m/d/Y', strtotime($crypto_transaction->createdAt)) }}
             </td>
         </tr>
     @elseif ($crypto_transaction->walletId == $wallet_data->crypto_id && @$type != null)
         <tr>
             <td>{{ ucfirst($crypto_transaction->title) }}</td>
             <td>{{ $crypto_transaction->cpt_id }}</td>
             <td>{{ ucfirst($crypto_transaction->transferType) }}</td>
             <td>{{ $crypto_transaction->quantity }}
             </td>
             <td>{{ $crypto_transaction->cryptoCurrency }}</td>
             <td>{{ ucfirst($crypto_transaction->status) }}</td>
             <td>{{ date('m/d/Y', strtotime($crypto_transaction->createdAt)) }}
             </td>
         </tr>
     @elseif(@$crypto_transaction->account->person->person_id == $wallet_data->createdPersonId ||
         ($crypto_transaction->walletId == $wallet_data->crypto_id && $type == null))
         <tr>
             <td>{{ ucfirst($crypto_transaction->title) }}</td>
             <td>{{ $crypto_transaction->cpt_id }}</td>
             <td>{{ ucfirst($crypto_transaction->transferType) }}</td>
             <td>
                 @if ($crypto_transaction->transferType == 'buy')
                     ${{ $crypto_transaction->amount }}
                 @else
                     {{ $crypto_transaction->quantity }}
                 @endif
             </td>
             <td>{{ $crypto_transaction->cryptoCurrency }}</td>
             <td>{{ ucfirst($crypto_transaction->status) }}</td>
             <td>{{ date('m/d/Y', strtotime($crypto_transaction->createdAt)) }}
             </td>
         </tr>
     @endif
 @endforeach

 <script>
     $(document).ready(function() {
         $("#transactions-list").dataTable().fnDestroy();

         $('#transactions-list').DataTable({
             dom: 'Bfrtip',

             buttons: [

                 {

                     extend: 'copyHtml5',

                     text: '<i class="fa fa-copy mr-1"></i> Copy',

                     titleAttr: 'Copy',

                     exportOptions: {
                         columns: [0, 1, 2, 3, 4, 5, 6]
                     },

                 },

                 {

                     extend: 'excelHtml5',

                     text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                     titleAttr: 'Excel',

                     exportOptions: {
                         columns: [0, 1, 2, 3, 4, 5, 6]
                     },

                 },

                 {

                     extend: 'csvHtml5',

                     text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                     titleAttr: 'CSV',

                     exportOptions: {
                         columns: [0, 1, 2, 3, 4, 5, 6]
                     },

                 },

                 {

                     extend: 'pdfHtml5',

                     text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                     titleAttr: 'PDF',

                     exportOptions: {
                         columns: [0, 1, 2, 3, 4, 5, 6]
                     },

                 }

             ],
             oLanguage: {
                 sEmptyTable: "No Transaction Found"
             },
             columnDefs: [{
                 targets: 0,
                 render: function(data, type, row) {
                     return data;
                 }
             }],
         });
     });
 </script>
