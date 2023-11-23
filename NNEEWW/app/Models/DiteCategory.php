<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiteCategory extends Model
{
    protected $table = 'diet_categories';
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','status'];

     CONST ACTIVE_STATUS = '1';   
    static function ACTIVE_DIET_CATEGORY(){
        return  DiteCategory::where('status',DiteCategory::ACTIVE_STATUS)->orderBy('title')->get();
    }

}
