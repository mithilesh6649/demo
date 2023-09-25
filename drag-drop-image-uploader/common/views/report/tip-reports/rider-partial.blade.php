<?php $count = 0; ?>
@forelse ($branch_tip_report as $key => $report_)

    @foreach ($report_ as $report)
        <tr>
            <td style="display:none"></td>
            <td class="table_td">{{ date('Y', strtotime($report->report_date)) }}</td>
            <td class="table_td">{{ date('F', strtotime($report->report_date)) }}</td>
            <td class="table_td">KD {{ number_format($report->amount, 3, '.', '') }}</td>

             @if (Gate::check('edit_tip_report') || Gate::check('delete_tip_report'))  
            
            <td>
                  @can('edit_tip_report')
                <a class="action-button" title="Edit" href="{{ route('tip-rider.edit', ['id' => $report->id]) }}"> <i
                        class="text-warning fa fa-edit"></i></a>
                  @endcan
                     @can('delete_tip_report') 

                <a data-id="{{ $report->id }}" class="action-button delete-button" title="Delete"
                    href="javascript:void(0)"><i class="text-danger fa fa-trash-alt"></i></a>
                 @endcan
            </td>
            @endif
             
        </tr>
    @endforeach
    <?php $count++; ?>
@empty
@endforelse
