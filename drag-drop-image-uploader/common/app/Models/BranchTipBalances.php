<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BranchTipBalances extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable=['opening_balance','closing_balance','tip_received','manager_id','branch_id','tip_distributed','branch_tip_id','branch_tip_distribution_id','date'];

    public function updateEntries($id){

        $balance = BranchTipBalances::find($id);
        $all_later_entries = BranchTipBalances::where('branch_id',\Session::get('branch_id'))->where('id','>',$id)->get();

        if($balance){
            $older_closing_balance = $balance->closing_balance;

            foreach($all_later_entries as $entry){

                $entry->update([
                    'opening_balance' => $older_closing_balance,
                    'closing_balance' => ($older_closing_balance + $entry->tip_received-$entry->tip_distributed),
                ]);

                $older_closing_balance = ($older_closing_balance + $entry->tip_received-$entry->tip_distributed);// + ($entry->cash_received);
            }
        }
    }

    public function expenseAmountUpdated($expense_id){

        $expense = BranchTip::find($expense_id);
        $balance_entry = BranchTipBalances::where('branch_tip_id',$expense_id)->first();

        if($balance_entry){

            $new_closing = ($balance_entry->closing_balance - $balance_entry->tip_received) + $expense->amount;
            $balance_entry->update([
                'tip_received' => $expense->amount,
                'closing_balance' => $new_closing
            ]);

            Self::updateEntries($balance_entry->id);
        }
    }
}
