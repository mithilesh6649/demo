<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchTip extends Model
{
    use HasFactory, SoftDeletes;

    public function totalExpenseByDate($year, $month ,$selected_branch)
    {
        $expenses = BranchTip::where([
            'branch_id' => $selected_branch,
        ])->whereYear('report_date', $year)->whereMonth('report_date', $month)->get();

        $tiprider = 0.000;

        $tipcollection = 0.000;
        foreach ($expenses as $expense) {
            if ($expense->tip_type == 'tip') {
                $tipcollection = number_format($tipcollection, 3, '.', '') + number_format($expense->amount, 3, '.', '');
            } else {
                $tiprider = number_format($tiprider, 3, '.', '') + number_format($expense->amount, 3, '.', '');
            }
        }

        return "Tip Collection - KD " . number_format($tipcollection, 3, '.', '');
    }

    public static function tipcollection($branch_id, $report_date)
    {

        $report_date_1 = str_replace("/", "-", $report_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $report_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $branchtip = BranchTip::selectRaw('SUM(branch_tips.amount) as tip_amount')
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->where(['branch_id' => $branch_id, 'tip_type' => 'tip', 'is_distributed' => 0])
            ->first();

        if ($branchtip) {
            return number_format($branchtip->tip_amount, 3, '.', '');

        } else {
            return number_format(0, 3, '.', '');
        }
    }

    public static function tipRiderss($branch_id, $report_date)
    {

        $report_date_1 = str_replace("/", "-", $report_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $report_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $branchtip = BranchTip::selectRaw('SUM(branch_tips.amount) as tip_amount')
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->where(['branch_id' => $branch_id, 'tip_type' => 'rider', 'is_distributed' => 0])
            ->first();

        if ($branchtip) {
            return number_format($branchtip->tip_amount, 3, '.', '');

        } else {
            return number_format(0, 3, '.', '');
        }
    }

    public static function tipDistributed($branch_id, $report_date)
    {
        $report_date_1 = str_replace("/", "-", $report_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $report_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $tip_distributed = BranchTipDistributions::selectRaw('SUM(branch_tip_distributions.amount) as tip_distributed')
            ->where('distribution_date', '>=', $report_date_1)
            ->where('distribution_date', '<=', $report_date_2)
            ->where(['branch_id' => $branch_id, 'is_distributed' => 0, 'type' => 'Special'])
            ->first();

        if ($tip_distributed) {
            return number_format($tip_distributed->tip_distributed, 3, '.', '');

        } else {
            return number_format(0, 3, '.', '');
        }
    }

    public static function tiptobeDistributed($branch_id, $report_date)
    {

        return number_format((SELF::tipcollection($branch_id, $report_date) + SELF::tipRiderss($branch_id, $report_date) - SELF::tipDistributed($branch_id, $report_date)), 3, '.', '');
    }
   
       public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

}
