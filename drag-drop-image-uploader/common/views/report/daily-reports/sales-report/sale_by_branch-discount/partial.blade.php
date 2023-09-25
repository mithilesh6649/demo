@foreach ($allmonth as $key => $month)
    {{-- @if (in_array($key, array_keys($dailymonthdiscount))) --}}
    <tr>

        <?php

        $total_sum = 0;

        ?>


        <td class="table_td">{{ ($key > 9 ? $key : '0' . $key) . '/' . $year }}</td>

        @foreach ($branch as $bkey => $branch_name)
            @if (@$monthdiscount_check[$key])
                @if (in_array($bkey, array_keys($monthdiscount_check[$key])))
                    <?php

                    $total_sum = $total_sum + $monthdiscount_check[$key][$bkey]['discount'];

                    ?>

                    <td class="table_td">
                        {{ $monthdiscount_check[$key][$bkey]['discount'] == 0 ? '-' : number_format((float) $monthdiscount_check[$key][$bkey]['discount'], 3, '.', '') }}
                    </td>
                @else
                    <td class="table_td">-</td>
                @endif
            @else
                <td class="table_td">-</td>
            @endif
        @endforeach
        <td>{{ $total_sum == 0 ? '-' : number_format((float) $total_sum, 3, '.', '') }}</td>
        {{-- @endif --}}
    </tr>
@endforeach
