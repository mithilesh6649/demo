<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory , SoftDeletes;

   
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
   
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    
    public function orderLogs(){
        return $this->hasMany(OrderLog::class)->latest();
    }

   

    // public function orderLogs(){
    //     return $this->hasMany(OrderLog::class)->latest()->limit(1);
    // }

}
