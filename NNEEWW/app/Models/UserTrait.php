<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrait extends Model
{
    use HasFactory;

     public function trait(){
       return $this->belongsTo(TraitList::class,'trait_list_id','id')->select(['id','title']);
    }

}
