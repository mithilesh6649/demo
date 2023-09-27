<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reverification extends Model
{
    use HasFactory;

    protected $table = 're_verifications';

    protected $fillable = [
        'user_id',
        'country_code',
        'new_username',
        'otp',
        'expiry_at',
        'token'
    ];
}
