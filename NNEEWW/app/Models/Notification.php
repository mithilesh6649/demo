<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Notification extends Model
{
    use HasFactory;

    //7 is the id of appointment scheduled from notification_templates.......
    const appointmentScheduled = '7';
    const appointmentUpdated = '8'; 
    const appointmentCancelled = '9';  


    public function StoreNotificaiton($notification_template_id =1,$notification_to=1,$notification_to_guard='',$notification_from=1,$notification_from_guard='',$read=1){
           $newNotification = new Notification;
           $newNotification->notification_template_id = $notification_template_id;
           $newNotification->notification_to = $notification_to;
           $newNotification->notification_to_guard = $notification_to_guard;
           $newNotification->notification_from = $notification_from;
           $newNotification->notification_from_guard = $notification_from_guard;
           $newNotification->read = $read; 
           $newNotification->save();  
    }
}
