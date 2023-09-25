<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory; 

    public function Managementrole()
    {
        return $this->belongsTo(ManagementRole::class,'management_role_id','id');
    }
}
