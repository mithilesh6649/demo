<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joinus extends Model
{
    use HasFactory;

     public function getResumeFileAttribute($value) {
           return env('CUSTOMER_WEBSITE_URL').'/public/joins/'.$value;
        }

}
