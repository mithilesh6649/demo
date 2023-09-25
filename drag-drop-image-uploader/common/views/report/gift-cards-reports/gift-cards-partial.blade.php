@forelse ($daily_gifts_card_report as $key => $report_)
    <tr>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td class="date_heading" colspan="9">
            <span class="separator">{{ date('d/m/Y', strtotime($key)) }}</span>
        </td>
    </tr>
    @foreach ($report_ as $report)
        <tr>


            <?php
            $card_number = json_decode($report->card_number);
            ?>
            <td style="display:none"></td>
            <td class="table_td">


                <ul class="stocks">
                    @forelse ($card_number as $number)
                        <li class="mb-2">
                            <span>{{ $number }}</span>
                        </li>
                    @empty
                        <li>
                            <span>N/A</span>
                        </li>
                    @endforelse



                </ul>


 
            </td>
            <td class="table_td">{{ date('d/m/Y', strtotime($report->date)) }}</td>
            <td class="table_td">{{ $report->branch->short_name ?? '' }}</td>
            <td class="table_td">{{ $report->guest_name ?? 'N/A' }}</td>
            <td class="table_td">{{ $report->mobile_number ?? 'N/A' }}</td>
            <td class="table_td">{{ $report->pos_invoice_number ?? 'N/A' }}</td>
            <td class="table_td">{{ number_format($report->pos_invoice_amount, 3, '.', '') }}</td>


            <td class="table_td">{{ number_format($report->card_amount, 3, '.', '') }}</td>
            @if (Gate::check('view_gift_card_report') || Gate::check('delete_gift_card_report') || Gate::check('edit_gift_card_report'))
                <td class="table_td">
                     
                      @can('edit_gift_card_report')
                    <a class="action-button" title="Edit"
                        href="{{ route('gift.card.report.edit', ['id' => $report->id]) }}"><i
                            class="text-warning fa fa-edit"></i></a>
                       @endcan
                    @can('view_gift_card_report')
                        <a class="action-button" title="View"
                            href="{{ route('gift.card.report.view', ['id' => $report->id]) }}"><i
                                class="text-info fa fa-eye"></i></a>
                    @endcan
                    @can('delete_gift_card_report')
                        <a data-id="{{ $report->id }}" class="action-button delete-button" title="Delete"
                            href="javascript:void(0)"><i class="text-danger fa fa-trash-alt"></i></a>
                    @endcan
                </td>
            @endif
        </tr>
    @endforeach
    @empty
    @endforelse
