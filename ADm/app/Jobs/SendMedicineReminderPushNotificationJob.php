<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\PushNotificationService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMedicineReminderPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationData;

    protected $deviceTokenIds;
    
    /**
     * Create a new job instance.
     * 
     * @param array $pshNotificationData
     * @param array $fcmTokenIds
     *
     * @return void
     */
    public function __construct($pshNotificationData, $fcmTokenIds)
    {
        $this->notificationData = $pshNotificationData;
        $this->deviceTokenIds = $fcmTokenIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->notificationData as $data) {

            $notificationDat[] = [
                'notification_template_id' => 2,
                'notification_to' => $data['user_id'],
                'notification_to_guard' => 'users',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        \App\Models\Notification::insert($notificationDat);

        $notificationTemplate = \App\Models\NotificationTemplate::find(2);

        $pushNotificationData = [
            'title' => $notificationTemplate->title,
            'body' => $notificationTemplate->body,
            'image' => $notificationTemplate->notification_image,
            'data' => [
                'notification_type' => 'medicine_tracker'
            ]
        ];

        try {

            new PushNotificationService($pushNotificationData, $this->deviceTokenIds);
        
        } catch (\Exception $e) {

            \Log::channel('pushnotification')->info('Error from medicine reminder', ['error' => $e]);
            
        }
    }
}
