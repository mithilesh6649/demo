<?php

namespace App\Observers;

use App\Models\ReviewComment;

class ReviewCommentObserver
{
    /**
     * Handle the ReviewComment "created" event.
     *
     * @param  \App\Models\ReviewComment  $reviewComment
     * @return void
     */
    public function created(ReviewComment $reviewComment)
    {
        $this->updateAverageReview($reviewComment);
    }

    /**
     * Handle the ReviewComment "updated" event.
     *
     * @param  \App\Models\ReviewComment  $reviewComment
     * @return void
     */
    public function updated(ReviewComment $reviewComment)
    {
        $this->updateAverageReview($reviewComment);
    }

    /**
     * Handle the ReviewComment "deleted" event.
     *
     * @param  \App\Models\ReviewComment  $reviewComment
     * @return void
     */
    public function deleted(ReviewComment $reviewComment)
    {
        //
    }

    /**
     * Handle the ReviewComment "restored" event.
     *
     * @param  \App\Models\ReviewComment  $reviewComment
     * @return void
     */
    public function restored(ReviewComment $reviewComment)
    {
        //
    }

    /**
     * Handle the ReviewComment "force deleted" event.
     *
     * @param  \App\Models\ReviewComment  $reviewComment
     * @return void
     */
    public function forceDeleted(ReviewComment $reviewComment)
    {
        //
    }

    public function updateAverageReview($reviewComment)
    {
        $review = $reviewComment->getReview;
        $countReview = $review->comments->count();
        $totalStars = $review->comments->sum('review');
        $average = round($totalStars / $countReview, 1);

        $review->avg_rating = $average;
        $review->save();

        //TODO: Notify Nutritionists
    }
}
