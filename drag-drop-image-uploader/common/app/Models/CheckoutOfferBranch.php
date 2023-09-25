<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class CheckoutOfferBranch extends Model
{
    use HasFactory , SoftDeletes;

     public function  Branch() {
        return $this->belongsTo(Branch::class);
    }

    
     public function  CheckoutOffer() {
        return $this->belongsTo(CheckoutOffer::class);
    }
}
