



<div class="container-fluid mb-1" >
  <h4 class="text-center font-weight-bold">MM  Restaurant Sale Dt . {{date('d/m/Y',strtotime($report_date))}}</h4>

  <table class="table text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="background-color:#848884">Sl.No</th>
      <th scope="col" style="background-color:#848884">Branch</th>
      <th scope="col" style="background-color:#848884">Gross Sales</th>
      <th scope="col" style="background-color:#848884">Discount</th>
      <th scope="col" class="bg-warning">Net Sales</th>
    </tr>
  </thead>
  <tbody>
    @php
       $total_g_sale = 0;
       $total_d_sale = 0;
       $total_n_sale = 0;
     @endphp 

  	@forelse($daily_all_branch_DSR as  $key=>$DSR)
    <p>{{--$DSR--}}</p> 
     
     @php
        $total_g_sale = $total_g_sale+$DSR->gross_sale;
        $total_d_sale = $total_d_sale + $DSR->discount;
        $total_n_sale = $total_n_sale + $DSR->netsales;
     @endphp

     <tr> 
      <th scope="row">{{++$key}}</th>
      <td>{{ \App\Models\DailySaleReport::getBranchName($DSR->branch_id)}}</td>
      <td>{{ number_format($DSR->gross_sale,3, '.','') }}</td>
      <td>{{ number_format($DSR->discount,3, '.','') }} </td>
      <td>{{ number_format($DSR->netsales,3, '.','') }} </td>
    </tr>
    @empty
    <p>Data Not Found for this date</p>
    @endforelse
    <tr>
      <th scope="row" style="background-color:#848884;font-weight: bold;">Total</th>
      <td style="background-color:#848884;font-weight: bold;"> </td>
      <td style="background-color:#848884;font-weight: bold;">{{ number_format($total_g_sale,3, '.','') }}</td>
      <td style="background-color:#848884;font-weight: bold;">{{ number_format($total_d_sale,3, '.','') }} </td>
      <td class="bg-warning" style="font-weight:bold;">{{ number_format($total_n_sale,3, '.','') }} </td>
    </tr>




   
 
  </tbody>
</table>

              
</div> 
 
