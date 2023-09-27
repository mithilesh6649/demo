<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review_to_id', 'review_to_guard', 'type', 'avg_rating'];

    public function comments()
    {
        return $this->hasMany(ReviewComment::class, 'review_id', 'id')->where('review_by_guard', 'users')->orderBy('id', 'DESC');
    }

    public function createOrUpdateReview($data)
    {
        return Review::firstOrCreate(['review_to_id' => $data->consultant_id], ['review_to_guard' => config('common.guards.web_users'), 'type' => 2]);
    }
}
