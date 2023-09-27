<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHealthComplaint extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'health_complaint_id', 'type'];
}
