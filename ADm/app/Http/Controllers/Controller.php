<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Str;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function pushnotification($deviceToken, $title, $message, $matchID, $data=null) {

        \Log::debug("Push Notification Sent");

        $serverkey = 'AAAAj6YdEwc:APA91bEbYZIByeMPr8cxbZd2M5l6vD7AWUc-rn5JS9PkmPNTcXol-ililwztyW-TcXtYGP1kVNC136I4mddc9exCMLKnXNK-df1RJXegJxXFCov1z3txzbHlMJxsiplkRioT1s8IYw1V';

        $url = 'https://fcm.googleapis.com/fcm/send';

        if($title!='Incoming Call'){
            $fields = [
                'to' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $message,
                ],
                'data' => $data
            ];
        }else{
            $fields = [
                'to' => $deviceToken,
                'data' => $data
            ];
            // $fields = [
            //     'to' => $deviceToken,
            //     // 'notification' => [
            //     //     'title' => $title,
            //     //     'body' => $message,
            //     // ],
            //     'data' => $data
            // ];
        }


        $headers = array(
            'Authorization: key='.$serverkey,
            'Content-Type: application/json'
        );
        \Log::info("Notification Payload", ['Fields' => $fields]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        \Log::info('FCM Notification Result: ', ['Result' => $result]);

        if ($result === FALSE)  {
            \Log::info('FCM Notification Error: ', ['FCM Error' => curl_error($ch)]);
        }
        else {
            \Log::debug('FCM Notification Sent Successfully.....!!!!!!!!');
        }
        curl_close($ch);

        // return $result;
    }


    public function pushnotificationIOS($device_token, $title, $message, $matchID, $data=null){

        $ch = curl_init();
        $body ['aps'] = array (
                       'title' => $title,
                       'message' => $message,
                       'data' => $data
        );
        $base_path =  public_path();//die;
        $pushCertAndKeyPemFile = $base_path. '/VOIP-Certificates.pem';

        $curlconfig = array(
            CURLOPT_URL => "https://api.development.push.apple.com/3/device/$device_token",//development
            // CURLOPT_URL => "https://api.push.apple.com/3/device/$device_token",//development
            CURLOPT_RETURNTRANSFER =>true,
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_SSLCERT =>$pushCertAndKeyPemFile,
            CURLOPT_SSLCERTPASSWD => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
            CURLOPT_VERBOSE => true
        );
        curl_setopt_array($ch, $curlconfig);
        $res = curl_exec($ch);
        if ($res === FALSE) {
               //echo('Curl failed: ' . curl_error($ch));die;
        }else{
           // echo "<pre>";print_r($res);die;
            //echo "done";
        }
        curl_close($ch);
       // return true;
    }

    public function generateOTP()
    {
        return rand(1000, 9999);
    }

    public function generateRandomString(int $charLength = null)
    {
        return Str::random(($charLength) ? $charLength : 40);
    }
}
