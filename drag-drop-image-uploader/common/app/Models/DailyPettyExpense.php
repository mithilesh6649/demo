<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyPettyExpense extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public const NORMAL = 0;
    public const VOUCHER = 1;


    protected $appends = ['expense_desc','receiver_signature','verified_by','approved_by','person'];

    // public function getExpenseDescAttribute(){
    //     if($this->description) return $this->sub_category->sub_cat_name.' ('.$this->description.')';
    //     else return $this->sub_category->sub_cat_name;
    // }


    public function getExpenseDescAttribute(){

       if($this->category_id=='1' || $this->category_id==1)
       {
         return $this->category->cat_name.' ( '.$this->sub_category->sub_cat_name.' )'.' ( '.$this->number_cylinder.' )';
       
       }else{
         return $this->category->cat_name.' ( '.$this->sub_category->sub_cat_name.' )';
       }
        
    }



       public function getPersonAttribute(){
        // if($this->driver_id){
        //     return $this['driver']['drivers_name'];
        // }else{
        //     return $this['person_name'];
        // }
    }

    public function getReceiverSignatureAttribute(){
      $base_path = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
      $signature = Signature::where([
          'parent_id' => $this->id,
          'parent_type' => Signature::DAILY_PETTY_REPORT,
          'signature_type' => Signature::RECEIVER,
      ])->first();
      if($signature){
          return $base_path.'/'.$signature['signature'];
      }else{
          return null;
      }
  }

  public function getVerifiedByAttribute(){
      $base_path = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
      $signature = Signature::where([
          'parent_id' => $this->id,
          'parent_type' => Signature::DAILY_PETTY_REPORT,
          'signature_type' => Signature::VERIFIED_BY,
      ])->first();

      if($signature){
          return $base_path.'/'.$signature['signature'];
      }else{
          return null;
      }
  }

  public function getApprovedByAttribute(){
      $base_path = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
      $signature = Signature::where([
          'parent_id' => $this->id,
          'parent_type' => Signature::DAILY_PETTY_REPORT,
          'signature_type' => Signature::APPROVED_BY,
      ])->first();

      if($signature){
          return $base_path.'/'.$signature['signature'];
      }else{
          return null;
      }
  }


    public function category(){
      return $this->belongsTo(DailyPettyExpenseCategory::class,'category_id');
    }

    public function sub_category(){
      return $this->belongsTo(DailyPettyExpenseSubCategory::class,'sub_category_id');
    }

    public function DailyPettyExpenseDoc(){
      return $this->hasMany(DailyPettyExpenseDoc::class,'daily_petty_expense_id','id');
    }

    public function  Branch() {
      return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function docs(){
      return $this->hasMany(DailyPettyExpenseDoc::class,'daily_petty_expense_id');
    }

    public static function getExpenseBranchWise($subcategory,$current_date,$branch_id){
      return DailyPettyExpense::where('category_id',$subcategory->category_id)
        ->where('sub_category_id',$subcategory->id)
        ->where('branch_id',$branch_id)
        ->whereDate('report_date',$current_date)
        ->sum('amount');
    }

    public static function getExpenseBranchMonthWise($subcategory,$branch,$month=null,$year=null){
      $month = $month?$month:date('m');
      $year = $year?$year:date('Y');
      return DailyPettyExpense::where('branch_id',$branch->id)
        ->where('category_id',$subcategory->category_id)
        ->where('sub_category_id',$subcategory->id)
        ->whereMonth('created_at',$month)
        ->whereYear('created_at',$year)
        ->sum('amount');
    }

    public function checkSingleBranchAmountExist($branch,$month=null,$year=null){
      $month = $month?$month:date('m');
      $year = $year?$year:date('Y');
      return DailyPettyExpense::where('branch_id',$branch->id)
              ->whereMonth('created_at',$month)
              ->whereYear('created_at',$year)
              ->orderBy('report_date','DESC')
              ->sum('amount');
  }

    public function hasReportData($date,$branch_id){
      return DailyPettyExpense::where('branch_id',$branch_id)
      ->where('report_date',$date)
      ->count();
    }

    // update opening and closing balances when one of the expense gets deleted
    public function updateBalanceEntriesOnDelete($id){

        $balance = DailyPettyExpenseBalance::find($id);
        $previous_entry = DailyPettyExpenseBalance::where('branch_id',$balance->branch_id)->where('id','<',$id)->orderBy('report_date','DESC')->orderBy('id','DESC')->first();

        if($balance->delete()){

          $all_later_entries = DailyPettyExpenseBalance::where('branch_id',$previous_entry->branch_id)->where('id','>',$previous_entry->id)->get();
          $older_closing_balance = $previous_entry->petty_cash_closing_balance;

          foreach($all_later_entries as $entry){
            $entry->update([
                'petty_cash_opening_balance' => $older_closing_balance,
                'petty_cash_closing_balance' => ($older_closing_balance - $entry->cash_expense) + ($entry->cash_received),
            ]);
            $older_closing_balance = ($older_closing_balance - $entry->cash_expense) + ($entry->cash_received);
          }
        }
    }


    // opening and closing balances
    public function openingBalance($branch_id,$report_date){
        $expense = DailyPettyExpenseBalance::where(['branch_id'=>$branch_id,'report_date' => $report_date])->orderBy('report_date','ASC')->orderBy('id','ASC')->first();
        if($expense){
            return number_format($expense->petty_cash_opening_balance,3,'.','');
        }else{
            return 0.000;
        }
    }

    public function totalReceived($branch_id,$report_date){
        $expenses = DailyPettyExpenseBalance::where(['branch_id' => $branch_id,'report_date' => $report_date])->where('cash_received','!=',0)->orderBy('report_date','DESC')->orderBy('id','DESC')->get();
        $today_total_received = 0.000;
        foreach($expenses as $expense){
            $today_total_received = number_format($today_total_received,3,'.','') + number_format($expense->cash_received,3,'.','');
        }
        return number_format($today_total_received,3,'.','');
    }

    public function totalExpense($branch_id,$report_date){
        $expenses = DailyPettyExpenseBalance::where(['branch_id' => $branch_id,'report_date' => $report_date])->get();
        $today_total_expenses = 0.000;
        foreach($expenses as $expense){
            $today_total_expenses = number_format($today_total_expenses,3,'.','') + number_format($expense->cash_expense,3,'.','');
        }
        return number_format($today_total_expenses,3,'.','');
    }

    public function closingBalance($branch_id,$report_date){
        $expense = DailyPettyExpenseBalance::where('branch_id',$branch_id)->where('report_date','<=',$report_date)->orderBy('report_date','DESC')->orderBy('id','DESC')->first();
        if($expense){
            return number_format($expense->petty_cash_closing_balance,3,'.','');
        }else{
            return 0.000;
        }
    }

    // for combined petty cash report
    public function totalPettyExpenseByDate($report_date,$branch_id){
      $expenses = DailyPettyExpense::where([
          'branch_id' => $branch_id,
          'report_date' => $report_date,
      ])->get();

      $today_total_expenses = 0.000;
      foreach($expenses as $expense){
          $today_total_expenses = number_format($today_total_expenses,3,'.','') + number_format($expense->amount,3,'.','');
      }
      return number_format($today_total_expenses,3,'.','');
    }

    public function getReportsByDate($report_date,$report_type,$branch_id){
        return Self::where([
            'report_date' => $report_date,
            'report_type' => $report_type,
            'branch_id' => $branch_id,
        ])->orderBy('report_date','DESC')->orderBy('id','DESC')->get();
    }


       public function car(){
        return $this->belongsTo(Cars::class,'car_id'); 
    }

    public function driver(){
        return $this->belongsTo(Driver::class,'driver_id','id');
    }

    public function petrolpump(){
        return $this->belongsTo(PetrolPumps::class,'petrol_pump_id');
    }

}
