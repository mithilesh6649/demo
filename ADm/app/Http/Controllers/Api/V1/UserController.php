<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Services\UserServices;

class UserController extends Controller
{
    protected $userServices;

    /**
     * Dependency of UserServices
     */
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * Function: index
     * Functionality: get user profile
     */
    public function index()
    {
        $response = $this->userServices->userProfile();
        return Response::json($response, $response['status']);
    }

    /**
     * Fnc manageNotification will enable/disable the device notification
     * Change Email/Push notification
     *
     * @param \Illuminate\Http\Request $request
     */
    public function manageNotification(Request $request)
    {
        $response = $this->userServices->manageNotification($request->all());

        return Response::json($response, $response['status']);
    }

    /**
     * Function: update
     * Functionality: Update the user object
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $response = $this->userServices->updateProfile($request->all());
        return Response::json($response, $response['status']);
    }

    /**
     * Function: updateProfile
     * Functionality: Update the new Phone number/email of the user
     *
     * @param \Illuminate\Http\Request $request
     */
    public function updateProfile(Request $request)
    {
        $response = $this->userServices->updateProfileEmailOrPhone($request->all());

        return Response::json($response, $response['status']);
    }

    /**
     * Function: saveHealthStatus
     * Functionality: Save the data for health status and calculating BMI
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function saveHealthStatus(Request $request)
    {
        $response = $this->userServices->saveHealthStatusInput($request);

        return Response::json($response, $response['status']);
    }
}
