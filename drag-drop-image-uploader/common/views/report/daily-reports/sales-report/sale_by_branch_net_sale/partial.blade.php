 <?php
     $i = 0; 
      
     ?>

 @foreach ($salesbranch as $key => $report)

     <?php
     
     $total_sum = 0;

     ?>

     <tr>
          <td class="d-none">{{$i}}</td>
         <td class="table_td">{{ date('d/M/Y', strtotime($key)) }}</td>
         <td class="table_td">{{ date('D', strtotime($key)) }}</td>
         @foreach ($branch as $bkey => $branch_name)
             <td class="table_td">
                 @if (isset($salesbranch[$key][$bkey]['net_sale']))
                     <?php

                     $total_sum = $total_sum + $salesbranch[$key][$bkey]['net_sale'];

                     ?>
                     {{ $salesbranch[$key][$bkey]['net_sale'] == 0 ? '-' : number_format((float) $salesbranch[$key][$bkey]['net_sale'], 3, '.', '') }}
                 @else
                     -
                 @endif
             </td>
         @endforeach
         <td>{{ $total_sum == 0 ? '-' : number_format((float) $total_sum, 3, '.', '') }}</td>
         <!-- <td><a class="action-button" title="View" href="#" data-date="{{ $key }}"><i class="text-info fa fa-eye eye_green"></i></a></td> -->
     </tr>
     <?php $i++ ?>
 @endforeach
