<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultantSession extends Model
{
    use HasFactory,SoftDeletes;

    public function Consultant(){
        return $this->belongsTo(Consultant::class);
    }
}
