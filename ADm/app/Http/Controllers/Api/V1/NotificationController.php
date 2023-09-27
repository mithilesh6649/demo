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
        // $weightReminderData = \DB::table('weight_reminders')
        // ->select('users.device_token', 'users.id AS user_id')
        // ->join('users', 'users.id', '=', 'weight_reminders.user_id')
        // ->where('weight_reminders.cron_time', '<', now())
        // ->where('weight_reminders.status', 1)
        // ->get()
        // ->toArray();

        // dd($weightReminderData);

        // $currentDateTime = now();
        // dump($currentDateTime);
        // $stepReminderData = \DB::table('step_reminders')
        // ->select('users.device_token', 'users.id AS user_id', 'step_reminders.cron_time')
        // ->join('users', 'users.id', '=', 'step_reminders.user_id')
        // ->where('step_reminders.cron_time', '<', $currentDateTime)
        // ->get()
        // ->toArray();

        // dd()
        // foreach ($stepReminderData as $stepReminderDat) {

        //     if ($stepReminderDat)
        // }
        // dd($stepReminderData);

        // $notificationData = [
        //     'title' => 'Hh',
        //     'body' => 'asdasdsd',
        //     'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/water_reminder1.png',
        //     'data' => [
        //         'notification_type' => 'medicine_tracker'
        //     ]
        // ];

        // new \App\Services\PushNotificationService($notificationData, ['d7R380sQSOirmJ3rrWR7Zb:APA91bHr7YgrOHk4MsnuelKlmHvVFIsCcPBJGfUM8KZSWAGsk_qzEIoTrhUQL2mQvxXMYonG2EB-6oosXTRz9ISHYEhS0YkKvVynvSsIo3QFkb_62m5plII8VAJxH2D2DGKAvIOUUgUV']);

        // $token = 'd7R380sQSOirmJ3rrWR7Zb:APA91bHr7YgrOHk4MsnuelKlmHvVFIsCcPBJGfUM8KZSWAGsk_qzEIoTrhUQL2mQvxXMYonG2EB-6oosXTRz9ISHYEhS0YkKvVynvSsIo3QFkb_62m5plII8VAJxH2D2DGKAvIOUUgUV';
        // $url = 'https://fcm.googleapis.com/fcm/send';
        // $serverKey = env('FIREBASE_SERVER_KEY');
        // $title = $push_notification_title ?? "New Physician Review";
        // $body = $push_notification_body ?? "Your case has been reviewed";

        // $notification = array('title' => $title, 'text' => $body, 'body' => $body, 'sound' => 'default', 'badge' => '1');
        // $data = array('user_id' => 'youruserid', 'name' => 'yohan'); // 👈 new array
        // $arrayToSend = array('to' => $token, 'notification' => $notification,
        //                     'priority' => 'high', 'data' => $data, 'content_available' => true);

        // $json = json_encode($arrayToSend);
        // $headers = array();
        // $headers[] = 'Content-Type: application/json';
        // $headers[] = 'Authorization: key=' . $serverKey;

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
