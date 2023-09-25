@forelse ($daily_petty_expense_report as $report)
<tr>
    <th class="table_th">{{ $report->id }}.</th>
    <td class="table_td">{{ $report->category->cat_name }}</td>
    <td class="table_td">{{ $report->sub_category->sub_cat_name }}</td>
    <td class="table_td">{{ $report->doc_ref_no }}</td>
    <td class="table_td">KD {{ $report->amount }}</td>
    <td class="table_td">{{ date('d/m/Y', strtotime($report->updated_at)) }}</td>
        <td><a class="m-1" title="View"
            href="{{route('daily_petty_expense_report.view',$report->id)}}"><i
                class="text-info fa fa-eye eye_green"></i>
        </a>
            
    </td>
</tr>
@empty
@endforelse  