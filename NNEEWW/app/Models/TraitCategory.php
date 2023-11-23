<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitCategory extends Model
{
    use HasFactory;
    protected $fillable = ['title','status'];
      CONST ACTIVE_STATUS = '1';   
    static function ACTIVE_TRAITS_CATEGORY(){
        return  TraitCategory::where('status',TraitCategory::ACTIVE_STATUS)->orderBy('title')->get();
    }
}
