<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceBalance extends Model
{
    use HasFactory;

    protected $table = 'maintenance_balances';
    protected $guarded = [];

    // protected $fillable = ['branch_id','maintenance_report_id','opening_balance','cash_received','expense','closing_balance','report_date','doc_ref_no','deleted_at'];

    public function updateEntries($id,$branch_id)
    {

        $balance = MaintenanceBalance::find($id);

        $all_later_entries = MaintenanceBalance::where('branch_id', $branch_id)->where('id', '>', $id)->get();

        if ($balance) {
            $older_closing_balance = $balance->closing_balance;

            foreach ($all_later_entries as $entry) {

                $entry->update([
                    'opening_balance' => $older_closing_balance,
                    'closing_balance' => ($older_closing_balance - $entry->expense) + ($entry->cash_received),
                ]);

                $older_closing_balance = ($older_closing_balance - $entry->expense) + ($entry->cash_received);
            }
        }
    }

    public function expenseAmountUpdated($expense_id)
    {

        $expense = MaintenanceReport::find($expense_id);
        $balance_entry = MaintenanceBalance::where('maintenance_report_id', $expense_id)->first();

        if ($balance_entry) {

            $new_closing = ($balance_entry->closing_balance + $balance_entry->expense) - $expense->amount;
            $balance_entry->update([
                'expense' => $expense->amount,
                'closing_balance' => $new_closing,
            ]);

            Self::updateEntries($balance_entry->id,$expense->branch_id);
        }
    }
}
