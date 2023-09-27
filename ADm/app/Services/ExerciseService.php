<?php

namespace App\Services;

use App\Http\Resources\DailyExerciseResource;
use App\Http\Resources\ExerciseResource;
use App\Models\UserFavouriteExercise;
use App\Models\UserDailyExercise;
use App\Models\UserExercise;
use App\Models\Exercise;

class ExerciseService {

    /**
     * Function: addFavOrGetExercise
     * Functionality: This fnc can search or add exercise to favrouite
     *
     *
     * @return array
     */
    public function addFavOrGetExercise($request):array
    {
        $paginateOffset = (isset($request->page)) ? ($request->page * 20) - 20 : 0;

        if (isset($request->favourite)) {

            UserFavouriteExercise::updateOrCreate(['user_id' => auth()->id(), 'exercise_id' => $request->exercise_id]);
            $responseData = "Exercise successfully added to favrourite";

        } else {

            $exerciseOrNot = ($request->search == '') ? null : $request->search;

            $exercises = Exercise::select('id', 'title', 'calories_burnt', 'duration_in_minutes')
                ->when($exerciseOrNot != '', function ($qr) use ($exerciseOrNot) {
                    $qr->where('title', 'LIKE', "%$exerciseOrNot%")->get();
                })
                ->offset($paginateOffset)
                ->limit(20)
                ->status()
                ->get();

            $responseData = ($exercises->isEmpty()) ? null : ExerciseResource::collection($exercises);
        }

        return ['status' => 200, 'success' => true, 'data' => $responseData, 'error' => false];
    }

    /**
     * Function: getUserFavouriteExercises
     * Functionality: This fnc will get the Favourite exercise
     *
     * @return array
     */
    public function getUserFavouriteExercises():array
    {
        $exercises = auth()->user()->favouriteExercises;

        return ['status' => 200, 'success' => true, 'data' => ($exercises->isEmpty()) ? null : ExerciseResource::collection($exercises), 'error' => false];
    }

    /**
     * Function: getUserFavouriteExercises
     * Functionality: This fnc will get the Favourite exercise of
     * the app user
     *
     * @return array
     */
    public function saveExerciseBasedOnDate():array
    {
        try {

            $date = (isset(request()->date)) ? now()->parse(request()->date)->format('Y-m-d') : today();

            $dailyExercise = new UserDailyExercise;
            $dailyExerciseInfo = $dailyExercise->createOrGetExercise($date);

            $userExercise = new UserExercise;
            $userExercise->saveExercise($dailyExerciseInfo->id);

            return ['status' => 200, 'success' => true, 'data' => 'Exercise successfully updated', 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: getAddedExerciseBasedOnDate
     * Functionality: This Fnc will fetch the user's added's
     * exercise based on the date.
     *
     * @return array
     */
    public function getAddedExerciseBasedOnDate():array
    {
        $exercises = auth()->user()->currentDayExercise(request()->date)->with(['exercises.exercise'])->first();
        $responseData = ($exercises == null) ? [] : DailyExerciseResource::collection(UserExercise::where('user_daily_exercise_id', $exercises->id)->with('exercise')->get());

        return ['status' => 200, 'success' => true, 'data' => $responseData, 'error' => false];
    }

    /**
     * Function: deleteAddedExerciseBasedOnDate
     * Functionality: This Fnc will delete the added exercise by the
     * user based on the date
     *
     * @return array
     */
     public function deleteAddedExerciseBasedOnDate():array
     {
        try {

            UserExercise::find(request()->exercise_id)->delete();

            return ['status' => 200, 'success' => true, 'message' => 'Exercise deleted successfully', 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => true, 'message' => 'Something went wrong', 'error' => true];
        }
     }
}
