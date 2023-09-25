<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchImage extends Model
{
    use HasFactory , SoftDeletes;

        protected $fillable = [
        'branch_id',
        'image_name',
        'image_type'
    ];


      public function Branch(){
      return $this->belongsTo(Branch::class);
    }

}
