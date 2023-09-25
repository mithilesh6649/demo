 @forelse ($daily_report_sales as $report)
                <tr>
                    <th class="table_th">{{ $report->id }}.</th>
                     <td class="table_td">{{ optional($report->branch)->title_en ?? 'N/A' }}</td>
                      <td class="table_td">
                        <span class="mr-2 reports_rv_number">{{ $report->rv_number }}</span> 
                        <span> 
                           <i class="text-warning fa fa-edit reports_rv_number_edit" report-id='{{$report->id}}' style="font-size:20px;cursor: pointer;" title="Edit Rv No"></i>
                           <i class="text-success fa fa-save reports_rv_number_save d-none" report-id='{{$report->id}}' style="font-size:22px;cursor: pointer;" title="Update Rv No"></i>
                        </span>
                      

                     </td>
                    <td class="table_td">KD {{ $report->total_collection }}</td>
                     <td class="table_td">{{ date('d/m/Y', strtotime($report->updated_at)) }}</td>
                    <td class="table_td"><a class="action-button" title="View"
                            href="{{ route('report.view', ['id' => $report->id]) }}"><i
                                class="text-info fa fa-eye eye_green"></i>
                        </a>
                     
                    </td>  
                </tr>
                @empty
                @endforelse    