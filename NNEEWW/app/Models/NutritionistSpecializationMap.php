<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionistSpecializationMap extends Model
{
    use HasFactory;
    protected $table = 'web_user_specialization_maps';
    public $timestamps = false;
    
    public function Specialization() {
        return $this->belongsTo(Specialization::class);
    }

}
 