<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CurrentOpening extends Model
{
    // /protected $table = 'currrent_opening';
    use HasFactory,SoftDeletes;

    protected $fillable = ['job_title','department','location','employee_type','description','status'];
}
