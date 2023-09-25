<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SecurityQuestion extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title_en','title_ar','status'];
}
