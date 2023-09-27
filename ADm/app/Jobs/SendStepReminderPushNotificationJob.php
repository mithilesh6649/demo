<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\PushNotificationService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendStepReminderPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    protected $fcmTokens;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $fcmTokens)
    {
        $this->fcmTokens = $fcmTokens;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stepReminder = $this->data;

        foreach ($stepReminder as $step) {

            \DB::table('step_reminders')->where('user_id', $step->user_id)->update(['cron_time' => now()->parse($step->cron_time)->addDay()]);
        }

        //TODO: Send Push notification from here
        $notificationTemplate = \App\Models\NotificationTemplate::find(5);

        $notificationData = [
            'title' => $notificationTemplate->title,
            'body' => $notificationTemplate->body,
            'image' => $notificationTemplate->notification_image,
            'data' => [
                'notification_type' => 'step_tracker'
            ]
        ];

        new PushNotificationService($notificationData, $this->fcmTokens);
    }
}
