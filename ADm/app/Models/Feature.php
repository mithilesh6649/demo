<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $appends = ['is_string'];

    protected $casts = ['is_genetic_test' => 'boolean'];

    public function getIsStringAttribute()
    {
        return ($this->is_genetic_test) ? true : false;
    }
}
