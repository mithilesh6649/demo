<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialization extends Model
{
    use HasFactory,SoftDeletes;
    CONST ACTIVE_STATUS = '1';   
    static function ACTIVE_SPECIALIZATION(){
        return  Specialization::where('status',Specialization::ACTIVE_STATUS)->orderBy('name')->get();
    }

}
