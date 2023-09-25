<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchDriver extends Model
{
    use HasFactory , SoftDeletes;

    public const ACTIVE = 1;

    public function driver(){
        return $this->hasOne(Driver::class,'id','driver_id')->where('status',Driver::ACTIVE);
    }

}
