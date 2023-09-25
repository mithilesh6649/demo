<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ownership;
use App\Models\Driver;

class Cars extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function owner(){
        return $this->belongsTo(Ownership::class);
    }

     public function driver(){
        return $this->belongsTo(Driver::class);
    }

       public function carBranch(){
        return $this->hasOne(BranchCar::class,'car_id','id');
    }

}
 