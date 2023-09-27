<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitMap extends Model
{
    use HasFactory;

    protected $table = 'trait_maps';

    public function trait()
    {
        return $this->belongsTo(TraitList::class, 'trait_list_id', 'id');
    }
}
