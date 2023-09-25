<div class="opening_balance_wrap d-flex align-items-center justify-content-between">
    <ul class="opening_data mb-0 d-flex align-items-center flex-wrap justify-content-between w-100 mb-2">

        <li class="received_btn" id="total_recieved_amount">
            <div class="received_content">
                Total received amount : <label
                    style="cursor:pointer">{{ \App\Models\MaintenanceReport::totalReceived($selected_branch, $selected_date) }}</label>
            </div>
            <label class="note-content">Note : Click this when you receive
                maintenance cash from head office.</label>
        </li>
        <li>
            <div class="received_content one">
                Total expense amount : <label
                    id="total_expense_amount">{{ \App\Models\MaintenanceReport::totalExpense($selected_branch, $selected_date) }}</label>
            </div>
            <label class="note-content" style="opacity: 0;">Note : Click
                this when you receive petty cash from head office.</label>
        </li>
        <li>
            <div class="received_content one">
                Closing balance : <label
                    id="closing_balance">{{ \App\Models\MaintenanceReport::closingBalance($selected_branch, $selected_date) }}</label>
            </div>
            <label class="note-content" style="opacity: 0;">Note : Click
                this when you receive petty cash from head office.</label>
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
                    <form class="receive_amount" id="received_amount_form"
                        action="{{ route('maintenance-add-received-amount') }}" method="POST">
                        @csrf
                        <input type="hidden" name="get_branch_id" id="get_branch_id" value="{{ $selected_branch }}">
                        @foreach($selected_date as $date)
                        <input type="hidden" name="get_date[]" id="get_date" value="{{$date}}">
                        @endforeach
                        <input type="hidden" name="id" id="balance_id" value="0">
                        <input type="number" id="received_amount" name="received_amount" class="form-control"
                            placeholder="0.000">
                        <div class="text-center">
                            <button class="button btn btn-sm btn_clr btn-success mt-4 mb-4 add_amount">Submit</button>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($last_received_amounts as $received_amount)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ date('d/m/Y', strtotime($received_amount->report_date)) }}
                                            </td>
                                            <td>KD
                                                {{ number_format($received_amount->cash_received, 3, '.', '') }}
                                            </td>
                                            <td>
                                                {{-- @if ($received_amount->report_date == date('Y-m-d')) --}}
                                                    <a href="Javascript:void(0)" class="edit_balance"
                                                        data-id="{{ $received_amount->id }}"
                                                        data-amount="{{ $received_amount->cash_received }}"><i
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
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
