<?php for ($i=0; $i < count($cards); $i++) { ?>
<tr>
    <th class="display-none"></th>

    <td> {{ ucwords($cards[$i]->person->firstName) }}</td>

    <td> {{ $cards[$i]->card_id }} </td>

    <td> {{ ucfirst($cards[$i]->cardType) }} </td>

    @if ($cards[$i]->cardStatus == 'active')
        <td style="color:green;">Active</td>
    @elseif($cards[$i]->cardStatus == 'inactive')
        <td style="color:orange;">Inactive</td>
    @endif

    <td> {{ $cards[$i]->activatedAt ? date('m/d/Y', strtotime($cards[$i]->activatedAt)) : '--' }}
    </td>

    <td>
        @can('view_cards')
            <a class="action-button" title="View" href="view/{{ $cards[$i]->id }}"><i class="text-info fa fa-eye"></i></a>
        @endcan
    </td>

</tr>
<?php } ?>
<script>
    $(document).ready(function() {
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
            columnDefs: [{
                targets: 0,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }],
        });
    });
</script>
