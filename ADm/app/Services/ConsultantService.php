<?php

namespace App\Services;

use App\Http\Resources\SpecializationResource;
use App\Http\Resources\ConsultantResource;
use App\Http\Resources\ReviewResource;
use App\Models\Specialization;
use App\Models\WebUser;

class ConsultantService {

    protected const NUTRITIONIST_GUARD = 'Web_users';
    /**
     * Function: getConsultantAndSpecializationList
     * Functionality: get Consultant/Nutritionist & Specializations records from DB
     *
     * @param string $searchConsultants
     *
     * @return array
     */
    public function getConsultantAndSpecializationList($searchConsultant):array
    {
        $searchConsultantWord = (isset($searchConsultant['search'])) ? $searchConsultant['search'] : null;
        $filterBySpecialization = (isset($searchConsultant['filter'])) ? $searchConsultant['filter'] : null;
        $paginateOffset = (isset($searchConsultant['page'])) ? ($searchConsultant['page'] * 10) - 10 : 0;

        $consultantData = WebUser::when($searchConsultantWord, function ($qr) use ($searchConsultantWord) {
                $qr->where('name', 'like', "%$searchConsultantWord%");
            })
            ->with('metadata', 'specialization.specialization', 'reviews.comments')
            ->when($filterBySpecialization, function ($qr) use ($filterBySpecialization) {

                $qr->whereHas('specialization.specialization', function ($qry) use ($filterBySpecialization) {
                    $qry->where('id', $filterBySpecialization);
                });
            })
            ->orderBy('name', 'ASC')
            ->offset($paginateOffset)
            ->limit(10)
            ->get();

        if ($consultantData) {

            return ['status' => 200, 'success' => true, 'data' => ['consultants' => ConsultantResource::collection($consultantData)->response()->getData(true), 'specializations' => SpecializationResource::collection(Specialization::where('status', 1)->get())] ,  'error' => false];
        }

        return ['status' => 400, 'success' => false, 'message' => 'consultant not found', 'error' => true];

    }

    /**
     * Function: getConsultantData
     * Functionality: This function will fetch the consultant/Nutriotionist Data with there reviews
     *
     * @param string $consultantId
     *
     * @return array
     */
    public function getConsultantData($consultantId)
    {
        $consultantData = WebUser::whereId($consultantId)->with('reviews.comments.user.healthStatus');

        $totalReviewCounts = ($consultantData->first()->reviews == null) ? 0 : $consultantData->first()->reviews->comments->count();

        $consultantData = $consultantData->with('reviews.comments', function ($qr) {
            $qr->take(10);
        })->first();

        if ($consultantData) {

            $totalRatingStar = ($consultantData->reviews == null) ? 0 : (int) $consultantData->first()->reviews->comments->sum('review');

            return ['status' => 200, 'success' => true, 'data' => ['consultants' => (new ConsultantResource($consultantData))->totalRatingStar($totalRatingStar, $totalReviewCounts)] , 'error' => false];
        }
        return ['status' => 400, 'success' => false, 'message' => 'Consultant not found', 'error' => true];
    }

