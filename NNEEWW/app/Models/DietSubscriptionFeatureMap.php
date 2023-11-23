<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietSubscriptionFeatureMap extends Model
{
    use HasFactory;

     public function DietSubscriptionFeature(){
        return $this->hasOne(Feature::class,'id','feature_id');
    }
}
