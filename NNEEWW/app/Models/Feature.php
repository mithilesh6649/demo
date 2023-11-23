<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    //Featur Type
    const DIET_PLAN = 1;
    const DIET_SUB_PLAN = 2;
    const DIET_DURATION_PLAN = 3;
    protected $fillable = ['type','name','status'];
}
