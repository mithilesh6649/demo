<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebUserWorkingHour extends Model
{
    use HasFactory;

     public function setOpenTimeAttribute($value)
    {
        $this->attributes['open_time'] = date('H:i', strtotime($value));
    }

    public function setCloseTimeAttribute($value)
    {
        $this->attributes['close_time'] = date('H:i', strtotime($value));
    }

    public function getOpenTimeAttribute($value)
    {
        return date('g:i A', strtotime($value));
    }

    public function getCloseTimeAttribute($value)
    {
        return date('g:i A', strtotime($value));
    }
}
