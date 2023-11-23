<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;
use App\Models\NotificationTemplate;
use Log;

class SendNotificationUserOrNutritionist implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $getData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($requestedData)
    {
        $this->getData = $requestedData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Log::info($this->getData['notification_template']);
        $NotificationTemplate = NotificationTemplate::where('id', $this->getData['notification_template'])->first();
        $NotificationTemplate->body = $this->getData['body'];
        $NotificationTemplate->update();
        if (isset($this->getData['is_user'])) {
            if ($this->getData['users'] != "") {
                foreach ($this->getData['users'] as $key => $id) {
                    $Notification = new Notification();
                    $Notification->notification_template_id = $this->getData['notification_template'];
                    $Notification->notification_to = $id;
                    $Notification->notification_to_guard = 'users';
                    $Notification->notification_from = '1';
                    $Notification->notification_from_guard = 'admins';
                    $Notification->save();
                }
            }

        }

        if (isset($this->getData['is_nutritionist'])) {
            if ($this->getData['is_nutritionist'] != "") {
                foreach ($this->getData['nutritionists'] as $key => $id) {
                    $Notification = new Notification();
                    $Notification->notification_template_id = $this->getData['notification_template'];
                    $Notification->notification_to = $id;
                    $Notification->notification_to_guard = 'web_users';
                    $Notification->notification_from = '1';
                    $Notification->notification_from_guard = 'admins';
                    $Notification->save();
                }
            }

        }

    }
}
