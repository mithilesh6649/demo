 @foreach($allmonth as $mkey=>$month)
  <tr>

    <td class="table_td" style="white-space: nowrap;">{{$month}}</td>
    @if(in_array($mkey,array_keys($month_datavalue)))

      @foreach($headerscolumn as $bkey=>$daily_salse)

         <td class="table_td" >{{$month_datavalue[$mkey][$bkey] == 0 ? '-' : number_format( (float) $month_datavalue[$mkey][$bkey], 3, '.', '')}}</td>


      @endforeach

    @else

      @foreach($headerscolumn as $bkey=>$daily_salse)
          <td class="table_td">-</td>
      @endforeach

    @endif
    <!-- <td><a class="action-button" title="View" href="#" data-date=""><i class="text-info fa fa-eye eye_green"></i></a></td> -->
 </tr>
@endforeach
