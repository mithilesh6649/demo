<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','invitee_id','status'];
    CONST appointment_requested = 1;
    CONST appointment_scheduled = 2;
    CONST appointment_end = 3;
    CONST appointment_cancel = 12;

    public function AppointmentMetaData(){
        return $this->hasOne(AppointmentMetaData::class);
    }
 
    public function metadata()
    {
        return $this->hasMany(AppointmentMetaData::class, 'appointment_id', 'id');
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function  Nutritionist(){
     return $this->belongsTo(Nutritionist::class,'invitee_id');
 }

   //Get URL 

 CONST   CLIENT_ID ='V8BIrV0vSEyBiMK8YuwZfA';
 CONST   CLIENT_SECRET ='f28fQWsI23s6KTSMHSojJGwaipNrcnyS';
 CONST   REDIRECT_URI='https://server3.rvtechnologies.in/Gena-HealthX/admin/public/zoom-authentication'; 


 public function clientId(){
    return  ConfidentialApiKey::where(['slug'=>'zoom','key_slug'=>'zoom_client_id'])->value('value'); 
}

public function clientSecret(){
    return  ConfidentialApiKey::where(['slug'=>'zoom','key_slug'=>'zoom_client_secret'])->value('value'); 
}

public function redirectUrl(){
  return  url('zoom-authentication');
}

public function secretToken(){
    return  ConfidentialApiKey::where(['slug'=>'zoom','key_slug'=>'zoom_secret_token'])->value('value'); 
}

   // Check Appointment Exists or  Not


public function checkAppointmentExistOrNot($nutritionist_id,$appoinment_date,$start_time,$end_time,$metadataid=null){

    $appointment_check =  Appointment::where('invitee_id',$nutritionist_id)
       ->with('metadata',function($q) use ($start_time,$end_time){
        $q->whereBetween('start_time', [$start_time, $end_time])
        ->orWhereBetween('end_time', [$start_time, $end_time]);
    })->whereHas('metadata',function($que)use($appoinment_date,$start_time,$end_time,$metadataid){ 
       $que->where('status',2)->where('id','!=',$metadataid)
       ->whereDate('appointment_time', $appoinment_date);
    })->get();
 
     
     if(count($appointment_check)){
            
            $array = json_decode($appointment_check, true);
            $filteredArray = array_filter($array, function($obj) {
                return !empty($obj['metadata']);
            });
            if(count($filteredArray)){
              return true;
            }else{
              return false;
            }  
     }


}


 public function create_time_range($start, $end, $interval = '30 mins', $format = '24')
    {
        $startTime = strtotime($start);
        $endTime = strtotime($end);
        $returnTimeFormat = ($format == '12') ? 'g:i:s A' : 'G:i:s';

        $current = time();
        $addTime = strtotime('+' . $interval, $current);
        $diff = $addTime - $current;

        $times = array();
        while ($startTime < $endTime) {
            $times[] = date($returnTimeFormat, $startTime);
            $startTime += $diff;
        }
        $times[] = date($returnTimeFormat, $startTime);
        return $times;
    }


        public function SendMailToUser($allDetails){ 
         $allDetails['form'] = 'user_function'; 
         $data = array('details'=>$allDetails);
         \Mail::send(['html' => 'mail'],$data, function ($message) {
            $message->to('mithilesh_kumar@rvtechnologies.com', 'Mithilesh S1')->subject
            ('Gena Health X Appointment');
            $message->from('mithileshkumar6649@gmail.com', 'Mithilesh S2');
        }); 

     } 


     public function SendMailToNutritionist($allDetails){
        $allDetails['form'] = 'nutritionist_function';  
        $data = array('details'=>$allDetails);
        \Mail::send(['html' => 'mail'],$data, function ($message) {
            $message->to('mithilesh_kumar@rvtechnologies.com', 'Mithilesh S1')->subject
            ('Gena Health X Appointment');
            $message->from('mithileshkumar6649@gmail.com', 'Mithilesh S2');
        });
    }   








 




}
