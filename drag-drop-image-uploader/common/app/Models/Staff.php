<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

     protected $guarded = []; 


     public function designation_name()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function branchStaffs(){
        return $this->belongsTo(branchStaffs::class,'id','staff_id')->whereNull('end_date');
    }
    
}
