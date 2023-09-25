<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
     use SoftDeletes;
    use HasFactory;
    public function cars(){
        return $this->hasMany(\App\Models\Cars::class);
    }

    public const ACTIVE = 1;
}
