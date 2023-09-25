<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class branchStaffs extends Model
{
    use HasFactory , SoftDeletes;

   
    public function Staff(){
      return  $this->hasOne(Staff::class,'id','staff_id');
    }

    public function StaffBranch(){
      return  $this->hasOne(Branch::class,'id','branch_id');
    }

     



}
