<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratory extends Model
{
    use HasFactory,SoftDeletes;

    public function LaboratoryMetadata(){
        return $this->hasOne(LaboratoryMetadata::class);
    }

     public function labVerificationStatus(){
        return $this->belongsTo(Status::class,'lab_status','id');
    }

}
