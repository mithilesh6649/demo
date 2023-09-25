<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyPettyExpenseDoc extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    
    public function daily_expense(){
        return $this->belongsTo(DailyPettyExpense::class,'daily_petty_expense_id','id');
    }

    // public function getDocAttribute($value) {
    //     return urlencode(env('BRANCH_PORTAL_URL').'/public/petty_docs/'.$value);
    // }

    public static function checkpettyattachment($petty_id)
    {
        $attachment=DailyPettyExpenseDoc::where(['daily_petty_expense_id'=>$petty_id,'deleted_at'=>null])->first();
        if($attachment) return "Yes";
        else return "No";
    }
}
