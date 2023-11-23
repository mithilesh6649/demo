<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class UserClinicalGoal extends Model
{
    use HasFactory;
   
     public function getClinicalGoalName($data){
        return DB::table('md_dropdowns')->where('id',$data)->value('name');
     }
    
}
