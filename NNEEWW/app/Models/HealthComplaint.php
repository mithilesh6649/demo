<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthComplaint extends Model
{
    use HasFactory,SoftDeletes;

    const FOOD_PREFERENCES = '5';
    const DISEASE = '1' ;
    const ALLERGY = '0';
    const FOODALLERGY = '4';
    const ACTIVE_STATUS = '1';

     public function getDiseasesName($disease_id){
        return HealthComplaint::where('id',$disease_id)->value('name');
     }
}
