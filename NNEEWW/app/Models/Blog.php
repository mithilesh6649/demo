<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Blog extends Model
{
    use HasFactory,SoftDeletes;

    public function author(){
      return  $this->hasOne(Admin::class,'id','author_id');
    }


    public function reviewer(){
      return  $this->hasOne(Admin::class,'id','reviewer_id');
    }
}
