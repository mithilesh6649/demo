         <?php $count = 1; ?>
                 @foreach($daily_sales_report_doc as $daily_sales_data)
                  
                  <tr> 
                    
               
                  <td>{{ $count }}</td>
                    
                  
                <td class="text-uppercase">
                   <!--   @if ($daily_sales_data->invoice_domain == 'discount')
                        Discount
                    @elseif($daily_sales_data->invoice_domain == 'complimentary')
                        Complimentary
                    @elseif($daily_sales_data->invoice_domain == 'cash_deposit_in_bank')
                        Cash Deposit In Bank
                    @elseif($daily_sales_data->invoice_domain == 'report_from_icg')
                        Report From ICG
                    @elseif($daily_sales_data->invoice_domain == 'cheque')
                        Cheque
                    @elseif($daily_sales_data->invoice_domain == 'printed_gift_cards')
                        Printed Gift Card
                    @elseif($daily_sales_data->invoice_domain == 'e_gift_card')
                        E-Gift Card
                    @elseif($daily_sales_data->invoice_domain == 'gift_coupon_or_voucher')
                        Gift Coupon/Voucher
                    @endif -->

                       @foreach ($daily_invoice_types as $daily_invoice_type)
                         @if ($daily_invoice_type->value == $daily_sales_data->invoice_domain)
                             {{$daily_invoice_type->name}}
                         @endif
                       @endforeach
                </td>
                  
                <!--  <td>  {{pathinfo($daily_sales_data->doc, PATHINFO_EXTENSION) }}</td> -->
                    <td>@if(pathinfo($daily_sales_data->doc, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{env('BRANCH_PORTAL_DOC_URL').$daily_sales_data->doc}}" target="_blank"><i class="fas fa-file-pdf fa-10x text-danger" style="font-size:30px;"></i></a> 
                     @else
                        <a href="{{env('BRANCH_PORTAL_DOC_URL').$daily_sales_data->doc}}" target="_blank"><img src="{{env('BRANCH_PORTAL_DOC_URL').$daily_sales_data->doc}}"></a> 
                    @endif </td>    
                  <td>  {{ date('d/m/Y', strtotime($daily_sales_data->created_at)) }}</td>
                  <td> 
                        <!-- <a class="action-button" title="View" href="#"><i class="text-info fa fa-eye"></i></a> -->
                         <a class="action-button edit_btn_doc" style="cursor:pointer;"  data-id="{{$daily_sales_data->id}}" invoic_domain="{{$daily_sales_data->invoice_domain}}" title="Edit"  ><i class="text-warning fa fa-edit"></i></a>
                            <a data-id="{{$daily_sales_data->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
                  </td>
                 

        
                </tr>
                  <?php $count++; ?>
                 @endforeach