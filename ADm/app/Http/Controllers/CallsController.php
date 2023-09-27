<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\AgoraDynamicKey\RtcTokenBuilder;
use App\Events\MakeAgoraCall;
use App\Models\Call;
use App\Models\User;
use App\Models\UserImage;
use App\Models\ProfileLike;
use App\Models\Feedback;
use App\Models\Notification;
use Twilio\Rest\Client;

use Carbon\Carbon;

use Validator;
use Auth;

class CallsController extends Controller {

  /**
   * This function is used to make an outgoing call
    */
    public function callUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'receiver_user_id' => 'required',
            'type' => 'required',
        ]);
        if($validator->fails()) {
            $response['status'] = false;
            $response['message'] = $validator->errors()->first();
            return $response;
        }
        else {

            {
                $channelName = \Str::random(12);
                $appID = env('AGORA_APP_ID');
                $appCertificate = env('AGORA_APP_CERTIFICATE');

                $channelName = $channelName;
                $user = Auth::user()->name;
                $role = RtcTokenBuilder::RoleAttendee;
                $expireTimeInSeconds = 3600;
                $currentTimestamp = now()->getTimestamp();
                $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

                $token = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);

            }

            $data['userToCall'] = $request->receiver_user_id;
            $data['channelName'] = $request->channel_name;
            $data['from'] = Auth::id();

            $callDetails = new Call;
            $callDetails->call_by_id = Auth::id();
            $callDetails->call_to_id = $request->receiver_user_id;
            $callDetails->called_on = Carbon::now();
            $callDetails->called_on_time = date('Y-m-d\TH:i:s.ZZZ\Z', time());
            $callDetails->type = $request->type;
            if($callDetails->save()) {
                $callDetail = Call::find($callDetails->id);
                $callingUser = User::find(Auth::id());
                $otherUser = User::find($request->receiver_user_id);
                $deviceToken = $otherUser->device_token;
                $title = "Incoming Call";
                $message = $callingUser->first_name." is calling you!";
                $notificationType = "incoming_call";
                $sender = User::find(Auth::id());


                $senderName = $sender->first_name.' '.$sender->last_name;
                $senderImage = $sender->profile_picture;

                $uuid = $request->has('uuid')?$request->uuid:'';

                $data = [
                    'caller_id' => $sender->id,
                    'receiver_user_id' => $otherUser->id,
                    'caller_name' => $senderName,
                    'caller_image' => $senderImage,
                    'call_id' => $callDetails->id,
                    'channel_name' => $channelName,
                    'token' => $token,
                    'type' => $request->type,
                    'notificationType' => $notificationType,
                    'uuid' => $uuid,
                ];


                if($otherUser->device_type=='1' || $otherUser->device_type==1){
                    $this->pushnotification($deviceToken, $title, $message, null, $data);
                }else{
                    $this->pushnotificationIOS($otherUser->voip_token, $title, $message, null, $data);
                }

                // save notification
                // $notification = new Notification;
                // $notification->title = $title;
                // $notification->message = $message;
                // $notification->sender_id = $sender->id;
                // $notification->receiver_id = $otherUser->id;
                // $notification->type = 'incoming_call';
                // $notification->notification_time = date('Y-m-d\TH:i:s.ZZZ\Z', time());
                // $notification->save();
                // save notification

                $response['status'] = true;
                $response['message'] = "Call Initiated!";
                $newCollection = collect(["token" => $token,
                                        'channel_name' => $channelName,
                                        'type' => $request->type,
                                        ]);

                $response['data'] = collect($callDetail)->merge($newCollection);
            }
            else {
                $response['status'] = false;
                $response['message'] = "Something went wrong!";
            }
            return $response;
        }
    }

    /**
     * This function is used to save Received Call Detils
    */
    public function receiveCall(Request $request) {
        $validator = Validator::make($request->all(), [
            'call_id' => 'required',
        ]);
        if($validator->fails()) {
            $response['status'] = false;
            $response['message'] = $validator->errors()->first();
            return $response;
        }
        else {
            $receiveCall = Call::where('id', $request->call_id)->update([
                'is_accepted' => 1,
                'is_answered' => 1,
                'received_at' => Carbon::now(),
                'start_time' => Carbon::now()->format('H:i:s'),
            ]);
            if($receiveCall) {
                $response['status'] = true;
                $response['message'] = "Call Received!";
                $response['data'] = Call::find($request->call_id);
            }
            else {
                $response['status'] = false;
                $response['message'] = "Something went wrong!";
            }
            return $response;
        }
    }

    /**
     * This function is used to save Declined Call Detils
    */
    public function declineCall(Request $request) {
        $validator = Validator::make($request->all(), [
            'call_id' => 'required',
        ]);
        if($validator->fails()) {
            $response['status'] = false;
            $response['message'] = $validator->errors()->first();
            return $response;
        }
        else {
            $receiveCall = Call::where('id', $request->call_id)->update([
                'is_accepted' => 0,
                'is_answered' => 1,
                'declined_at' => Carbon::now(),
            ]);

            if($receiveCall) {
                $callDetail = Call::find($request->call_id);

                $callerDeclined = Call::where("call_by_id", $request->user_id)
                                            ->where("id", $request->call_id)
                                            ->first();

                $reciverDeclined = Call::where("call_to_id", $request->user_id)
                                            ->where("id", $request->call_id)
                                            ->first();


                // if trial call then end trail period
                {
                    if($request->is_trial == true){

                        ProfileLike::where("user_id", $request->user_id)
                                    ->where("other_user_id", $callDetail->call_to_id)
                                    ->whereNotNull("recommended_by")
                                    ->update(["is_trial_end" => true]);

                        ProfileLike::where("other_user_id", $request->user_id)
                                    ->where("user_id", $callDetail->call_to_id)
                                    ->whereNotNull("recommended_by")
                                    ->update(["is_trial_end" => true]);

                        //create default feedback object
                        {
                            $feedback = new Feedback();
                            $feedback->user_id = $request->user_id;
                            $feedback->for_user_id = $callDetail->call_to_id;
                            $feedback->call_id = $request->call_id;
                            $feedback->save();

                            $feedback2 = new Feedback();
                            $feedback2->user_id = $callDetail->call_to_id;
                            $feedback2->for_user_id = $request->user_id;
                            $feedback2->call_id = $request->call_id;
                            $feedback2->save();
                        }
                    }
                }


                if(!is_null($callerDeclined)){
                    $notificationType = "caller_declined";

                    //Alter caller and reciever aac to notification
                    $receivingUser = User::find($callDetail->call_by_id);
                    $callingUser = User::find($callDetail->call_to_id);

                }else{
                    $notificationType = "receiver_declined";

                    //Alter caller and reciever aac to notification
                    $receivingUser = User::find($callDetail->call_to_id);
                    $callingUser = User::find($callDetail->call_by_id);
                }

                $deviceToken = $callingUser->device_token;
                $title = "Declined Call";
                $message = $receivingUser->first_name." declined your call!";

                $sender = $receivingUser;
                $userImage = UserImage::where('id', $sender->id)->where('image_type', 'profile_image')->first();
                $senderName = $sender->first_name.' '.$sender->last_name;
                $senderImage = $userImage != null ? $userImage->image_path.$userImage->image : url('/images/default.png');
                $otherData = [
                    'channel_name' => $request->channel_name,
                    'sender_id' => $sender->id,
                    'sender_name' => $senderName,
                    'sender_image' => $senderImage
                ];
                $this->pushnotification($deviceToken, $title, $message, null, $notificationType, $otherData);
                $response['status'] = true;
                $response['message'] = "Call Declined!";
                $response['data'] = Call::find($request->call_id);
            }
            else {
                $response['status'] = false;
                $response['message'] = "Something went wrong!";
            }
            return $response;
        }
    }

    /**
     * This function is used to Save Unanswered Call Detils
    */
    public function unansweredCall(Request $request) {
        $validator = Validator::make($request->all(), [
            'call_id' => 'required',
        ]);
        if($validator->fails()) {
            $response['status'] = false;
            $response['message'] = $validator->errors()->first();
            return $response;
        }
        else {
            $updateCall = Call::where('id', $request->call_id)->update([
                'is_accepted' => 0,
                'is_answered' => 0,
            ]);
            if($updateCall) {
                $response['status'] = true;
                $response['message'] = 'Call went unanswered!';
            }
            else {
                $response['status'] = false;
                $response['message'] = 'Something went wrong!';
            }
            return $response;
        }
    }

    /**
     * This function is used to save Call Detils on End call
    */
    public function disconnectCall(Request $request) {
        $validator = Validator::make($request->all(), [
            'disconnected_by' => 'required',
            'call_id' => 'required',
        ]);
        if($validator->fails()) {
            $response['status'] = false;
            $response['message'] = $validator->errors()->first();
            return $response;
        }
        else {
            $now = Carbon::now()->format('H:i:s');
            $callDetails = Call::find($request->call_id);
            $callStartTime = $callDetails->start_time;
            $duration = Carbon::parse($callStartTime)->diffInSeconds(Carbon::parse($now));
            $updateCallDetails = Call::where('id', $request->call_id)->update([
                'end_time' => $now,
                'call_duration_seconds' => $duration,
            ]);
            if($updateCallDetails) {
                $otherUser = null;
                if($request->disconnected_by == 'caller') {
                    $otherUser = User::find($callDetails->call_to_id);
                    $disconnectingUser = User::find(Auth::id());
                }
                else {
                    $otherUser = User::find(Auth::id());
                    $disconnectingUser = User::find($callDetails->call_to_id);
                }
                $deviceToken = $otherUser->device_token;
                $title = "Call Disconnected";
                $message = $disconnectingUser->first_name." has disconnected the call!";
                $notificationType = "call_disconnected";
                $sender = $disconnectingUser;
                $userImage = UserImage::where('id', $disconnectingUser->id)->where('image_type', 'profile_image')->first();
                $senderName = $disconnectingUser->first_name.' '.$disconnectingUser->last_name;
                $senderImage = $userImage != null ? $userImage->image_path.$userImage->image : url('/images/default.png');
                $otherData = [
                    'channel_name' => $request->channel_name,
                    'sender_id' => $sender->id,
                    'sender_name' => $senderName,
                    'sender_image' => $senderImage
                ];

                $a = $this->pushnotification($deviceToken, $title, $message, null, $notificationType, $otherData);
                $response['status'] = true;
                $response['message'] = "Call Disconnected!";
            }
            else {
                $response['status'] = false;
                $response['message'] = "Something went wrong!";
            }
            return $response;
        }
    }


    /**
     *  Generate token agora token
    */

    public function generateToken(Request $request)
    {

        //Generate channel name
        {
            $date = new \DateTime("now", new \DateTimeZone('UTC'));
            $channelName = $date->getTimestamp() + 24 * 3600;
        }

        $appID = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');

        $channelName = (string)($channelName);
        $user = Auth::user()->name;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 36000;
        $currentTimestamp = now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);

        if(!is_null($token)){
            $response['status'] = true;
            $response['message'] = "Token Generated!";
            $response['data'] = $token;
            $response['chanel_name'] = $channelName;

        }else{
            $response['status'] = false;
            $response['message'] = "Something wrong!";
            $response['data'] = null;
        }

        return $response;
    }


    public function callHistory(){
        try{

            $user_id = Auth::user()->id;

            $callList = Call::with('caller','receiver')->where(function($query) use ($user_id){
                            $query->where('call_by_id',$user_id);
                        })->orWhere(function($query2) use ($user_id){
                            $query2->where('call_to_id',$user_id);
                        })->orderBy('created_at','DESC')->paginate(10);

            $res = [
                'status' => 200,
                'data' => $callList,
            ];
            return response()->json($res,200);

        }catch (\Exception $e) {
            $error = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($error, 400);
        }
    }


    public function twilioCalls()
    {
        $sid = "AC0adc76f90fe82b022375f13c538e5e1b";
        $token = "5ed45996d04747a3a9af05dbc31db735";
        $twilio = new Client($sid, $token);

        $call = $twilio->calls
               ->create("+919557590293", // to
                        "+18175871251", // from
                        [
                            "twiml" => "<Response><Say>Hi, Nagendra. How are you?</Say></Response>"
                        ]
               );

        print($call->sid);
    }

    public function twilioWebhook(Request $request)
    {
        Log::info(['This is from Twilio Webhook' => $request->all()]);
    }

    public function zoomtest()
    {
        dd('hie');
    }

    public function zoomAuth(Request $request)
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);

        $response = $client->request('POST', '/oauth/token', [
            "headers" => [
                "Authorization" => "Basic ". base64_encode('2Cje4dGIRnq6QuYzviDDtA:FiKlNmMGilfl6YoBFdh9DRe771DWiptv')
            ],
            'form_params' => [
                "grant_type" => "authorization_code",
                "code" => $_GET['code'],
                "redirect_uri" => "https://28d3-111-93-38-130.ngrok.io/zoom-authentication"
            ],
        ]);

        $token = json_decode($response->getBody()->getContents(), true);

        dd($token);
    }

    public function testZoom()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiIzOTA0MTFhZC04OTAwLTQzZjItYjFmYS00NmU2ODhlZTIxNjMifQ.eyJ2ZXIiOjcsImF1aWQiOiI1MTYzMjkzMmY3NjU5YTc5ZGZkNTU4YTJhNDdkMWI1YyIsImNvZGUiOiJMa0RBT3NHbjN2ZGw5Y1hQTmVZUkZlbGxHaWwzNTZFd3ciLCJpc3MiOiJ6bTpjaWQ6MkNqZTRkR0lSbnE2UXVZenZpRER0QSIsImdubyI6MCwidHlwZSI6MCwidGlkIjowLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJzeVlCb0dST1NfS3FYMEprQWI2TmR3IiwibmJmIjoxNjczMjQ0NDA2LCJleHAiOjE2NzMyNDgwMDYsImlhdCI6MTY3MzI0NDQwNiwiYWlkIjoiZ1lLZFY3c0tScnlsWDE0dTFDTTNmZyIsImp0aSI6IjdkNGYzYTYzLTI0ZDgtNGUzMy05ZDQ5LWY3YmYxY2QxMTBmYiJ9.h6yP6zFxMWrBFml-WnP1rjfUYiFk0CBgV2OSE9eekMr3Qvg6SDZXKIMRp9Nno7eapXKD9kHOdp-XZ3kzfvRrjA"
            ],
            'json' => [
                "topic" => "Let's learn Laravel",
                "type" => 2,
                "start_time" => "2022-01-010T20:30:00",
                "duration" => "30", // 30 mins
                "password" => "123456"
            ],
        ]);

        $data = json_decode($response->getBody());

        dd($data);
    }
}
