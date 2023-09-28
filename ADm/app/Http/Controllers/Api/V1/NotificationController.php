<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Response;
use App\Services\NotificationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;


    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Function: index
     * Functionality: It will fetch notification list from DB
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function index(Request $request)
    {
        $response = $this->notificationService->listNotification();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: delete
     * Functionality: This function will delete the notification permanantly
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function delete(Request $request)
    {
        $response = $this->notificationService->deleteNotification();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: read
     * Functionality: This function will change the status of notification to read
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function read(Request $request)
    {
        $response = $this->notificationService->changeNotificationReadStatus();

        return Response::json($response, $response['status']);
    }


    public function sendTestPushNotification(Request $request)
    {
         
        $url = 'https://api.edamam.com/api/food-database/v2/parser';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }
}
