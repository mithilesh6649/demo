<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebUserMetadata extends Model
{
    use HasFactory;

    public function getOpenTimeAttribute($val)
    {
        return now()->parse($val)->format('g:i A');
    }

    public function getCloseTimeAttribute($val)
    {
        return now()->parse($val)->format('g:i A');
    }
}
