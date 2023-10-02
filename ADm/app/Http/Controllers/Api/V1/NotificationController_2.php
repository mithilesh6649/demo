<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\UserMessage;
use App\Models\AdminNotification;
use App\Models\AdminNotificationUser;
use App\Models\User;

class NotificationsController extends Controller
{
    public function notificationList(){
        $notifications = AdminNotification::orderBy('id', 'Desc')->get()->toArray();
        return view('notifications.list', ['notifications' => $notifications]);
    }

    public function viewNotification($id){
        $notification = AdminNotification::where('id', $id)->first();
        //echo"<pre>";print_r($notification->toArray());die;
        return view('notifications.view', ['notification' => $notification]);
    }

    public function fetchUsersList(Request $request){

        $term = $request->post('search');
        $users = User::where('email','LIKE','%'.$term.'%')->where('role','2')->whereNull('is_deleted')->get();

        $result = [];
        if($users->isNotEmpty()){
            foreach($users as $key => $value){
                $result[] = ['text' => $value->email, 'value' => $value->id];
            }
        }

        return json_encode($result);
    }    

      /**
     * This function is used to Add Job Seeker
    */
    // public function add() {

    //  if(Auth::user()->can('add_app_user')) {
    //      return view('app_users/add');
    //  }else{
    //      return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    //  }
    // }

    public function addNotification(){
        return view('notifications/add');
    }


    public function sendNotification(Request $request){
        //echo"<pre>";print_r($request->all());die;
        if($request->has('all_users') && $request->all_users == 'on'){
            $users = User::get()->toArray();
        }else{
            if($request->has('users') && !empty($request->users)){
                $users = User::whereIn('id', $request->users)->get()->toArray();
            }else{
                return back()->with('error', 'Select Users');
            }
        }

        $subject = $request->notification_subject;
        $message = $request->notification_message;

        $adminNotification = new AdminNotification;
        $adminNotification->subject = $subject;
        $adminNotification->message = $message;
        $adminNotification->save();

        foreach($users as $key => $user){
            $adminNotificationUser = new AdminNotificationUser;
            $adminNotificationUser->admin_notifications_id = $adminNotification->id;
            $adminNotificationUser->user_id = $user['id'];
            $adminNotificationUser->save();

            if($user['device_type'] == '1'){
                $this->sendPushNotification($user['fcm_token'],$message,['message' => $message]);
            }elseif($user['device_type'] == '2'){
                $this->iospushnotification($user['fcm_token'],$message,['message' => $message]);
            }
        }

        return redirect()->route('notification_list')->with('success', 'Notification Sent Successfully!');
    }
    
    public function sendPushNotification($token,$msg="",$data=array()) {
     //echo $token;die;
     
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            "registration_ids" => array(
                $token
            ),
           "notification" => array(
               "body" => $msg,
               "sendby" => "Wantwire",
               "establishment_detail" => "Wantwire",
               "type" => "Wantwire",
               "content-available" => 1,
               "badge" => 0,
               "sound" => "default",
               "data" => $data
           ),
            "data" => array(
               "body" => $msg,
               "sendby" => "Wantwire",
               "establishment_detail" => "Wantwire",
               //"type" => "Wantwire",
               "content-available" => 1,
               "badge" => 0,
               "sound" => "default",
               //"type"=> $type,
               "data"=>$data,
               "base_url"=>url("/")
            ),
            "priority" => 1
        );
       //echo "<pre>";print_r($fields);die;
        $fields = json_encode($fields);
        $firebaseKey = env('FIREBASE_KEY');
       
        $headers = array(
           'Authorization: key=' . $firebaseKey,
           'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        //echo "<pre>";print_r($result);die;
        return $result;
    }

    public function iospushnotification($token,$msg="",$data=array()) {

        $url = 'https://fcm.googleapis.com/fcm/send';
        $notification = [
           'sound' => 'Default',
           //"type"=> $type,
           "base_url"=>url("/"),
           "body" => $msg,
           "title" => "Wantwire",
           //"click_action" => $type,
           "data"=>$data
        ];
        $fields = array(
           'to' => $token,
           'notification' => $notification,
           
        );
        $fields = json_encode($fields);
        $firebaseKey = env('FIREBASE_KEY');
        $headers = array(
           'Authorization: key=' . $firebaseKey,
           'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        curl_close($ch);
        // print_r($result);die;
        return $result;
    }

}
