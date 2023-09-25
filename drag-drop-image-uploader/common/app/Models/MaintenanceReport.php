<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceReport extends Model
{
    use HasFactory, SoftDeletes;

    public function MaintenanceSubCategory()
    {
        return $this->belongsTo(MaintenanceSubCategory::class, 'restaurant_id', 'id');
    }

    protected $appends = ['expense_desc', 'receiver_signature', 'verified_by', 'approved_by','person'];


    public function getPersonAttribute(){
        if($this->driver_id){
            return $this['driver']['drivers_name'];
        }else{
            return $this['person_or_company_name'];
        }
    }

    public function getReceiverSignatureAttribute()
    {
        $base_path = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
        $signature = Signature::where([
            'parent_id' => $this->id,
            'parent_type' => Signature::MAINTENANCE_REPORT,
            'signature_type' => Signature::RECEIVER,
        ])->first();

        if ($signature) {
            return $base_path . $signature['signature'];
        } else {
            return null;
        }
    }

    public function getVerifiedByAttribute()
    {
        $base_path = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
        $signature = Signature::where([
            'parent_id' => $this->id,
            'parent_type' => Signature::MAINTENANCE_REPORT,
            'signature_type' => Signature::VERIFIED_BY,
        ])->first();

        if ($signature) {
            return $base_path . $signature['signature'];
        } else {
            return null;
        }
    }

    public function getApprovedByAttribute()
    {
        $base_path = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
        $signature = Signature::where([
            'parent_id' => $this->id,
            'parent_type' => Signature::MAINTENANCE_REPORT,
            'signature_type' => Signature::APPROVED_BY,
        ])->first();

        if ($signature) {
            return $base_path . $signature['signature'];
        } else {
            return null;
        }
    }

    // public function getExpenseDescAttribute()
    // {
    //     if ($this->description) {
    //         return $this->sub_category->sub_cat_name . '(' . $this->description . ')';
    //     } else {
    //         return $this->sub_category->sub_cat_name;
    //     }

    // }
 
     public function getExpenseDescAttribute()
    {
        return $this->category->cat_name.' ( '.$this->sub_category->sub_cat_name.' )';
    }


    public function category()
    {
        return $this->belongsTo(MaintenanceCategory::class, 'category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(MaintenanceSubCategory::class, 'sub_category_id');
    } 
   

   public function MaintenanceReportDoc()
    {
        return $this->hasMany(MaintenanceReportDoc::class);
    }

    
    public function car_data()
    {
        return $this->belongsTo(Cars::class, 'car_id', 'id');
    }

    public function restaurant_data()
    {
        return $this->belongsTo(MaintenanceSubCategory::class, 'restaurant_id', 'id');
    }

    public function getMaintenanceDocRefNo($branch_id)
    {
        $branch = Branch::find($branch_id);
        return 'ME/' . ($branch->branch_code ? $branch->branch_code : $branch->short_name) . '-' . date('dmy');
    }

    public function closingBalanceLog($maintenance_id)
    {

        $expense = MaintenanceReport::find($maintenance_id);
        $last_closing_balance = Self::closingBalance($expense->branch_id);

        $new_closing_balance = $last_closing_balance - number_format($expense->amount, 3, '.', '');

        MaintenanceBalance::create([
            'branch_id' => $expense->branch_id,
            'maintenance_report_id' => $maintenance_id,
            'opening_balance' => number_format($last_closing_balance, 3, '.', ''),
            'cash_received' => 0.000,
            'expense' => $expense->amount,
            'closing_balance' => number_format($new_closing_balance, 3, '.', ''),
            'doc_ref_no' => $expense->doc_ref_no,
            'report_date' => $expense->report_date,
        ]);
    }

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function totalExpenseByDate($branch_id,$report_date)
    {
        $expenses = MaintenanceReport::where([
            'branch_id' => $branch_id,
            'report_date' => $report_date,
        ])->get();

        $today_total_expenses = 0.000;
        foreach ($expenses as $expense) {
            $today_total_expenses = number_format($today_total_expenses, 3, '.', '') + number_format($expense->amount, 3, '.', '');
        }
        return number_format($today_total_expenses, 3, '.', '');
    }

    public function openingBalance($branch_id)
    {
        $expense = MaintenanceBalance::where(['branch_id' => $branch_id])->orderBy('created_at', 'ASC')->first();
        if ($expense) {
            return number_format($expense->opening_balance, 3, '.', '');
        } else {
            $expense_ = MaintenanceBalance::where(['branch_id' => $branch_id])->orderBy('report_date', 'DESC')->orderBy('id', 'DESC')->first();
            if ($expense_) {
                return number_format($expense_->closing_balance, 3, '.', '');
            } else {
                return 0.000;
            }
        }
    }

    public function totalReceived($branch_id, $report_date)
    {

        $report_date_1 = str_replace("/", "-", $report_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $report_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $expenses = MaintenanceBalance::where(['branch_id' => $branch_id])
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->where('cash_received', '!=', 0)->orderBy('report_date', 'DESC')->orderBy('id', 'DESC')->get();
        $today_total_received = 0.000;
        foreach ($expenses as $expense) {
            $today_total_received = number_format($today_total_received, 3, '.', '') + number_format($expense->cash_received, 3, '.', '');
        }
        return number_format($today_total_received, 3, '.', '');
    }

    public function totalExpense($branch_id, $report_date)
    {

        $report_date_1 = str_replace("/", "-", $report_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $report_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $expenses = MaintenanceBalance::where(['branch_id' => $branch_id])
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->get();
        $today_total_expenses = 0.000;
        foreach ($expenses as $expense) {
            $today_total_expenses = number_format($today_total_expenses, 3, '.', '') + number_format($expense->expense, 3, '.', '');
        }
        return number_format($today_total_expenses, 3, '.', '');
    }

    public function closingBalance($branch_id, $report_date)
    {

        $report_date_1 = str_replace("/", "-", $report_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $report_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $expense = MaintenanceBalance::where(['branch_id' => $branch_id])
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderBy('report_date', 'DESC')->orderBy('id', 'DESC')->first();
        if ($expense) {
            return number_format($expense->closing_balance, 3, '.', '');
        } else {
            return 0.000;
        }
    }

    public function totalAmount()
    {
        $expense = MaintenanceBalance::where('branch_id', $branch_id)->where('report_date', '<=', date('Y-m-d'))->orderBy('report_date', 'DESC')->orderBy('id', 'DESC')->first();
        if ($expense) {
            return number_format($expense->closing_balance, 3, '.', '');
        } else {
            return 0.000;
        }
    }

    public function signatureReceiver()
    {
        return $this->hasOne(Signature::class, 'parent_id')->where([
            'parent_id' => $this->id,
            'parent_type' => Signature::MAINTENANCE_REPORT,
            'signature_type' => Signature::RECEIVER,
        ]);
    }

    public function signatureVerifier()
    {
        return $this->hasOne(Signature::class, 'parent_id')->where([
            'parent_id' => $this->id,
            'parent_type' => Signature::MAINTENANCE_REPORT,
            'signature_type' => Signature::VERIFIED_BY,
        ]);
    }

    public function signatureApprover()
    {
        return $this->hasOne(Signature::class, 'parent_id')->where([
            'parent_id' => $this->id,
            'parent_type' => Signature::MAINTENANCE_REPORT,
            'signature_type' => Signature::APPROVED_BY,
        ]);
    }

    public function updateOlderReports()
    {

        $reports = MaintenanceReport::all();

        foreach ($reports as $report) {
            $balance_entry = MaintenanceBalance::where([
                'branch_id' => $report->branch_id,
                'maintenance_report_id' => $report->id,
            ])->first();

            if (!$balance_entry) {
                MaintenanceBalance::create([
                    'branch_id' => $report->branch_id,
                    'maintenance_report_id' => $report->id,
                    'opening_balance' => 0.000,
                    'cash_received' => 0.000,
                    'expense' => $report->amount,
                    'closing_balance' => 0.000,
                    'report_date' => $report->report_date,
                    'doc_ref_no' => $report->doc_ref_no,
                ]);
            }
        }

        foreach (Branch::all() as $branch) {

            $expenses = MaintenanceBalance::where([
                'branch_id' => $branch->id,
            ])->orderBy('report_date', 'ASC')->orderBy('id', 'ASC')->get();

            $older_closing_balance = 0.000;

            foreach ($expenses as $entry) {

                $closing_balance = ($older_closing_balance - $entry->expense) + ($entry->cash_received);

                $entry->update([
                    'opening_balance' => $older_closing_balance,
                    'closing_balance' => $closing_balance,
                ]);

                $older_closing_balance = $closing_balance;
            }

        }
    }

}
