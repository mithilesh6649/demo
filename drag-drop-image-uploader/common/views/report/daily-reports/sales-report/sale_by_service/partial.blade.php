@forelse($branch as $key=>$valbranch)
      <tr>
          <td class="table_td">{{$valbranch}}</td>
           <td class="table_td">{{$allmonth}}</td>
            @if(in_array($key,array_keys($month_datavalue)))
                  @foreach($headerscolumn as $bkey=>$daily_salse)

                     <td class="table_td">{{$month_datavalue[$key][$bkey] == 0 ?'-' : number_format( (float) $month_datavalue[$key][$bkey], 3, '.', '')}}</td>

                  @endforeach
               @else
                  @foreach($headerscolumn as $bkey=>$daily_salse)

                     <td class="table_td">-</td>

                  @endforeach
               @endif


      </tr>
      @empty

  @endforelse
