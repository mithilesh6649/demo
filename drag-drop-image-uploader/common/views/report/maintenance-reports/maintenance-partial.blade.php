<?php $count = 1; ?>
@forelse ($daily_maintenance_report as $key => $report_)
    <tr>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td style="display:none"></td>
        <td class="date_heading" colspan="8">
            <span class="separator">{{ date('d/m/Y', strtotime($key)) }}</span>
            <span class="separator">-</span>
            <span class="separator">KD
                {{ \App\Models\MaintenanceReport::totalExpenseByDate($selected_branch, date('Y-m-d', strtotime($key))) }}</span>
        </td>
    </tr>
    @foreach ($report_ as $report)
        <tr>
            <td style="display:none"></td>
            <td class="table_td">{{ @$report->category->cat_name }}</td>
            <td class="table_td">{{ @$report->sub_category->sub_cat_name }}</td>
            <td class="table_td">{{ $report->voucher_number ? $report->voucher_number : '-' }}</td>
            <td class="table_td">{{ $report->doc_ref_no }}</td>
            <td class="table_td">KD {{ number_format($report->amount, 3, '.', '') }}</td>
            <td class="table_td">{{ \App\Models\MaintenanceReportDoc::checkmaintenanceattachment($report->id) }}</td>
            {{-- @if (Gate::check('maintenance_edit') || Gate::check('maintenance_view')) --}}
            <td>
                <div>

                    <?php

                    $maintenance_docs = \App\Models\MaintenanceReportDoc::checkmaintenanceattachment($report->id);

                    ?>
                    @can('view_maintenance_report') 
                    @if ($maintenance_docs == 'Yes')
                        <a class="action-button quick_view" href="javascript:void(0)" data-id="{{ $report->id }}"
                            data-invoice="{{ $report['voucher_number'] ? $report['voucher_number'] : '-' }}"
                            data-doc-ref="{{ $report['doc_ref_no'] }}"
                            data-amount="{{ number_format($report->amount, 3) }}" title="Documents"><i
                                class="text-dark fa fa-file"></i></a>
                    @endif

                     
                    <a class="action-button ml-1" title="View"
                        href="{{ route('report.maintenance.view_maintenance', $report->id) }}"><i
                            class="text-info fa fa-eye eye_green"></i>
                    </a>
                      @endcan 
                      @can('edit_maintenance_report')  
                    <a class="action-button ml-1" title="Edit"
                        href="{{ route('report.maintenance.edit_maintenance', $report->id) }}"><i
                            class="text-warning fa fa-edit "></i></a>
                     @endcan 
                   
                    @can('delete_maintenance_report')
                    <a data-id="{{ $report->id }}" class="action-button delete-button" title="Delete"
                        href="javascript:void(0)"><i class="text-danger fa fa-trash-alt"></i></a>
                     @endcan

                    @can('download_maintenance_report')  
                    <a class="m-1" title="Download"
                        href="{{ route('download-maintenance', [$report->id, $selected_branch]) }}"><i
                            class="fa fa-download"></i></a>
                    @endcan         

                    
                </div>
            </td>
            {{-- @endif --}}
        </tr>
    @endforeach
    <?php $count++; ?>
@empty
@endforelse
