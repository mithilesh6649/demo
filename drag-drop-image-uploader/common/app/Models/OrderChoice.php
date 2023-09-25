<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderChoice extends Model
{
    use HasFactory;

    public function choice(){
        return $this->belongsTo(Choice::class,'choice_id');
    }
}
