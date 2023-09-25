<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ChoiceGroup extends Model
{
    use HasFactory,SoftDeletes;

    public function Choice(){
      return  $this->hasMany(Choice::class);
    }  
}
 