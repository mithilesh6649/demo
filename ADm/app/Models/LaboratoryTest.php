<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryTest extends Model
{
    use HasFactory;

    public function lab()
    {
        return $this->belongsTo(Laboratory::class, 'laboratory_id', 'id');
    }
}
