<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\NotificationTemplate;
use App\Jobs\SendNotificationUserOrNutritionist;
use App\Models\User;
use App\Models\Nutritionist;
use DB;
class NotificationController extends Controller
{
   public function NotificationList(){
      $allNotification = NotificationTemplate::all();
      $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      return view('notifications.list', ['allNotifications' => $allNotification, 'status' => $status]);
  }


  public function addNotification(){
      $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      $allUsers = User::get();
      $allNutritionists = Nutritionist::ACTIVE_NUTRITIONIST();
      $reminder = DB::table('md_dropdowns')->where(['module'=>'tracker'])->get();
      return view('notifications.add', ['status' => $status,'allUsers'=>$allUsers,'reminders'=>$reminder,'allNutritionists'=>$allNutritionists]);
  }


  public function saveNotification(Request $request){
      // dd($request->all());   
     $NotificationTemplate = new NotificationTemplate();
     $NotificationTemplate->title = $request->title;
     
     $nameToLowercase = strtolower($request->title);
     $slug = str_replace(' ', '_', $nameToLowercase);
     $NotificationTemplate->slug = $slug;
     $NotificationTemplate->body = $request->body;
     $NotificationTemplate->notification_type = $request->notification_type;
     //$NotificationTemplate->notification_type_id = $request->notification_type_id;
     $NotificationTemplate->status = $request->status;
     if ($request->file("thumbnail")) {
        $NotificationTemplateImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $NotificationTemplateImage->getClientOriginalExtension();
        $NotificationTemplateImage->move("images/NotificationTemplate", $thumbnail);
        $NotificationTemplate->notification_image = env('IMAGE_BASE_URL') . '/images/NotificationTemplate/' . $thumbnail;
    }

    if ($NotificationTemplate->save()) {


        if(isset($request->is_user)){
           if ($request->users != "") {
               foreach ($request->users as $key => $id) {
                  $Notification = new Notification();
                  $Notification->notification_template_id = $NotificationTemplate->id;
                  $Notification->notification_to = $id;
                  $Notification->notification_to_guard = 'users';
                  $Notification->notification_from = '1';
                  $Notification->notification_from_guard = 'admins';
                  $Notification->save();
              }
          }


      }

      if(isset($request->is_nutritionist)){
       if ($request->is_nutritionist != "") {
           foreach ($request->nutritionists as $key => $id) {
              $Notification = new Notification();
              $Notification->notification_template_id = $NotificationTemplate->id;
              $Notification->notification_to = $id;
              $Notification->notification_to_guard = 'web_users';
              $Notification->notification_from = '1';
              $Notification->notification_from_guard = 'admins';
              $Notification->save();
          }
      }


  }



  return redirect()->route('notification_list')->with(['success' => 'Notification  has been created successfully!']);
} else {
 return redirect()->back()->with('warning', 'Something went wrong!');
}           


}


public function viewNotification($id){
    $data = NotificationTemplate::with('Notification')->where('id', $id)->first();

    $getAllNotificationsUserId = Notification::where(['notification_template_id'=>$id,'notification_to_guard'=>'users'])->pluck('notification_to')->toArray(); 
    $getAllNotificationsNutritionistId = Notification::where(['notification_template_id'=>$id,'notification_to_guard'=>'web_users'])->pluck('notification_to')->toArray();  
    $allUsers = User::get();
    $allNutritionists = Nutritionist::ACTIVE_NUTRITIONIST();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    $reminders = DB::table('md_dropdowns')->where(['module'=>'tracker'])->get();
    return view('notifications.view', compact('status', 'data','allUsers','getAllNotificationsUserId','reminders','allNutritionists','getAllNotificationsNutritionistId'));
}

public function editNotification($id){
   
  $data = NotificationTemplate::with('Notification')->where('id', $id)->first();
  $getAllNotificationsNutritionistId = Notification::where(['notification_template_id'=>$id,'notification_to_guard'=>'web_users'])->pluck('notification_to')->toArray(); 

  $getAllNotificationsUserId = Notification::where(['notification_template_id'=>$id,'notification_to_guard'=>'users'])->pluck('notification_to')->toArray();  
  $allUsers = User::get();
  $allNutritionists = Nutritionist::ACTIVE_NUTRITIONIST();
  $reminders = DB::table('md_dropdowns')->where(['module'=>'tracker'])->get();
  $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
  return view('notifications.edit', compact('status', 'data','allUsers','getAllNotificationsUserId','reminders','getAllNotificationsNutritionistId','allNutritionists'));
  
}

public function deleteNotification(Request $request){
   $Test = NotificationTemplate::where('id', $request->id)->first();
   if ($Test) {
    $Test->delete();
    return response()->json([
        'success' => 1,
    ]);
} else {
    return response()->json([
        'success' => 0,
    ]);
} 
}


public function updateNotification( Request $request){
 
  // dd($request->all());

 $NotificationTemplate = NotificationTemplate::where('id',$request->notification_id)->first();
 $NotificationTemplate->title = $request->title;
 $NotificationTemplate->body = $request->body;
 $NotificationTemplate->notification_type = $request->notification_type;
 //$NotificationTemplate->notification_type_id = $request->notification_type_id;
 $NotificationTemplate->status = $request->status;
 if ($request->file("thumbnail")) {
    $NotificationTemplateImage = $request->file("thumbnail");
    $thumbnail = time() . "." . $NotificationTemplateImage->getClientOriginalExtension();
    $NotificationTemplateImage->move("images/NotificationTemplate", $thumbnail);
    $NotificationTemplate->notification_image = env('IMAGE_BASE_URL') . '/images/NotificationTemplate/' . $thumbnail;
}

if ($NotificationTemplate->save()) {
    Notification::where('id',$request->notification_id)->delete();
    if ($request->users != "") {
       foreach ($request->users as $key => $id) {
          $Notification = new Notification();
          $Notification->notification_template_id = $NotificationTemplate->id;
          $Notification->notification_to = $id;
          $Notification->notification_to_guard = 'users';
          $Notification->notification_from = '1';
          $Notification->notification_from_guard = 'admins';
          $Notification->save();
      }
  }



  return redirect()->route('notification_list')->with(['success' => 'Notification  has been updated successfully!']);
} else {
 return redirect()->back()->with('warning', 'Something went wrong!');
}

}



public function sendNotification(){
      $allNotificationTemplate = NotificationTemplate::where('status',1)->get();
      $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      $allUsers = User::get();
      $allNutritionists = Nutritionist::ACTIVE_NUTRITIONIST();
      return view('notifications.send', ['allNotificationTemplates' => $allNotificationTemplate, 'status' => $status,'allUsers'=>$allUsers,'allNutritionists'=>$allNutritionists]);  
}

public function sendStoreNotification(Request $request){
         dispatch(new SendNotificationUserOrNutritionist($request->all()));
        return redirect()->route('notification_list')->with(['success' => 'Notification  has been send successfully!']);
 
}

} 
