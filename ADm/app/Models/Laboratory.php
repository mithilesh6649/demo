<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['lab_name'];

    public function getLabNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function test()
    {
        return $this->hasOne(LaboratoryTest::class, 'laboratory_id', 'id');
    }

    public function metadata()
    {
        return $this->hasOne(LaboratoryMetadata::class);
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
}
