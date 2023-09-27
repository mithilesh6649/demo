<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitList extends Model
{
    use HasFactory;

    public function traitMap()
    {
        return $this->hasOne(TraitMap::class, 'trait_list_id', 'id');
    }

    public function scopeStatus($qr)
    {
        return $qr->where('status', 1);
    }
}
