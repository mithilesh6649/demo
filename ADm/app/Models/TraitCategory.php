<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitCategory extends Model
{
    use HasFactory;

    protected $table = 'trait_categories';

    public function traitMaps()
    {
        return $this->hasMany(TraitMap::class);
    }

    public function scopeStatus($qr)
    {
        return $qr->where('status', 1);
    }

    // public function traits()
    // {
    //     return $this->hasManyThrough(TraitList::class, TraitMap::class, 'trait_category_id', 'id', 'id', 'trait_list_id');
    // }

    public function traits()
    {
        return TraitList::select('trait_lists.id', 'trait_lists.title')
            ->leftJoin('trait_maps', 'trait_maps.trait_list_id', 'trait_lists.id')
            ->leftJoin('trait_categories', 'trait_categories.id', 'trait_maps.trait_category_id')
            ->whereIn('trait_categories.id', request()->trait_category_ids)
            ->get();
    }
}
