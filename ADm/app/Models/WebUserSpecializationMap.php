<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebUserSpecializationMap extends Model
{
    use HasFactory;

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
