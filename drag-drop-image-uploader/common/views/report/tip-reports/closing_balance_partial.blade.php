<div class="opening_balance_wrap d-flex align-items-center justify-content-between mb-4">
    <ul class="mb-0 d-flex align-items-center flex-wrap justify-content-between w-100 mb-0">
        {{-- <li class="mb-1">
            <label class="note-content" style="opacity: 0;">Note : Click
                this when you receive petty cash from head office.</label> --}}
        <li class="mt-4">
            <label class="note-content"></label>
            <div class="received_content one">

                Tip collection: <label
                    id="opening_balance">{{ \App\Models\BranchTip::tipcollection($selected_branch, $selected_date) }}</label>

            </div>
        </li>
        <li class=" mt-4">
            <label class="note-content"></label>
            <div class="received_content one">

                Tip rider : <label
                    id="opening_balance">{{ \App\Models\BranchTip::tipRiderss($selected_branch, $selected_date) }}</label>

            </div>
        </li>
        <li>
            <label class="note-content mt-4" style="opacity: 0;"></label>
            <div class="received_content one">

                Special tip distributions : <label
                    id="total_expense_amount">{{ \App\Models\BranchTip::tipDistributed($selected_branch, $selected_date) }}</label>

            </div>
        </li>
        <li>
            <label class="note-content mt-4" style="opacity: 0;"></label>
            <div class="received_content one">

                Tip to be distributed : <label
                    id="closing_balance">{{ \App\Models\BranchTip::tiptobeDistributed($selected_branch, $selected_date) }}</label>

            </div>
        </li>
    </ul>
</div>
