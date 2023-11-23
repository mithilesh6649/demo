<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitList extends Model
{
    use HasFactory;
    protected $fillable = ['trait_category_id','title','status'];
}
