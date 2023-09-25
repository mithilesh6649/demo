<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLeave extends Model
{
    use HasFactory;


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

     public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

}
