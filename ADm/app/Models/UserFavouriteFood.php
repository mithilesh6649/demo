<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavouriteFood extends Model
{
    use HasFactory;

    protected $table = 'user_favourite_foods';

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
