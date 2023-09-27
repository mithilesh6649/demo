<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function laboratories()
    {
        return $this->hasMany(LaboratoryTest::class, 'test_id', 'id');
    }

    public function reports()
    {
        return $this->hasOne(UserReport::class);
    }

    public function scopeStatus($qr)
    {
        return $qr->where('status', 1);
    }
}
