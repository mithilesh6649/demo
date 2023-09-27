<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Mail\SendTransactionEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\SendMobileOTP;
use Illuminate\Support\Str;
use Mail;

class SendNotificationToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationType;

    protected $notificationData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($notificationType, $notificationData)
    {
        $this->notificationType = $notificationType;
        $this->notificationData = $notificationData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = config('common.notification_message.'.$this->notificationType.'.phone');
        $message = Str::replaceArray('?', [($this->notificationData['user_name'] == '') ? ' ' : $this->notificationData['user_name']], $message);
        
        if ($this->notificationData['phone_number'] != '' || $this->notificationData['phone_number'] != null) {

            SendMobileOTP::sendOTPToPhoneNumber($this->notificationData, $message);
        }

        if($this->notificationData['user_email'] != '' && $this->notificationData['user_email'] != null) {

            $emailData = [
                'message_body' => $message,
                'user_data' => $this->notificationData
            ];

            Mail::to($this->notificationData['user_email'])->send(new SendTransactionEmailNotification($emailData));
        }
    }
}
