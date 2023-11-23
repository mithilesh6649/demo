<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;
use App\Models\AppointmentMetaData;
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected  $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Appdetails)
    {
       $this->details = $Appdetails;
   }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $appointmentId =  $this->details['id']; //'7';


        $appointmentDetails = AppointmentMetaData::with('Appointment.User', 'Appointment.Nutritionist')->where('id', $appointmentId)->first();
         $zoomLink = $appointmentDetails['appointment_join_url'];
         $appointmentTime =  $appointmentDetails['appointment_time'];
         $startTime = $appointmentDetails['start_time'];
         $endTime = $appointmentDetails['end_time'];
         $UserEmail = $appointmentDetails['Appointment']['User']['email'];
         $UserName = $appointmentDetails['Appointment']['User']['name'];
         $NutritionistEmail = $appointmentDetails['Appointment']['Nutritionist']['email'];
         $NutritionistName = $appointmentDetails['Appointment']['Nutritionist']['name'];

         $allDetails = array(
              'zoomLink' => $zoomLink,
              'appointmentTime' => $appointmentTime,
              'startTime' => $startTime,
              'endTime' => $endTime,
              'NutritionistEmail'=>$NutritionistEmail,
              'NutritionistName'=>$NutritionistName,
              'UserEmail'=>$UserEmail,
              'UserName'=>$UserName,
          );
         
          Appointment::SendMailToUser($allDetails);
          Appointment::SendMailToNutritionist($allDetails);
          
        
 }
    }
