<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserSocialLogin extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = "users_social_login";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
