<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountBranch extends Model
{
    use HasFactory , SoftDeletes;
 
   public function  Branch() {
        return $this->belongsTo(Branch::class);
    }
    
     public function discount(){
        return $this->belongsTo(Discount::class);
    }
}
