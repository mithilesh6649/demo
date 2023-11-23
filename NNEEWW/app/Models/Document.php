<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public function documentStatus(){
        return $this->belongsTo(Status::class,'document_status','id');
    }
}
