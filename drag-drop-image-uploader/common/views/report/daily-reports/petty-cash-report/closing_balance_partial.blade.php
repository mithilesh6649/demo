<div class="opening_balance_wrap d-flex align-items-center justify-content-between">
    <ul class="mb-0 d-flex align-items-center flex-wrap justify-content-between w-100 mb-4">
      <li class="received_content one">
        <label class="note-content" style="opacity: 0;">Note : Click this when you receive  petty cash from head office.</label>
        <div class="received_content one">
            Today opening balance :
            <label id="opening_balance">{{\App\Models\DailyPettyExpense::openingBalance($selected_branch,$selected_date)}}</label>
        </div>
      </li>

      <li class="received_btn" id="total_recieved_amount">
        <label class="note-content">Note : Click this when you receive  petty cash from head office.</label>
        <div class="received_content">
            Today received amount :
            <label style="cursor:pointer">{{\App\Models\DailyPettyExpense::totalReceived($selected_branch,$selected_date)}}</label>
        </div>
      </li>

      <li class="received_content one">
      <label class="note-content" style="opacity: 0;">Note : Click this when you receive  petty cash from head office.</label>
        <div class="received_content one">
            Today expense amount :
            <label id="total_expense_amount">{{\App\Models\DailyPettyExpense::totalExpense($selected_branch,$selected_date)}}</label>
        </div>
      </li>

      <li class="received_content one">
        <label class="note-content" style="opacity: 0;">Note : Click this when you receive  petty cash from head office.</label>
        <div class="received_content one">
            Today Closing balance :
            <label id="closing_balance">{{\App\Models\DailyPettyExpense::closingBalance($selected_branch,$selected_date)}}</label>
        </div>
      </li>

    </ul>

</div>

{{-- modal for receiving amount --}}
<div id="add_receive_amount" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Add Received Amount</h4>
        </div>
        <div class="modal-body">
           <div class="model-back">

                <input type="hidden" name="id" id="balance_id" value="0">

                <div class="row">
                   <div class="col-6">
                      <select name="cash_received_by" id="cash_received_by" class="form-control">
                         @foreach ($cash_received_by as $item)
                         <option value="{{$item->value}}">{{$item->name}}</option>
                         @endforeach
                      </select>
                   </div>
                   <div class="col-6">
                      <input type="number" id="received_amount" name="received_amount" class="form-control"
                          placeholder="0.000">
                          <label class="error amount_error" style="display:none">Amount is required</label>
                   </div>

                   <div class="col-12 cheque_number">
                      <br>
                      <input type="text" id="cheque_number" name="cheque_number" class="form-control"
                          placeholder="Cheque Number">
                      <label class="error cheque_number_error" style="display:none">Cheque is required</label>
                   </div>
                </div>

                 <div class="text-center">

                    <button class="button btn btn-sm btn_clr btn-success mt-4 mb-4 add_amount">Submit</button>

                    <table class="table mb-0">
                       <thead>
                          <tr>
                             <th scope="col">#</th>
                             <th scope="col">Date</th>
                             <th scope="col">Received by</th>
                             <th scope="col">Cheque Number</th>
                             <th scope="col">Amount</th>
                             <th scope="col">Action</th>
                          </tr>
                       </thead>
                       <tbody>
                          @forelse ($last_received_amounts as $received_amount)
                          <tr>
                             <th scope="row">{{ $loop->iteration }}</th>
                             <td>{{ date('d/m/Y', strtotime($received_amount->report_date)) }}</td>
                             <td>{{ucfirst($received_amount->cash_received_by)}}</td>
                             <td>{{$received_amount->cheque_number?$received_amount->cheque_number:'-'}}</td>
                             <td>KD {{ number_format($received_amount->cash_received, 3, '.', '') }}</td>
                             <td>
                                {{-- @if ($received_amount->report_date == date('Y-m-d')) --}}
                                <a href="Javascript:void(0)" class="edit_balance"
                                   data-id="{{ $received_amount->id }}"
                                   data-amount="{{ $received_amount->cash_received }}" data-type="{{$received_amount->cash_received_by}}" data-cheque="{{$received_amount->cheque_number}}"><i
                                   class="fa fa-edit"></i></a>
                                {{-- @else
                                <i class="fa fa-edit" style="opacity:0.3"></i>
                                @endif --}}
                             </td>
                          </tr>
                          @empty
                          <tr>No data found</tr>
                          @endforelse
                       </tbody>
                    </table>
                 </div>

           </div>
        </div>
     </div>
  </div>
</div>
