<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Choice extends Model
{
    use HasFactory,SoftDeletes;

 protected $fillable=['name_en','price','name_ar','choice_group_id','imagefile'];

    public function ChoiceGroup(){
      return  $this->belongsTo(ChoiceGroup::class);
    }

}
 