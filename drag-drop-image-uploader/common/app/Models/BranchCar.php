<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BranchCar extends Model
{
    use HasFactory , SoftDeletes;
    public const ACTIVE = 1;

    public function branch(){
      return $this->belongsTo(Branch::class);
    }  

    public function car(){
        return $this->hasOne(Cars::class,'id','car_id');
    }

}
