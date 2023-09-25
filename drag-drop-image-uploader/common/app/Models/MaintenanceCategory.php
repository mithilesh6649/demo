<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function sub_categories()
    {
        return $this->hasMany(MaintenanceSubCategory::class, 'cat_id');
    }
}
