<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitMap extends Model
{
    use HasFactory;
    protected $fillable = ['trait_category_id','trait_list_id'];
}
