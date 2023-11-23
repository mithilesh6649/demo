<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class UserTest extends Model
{
    use HasFactory;
     protected $appends = ['document_url'];
     //Get Test Name
    public function test(){
       return $this->belongsTo(Test::class);
    }

     public function getDocumentUrlAttribute()
    {
       return DB::table('user_reports')->where(['user_test_id'=>$this->id])->value('document_url'); 
    }
}
