<?php

namespace App\Http\Controllers\Api\V1\Exercise;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\ExerciseService;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    protected $exerciseServices;

    public function __construct(ExerciseService $exerciseServices)
    {
        $this->exerciseServices = $exerciseServices;
    }

    /**
     * Function: addFavOrGetExercise
     * Functionaity: This fnc will get the list of searched
     * exercise or save the exercise to user favourite
     * list
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function addFavOrGetExercise(Request $request)
    {
        $response = $this->exerciseServices->addFavOrGetExercise($request);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: getFavouriteExercises
     * Functionaity: This fnc will get the list of user's
     * favourite exercise
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function getFavouriteExercises()
    {
        $response = $this->exerciseServices->getUserFavouriteExercises();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: saveExercise
     * Functionaity: This fnc will save the selected
     * exercise to his daily records
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function saveExercise(Request $request)
    {
        $response = $this->exerciseServices->saveExerciseBasedOnDate();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: getAddedExercise
     * Functionaity: This fnc will fetch the exercise records
     * based on the date
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function getAddedExercise(Request $request)
    {
        $response = $this->exerciseServices->getAddedExerciseBasedOnDate();

        return Response::json($response, $response['status']);
    }

     /**
     * Function: deleteAddedExercise
     * Functionaity: This fnc will delete the added exercise
     * based on the date
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function deleteAddedExercise(Request $request)
    {
        $response = $this->exerciseServices->deleteAddedExerciseBasedOnDate();

        return Response::json($response, $response['status']);
    }
}