    /**
     * Function: getConsultantReviews
     * Functionality: Fetch the consultants reviews
     *
     * @param array $request
     *
     * @return array
     */
    public function getConsultantReviews($request)
    {
        $paginateOffset = (isset($request['page'])) ? ($request['page'] * 10) - 10 : 0;

        $consultantData = WebUser::whereId($request['consultant_id'])
        ->with('reviews.comments.user.healthStatus');

        $totalReviewCounts = ($consultantData->first()->reviews == null) ? 0 : $consultantData->first()->reviews->comments->count();

        $consultantDat = $consultantData->with('reviews.comments', function ($qr) use ($paginateOffset) {
            $qr->offset($paginateOffset)->limit(10);
        })
        ->first();

        if ($consultantDat) {

            $totalRatingStar = ($consultantData->first()->reviews == null) ? 0 : (int) $consultantData->first()->reviews->comments->sum('review');
            $reviewsCount = $consultantData->first();
            $ratingCount['five_rating'] = ($reviewsCount->reviews == null) ? 0 : $reviewsCount->reviews->comments->where('review', 5)->count();
            $ratingCount['four_rating'] = ($reviewsCount->reviews == null) ? 0 : $reviewsCount->reviews->comments->where('review', 4)->count();
            $ratingCount['three_rating'] = ($reviewsCount->reviews == null) ? 0 : $reviewsCount->reviews->comments->where('review', 3)->count();
            $ratingCount['two_rating'] = ($reviewsCount->reviews == null) ? 0 : $reviewsCount->reviews->comments->where('review', 2)->count();
            $ratingCount['one_rating'] = ($reviewsCount->reviews == null) ? 0 : $reviewsCount->reviews->comments->where('review', 1)->count();

            $averageRating = ($consultantDat->reviews == null) ? 0 : $consultantDat->reviews->avg_rating;

            return ['status' => 200, 'success' => true, 'data' => ['review' => ['average_rating' => $averageRating, 'total_review_count' => $totalReviewCounts, 'total_rating_star' => $totalRatingStar, 'rating_count' => $ratingCount], 'comments' => new ReviewResource($consultantDat)] , 'error' => false];
        }
        return ['status' => 400, 'success' => false, 'message' => 'Consultant not found', 'error' => true];
    }

     /**
     * Function: consultantAvailabilityTime
     * Functionality: Fetch the consultant/nutritionist Availability
     * time
     *
     * @param array $request
     *
     * @return array
     */
    public function consultantAvailabilityTime()
    {
        $finalAvailabilityTime = $alreadyFixed = $finalArray = [];
        $consultant = new WebUser;
        $consultantInfo = $consultant->getAvailabilityTime();

        if ($consultantInfo->availabilityTime != null) {

            $startTime = $consultantInfo->availabilityTime->open_time;
            $endTime = $consultantInfo->availabilityTime->close_time;

            $intervals = \Carbon\CarbonPeriod::since($startTime)->hours(1)->until($endTime)->toArray();
            $currentDate = now()->parse('00:00:00');
            $incomingDate = now()->parse(request()->date . '00:00:00');

            foreach ($intervals as $interval) {

                $to = next($intervals);

                if ($to !== false) {

                    foreach($consultantInfo->appointments as $appointment) {

                        if (!$appointment->metadata->isEmpty()) {

                            foreach ($appointment->metadata as $appointmentMetadata) {

                                if(!now()->parse($appointmentMetadata->start_time)->addMinute()->between($interval, $to , true) && !now()->parse($appointmentMetadata->end_time)->subMinute()->between($interval, $to , true)) {

                                    if ($currentDate->eq($incomingDate)) {

                                        if (!now()->gt($interval->format('H:i'))) {

                                            array_push($finalAvailabilityTime, $interval->format('H:i') . ' - ' . $to->format('H:i'));
                                        }
                                    } else {

                                        array_push($finalAvailabilityTime, $interval->format('H:i') . ' - ' . $to->format('H:i'));
                                    }

                                } else {

                                    array_push($alreadyFixed, $interval->format('H:i') . ' - ' . $to->format('H:i'));
                                }
                            }
                        }
                    }
                }
            }

            if (count($finalAvailabilityTime) == 0) {

                foreach ($intervals as $interval) {

                    $to = next($intervals);

                    if ($to !== false) {

                        if ($currentDate->eq($incomingDate)) {

                            if (!now()->gt($interval->format('H:i'))) {

                                array_push($finalAvailabilityTime, $interval->format('H:i') . ' - ' . $to->format('H:i'));
                            }
                        } else {

                            array_push($finalAvailabilityTime, $interval->format('H:i') . ' - ' . $to->format('H:i'));
                        }
                    }
                }
            }

            $finalArray = array_unique($finalAvailabilityTime);

            for ($i = 0; $i < count($alreadyFixed); $i++) {

                if (($key = array_search($alreadyFixed[$i], $finalArray)) !== false) {

                    unset($finalArray[$key]);
                }
            }
        }

        return ['status' => 200, 'success' => true, 'data' => array_values($finalArray), 'error' => false];
    }
}
