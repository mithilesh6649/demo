@foreach ($reports as $report)
    <tr>
        <td>{{ date('d/m/Y', strtotime($report->report_date)) }}</td>
        @foreach ($categories as $category)
            @foreach ($category->subcategories as $subcategory)
                @if ($subcategory->id == $report->sub_category_id)
                    <td>{{ $report->amount == 0 ? '-' : number_format($report->amount, 3, '.', '') }}</td>
                @else
                    <td>-</td>
                @endif
            @endforeach
        @endforeach
    </tr>
@endforeach
