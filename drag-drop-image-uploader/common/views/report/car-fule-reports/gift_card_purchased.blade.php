
                       @php $i=0; 
                               $cardgift=json_decode($gift->card_number);
                             @endphp
                            @forelse($cardgift as $cardgift_value) 
                              <span id="printed_gift_card_data_{{$i}}" class="d-flex align-items-center mt-1"><input
                                    type="number" disabled step="0.01" value="{{$cardgift_value}}" name="pre_printed_gift_card_input_value"
                                    class="pre_printed_gift_card_input_value input_card gross_sum margin-unset"
                                    maxlength="100" aria-invalid="false" id="printed_gift_card_input_value_{{$i}}"
                                    data-id="{{$i}}">
                                  <a href="javascript:;" class="printed_gift_card_delete_icon_old delete_input_icon_old"
                                    id="{{$i}}" data-card-number={{$cardgift_value}} data-gift="{{$gift->id}}">
                                     


                                    <i class="text-danger fa fa-trash-alt printed_gift_card_remove_btn_old"
                                        style="font-size:16px;cursor:pointer"></i>
                                    </a> </span>
                              @php $i++; @endphp
                            @empty
                              
					<div class="gift-card-contain">

					<input type="number"  step="1" name="printed_gift_card_input_value" class="gift-card-input">

					<span><i class="text-danger fa fa-trash-alt printed_gift_card_remove_btn"
					style="font-size:18px;cursor:pointer"></i></span>

					</div> 
                            
                            @endforelse