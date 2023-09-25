@foreach($daily_car_fule_report as $key => $report)

 <tr>

  
            <td class="table_td">{{++$key}}</td>
            <td class="table_td">{{ @date('d/m/Y', strtotime($report->report_date)) }}</td>
            <td class="table_td">{{ @$report->branch->short_name ?? '' }}</td>
            <td class="table_td">{{ @$report->car->no_plate ?? 'N/A' }}</td>
            <td class="table_td">{{ @$report->driver->drivers_name ?? 'N/A' }}</td>
            <td class="table_td">{{ @$report->fuel ?? 'N/A' }}</td>
            <td class="table_td">{{ @$report->driven_km ?? 'N/A' }}</td>
           
           
            
            <td class="table_td">{{ @$report->amount ?? 'N/A' }}</td>
            
            <td>
                    <a class="action-button quick_view"  href="javascript:void(0)"  data-id="{{$report->id}}"     title="Documents"><i class="text-dark fa fa-file"></i></a>

            </td>    
          
            
           <!--  @if (Gate::check('view_gift_card_report') || Gate::check('delete_gift_card_report'))
                <td class="table_td">

                    <a class="action-button" title="Edit"
                        href="#"><i
                            class="text-warning fa fa-edit"></i></a>
                    @can('view_gift_card_report')
                        <a class="action-button" title="View"
                            href="#"><i
                                class="text-info fa fa-eye"></i></a>
                    @endcan
                    @can('delete_gift_card_report')
                        <a data-id="#" class="action-button delete-button" title="Delete"
                            href="javascript:void(0)"><i class="text-danger fa fa-trash-alt"></i></a>
                    @endcan
                </td>
            @endif -->
        </tr>

@endforeach