<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsTo(Order::class);
    }

    public function menuItems(){
        return $this->belongsTo(MenuItem::class,'item_id','id');
    }

     public function orderChoices() {
        return $this->hasMany(OrderChoice::class,'order_item_id');
    }

}
