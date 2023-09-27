<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\PushNotificationService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWeightReminderPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationData;

    protected $fcmTokens;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($notificationData, $fcmTokens)
    {
        $this->notificationData = $notificationData;
        $this->fcmTokens = $fcmTokens;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notificationTemplate = \App\Models\NotificationTemplate::find(4);

        $notificationData = [
            'title' => $notificationTemplate->title,
            'body' => $notificationTemplate->body,
            'image' => $notificationTemplate->notification_image,
            'data' => [
                'notification_type' => 'weight_tracker'
            ]
        ];

        new PushNotificationService($notificationData, $this->fcmTokens);
    }
}
