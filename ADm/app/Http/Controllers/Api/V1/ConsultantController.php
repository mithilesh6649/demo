<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\ConsultantService;
use App\Models\ReviewComment;
use Illuminate\Http\Request;
use App\Models\Review;

class ConsultantController extends Controller
{
    protected $consultantService;

    public function __construct (ConsultantService $consultantService)
    {
        $this->consultantService = $consultantService;
    }

    /**
     * Function: index
     * Functionality: Fetch the Consultation/Nutritionist and specialization records with filter
     * with Nutritionist specialization, search by Nutritionist name & pagiantion
     *
     * @param \Illuminate\Http\Request $request  $search|$filter|$page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = $this->consultantService->getConsultantAndSpecializationList($request->all());

        return Response::json($response, $response['status']);
    }

    /**
     * Function: consultant
     * Functionality: Fetch the individual Nutritionist and its reviews records
     *
     * @param \Illuminate\Http\Request $request $consultant_id
     *
     * @return \Illuminate\Http\Response
     */
    public function consultant(Request $request)
    {
        $response = $this->consultantService->getConsultantData($request->consultant_id);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: reviews
     * Functionality: Fetch all reviews of clinician
     *
     * @param \Illuminate\Http\Request $request $consultant_id
     *
     * @return \Illuminate\Http\Response
     */
    public function reviews(Request $request)
    {
        $response = $this->consultantService->getConsultantReviews($request->all());

        return Response::json($response, $response['status']);
    }

    /**
     * Function: saveReview
     * Functionality: Store user review
     *
     * @param \Illuminate\Http\Request $request $consultant_id
     * @param \App\Models\Review $review
     *
     * @return \Illuminate\Http\Response
     */
    public function saveReview(Request $request, Review $review, ReviewComment $reviewComment)
    {
        $reviewInfo = $review->createOrUpdateReview($request);

        if ($reviewComment->createOrUpdateComment($reviewInfo->id, $request->all())) {

            return Response::json(['status' => 200, 'success' => true, 'message' => 'Review successfully saved', 'error' => false], 200);
        }

        return Response::json(['status' => 400, 'success' => false, 'message' => 'Something went wrong', 'error' => true], 400);
    }

    /**
     * Function: availabilityTime
     * Functionality: This Fnc will get the consultant availablity time
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function availabilityTime(Request $request)
    {
        $response = $this->consultantService->consultantAvailabilityTime();

        return Response::json($response, $response['status']);
    }
}
