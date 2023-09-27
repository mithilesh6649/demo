<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    use HasFactory;

    protected $fillable = ['review_id', 'review_by_id', 'review_by_guard', 'review_by_name', 'review_by_email', 'review', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'review_by_id', 'id')->withTrashed();
    }

    public function getReview()
    {
        return $this->belongsTo(Review::class, 'review_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->formatLocalized('%d %b %Y');
    }

    public function createOrUpdateComment($reviewId, $reviewData)
    {
        return ReviewComment::updateOrCreate(['review_id' => $reviewId, 'review_by_id' => auth()->id(), 'review_by_guard' => config('common.guards.users')], ['review_by_name' => auth()->user()->name, 'review_by_email' => auth()->user()->email, 'review' => $reviewData['rating'], 'comment' => $reviewData['review']]);
    }


    public static function boot()
    {
        parent::boot();

        ReviewComment::observe(new \App\Observers\ReviewCommentObserver);
    }
}
