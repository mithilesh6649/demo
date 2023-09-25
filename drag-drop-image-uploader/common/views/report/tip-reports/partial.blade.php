<?php $count = 0; ?>
@forelse ($branch_tip_report as $key => $report_)
    <tr>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td class="date_heading" colspan="8">
            <span class="separator">{{ date('F Y', strtotime($key)) }}</span>
            <span class="separator">-</span>
            <span
                class="separator">{{ \App\Models\BranchTip::totalExpenseByDate(date('Y', strtotime($key)), date('m', strtotime($key)) , $selected_branch) }}</span>


            {{-- <span class="separator">
                <a href="{{ route('download-maintenance', base64_encode($key)) }}"><i class="fa fa-download"></i></a>
            </span> --}}
        </td>
    </tr>
    @foreach ($report_ as $report)
        <tr>
            <td style="display:none"></td>
            <td class="table_td">{{ date('d/m/Y', strtotime($report->report_date)) }}</td>
            <td class="table_td">KD {{ number_format($report->amount, 3, '.', '') }}</td>

             @if (Gate::check('edit_tip_report') || Gate::check('delete_tip_report'))  
            
                <td class="table_td" style="padding: 0.25rem!important;">
                      
                      @can('edit_tip_report')
                    <a class="action-button" title="Edit" href="{{ route('branch_tip.edit', ['id' => $report->id]) }}"> <i
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
