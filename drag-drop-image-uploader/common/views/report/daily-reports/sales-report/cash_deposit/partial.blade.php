 @foreach($aDates as $dates)


                        @if(in_array($dates,array_keys($dailymonthdepositbank)))

                          <?php

                          $total_sum = 0;

                          ?>

                           <tr>

                           <td class="table_td">{{date('d/M/Y',strtotime($dates))}}</td>
                           <td class="table_td">{{date('D',strtotime($dates))}}</td>

                          @foreach($branch as $bkey=>$branch_name)

                            @if(in_array($bkey,array_keys($dailymonthdepositbank[$dates])))

                            <?php

                            $total_sum = $total_sum + $dailymonthdepositbank[$dates][$bkey]['cash_deposit_in_bank'];

                            ?>


                             <td class="table_td">{{$dailymonthdepositbank[$dates][$bkey]['cash_deposit_in_bank'] == 0 ? '-' :number_format( (float) $dailymonthdepositbank[$dates][$bkey]['cash_deposit_in_bank'], 3, '.', '')}}</td>
                               @else
                            <td class="table_td">-</td>
                            @endif

                          @endforeach

                            <td>{{ $total_sum == 0 ? '-' : number_format( (float)$total_sum, 3, '.', '')}}</td>
                        @else

                         <!--  @foreach($branch as $bkey=>$branch_name)
                             <td class="table_td">{{number_format( (float) 0, 3, '.', '')}}</td>
                          @endforeach -->

                        @endif
                           </tr>
                        <!-- <td><a class="action-button" title="View" href="#" data-date="{{$dates}}"><i class="text-info fa fa-eye eye_green"></i></a></td> -->

                    @endforeach
