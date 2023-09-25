@foreach ($branch_tip_report as $report)
    <tr>
        <td style="display:none"></td>
        <td class="table_td">{{ date('d/m/Y', strtotime($report->distribution_date)) }}</td>

        <td>{{ \App\Models\BranchTipDistributions::getName($report->staff_id) }}</td>
        <td class="table_td">KD {{ number_format($report->amount, 3, '.', '') }}</td>
     

       @if (Gate::check('edit_tip_report') || Gate::check('delete_tip_report'))  
        <td class="table_td" style="padding: 0.25rem!important;">

           @can('edit_tip_report')
            <a class="action-button" title="Edit" href="{{ route('tip-distribution.edit', [$report->id,$branch_id]) }}">
                <i class="text-warning fa fa-edit"></i></a>

                     @endcan
                     @can('delete_tip_report') 

            <a data-id="{{ $report->id }}" class="action-button delete-button" title="Delete"
                href="javascript:void(0)"><i class="text-danger fa fa-trash-alt"></i></a>

            @endcan

        </td>
        @endif
        
        </td>
         
    </tr>
@endforeach
