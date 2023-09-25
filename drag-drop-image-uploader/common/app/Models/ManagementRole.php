<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementRole extends Model
{
    use HasFactory; 

    public function Management()
    {
        return $this->hasMany(Management::class,'management_role_id','id');
    }
}
