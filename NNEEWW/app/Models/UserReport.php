<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    use HasFactory;
     
    protected $fillable = ['id','report_no','user_test_id','user_id','test_id','document_url','uploaded_by','uploaded_by_guard','document_type'];
    
  
     
    public function TestType() {
        return $this->hasOne(Test::class,'id','test_id');
    }   
}
