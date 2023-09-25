<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyPettyExpenseBalance extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'daily_petty_cash_expense_balance';
    protected $guarded = [];

    public const CASH_RECEIVED_BY = 'cash_received_by';
    public const CASH = 'cash';
    public const CHEQUE = 'cheque';

    public function updateEntries($id,$branch_id){

        $balance = DailyPettyExpenseBalance::find($id);
        $all_later_entries = DailyPettyExpenseBalance::where('branch_id',$branch_id)->where('id','>',$id)->get();

        if($balance){
            $older_closing_balance = $balance->petty_cash_closing_balance;
    
            foreach($all_later_entries as $entry){
    
                $entry->update([
                    'petty_cash_opening_balance' => $older_closing_balance,
                    'petty_cash_closing_balance' => ($older_closing_balance - $entry->cash_expense) + ($entry->cash_received),
                ]);
    
                $older_closing_balance = ($older_closing_balance - $entry->cash_expense) + ($entry->cash_received);
            }
        }
    }

    public function expenseAmountUpdated($expense_id){

        $expense = DailyPettyExpense::find($expense_id);
        $balance_entry = DailyPettyExpenseBalance::where('daily_petty_cash_id',$expense_id)->first();

        if($balance_entry){

            $new_closing = ($balance_entry->petty_cash_closing_balance + $balance_entry->cash_expense) - $expense->amount;
            $balance_entry->update([
                'cash_expense' => $expense->amount,
                'petty_cash_closing_balance' => $new_closing
            ]);
    
            Self::updateEntries($balance_entry->id,$expense->branch_id);
        }
    }
}
