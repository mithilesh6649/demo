<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BranchMenuCategory extends Model
{
    use HasFactory , SoftDeletes;

    
          
      public function  menuCategory(){
        return $this->hasMany(MenuCategory::class,'id','menu_category_id');
    }

      public function  branch(){
        return $this->hasOne(Branch::class,'id','branch_id');
    }

}
