@forelse($daily_petty_expense_report as $key => $report_)
<?php $count = 1; ?>
<tr>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td style="display:none"></td>
    <td colspan="8">
       <span class="separator">{{ date('d/m/Y', strtotime($key)) }}</span>
       <span class="separator">-</span>
       <span class="separator">KD {{ \App\Models\DailyPettyExpense::totalPettyExpenseByDate(date('Y-m-d', strtotime($key)),$selected_branch) }}</span>
       <span class="separator"></span>
        

           <span class="separator bg-warning" style="border-radius:4px;">
            <a class="m-1 petty_pdf_download" title="Download PDF" style="cursor: pointer;"><i class="fa fa-download"></i></a>
       </span>

    </td>
</tr>
@if(count(\App\Models\DailyPettyExpense::getReportsByDate($key,\App\Models\DailyPettyExpense::NORMAL,$selected_branch)))
<tr>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td colspan="8">
      <span class="separator">Daily Petty Expense Reports</span>
   </td>
</tr>
@endif
@forelse(\App\Models\DailyPettyExpense::getReportsByDate($key,\App\Models\DailyPettyExpense::NORMAL,$selected_branch) as $report)
    <tr>
        <th class="table_th">{{ $count }}.</th>
        <td>{{$report['category']['cat_name']}}</td>
        <td>{{$report['sub_category']['sub_cat_name']}}</td>
        <td>{{$report['voucher_number']?$report['voucher_number']:'-'}}</td>
        <td>{{$report['doc_ref_no']}}</td>
        <td>{{number_format($report->amount,3)}}</td>
        <td class="table_td">
            {{ \App\Models\DailyPettyExpenseDoc::checkpettyattachment($report->id) }}
         </td>
        <td>
        
           @can('view_sales_petty_report')
           <a class="action-button quick_view"  href="javascript:void(0)"  data-id="{{$report->id}}"  data-invoice="{{$report['voucher_number']?$report['voucher_number']:'-'}}" data-doc-ref="{{$report['doc_ref_no']}}" data-amount="{{number_format($report->amount,3)}}"  title="Documents"><i class="text-dark fa fa-file"></i></a>

            <a class="action-button"  href="{{route('view-sale-and-petty',[base64_encode($report->id),base64_encode($report->report_type)])}}"  title="View"><i class="text-info fa fa-eye"></i></a>
            @endcan
           
           @can('edit_sales_petty_report')

            <a class="action-button" title="Edit" href="{{route('edit-sale-and-petty',[base64_encode($report->id),base64_encode($report->report_type)])}}">
                <i class="text-warning fa fa-edit" ></i>
            </a>
            @endcan 
           @can('delete_sales_petty_report')
           
            <a data-id="{{ $report->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)">
                <i class="text-danger fa fa-trash-alt" ></i>

            </a>
            @endcan
        </td>
    </tr>
<?php $count++; ?>
@empty
@endforelse

{{-- petty voucher --}}
@if(count(\App\Models\DailyPettyExpense::getReportsByDate($key,\App\Models\DailyPettyExpense::VOUCHER,$selected_branch)))
<tr>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
   <td style="display:none"></td>
  <!-- <td colspan="8">
        <span class="separator">Petty Cash Voucher</span>
        <span class="separator">
        <a href="{{route('download-petty-cash-voucher',[base64_encode($key),$selected_branch])}}">
        <i class="fa fa-download"></i>
        </a>
        </span>
   </td>-->
</tr>
@endif
@forelse(\App\Models\DailyPettyExpense::getReportsByDate($key,\App\Models\DailyPettyExpense::VOUCHER,$selected_branch) as $report)
    <tr>
        <th class="table_th">{{ $count }}.</th>
        <td>{{$report['category']['cat_name']}}</td>
        <td>{{$report['sub_category']['sub_cat_name']}}</td>
        <td>{{$report['voucher_number']?$report['voucher_number']:'-'}}</td>
        <td>{{$report['doc_ref_no']}}</td>
        <td>{{number_format($report->amount,3)}}</td>
        <td class="table_td">
            {{ \App\Models\DailyPettyExpenseDoc::checkpettyattachment($report->id) }}
         </td>
        <td>

            @can('view_sales_petty_report')
            <a class="action-button"  href="{{route('view-sale-and-petty',[base64_encode($report->id),base64_encode($report->report_type)])}}"  title="View"><i class="text-info fa fa-eye"></i></a>
            @endcan

           @can('edit_sales_petty_report')

            <a class="action-button" title="Edit" href="{{route('edit-sale-and-petty',[base64_encode($report->id),base64_encode($report->report_type)])}}">
                <i class="text-warning fa fa-edit" ></i>
            </a>
            @endcan
            
           @can('delete_sales_petty_report')

            <a data-id="{{ $report->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)">
                <i class="text-danger fa fa-trash-alt" ></i>
            </a>

           @endcan


           @can('download_sales_petty_report')
              
            <a class="m-1" title="Download" href="{{route('download-petty-cash-voucherNew',$report->id)}}"><i class="fa fa-download"></i></a>
            @endcan
        </td>
    </tr>
<?php $count++; ?>
@empty
@endforelse

@empty
@endforelse
