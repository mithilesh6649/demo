<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchTipDistributions extends Model
{
    use HasFactory,SoftDeletes;


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

        $expense = BranchTipDistributions::find($expense_id);
        $balance_entry = BranchTipBalances::where('branch_tip_distribution_id',$expense_id)->first();

        if($balance_entry){

            $new_closing = ($balance_entry->closing_balance + $balance_entry->tip_distributed) - $expense->amount;
            $balance_entry->update([
                'tip_distributed' => $expense->amount,
                'closing_balance' => $new_closing
            ]);

            Self::updateEntries($balance_entry->id);
        }
    }


    public static function getName($id){
         return Staff::where('id',$id)->value('staff_name');
    }

    public static function getbranchstaffAmount($id)
    {
        $branchtip=BranchTip::selectRaw('SUM(branch_tips.amount) as tip_amount')->where(['branch_id'=>Session::get('branch_id'),'is_distributed'=>0])->first();

        $tip_distributed=BranchTipDistributions::selectRaw('SUM(branch_tip_distributions.amount) as tip_distributed')->where(['branch_id'=>Session::get('branch_id'),'is_distributed'=>0,'type'=>'Special'])->first();

         $branch_staff=branchStaffs::where('branch_id',Session::get('branch_id'))->pluck('staff_id');

         $totalstaff_points=Staff::selectRaw('SUM(staff.points) as staff_points')->whereIn('id',$branch_staff)->first();

        $staff=Staff::where('id',$id)->first();

        if($staff)
        {
            $amount=(($branchtip->tip_amount-$tip_distributed->tip_distributed)/$totalstaff_points->staff_points)*$staff->points;

            return  number_format($amount,3,'.','');
        }else{
            return  number_format(0,3,'.','');
        }

    }

    public static function getBranchstaffAviable($id)
    {
        $branch_staff=branchStaffs::where('staff_id',$id)->first();

        if($branch_staff)
        {

            $start = strtotime($branch_staff->start_date);
            if($branch_staff->end_date!=null)
            {
               $end = strtotime($branch_staff->end_date);
            }else{
                $end = strtotime(date('Y-m-d'));
            }

            return $days_between = ceil(abs($end - $start) / 86400);

        }else{
            return 0;
        }

    }


       public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


       public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

}
