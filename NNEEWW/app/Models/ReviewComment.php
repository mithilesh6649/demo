<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    use HasFactory;

    public function ReviewCommentByUsers(){
       return $this->belongsTo(User::class,'review_by_id');
    }

    public function TotalReviews($id){
        $allReviews = ReviewComment::where('review_id',$id)->count();
       if($allReviews){
          return $allReviews;
       }else{
        return '0';
       }
    }

   public function ReviewToNutritionst(){
       return $this->belongsTo(Review::class,'review_id')->where('review_to_guard','web_users');
    }  

}
